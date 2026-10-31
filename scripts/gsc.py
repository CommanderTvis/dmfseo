# /// script
# requires-python = ">=3.11"
# dependencies = ["google-auth", "requests"]
# ///
"""Pull Search Console performance (last 28 days) into gsc.csv. Usage: gsc.py <data_dir>

Needs GSC_SERVICE_ACCOUNT_JSON; GSC_SITE_URL defaults to the URL-prefix property.
Skips quietly when the credentials are missing.
"""
import csv, json, os, sys
from datetime import date, timedelta
from urllib.parse import quote

FIELDS = ["date", "query", "page", "clicks", "impressions", "ctr", "position"]


def main(data_dir):
    cred = os.environ.get("GSC_SERVICE_ACCOUNT_JSON")
    if not cred:
        print("GSC_SERVICE_ACCOUNT_JSON not set, skipping Search Console")
        return
    from google.oauth2 import service_account
    from google.auth.transport.requests import AuthorizedSession
    site = os.environ.get("GSC_SITE_URL", "https://business.constructor.university/guillemots/")
    creds = service_account.Credentials.from_service_account_info(
        json.loads(cred), scopes=["https://www.googleapis.com/auth/webmasters.readonly"])
    end = date.today()
    resp = AuthorizedSession(creds).post(
        f"https://www.googleapis.com/webmasters/v3/sites/{quote(site, safe='')}/searchAnalytics/query",
        json={"startDate": str(end - timedelta(days=28)), "endDate": str(end),
              "dimensions": ["date", "query", "page"], "rowLimit": 5000})
    resp.raise_for_status()
    path = os.path.join(data_dir, "gsc.csv")
    rows = {}
    if os.path.exists(path):
        for r in csv.DictReader(open(path)):
            rows[(r["date"], r["query"], r["page"])] = r
    for r in resp.json().get("rows", []):
        d, q, p = r["keys"]
        rows[(d, q, p)] = dict(date=d, query=q, page=p, clicks=r["clicks"],
                               impressions=r["impressions"], ctr=r["ctr"], position=r["position"])
    with open(path, "w", newline="") as f:
        w = csv.DictWriter(f, FIELDS)
        w.writeheader()
        w.writerows(sorted(rows.values(), key=lambda r: (r["date"], r["query"], r["page"])))
    print(f"gsc.csv: {len(rows)} rows")


if __name__ == "__main__":
    main(sys.argv[1])
