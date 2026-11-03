# /// script
# requires-python = ">=3.11"
# ///
"""Publish pages/ to WordPress. Usage: wp_sync.py push [--dry-run]

pages/site.json holds the front page and navigation menus (by ID), the wordpress.org
plugins to keep active, and our own PHP snippets (run by the Code Snippets plugin).
pages/manifest.json maps each page to a file, title, slug and status, plus the
optional "description" and "seo_title" that snippets/seo-head.php puts in the page head,
and "lang" / "alternate" (slug of the same page in the other language) for hreflang.
An entry with "type": "post" is a blog post (Journal) instead of a page; posts may also
list "categories" (WordPress category IDs) and a "date".
"parent_slug" (path of an already published page, e.g. "de") nests a page under it, which gives the
German pages their /de/ URLs; slugs are then looked up under that parent, so "journal" and
"de/projekt-journal" cannot be mixed up. A navigation entry in site.json without an "id" is created
by "slug" and found by it afterwards.
A page is addressed by its "id", or by slug when the entry has no id; a page that does not
exist yet is created once, then found by slug on every later run, so a run cannot produce
duplicates. An entry with status "trash" (no file needed) moves that page to the
WordPress trash. Needs WP_USER and WP_APP_PASSWORD; WP_URL is optional.
"""
import base64, json, os, sys, urllib.error, urllib.request

BASE = os.environ.get("WP_URL", "https://business.constructor.university/guillemots").rstrip("/")
PAGES = os.path.join(os.path.dirname(os.path.abspath(__file__)), "..", "pages")
AUTH = "Basic " + base64.b64encode(
    f"{os.environ['WP_USER']}:{os.environ['WP_APP_PASSWORD']}".encode()).decode()


def api(method, path, body=None, ns="wp/v2"):
    req = urllib.request.Request(
        f"{BASE}/wp-json/{ns}/{path}", method=method,
        data=json.dumps(body).encode() if body is not None else None,
        headers={"Authorization": AUTH, "Content-Type": "application/json",
                 "User-Agent": "dmfseo-sync"})
    try:
        with urllib.request.urlopen(req, timeout=60) as r:
            return json.load(r)
    except urllib.error.HTTPError as e:
        sys.exit(f"{method} {path}: HTTP {e.code} {e.read()[:300]!r}")


def kind(m):
    """REST collection for a manifest entry: "posts" for Journal posts, otherwise "pages"."""
    return "posts" if m.get("type") == "post" else "pages"


def meta(m):
    return {"grohnpetrel_description": m.get("description", ""),
            "grohnpetrel_title": m.get("seo_title", ""),
            "grohnpetrel_lang": m.get("lang", ""),
            "grohnpetrel_alternate": m.get("alternate", "")}


def parent_id(m):
    """WordPress ID of the parent page: "parent" (ID) or "parent_slug" (path of a published page), else 0."""
    if "parent_slug" in m:
        found = api("GET", f"pages?slug={m['parent_slug'].rsplit('/', 1)[-1]}&parent=0"
                           "&status=publish,draft,pending,private&context=edit")
        return found[0]["id"] if found else None  # None: parent not created yet (dry run)
    return m.get("parent", 0)


def find(m):
    """The page or post for a manifest entry: by "id" when given, otherwise by slug (any status).
    Pages are looked up under their parent, so the same slug can exist at several levels."""
    if "id" in m:
        return api("GET", f"{kind(m)}/{m['id']}?context=edit")
    q = f"{kind(m)}?slug={m['slug']}&status=publish,draft,pending,private&context=edit"
    if kind(m) == "pages":
        pid = parent_id(m)
        if pid is None:
            return None
        q += f"&parent={pid}"
    found = api("GET", q)
    return found[0] if found else None


