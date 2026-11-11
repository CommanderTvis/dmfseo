# Technical indexation and stale-URL audit — 11 November 2026

Checked 11 Nov 2026, about 22:00 CET, from a logged-out browser `fetch` (no cookies) against the live site. Baseline `main` = `e677912`. No Search Console URL Inspection was run (the service account is used only by GitHub Actions; no interactive access in this session), so Google's own crawl dates are **not** included.

## Indexable core pages (all languages)

| URL | HTTP | Canonical | Robots meta | X-Robots-Tag | In sitemap |
|---|---|---|---|---|---|
| `/` | 200 | self | index | none | yes |
| `/de/` | 200 | self | index | none | yes |
| `/es/` | 200 | self | index | none | yes |
| `/zh/` | 200 | self | index | none | yes |
| `/what-is-grohnpetrel-2/` | 200 | self | index | none | yes |
| `/de/was-ist-grohnpetrel/` | 200 | self | index | none | yes |
| `/es/que-es-grohnpetrel/` | 200 | self | index | none | yes |
| `/zh/grohnpetrel-shi-shenme/` | 200 | self | index | none | yes |
| `/grohnpetrel-faq/` | 200 | self | index | none | yes |
| `/de/haeufige-fragen/` | 200 | self | index | none | yes |
| `/es/preguntas-frecuentes-grohnpetrel/` | 200 | self | index | none | yes |
| `/zh/grohnpetrel-changjian-wenti/` | 200 | self | index | none | yes |
| `/journal/`, `/de/projekt-journal/` | 200 | self | index | none | yes |

All 66 sitemap URLs returned 200 when logged out; each has exactly one H1; no image lacks `alt`; 70 internal link targets, none broken or redirected.

## Stale, deleted and archive URLs (incl. URLs with old Search Console impressions)

| URL | Result | Verdict |
|---|---|---|
| `/hello-world/` | 404, `noindex` | Deleted default post; not live. NO CHANGE NEEDED. Old GSC impressions are history. |
| `/sample-page/`, `/cookie-policy-eu/` | 404, `noindex` | Trashed in the manifest; not live. NO CHANGE NEEDED. |
| `/was-ist-grohnpetrel/` | redirect → `/de/was-ist-grohnpetrel/` (200, self-canonical) | WordPress old-slug redirect to the correct equivalent. NO CHANGE NEEDED. |
| `/grohnpetrel-faq-de/` | redirect → `/de/haeufige-fragen/` (200) | Correct equivalent. NO CHANGE NEEDED. |
| `/what-is-grohnpetrel/` | redirect → `/what-is-grohnpetrel-2/` (200) | Correct equivalent. NO CHANGE NEEDED. |
| `/category/uncategorized/` | 200, `noindex`, not in sitemap | As set by PR #14 (7 Nov); no regression. |
| `/2026/11/` (date archive), `/?s=grohnpetrel` | 200, `noindex` | No regression. |
| `/author/` | 404, `noindex` | Fine. |
| `/feed/` | 200 (RSS) | Normal feed; not an HTML page. |

Redirect status codes (301 vs 302) cannot be read from a browser `fetch`; WordPress's `wp_old_slug_redirect()` issues 301 by default. Marked PARTIAL.

## Search Console "indexed: 0" in `data/sitemap.json`

The `contents[].indexed` field of the Search Console Sitemaps API is no longer filled by Google (announced in Google's 2019 note "Minor cleaning up in the Search Console API"); it reports 0 regardless of indexing. It must **not** be read as "no page indexed". Search Console performance data (1,221 impressions, 29 clicks in 28 days) and the rank tracker show that pages are indexed. `submitted: 63` was the sitemap size when it was last read (10 Nov, 08:40 UTC); the live sitemap has 66 URLs.

## Fixes made

None needed for indexation. One related structured-data defect was found and fixed in `snippets/schema.php`: the last FAQ answer in the FAQPage markup included the page's byline ("By the Guillemots team · Last updated …"). Small-print paragraphs are now excluded (verified on EN, DE and ES FAQ content).

## Not done / pending

- URL Inspection and crawl dates in Search Console: needs an interactive Search Console login (Iaroslav).
- Removal of the old URLs from Google: happens on recrawl; not claimed.
