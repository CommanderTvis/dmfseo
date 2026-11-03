# /// script
# requires-python = ">=3.11"
# dependencies = ["google-auth", "requests"]
# ///
"""Resubmit the WordPress sitemap to Search Console so Google re-reads it. Usage: gsc_sitemap.py

WordPress rebuilds the sitemap itself on every change; this only tells Google to fetch it.
Needs GSC_SERVICE_ACCOUNT_JSON (a full user on the property); GSC_SITE_URL defaults to the
URL-prefix property. Skips quietly when the credentials are missing.
"""
import json, os, sys
from urllib.parse import quote


def main() -> None:
    cred = os.environ.get("GSC_SERVICE_ACCOUNT_JSON")
    if not cred:
        print("GSC_SERVICE_ACCOUNT_JSON not set, skipping sitemap submit")
        return
    from google.oauth2 import service_account
    from google.auth.transport.requests import AuthorizedSession
    site = os.environ.get("GSC_SITE_URL", "https://business.constructor.university/guillemots/")
    sitemap = site + "wp-sitemap.xml"
    creds = service_account.Credentials.from_service_account_info(
        json.loads(cred), scopes=["https://www.googleapis.com/auth/webmasters"])
    url = (f"https://www.googleapis.com/webmasters/v3/sites/{quote(site, safe='')}"
           f"/sitemaps/{quote(sitemap, safe='')}")
    sess = AuthorizedSession(creds)
    resp = sess.put(url)
    if not resp.ok:
        sys.exit(f"Search Console {resp.status_code}: {resp.text[:300]}")
    info = sess.get(url).json()
    print(f"submitted {sitemap} (lastSubmitted {info.get('lastSubmitted')}, "
          f"errors {info.get('errors')}, warnings {info.get('warnings')})")


if __name__ == "__main__":
    main()