def main(dry):
    manifest = json.load(open(os.path.join(PAGES, "manifest.json")))
    failed = False
    code(dry)
    for m in manifest:
        page = find(m)
        if page is None:  # no WordPress page with this ID or slug yet: create it once
            want = {"title": m["title"], "slug": m["slug"], "status": m["status"],
                    "content": open(os.path.join(PAGES, m["file"])).read(), "meta": meta(m)}
            for k in ("template", "parent", "categories", "date", "excerpt"):
                if k in m:
                    want[k] = m[k]
            if "parent_slug" in m and parent_id(m):
                want["parent"] = parent_id(m)
            print(f"{'would create' if dry else 'create'} {kind(m)[:-1]} {m['slug']} ({m['status']})")
            if not dry:
                res = api("POST", kind(m), want)
                if res["slug"] != m["slug"]:
                    print(f"  WARNING: WordPress gave slug {res['slug']!r}, wanted {m['slug']!r}", file=sys.stderr)
                    failed = True
            continue
        m = {**m, "id": page["id"]}
        if m["status"] == "trash":  # moved to the WordPress trash (recoverable there), never deleted
            if page["status"] == "trash":
                print(f"ok      {m['id']} trashed")
            else:
                print(f"{'would trash' if dry else 'trash'} {m['id']} {page['slug']}")
                if not dry:
                    api("DELETE", f"{kind(m)}/{m['id']}")
            continue
        path = os.path.join(PAGES, m["file"])
        want = {"title": m["title"], "slug": m["slug"], "status": m["status"],
                "content": open(path).read()}
        have = {"title": page["title"]["raw"], "slug": page["slug"], "status": page["status"],
                "content": page["content"]["raw"]}
        if "template" in m:
            want["template"], have["template"] = m["template"], page.get("template", "")
        if "parent" in m or "parent_slug" in m:
            want["parent"], have["parent"] = parent_id(m), page.get("parent", 0)
        if "categories" in m:
            want["categories"], have["categories"] = sorted(m["categories"]), sorted(page.get("categories", []))
        want["meta"] = meta(m)
        have["meta"] = {k: (page.get("meta") or {}).get(k, "") for k in want["meta"]}
        diff = [k for k in want if want[k] != have[k]]
        if not diff:
            print(f"ok      {m['id']} {m['slug']}")
            continue
        print(f"{'would update' if dry else 'update'} {m['id']} {m['slug']}: {', '.join(diff)}")
        if dry:
            continue
        res = api("POST", f"{kind(m)}/{m['id']}", {k: want[k] for k in diff})
        if res["slug"] != m["slug"] and m["status"] == "publish":
            print(f"  WARNING: WordPress gave slug {res['slug']!r}, wanted {m['slug']!r} (taken by another page?)",
                  file=sys.stderr)
            failed = True
    site(dry)
    sys.exit(1 if failed else 0)


def code(dry):
    """wordpress.org plugins and our PHP snippets (pages/site.json), set up before the pages."""
    cfg = json.load(open(os.path.join(PAGES, "site.json")))
    have = {p["plugin"]: p["status"] for p in api("GET", "plugins")}
    ready = True
    for p in cfg.get("plugins", []):
        if have.get(p) == "active":
            print(f"ok      plugin {p}")
            continue
        verb = "activate" if p in have else "install"
        print(f"{'would ' + verb if dry else verb} plugin {p}")
        if dry:
            ready = False
        elif p in have:
            api("POST", f"plugins/{p}", {"status": "active"})
        else:
            api("POST", "plugins", {"slug": p.split("/")[0], "status": "active"})
    ns = "code-snippets/v1"
    for s in cfg.get("snippets", []):
        src = open(os.path.join(PAGES, s["file"])).read().strip().removeprefix("<?php").strip()
        if not ready:
            print(f"would create snippet {s['name']!r}")
            continue
        found = [x for x in api("GET", "snippets?per_page=100", ns=ns)
                 if x["name"] == s["name"] and not x.get("trashed")]
        if not found:
            print(f"{'would create' if dry else 'create'} snippet {s['name']!r}")
            if dry:
                continue
            snip = api("POST", "snippets", {"name": s["name"], "code": src, "scope": "global",
                                            "desc": "Published from GitHub (dmfseo repo, " + s["file"]
                                                    + "). Edit there, not here."}, ns=ns)
        else:
            snip = found[0]
            if snip["code"].strip().removeprefix("<?php").strip() == src:
                print(f"ok      snippet {s['name']!r}")
            else:
                print(f"{'would update' if dry else 'update'} snippet {s['name']!r}")
                if not dry:
                    snip = api("POST", f"snippets/{snip['id']}", {"code": src}, ns=ns)
        if not snip["active"]:
            print(f"{'would activate' if dry else 'activate'} snippet {s['name']!r}")
            if not dry:
                api("POST", f"snippets/{snip['id']}/activate", ns=ns)


def site(dry):
    """Front page setting and navigation menus (pages/site.json)."""
    cfg = json.load(open(os.path.join(PAGES, "site.json")))
    for n in cfg["navigation"]:
        path = os.path.join(PAGES, n["file"])
        if "id" not in n:  # created once by slug, found by slug afterwards
            found = api("GET", f"navigation?slug={n['slug']}&status=publish,draft&context=edit")
            if not found:
                print(f"{'would create' if dry else 'create'} navigation {n['slug']}")
                if not dry:
                    api("POST", "navigation", {"title": n["title"], "slug": n["slug"], "status": "publish",
                                               "content": open(path).read()})
                continue
            n = {**n, "id": found[0]["id"]}
        have = api("GET", f"navigation/{n['id']}?context=edit")["content"]["raw"]
        if open(path).read() == have:
            print(f"ok      navigation {n['id']}")
        else:
            print(f"{'would update' if dry else 'update'} navigation {n['id']}")
            if not dry:
                api("POST", f"navigation/{n['id']}", {"content": open(path).read()})
    s = api("GET", "settings")
    if s["show_on_front"] == "page" and s["page_on_front"] == cfg["front_page_id"]:
        print("ok      front page")
    else:
        print(f"{'would set' if dry else 'set'} front page to {cfg['front_page_id']}")
        if not dry:
            api("POST", "settings", {"show_on_front": "page", "page_on_front": cfg["front_page_id"]})


if __name__ == "__main__":
    if len(sys.argv) < 2 or sys.argv[1] != "push":
        sys.exit(__doc__)
    main("--dry-run" in sys.argv)
