# /// script
# requires-python = ">=3.11"
# dependencies = []
# ///
"""Tell Bing (and the other IndexNow engines: Yandex, Seznam, Naver) which site URLs exist or changed.
Usage: indexnow.py [--days N] [--dry-run]

Reads the live WordPress sitemap and submits its URLs to https://api.indexnow.org. --days N only
sends URLs whose lastmod is within the last N days; the default 0 sends all of them (about 80,
well under the 10,000 limit). The key file is served by snippets/llms.php at
/guillemots/<key>.txt, so the submitted URLs must all start with /guillemots/.

Why: the site has never appeared in Bing or DuckDuckGo, which also feed ChatGPT search and
Copilot. Google gets the sitemap through scripts/gsc_sitemap.py instead. Needs no credentials:
an IndexNow key is public by design. Never fails the workflow; it only prints what happened.
"""
import argparse, json, sys, urllib.error, urllib.request
from datetime import datetime, timedelta, timezone
import xml.etree.ElementTree as ET

SITE = "https://business.constructor.university/guillemots/"
HOST = "business.constructor.university"
KEY = "9ff45e24c19f319a1085abe0f92839f8"  # must match GROHNPETREL_INDEXNOW_KEY in snippets/llms.php
NS = {"s": "http://www.sitemaps.org/schemas/sitemap/0.9"}
UA = {"User-Agent": "dmfseo-indexnow"}


def fetch(url: str) -> ET.Element:
    return ET.fromstring(urllib.request.urlopen(urllib.request.Request(url, headers=UA), timeout=30).read())


def sitemap_urls(days: int) -> list[str]:
    since = datetime.now(timezone.utc) - timedelta(days=days) if days else None
    out = []
    for sm in fetch(SITE + "wp-sitemap.xml").findall("s:sitemap/s:loc", NS):
        for u in fetch((sm.text or "").strip()).findall("s:url", NS):
            loc, mod = u.findtext("s:loc", "", NS).strip(), u.findtext("s:lastmod", "", NS).strip()
            if since and mod and datetime.fromisoformat(mod) < since:
                continue
            if loc.startswith(SITE):
                out.append(loc)
    return out


def main() -> None:
    ap = argparse.ArgumentParser()
    ap.add_argument("--days", type=int, default=0)
    ap.add_argument("--dry-run", action="store_true")
    a = ap.parse_args()
    key_url = f"{SITE}{KEY}.txt"
    try:
        served = urllib.request.urlopen(urllib.request.Request(key_url, headers=UA), timeout=30).read().decode().strip()
    except urllib.error.URLError as e:
        print(f"key file {key_url} not reachable ({e}), skipping")
        return
    if served != KEY:
        print(f"key file {key_url} does not contain the key, skipping")
        return
    urls = sitemap_urls(a.days)
    print(f"{len(urls)} URLs to submit" + (" (dry run)" if a.dry_run else ""))
    if not urls or a.dry_run:
        return
    body = json.dumps({"host": HOST, "key": KEY, "keyLocation": key_url, "urlList": urls}).encode()
    req = urllib.request.Request("https://api.indexnow.org/indexnow", data=body, method="POST",
                                 headers={**UA, "Content-Type": "application/json; charset=utf-8"})
    try:
        with urllib.request.urlopen(req, timeout=30) as r:
            code = r.status
    except urllib.error.HTTPError as e:
        code = e.code
    meaning = {200: "accepted", 202: "received, key check pending", 400: "bad request", 403: "key not valid",
               422: "URLs do not belong to the host or key folder", 429: "too many requests"}
    print(f"IndexNow {code}: {meaning.get(code, 'unexpected')}")


if __name__ == "__main__":
    sys.exit(main())
