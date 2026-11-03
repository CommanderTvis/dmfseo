# Project log

Format: action, who (when not the whole team), reason, outcome. Newest last. Copy entries to the Teams log.

## 2026-10-28

**Action:** AI-written draft pages created.

**Who:** Diego Aguilar and Mario Iraheta.

**Reason:** First content structure.

**Outcome:** Drafts only. The server blocked Googlebot, so the site could not be crawled.

---

## 2026-10-31

**Action:** Published 8 pages, set the front page and menus.

**Reason:** Get first content indexed.

**Outcome:** Live. SEO / AEO / GEO Lab still a draft.

---

**Action:** Claimed the site in Search Console.

**Reason:** Indexing and search data.

**Outcome:** Verified. API access works, too.

---

**Action:** Created the GitHub repo (https://github.com/CommanderTvis/dmfseo); a GitHub Action publishes pages to WordPress.

**Reason:** Version history, easy contributions, no duplicate pages.

**Outcome:** A push to `main` goes live in about a minute.

---

**Action:** Daily rank check and dashboard (https://commandertvis.github.io/dmfseo/).

**Reason:** Evidence for results.

**Outcome:** Baseline on Google: "grohnpetrel" #2 in 🇺🇸, #6 in 🇩🇪 and 🇬🇧; quoted "grohnpetrel" #2 everywhere; other queries not in top 10. Puffins #1. Not in DuckDuckGo results.

---

**Action:** Meta descriptions and social sharing tags on every page.

**Reason:** The site had no meta descriptions or social sharing tags. The description is what Google may show under our link.

**Outcome (1 Nov):** Google re-crawled the front page at 03:50 UTC, after the change, so it has the new description. Whether Google shows it in results is not measured yet. The other 7 pages are still unknown to Google (Search Console URL Inspection), so their descriptions have no effect so far. Ranks went up the same day, but a meta description is not a ranking factor, so the rise is not attributed to this change.

---

## 2026-11-01

**Action:** Submitted the sitemap (https://business.constructor.university/guillemots/wp-sitemap.xml) in Search Console, and made every publish from GitHub resubmit it automatically.

**Reason:** Only the front page is indexed; the other 7 pages are unknown to Google, and no sitemap had been submitted. WordPress updates the sitemap itself, but Google only re-reads it on its own schedule; resubmitting tells it there is new content.

**Outcome:** Accepted, no errors; Google has not processed it yet. The automatic resubmit works (tested by hand). Google treats it as a hint, so pages may still take days to be indexed.

---

**Action:** Activated Complianz in WordPress: cookie banner (Accept / Deny / View preferences), cookie blocker, Cookie Policy page (https://business.constructor.university/guillemots/cookie-policy-eu/). GDPR rules; Do Not Track / Global Privacy Control count as "deny".

**Who:** Diego Aguilar.

**Reason:** The site is in Germany, we plan to add Google Analytics (needs prior consent), and we had no Privacy or Cookie Policy.

**Outcome:** Banner and policy are live. Analytics is not connected yet. Done in WordPress, outside the repo. Next: connect GA4 in Site Kit and test that it loads only after "Accept".

---

## 2026-11-02

**Action:** Added About (team, roles, photo, use of AI), Contact, Imprint (draft until the responsible person is named) and Privacy Policy pages; linked them in the footer and fixed the footer "Transparency" menu, whose links pointed to trashed pages.

**Who:** Diego Aguilar.

**Reason:** The home page linked to a missing About page, and a site in Germany needs contact and privacy information. Clear authorship also helps search engines and AI assistants describe us. The competitor (Fulmars) has these pages.

**Outcome:** Pending. FAQ, Knowledge Centre and Cookie Policy show in the footer; the rest appear once published.

---

**Action:** Technical SEO on every page: structured data (JSON-LD for the project, website, page type, breadcrumbs, a definition on "What is Grohnpetrel?" and an FAQ built from the visible questions); keyword-first titles, e.g. "Grohnpetrel FAQ: What It Is, the Name, Who Made It"; German versions of "What is Grohnpetrel?" and the FAQ with hreflang links and `lang="de-DE"`; the home page's "About us" button now links to About, which is also in the main menu. The sync can now publish posts and translated pages.

**Who:** Diego Aguilar.

**Reason:** No page had structured data and titles were only the page name plus "– Grohnpetrel"; Fulmars has structured data, descriptive titles and a German version. This helps search engines and AI assistants identify what Grohnpetrel is and who made it, and lets German pages match searches like "Was ist Grohnpetrel".

**Outcome:** Pending (check structured data with Google's Rich Results Test).

---

**Action:** Published new content: "Seabirds of the North Sea" (an overview and six sourced species pages), a Journal ("How We Defined Grohnpetrel", "What a Hidden Noindex Header Taught Us About SEO", "Why We Built a Seabird Guide for an Invented Keyword"), the SEO / GEO Lab page (method, dated 28 October baseline, rankings, list of changes) and a "Merchandise: Plans, Not Sales" page.

**Who:** Diego Aguilar.

**Reason:** We had 8 pages; Fulmars has 10 product pages plus four articles and a merch page. Sourced pages and dated articles show real, ongoing work and give search engines, AI assistants and visitors more to rely on. The Lab page was an empty draft and is our main evidence page; the merch page shows the public side of the course's marketing plan.

**Outcome:** Pending.

---

## 2026-11-03

**Action:** Added Bremen wording to the front page (first sentence says the project is from Bremen, Germany; Grohn named as the Bremen district on the Weser near the North Sea and Wadden Sea) and to "What is Grohnpetrel?", rewrote both meta descriptions around Bremen-Grohn, and added a visible link from each to the German page.

**Reason:** The professor's check (Google.de, desktop, location Bremen, 2 Nov) had Puffins at #1 and us at #2, the same as our tracker. Puffins' pages lean heavily on Bremen and Grohn.

**Outcome:** Pending. Compare the 🇩🇪 ranks in the tracker after Google re-crawls.
