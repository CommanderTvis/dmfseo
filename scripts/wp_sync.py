# /// script
# requires-python = ">=3.11"
# ///
"""Sync WordPress pages with pages/. Usage: wp_sync.py pull|push [--dry-run]

pages/manifest.json maps each page ID to a file, title, slug and status. Pages are
always addressed by ID and only ever updated, never created, so a run cannot
produce duplicates. Needs WP_USER and WP_APP_PASSWORD; WP_URL is optional.
"""
import base64, json, os, sys, urllib.error, urllib.request

BASE = os.environ.get("WP_URL", "https://business.constructor.university/guillemots").rstrip("/")
PAGES = os.path.join(os.path.dirname(os.path.abspath(__file__)), "..", "pages")
AUTH = "Basic " + base64.b64encode(
    f"{os.environ['WP_USER']}:{os.environ['WP_APP_PASSWORD']}".encode()).decode()


def api(method, path, body=None):
    req = urllib.request.Request(
        f"{BASE}/wp-json/wp/v2/{path}", method=method,
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
    sys.exit(1 if failed else 0)


if __name__ == "__main__":
    if len(sys.argv) < 2 or sys.argv[1] not in ("pull", "push"):
        sys.exit(__doc__)
    main(sys.argv[1], "--dry-run" in sys.argv)
