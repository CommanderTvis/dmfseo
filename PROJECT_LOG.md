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

**Action:** Added About (team, roles, photo, use of AI), Contact, Imprint (draft until the responsible person is named) and Privacy Policy pages; linked them in the footer.

**Who:** Diego Aguilar.

**Reason:** The home page linked to a missing About page, and a site in Germany needs contact and privacy information. Clear authorship also helps search engines and AI assistants describe us. The competitor (Fulmars) has these pages.

**Outcome:** Pending.

---

**Action:** Fixed the footer "Transparency" menu (old links to trashed pages) and moved it into the repo.

**Who:** Diego Aguilar.

**Reason:** Those links did not show on the live site.

**Outcome:** FAQ, Knowledge Centre and Cookie Policy show; the rest appear once published.

---

**Action:** Added structured data (JSON-LD) to every page: project, website, page type, breadcrumbs, a definition on "What is Grohnpetrel?" and an FAQ built from the visible questions. The sync can also publish Journal posts and translated pages.

**Who:** Diego Aguilar.

**Reason:** No page had structured data; Fulmars has it everywhere. It helps search engines and AI assistants identify what Grohnpetrel is and who made it.

**Outcome:** Pending (check with Google's Rich Results Test).

---

**Action:** Rewrote every page title to start with the keyword and say what the page answers, e.g. "Grohnpetrel FAQ: What It Is, the Name, Who Made It". Linked the home page's "About us" button to the About page and added About to the main menu.

**Who:** Diego Aguilar.

**Reason:** Titles were just the page name plus "– Grohnpetrel"; Fulmars uses descriptive, keyword-first titles.

**Outcome:** Pending.

---

**Action:** Published "Seabirds of the North Sea": an overview and six sourced species pages (gannet, puffin, kittiwake, common tern, oystercatcher, storm petrel). Linked from the Knowledge Centre and footer.

**Who:** Diego Aguilar.

**Reason:** We had 8 pages; Fulmars has 10 product pages plus articles. Sourced pages on real seabirds make us a more reliable source for search engines, AI assistants and visitors.

**Outcome:** Pending.

---

**Action:** Started the Journal: published "How We Defined Grohnpetrel" (links fixed), added two articles ("What a Hidden Noindex Header Taught Us About SEO", "Why We Built a Seabird Guide for an Invented Keyword") and a Journal page in the main menu. The sync now publishes posts.

**Who:** Diego Aguilar.

**Reason:** Dated articles show ongoing activity and real experience. Fulmars has four articles.

**Outcome:** Pending.

---

**Action:** Published the SEO / GEO Lab page: research question, method, dated 28 October baseline, the noindex finding (resolved), first Google rankings and a dated list of changes.

**Who:** Diego Aguilar.

**Reason:** It was an empty draft, and it is our main evidence page.

**Outcome:** Pending.

---

**Action:** Added German versions of "What is Grohnpetrel?" and the FAQ, with hreflang links, `lang="de-DE"` and their own FAQ structured data.

**Who:** Diego Aguilar.

**Reason:** We rank in Germany, and Fulmars offers a German version. German pages can match searches like "Was ist Grohnpetrel".

**Outcome:** Pending.

---

**Action:** Added a "Merchandise: Plans, Not Sales" page: planned items (stickers, poster, tote bag), their learning links and our rules (no sales before registration, every printed fact sourced).

**Who:** Diego Aguilar.

**Reason:** The course includes a merchandise marketing plan; this shows its public side without selling anything. The competitor has a merch page too.

**Outcome:** Pending.

---

## 2026-11-03

**Action:** Added Bremen wording to the front page (first sentence says the project is from Bremen, Germany; Grohn named as the Bremen district on the Weser near the North Sea and Wadden Sea) and to "What is Grohnpetrel?", rewrote both meta descriptions around Bremen-Grohn, and added a visible link from each to the German page.

**Reason:** The professor's check (Google.de, desktop, location Bremen, 2 Nov) had Puffins at #1 and us at #2, the same as our tracker. Puffins' pages lean heavily on Bremen and Grohn.

**Outcome:** Pending. Compare the 🇩🇪 ranks in the tracker after Google re-crawls.
