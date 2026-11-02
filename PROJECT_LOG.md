# Project log

Format: action, reason, outcome. Newest last. Copy entries to the Teams log.

## 2026-10-28

**Action:** AI-written draft pages created.

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

**Action:** Daily rank check (https://commandertvis.github.io/dmfseo/).

**Reason:** Track results against yesterday's baseline.

**Outcome:**

- Google, "grohnpetrel": #1 in 🇬🇧, #2 in 🇩🇪, #3 in 🇺🇸.
- Google, quoted "grohnpetrel": #2 everywhere.
- Google, "grohnpetrel seabird": #1 everywhere.
- Google, "what is grohnpetrel": #1 in 🇩🇪, #3 in 🇺🇸, #4 in 🇬🇧 (neither was in the top 10 in the baseline).
- Only our front page ranks, no other page.
- Puffins still #1 for "grohnpetrel" in 🇺🇸 and 🇩🇪 and for quoted "grohnpetrel".
- Brave and DuckDuckGo: not in results.
- Search Console: no data yet.

---

**Action:** Submitted the sitemap (https://business.constructor.university/guillemots/wp-sitemap.xml) in Search Console, and made every publish from GitHub resubmit it automatically.

**Reason:** Only the front page is indexed; the other 7 pages are unknown to Google, and no sitemap had been submitted. WordPress updates the sitemap itself, but Google only re-reads it on its own schedule; resubmitting tells it there is new content.

**Outcome:** Accepted, no errors; Google has not processed it yet. The automatic resubmit works (tested by hand). Google treats it as a hint, so pages may still take days to be indexed.

---

**Action:** Activated the Complianz plugin: cookie consent banner (Accept / Deny / View preferences), cookie blocker and a Cookie Policy page (https://business.constructor.university/guillemots/cookie-policy-eu/).

**Reason:** The site is in Germany and we plan to add Google Analytics, which needs consent first under the GDPR. The site had no cookie or privacy information.

**Outcome:** Banner and Cookie Policy live. While checking, we found that our earlier note that Analytics loaded without consent was wrong: Analytics was never connected in Site Kit. Next: connect GA4 and test that it loads only after "Accept".

---

## 2026-11-02

**Action:** Added About (team, roles, team photo, use of AI), Contact, Imprint (draft until the responsible person is confirmed) and Privacy Policy pages, and put them in the footer.

**Reason:** The home page linked to "Get to know the Guillemots team" but no About page existed, and a site in Germany needs contact and privacy information. Clear authorship should also help search engines and AI assistants trust and describe the site correctly. The Fulmars' site (competitor) has all of these pages.

**Outcome:** Pending.

---

**Action:** Fixed the footer "Transparency" menu, whose FAQ, Knowledge Centre and Lab links still pointed to the old trashed pages, and moved the menu into the repo (`pages/navigation-footer-transparency.html`).

**Reason:** Those links did not appear on the live site.

**Outcome:** FAQ, Knowledge Centre and Cookie Policy show in the footer; the other links appear once their pages are published.

---

**Action:** Added structured data (JSON-LD) to every page: the project (schema.org Project, with a description that says it is a fictional student project), WebSite, the page type (About, Contact, FAQ, collection pages), breadcrumbs, a DefinedTerm on "What is Grohnpetrel?" and an FAQPage built from the visible FAQ questions. The sync can now also publish Journal posts and translated pages with hreflang.

**Reason:** No page had structured data, while a competing team (Fulmars) has it on every page. Structured data helps search engines and AI assistants identify what Grohnpetrel is and who made it.

**Outcome:** Pending (check with Google's Rich Results Test after publishing).

---

**Action:** Rewrote every page title (the text Google shows as the blue link) to start with the keyword and say what the page answers, e.g. "Grohnpetrel FAQ: What It Is, the Name, Who Made It". Linked the home page's "About us" button (it had no link) to the new About page and added About to the main menu.

**Reason:** Titles were just the page name plus "– Grohnpetrel". The competitor (Fulmars) uses descriptive, keyword-first titles.

**Outcome:** Pending.
