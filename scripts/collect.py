# /// script
# requires-python = ">=3.11"
# dependencies = ["ddgs"]
# ///
"""Daily rank check. Usage: collect.py <data_dir>

Google via Serper.dev (needs SERPER_API_KEY), DuckDuckGo via the unofficial ddgs
library (best effort). Appends one row per engine/country/query to results.csv and
stores the raw top-10 as JSON.
"""
import csv, json, os, sys, time, urllib.request
from datetime import datetime, timezone
from urllib.parse import urlparse

OUR = "business.constructor.university/guillemots"
HOST = "business.constructor.university"
QUERIES = os.environ.get("QUERIES", 'grohnpetrel|"grohnpetrel"|what is grohnpetrel|grohnpetrel seabird').split("|")
GOOGLE_COUNTRIES = os.environ.get("COUNTRIES", "de,us,gb").split(",")
DDG_REGIONS = {"de": "de-de", "us": "us-en", "gb": "uk-en"}
FIELDS = ["date", "time_utc", "engine", "country", "query", "our_rank", "our_url",
          "top_url", "rival_ranks", "n_results"]


def google(q, gl):
    req = urllib.request.Request(
        "https://google.serper.dev/search",
        data=json.dumps({"q": q, "gl": gl, "hl": "en", "num": 10}).encode(),
        headers={"X-API-KEY": os.environ["SERPER_API_KEY"], "Content-Type": "application/json"})
    with urllib.request.urlopen(req, timeout=30) as r:
        return [x["link"] for x in json.load(r).get("organic", [])]


def ddg(q, region):
    from ddgs import DDGS
    for attempt in range(3):
        try:
            return [x["href"] for x in DDGS().text(q, region=region, max_results=10, backend="duckduckgo")]
        except Exception:
            if attempt == 2:
                raise
            time.sleep(4)


def analyse(urls):
    our_rank = our_url = None
    rivals = []
    for i, u in enumerate(urls, 1):
        p = urlparse(u)
        path = (p.netloc + p.path).rstrip("/")
        if path == OUR or path.startswith(OUR + "/"):
            if our_rank is None:
                our_rank, our_url = i, u
        elif p.netloc == HOST:
            seg = p.path.strip("/").split("/")[0]
            rivals.append(f"{seg or 'root'}:{i}")
    return our_rank, our_url, ";".join(rivals)


def main(data_dir):
    now = datetime.now(timezone.utc)
    raw_dir = os.path.join(data_dir, "raw", now.strftime("%Y-%m-%d"))
    os.makedirs(raw_dir, exist_ok=True)
    path = os.path.join(data_dir, "results.csv")
    new = not os.path.exists(path)
    google_ok = 0
    jobs = []
    if os.environ.get("SERPER_API_KEY"):
        jobs += [("google", c, q, lambda q=q, c=c: google(q, c)) for c in GOOGLE_COUNTRIES for q in QUERIES]
    else:
        print("SERPER_API_KEY not set, skipping Google")
    jobs += [("duckduckgo", c, q, lambda q=q, c=c: ddg(q, DDG_REGIONS[c]))
             for c in GOOGLE_COUNTRIES if c in DDG_REGIONS for q in QUERIES]
    with open(path, "a", newline="") as f:
        w = csv.DictWriter(f, FIELDS)
        if new:
            w.writeheader()
        for engine, country, q, fn in jobs:
            try:
                urls = fn()
            except Exception as e:
                print(f"FAIL {engine} {country} {q!r}: {e}", file=sys.stderr)
                continue
            if engine == "google":
                google_ok += 1
            rank, our_url, rivals = analyse(urls)
            w.writerow(dict(date=now.strftime("%Y-%m-%d"), time_utc=now.strftime("%H:%M"),
                            engine=engine, country=country, query=q, our_rank=rank or "",
                            our_url=our_url or "", top_url=urls[0] if urls else "",
                            rival_ranks=rivals, n_results=len(urls)))
            name = f"{engine}-{country}-{''.join(ch if ch.isalnum() else '_' for ch in q)}-{now.strftime('%H%M')}.json"
            json.dump(urls, open(os.path.join(raw_dir, name), "w"), indent=1)
            print(f"{engine} {country} {q!r}: ours={rank} rivals={rivals}")
    if os.environ.get("SERPER_API_KEY") and google_ok == 0:
        sys.exit("all Google queries failed")


if __name__ == "__main__":
    main(sys.argv[1])
