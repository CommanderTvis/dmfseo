"""Fetch the live WordPress sitemap and write every URL with its lastmod to sitemap_urls.json.
Usage: sitemap_urls.py <data_dir>. Needs no credentials."""
import json, os, sys, urllib.request
import xml.etree.ElementTree as ET

SITE = os.environ.get("GSC_SITE_URL", "https://business.constructor.university/guillemots/")
NS = {"s": "http://www.sitemaps.org/schemas/sitemap/0.9"}


def fetch(url: str) -> ET.Element:
    req = urllib.request.Request(url, headers={"User-Agent": "dmfseo-dashboard"})
    return ET.fromstring(urllib.request.urlopen(req, timeout=30).read())


def main(data_dir: str) -> None:
    index = SITE + "wp-sitemap.xml"
    urls: list[dict[str, str]] = []
    for sm in fetch(index).findall("s:sitemap/s:loc", NS):
        sm_url = (sm.text or "").strip()
        for u in fetch(sm_url).findall("s:url", NS):
            urls.append({"loc": u.findtext("s:loc", "", NS).strip(),
                         "lastmod": u.findtext("s:lastmod", "", NS).strip(),
                         "sitemap": sm_url.rsplit("/", 1)[-1]})
    json.dump({"index": index, "urls": urls}, open(os.path.join(data_dir, "sitemap_urls.json"), "w"), indent=1)
    print(f"sitemap_urls.json: {len(urls)} URLs")


if __name__ == "__main__":
    main(sys.argv[1])
