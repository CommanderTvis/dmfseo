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

**Action:** Submitted the sitemap (https://business.constructor.university/guillemots/wp-sitemap.xml) in Search Console, and made every publish from GitHub resubmit it automatically.

**Reason:** Only the front page is indexed; the other 7 pages are unknown to Google, and no sitemap had been submitted. WordPress updates the sitemap itself, but Google only re-reads it on its own schedule; resubmitting tells it there is new content.

**Outcome:** Accepted, no errors; Google has not processed it yet. The automatic resubmit works (tested by hand). Google treats it as a hint, so pages may still take days to be indexed.

---

**Action:** Activated Complianz in WordPress: cookie banner (Accept / Deny / View preferences), cookie blocker, Cookie Policy page (https://business.constructor.university/guillemots/cookie-policy-eu/). GDPR rules; Do Not Track / Global Privacy Control count as "deny".

**Reason:** The site is in Germany, we plan to add Google Analytics (needs prior consent), and we had no Privacy or Cookie Policy.

**Outcome:** Banner and policy are live. Analytics is not connected yet. Done in WordPress, outside the repo. Next: connect GA4 in Site Kit and test that it loads only after "Accept".

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

---

**Action:** Published "Seabirds of the North Sea", a guide with an overview page and six species pages (northern gannet, Atlantic puffin, black-legged kittiwake, common tern, Eurasian oystercatcher, European storm petrel), each with key facts, threats and source links. Linked it from the Knowledge Centre and the footer.

**Reason:** Our site had 8 pages; a competing team (Fulmars) has 10 product pages plus articles. Sourced, useful pages on real seabirds give search engines and AI assistants more reasons to see our site as a reliable source on the topic, and give visitors something worth reading.

**Outcome:** Pending.

---

**Action:** Started the Journal: fixed and published "How We Defined Grohnpetrel" (its links pointed to old page addresses), added two articles ("What a Hidden Noindex Header Taught Us About SEO", "Why We Built a Seabird Guide for an Invented Keyword") and a Journal page in the main menu. The sync script now publishes posts too.

**Reason:** Dated articles show ongoing activity and real experience, which helps credibility with search engines and AI assistants. The competitor (Fulmars) has four articles.

**Outcome:** Pending.

---

**Action:** Published the SEO / GEO Lab page with the research question, method, the dated 28 October baseline, the noindex finding (now resolved), the first Google rankings and a dated list of our changes.

**Reason:** The page was an empty draft. It is our main evidence page and links our actions to measured results.

**Outcome:** Pending.

---

**Action:** Added German versions of "What is Grohnpetrel?" and the FAQ, linked to the English pages with hreflang tags and marked as German (`lang="de-DE"`), with their own FAQPage structured data.

**Reason:** We rank in Germany, and a competing team (Fulmars) offers a German version of its site. German pages can match German searches such as "Was ist Grohnpetrel".

**Outcome:** Pending.

---

**Action:** Added a "Merchandise: Plans, Not Sales" page that explains our planned items (stickers, poster, tote bag), their learning links and our rules (no sales before registration, every printed fact sourced on the site).

**Reason:** The course includes a merchandise marketing plan; this page shows its public side without selling anything. The competitor has a merch page too.

**Outcome:** Pending.

---

## 2026-11-03

**Action:** Added Bremen wording to the front page (first sentence says the project is from Bremen, Germany; Grohn named as the Bremen district on the Weser near the North Sea and Wadden Sea) and to "What is Grohnpetrel?", rewrote both meta descriptions around Bremen-Grohn, and added a visible link from each to the German page.

**Reason:** The professor's check (Google.de, desktop, location Bremen, 2 Nov) had Puffins at #1 and us at #2, the same as our tracker. Puffins' pages lean heavily on Bremen and Grohn.

**Outcome:** Pending. Compare the 🇩🇪 ranks in the tracker after Google re-crawls.
