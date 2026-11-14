# /// script
# requires-python = ">=3.11"
# dependencies = ["pillow"]
# ///
"""Fetch openly licensed images listed in media/fetch.json into media/ as WebP.

Each entry: {"file": "x.webp", "commons": "File name on Wikimedia Commons", "author": ..., "license": ...}.
Files that already exist are skipped, so the file in Git stays the source of truth (wp_sync.py
uploads it like any other image). Run by the fetch-media workflow on feature branches.
"""
import io, json, os, sys, urllib.parse, urllib.request
from PIL import Image

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
MEDIA = os.path.join(ROOT, "media")
UA = "GrohnpetrelMediaFetch/1.0 (https://github.com/CommanderTvis/dmfseo; student course project)"

for f in json.load(open(os.path.join(MEDIA, "fetch.json"))):
    out = os.path.join(MEDIA, f["file"])
    if os.path.exists(out):
        print("ok   ", f["file"]); continue
    url = "https://commons.wikimedia.org/wiki/Special:FilePath/" + urllib.parse.quote(f["commons"]) + "?width=1600"
    req = urllib.request.Request(url, headers={"User-Agent": UA})
    with urllib.request.urlopen(req, timeout=60) as r:
        img = Image.open(io.BytesIO(r.read())).convert("RGB")
    if img.width > 1200:
        img = img.resize((1200, round(img.height * 1200 / img.width)), Image.LANCZOS)
    img.save(out, "WEBP", quality=80, method=6)
    print("fetch", f["file"], img.size, os.path.getsize(out) // 1024, "KB")
sys.exit(0)
