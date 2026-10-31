# /// script
# requires-python = ">=3.11"
# ///
"""Sync WordPress pages with pages/. Usage: wp_sync.py pull|push [--dry-run]

pages/site.json holds the front page and navigation menus (by ID), the wordpress.org
plugins to keep active, and our own PHP snippets (run by the Code Snippets plugin).
pages/manifest.json maps each page ID to a file, title, slug and status, plus the
optional "description" and "seo_title" that snippets/seo-head.php puts in the page head.
Pages are always addressed by ID and only ever updated, never created, so a run cannot
produce duplicates. Needs WP_USER and WP_APP_PASSWORD; WP_URL is optional.
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


def main(mode, dry):
    manifest = json.load(open(os.path.join(PAGES, "manifest.json")))
    failed = False
    if mode == "push":
        code(dry)
    for m in manifest:
        page = api("GET", f"pages/{m['id']}?context=edit")
        path = os.path.join(PAGES, m["file"])
        if mode == "pull":
            open(path, "w").write(page["content"]["raw"])
            print(f"pulled {m['id']} -> {m['file']} ({len(page['content']['raw'])} chars)")
            continue
        want = {"title": m["title"], "slug": m["slug"], "status": m["status"],
                "content": open(path).read()}
        have = {"title": page["title"]["raw"], "slug": page["slug"], "status": page["status"],
                "content": page["content"]["raw"]}
        if "template" in m:
            want["template"], have["template"] = m["template"], page.get("template", "")
        want["meta"] = {"grohnpetrel_description": m.get("description", ""),
                        "grohnpetrel_title": m.get("seo_title", "")}
        have["meta"] = {k: (page.get("meta") or {}).get(k, "") for k in want["meta"]}
        diff = [k for k in want if want[k] != have[k]]
        if not diff:
            print(f"ok      {m['id']} {m['slug']}")
            continue
        print(f"{'would update' if dry else 'update'} {m['id']} {m['slug']}: {', '.join(diff)}")
        if dry:
            continue
        res = api("POST", f"pages/{m['id']}", {k: want[k] for k in diff})
        if res["slug"] != m["slug"] and m["status"] == "publish":
            print(f"  WARNING: WordPress gave slug {res['slug']!r}, wanted {m['slug']!r} (taken by another page?)",
                  file=sys.stderr)
            failed = True
    site(mode, dry)
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


def site(mode, dry):
    """Front page setting and navigation menus (pages/site.json)."""
    cfg = json.load(open(os.path.join(PAGES, "site.json")))
    for n in cfg["navigation"]:
        path = os.path.join(PAGES, n["file"])
        have = api("GET", f"navigation/{n['id']}?context=edit")["content"]["raw"]
        if mode == "pull":
            open(path, "w").write(have)
            print(f"pulled navigation {n['id']} -> {n['file']}")
        elif open(path).read() == have:
            print(f"ok      navigation {n['id']}")
        else:
            print(f"{'would update' if dry else 'update'} navigation {n['id']}")
            if not dry:
                api("POST", f"navigation/{n['id']}", {"content": open(path).read()})
    if mode == "push":
        s = api("GET", "settings")
        if s["show_on_front"] == "page" and s["page_on_front"] == cfg["front_page_id"]:
            print("ok      front page")
        else:
            print(f"{'would set' if dry else 'set'} front page to {cfg['front_page_id']}")
            if not dry:
                api("POST", "settings", {"show_on_front": "page", "page_on_front": cfg["front_page_id"]})


if __name__ == "__main__":
    if len(sys.argv) < 2 or sys.argv[1] not in ("pull", "push"):
        sys.exit(__doc__)
    main(sys.argv[1], "--dry-run" in sys.argv)
