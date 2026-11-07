# /// script
# requires-python = ">=3.11"
# ///
"""Offline checks of pages/ before anything is published. Usage: check_pages.py [--links-csv FILE]

Fails (exit 1) on problems that would publish a broken site:
- manifest.json is not valid JSON, an entry's file is missing, or two published entries share a URL;
- an "alternate" (translation) path is not a published entry, or the translation does not link back;
- a block comment's attributes are not valid JSON, or block comments are not balanced;
- a page with the "page-no-title" template does not have exactly one H1 (other pages get theirs
  from the theme, so they must have none);
- an internal link points to a URL that no published entry has.
Warns about published pages that no other page links to. Needs no network or credentials.
--links-csv writes the internal link graph (source URL, target URL) for audits.
"""
import csv, json, re, sys
from collections import Counter, defaultdict
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
PAGES = ROOT / "pages"
BASE = "https://business.constructor.university/guillemots/"
# Pages WordPress or plugins create outside the manifest, and files our snippets serve.
EXTERNAL_OK = {"cookie-policy-eu/", "wp-sitemap.xml", "llms.txt", "feed/"}


def url_of(m: dict) -> str:
    site = json.loads((PAGES / "site.json").read_text(encoding="utf-8"))
    if m.get("id") and m.get("id") == site.get("front_page_id"):
        return BASE
    parent = m.get("parent_slug", "")
    return BASE + (parent + "/" if parent else "") + m["slug"] + "/"


def main() -> int:
    errors: list[str] = []
    warnings: list[str] = []
    try:
        manifest = json.loads((PAGES / "manifest.json").read_text(encoding="utf-8"))
    except json.JSONDecodeError as e:
        print(f"ERROR manifest.json: {e}")
        return 1

    live = [m for m in manifest if m.get("status") == "publish" and m.get("file")]
    by_url: dict[str, dict] = {}
    for m in live:
        if not (PAGES / m["file"]).is_file():
            errors.append(f"{m['file']}: file missing")
            continue
        u = url_of(m)
        if u in by_url:
            errors.append(f"{m['file']} and {by_url[u]['file']}: same URL {u}")
        by_url[u] = m
    path_to_url = {u[len(BASE):].rstrip("/"): u for u in by_url}
    # The front page lives at BASE, but translations refer to it by its slug.
    path_to_url.update({m["slug"]: u for u, m in by_url.items() if u == BASE})

    # Translations: every alternate exists and links back.
    for u, m in by_url.items():
        for alt in filter(None, (a.strip() for a in m.get("alternate", "").split(","))):
            target = path_to_url.get(alt)
            if not target:
                errors.append(f"{m['file']}: alternate '{alt}' is not a published entry")
                continue
            back = [a.strip() for a in by_url[target].get("alternate", "").split(",")]
            own = u[len(BASE):].rstrip("/") or m["slug"]
            if own not in back and m["slug"] not in back:
                errors.append(f"{m['file']}: '{alt}' does not list it back as an alternate")

    links: list[tuple[str, str]] = []
    inbound: Counter[str] = Counter()
    for u, m in by_url.items():
        html = (PAGES / m["file"]).read_text(encoding="utf-8")
        filled = re.sub(r"\{\{media(-id)?:[^}]+\}\}", "0", html)
        opened = Counter()
        for name, attrs, closing in re.findall(r"<!-- (/?wp:[\w/-]+)(?: (\{.*?\}))? ?(/?)-->", filled):
            if attrs:
                try:
                    json.loads(attrs)
                except json.JSONDecodeError:
                    errors.append(f"{m['file']}: invalid JSON in <!-- {name} -->")
            if not closing:
                opened[name.lstrip("/")] += -1 if name.startswith("/") else 1
        for name, n in opened.items():
            if n:
                errors.append(f"{m['file']}: block {name} opened/closed unbalanced ({n:+d})")
        h1 = len(re.findall(r"<h1[\s>]", html))
        if m.get("template") == "page-no-title" and h1 != 1:
            errors.append(f"{m['file']}: {h1} H1 headings (page-no-title needs exactly 1)")
        if m.get("template") != "page-no-title" and h1:
            errors.append(f"{m['file']}: {h1} H1 in content, but the theme already prints the title as H1")
        for href in re.findall(r'href="([^"#]+)', html):
            if not href.startswith(BASE):
                continue
            rest = href[len(BASE):].split("?")[0]
            target = BASE + rest if not rest or rest.endswith("/") or "." in rest.split("/")[-1] else BASE + rest + "/"
            if target in by_url:
                links.append((u, target))
                if target != u:
                    inbound[target] += 1
            elif rest not in EXTERNAL_OK:
                errors.append(f"{m['file']}: link to unknown page {href}")

    # Menus link pages too; count them as inbound links.
    for nav in PAGES.glob("navigation-*.html"):
        for href in re.findall(r'"url":"([^"]+)"|href="([^"]+)"', nav.read_text(encoding="utf-8")):
            h = (href[0] or href[1]).replace("\\/", "/")
            if h in by_url:
                inbound[h] += 1
    for u, m in by_url.items():
        if u != BASE and not inbound[u]:
            warnings.append(f"{m['file']}: no internal links from other pages or menus ({u})")

    if "--links-csv" in sys.argv:
        out = sys.argv[sys.argv.index("--links-csv") + 1]
        with open(out, "w", newline="", encoding="utf-8") as f:
            w = csv.writer(f)
            w.writerow(["source", "target"])
            w.writerows(sorted(set(links)))
        per_target = defaultdict(int)
        for _, t in set(links):
            per_target[t] += 1
        print(f"link graph: {len(set(links))} links between {len(by_url)} URLs -> {out}")

    for w in warnings:
        print("WARN ", w)
    for e in errors:
        print("ERROR", e)
    print(f"{len(by_url)} published entries, {len(errors)} errors, {len(warnings)} warnings")
    return 1 if errors else 0


if __name__ == "__main__":
    sys.exit(main())
