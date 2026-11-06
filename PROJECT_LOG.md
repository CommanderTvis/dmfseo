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

**Outcome:** Baseline on Google: "grohnpetrel" #2 in 🇺🇸, #6 in 🇩🇪 and 🇬🇧; quoted "grohnpetrel" #2 everywhere; other queries not in top 10. Another team's site #1. Not in DuckDuckGo results.

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

**Reason:** The home page linked to a missing About page, and a site in Germany needs contact and privacy information. Clear authorship also helps search engines and AI assistants describe us.

**Outcome:** Pending. FAQ, Knowledge Centre and Cookie Policy show in the footer; the rest appear once published.

---

**Action:** Technical SEO on every page: structured data (JSON-LD for the project, website, page type, breadcrumbs, a definition on "What is Grohnpetrel?" and an FAQ built from the visible questions); keyword-first titles, e.g. "Grohnpetrel FAQ: What It Is, the Name, Who Made It"; German versions of "What is Grohnpetrel?" and the FAQ with hreflang links and `lang="de-DE"`; the home page's "About us" button now links to About, which is also in the main menu. The sync can now publish posts and translated pages.

**Who:** Diego Aguilar.

**Reason:** No page had structured data and titles were only the page name plus "– Grohnpetrel". This helps search engines and AI assistants identify what Grohnpetrel is and who made it, and lets German pages match searches like "Was ist Grohnpetrel".

**Outcome:** Pending (check structured data with Google's Rich Results Test).

---

**Action:** Published new content: "Seabirds of the North Sea" (an overview and six sourced species pages), a Journal ("How We Defined Grohnpetrel", "What a Hidden Noindex Header Taught Us About SEO", "Why We Built a Seabird Guide for an Invented Keyword"), the SEO / GEO Lab page (method, dated 28 October baseline, rankings, list of changes) and a "Merchandise: Plans, Not Sales" page.

**Who:** Diego Aguilar.

**Reason:** We had 8 pages. Sourced pages and dated articles show real, ongoing work and give search engines, AI assistants and visitors more to rely on. The Lab page was an empty draft and is our main evidence page; the merch page shows the public side of the course's marketing plan.

**Outcome:** Pending.

---

## 2026-11-03

**Action:** Added Bremen wording to the front page (first sentence says the project is from Bremen, Germany; Grohn named as the Bremen district on the Weser near the North Sea and Wadden Sea) and to "What is Grohnpetrel?", rewrote both meta descriptions around Bremen-Grohn, and added a visible link from each to the German page.

**Reason:** On Google.de (desktop, location Bremen, 2 Nov) another team's site was #1 and we were #2, the same as our tracker. The #1 site leans heavily on Bremen and Grohn.

**Outcome:** Pending. Compare the 🇩🇪 ranks in the tracker after Google re-crawls.

---

**Action:** Full German version of the site under /de/ (https://business.constructor.university/guillemots/de/): a German front page and German versions of every page and Journal post (23 new, the two existing German pages moved under /de/ with redirects from their old addresses), German menus, a language link at the top of every translated page, and hreflang links (en, de, x-default) on every pair. No translation plugin: the pages are published from GitHub like the English ones. Added a "Source code on GitHub" link to the footer and to the structured data (`sameAs`).

**Reason:** We rank in Germany, but only two pages were in German and the front page had no German version. Search engines prefer a separate, linked page per language. A public profile outside the site helps search engines recognise the project as an entity; our public GitHub repository plays that role and shows how the site is built.

**Outcome:** Pending. Check that the German pages are indexed (Search Console) and compare the 🇩🇪 ranks in the tracker.

---

**Action:** Added a "What is Grohnpetrel?" section to the top of our public GitHub repository's README (https://github.com/CommanderTvis/dmfseo): a short definition with the disclaimer, and links to the front page, "What is Grohnpetrel?", the FAQ and the seabird guide in English and German.

**Reason:** Backlink building. GitHub links are `nofollow`, so they pass little ranking credit, but GitHub is crawled often by search engines and AI search tools. A second, consistent description of Grohnpetrel that points to our site can help pages get found and help AI assistants cite us. Our site already links to the repository, so the two confirm each other.

**Outcome:** Pending.

---

**Action:** Connected the GitHub repository to Zenodo and published release v1.0, which Zenodo archived as a citable record with a DOI: https://doi.org/10.5281/zenodo.23926767 (site pages in English and German, scripts, project log; creator "Team Guillemots", Constructor University; all rights reserved). Linked the DOI from the README.

**Reason:** Backlink building. A Zenodo record is a permanent, citable research source that links to our site; Zenodo records are indexed by search engines and Google Scholar and are trusted by AI assistants.

**Outcome:** Record published 3 Nov. Release v1.1 the same day added links to 16 key pages (English and German, including the Journal and its posts) in the record's description and related links. Whether search engines or AI assistants pick it up: pending.

---

## 2026-11-04

**Action:** Strengthened the three pages that compete for "grohnpetrel" itself, in English and German: "What is Grohnpetrel?" grew from about 220 to about 580 words (answer-first summary, an "at a glance" table, what Grohnpetrel is not, a one-sentence description to quote, links to every section); the FAQ grew from 8 to 14 questions (what the word means, whether it is official, why other sites use the name, where it is based, which real seabirds we cover, how to cite us); the front page got a "Grohnpetrel at a glance" box and alt text for its hero image. The definition page and FAQ now show the Grohnpetrel mascot with descriptive alt text and a caption; shared links now use the page's featured image or the mascot as a large preview (og:image with size and alt). A new Journal post in both languages ("What Happened to Our Rankings After a Big Update") reports the 2 to 3 Nov tracker change and what we did about it.

**Who:** Diego Aguilar.

**Reason:** On 3 Nov our tracker showed us out of Google's top 10 for "grohnpetrel" in all three countries, while one rival site held positions 1 to 4 with its front page, FAQ (about 660 words) and product overview. Our definition page had about 220 words and our FAQ 8 short answers. The new FAQ answers also tell search engines and AI assistants that several course sites use the same word, so they can tell our concept apart.

**Outcome:** Pending. Compare the tracker after Google re-crawls the three pages, and check Google Images for the mascot.

## 2026-11-04 (afternoon)

**Action:** Second update of the day, in English and German. The front page grew from about 550 to about 950 words: a table of the six seabird species with links, the mascot, three short answers (is it a real organisation, a real bird, who made it), the team photo and the latest Journal posts. All 14 seabird page titles now end in "| Grohnpetrel". The structured data now gives the project, every page and every Journal post a main image (the featured image, else the mascot). The two new Journal posts were moved from 18:00 to 12:00 so they publish now; they had been scheduled for the evening by mistake.

**Who:** Diego Aguilar.

**Reason:** On 3 Nov the rival site held the top positions for "grohnpetrel" with a front page of about 770 words and 14 images, brand-first titles on every page and many pages that each say "Grohnpetrel" clearly. Our front page had about 550 words and our seabird pages did not carry the name in their titles.

**Outcome:** Pending. Check the tracker over the next days, especially whether the front page returns to the top 10 for "grohnpetrel".

---

## 2026-11-05

**Action:** Matched the technical SEO of Yoast SEO (free, default settings) in our own code instead of installing the plugin: Yoast's robots rules (search results, date archives and 404 pages not indexed), title patterns, canonical links on archives, publication and update times and reading time in share previews, and structured data in Yoast's format, keeping our definition, FAQ and German breadcrumbs.

**Reason:** Search engines read these signals the same way on every WordPress site; matching the common defaults closes the gaps without a plugin we could not manage from GitHub.

**Outcome:** Pending. Check with Google's Rich Results Test and Search Console.

---

**Action:** Made the pages load faster: front-page photo and logo as WebP (280 KB → 27 KB), lighter loading of styles and fonts, and browser caching for images.

**Reason:** PageSpeed Insights (5 Nov, mobile) measured 3.0 s until the main content showed.

**Outcome:** Pending. Re-run PageSpeed Insights after publishing.

---

**Action:** Redesign and clean-up, in English and German. A new design snippet (snippets/design.php) gives the whole site one look: ocean-teal and ivory palette, serif headings, consistent buttons, tables and image corners, a wider 1180 px layout for sections, cards and full-width bands. The front page was rebuilt into ten sections: a photo hero with the H1 "Grohnpetrel: Coastal Conservation & Seabird Education" and two buttons, What is Grohnpetrel? (with a sentence that other, unrelated sites use the same word), Our Main Goals as three cards, Why Coastal Conservation Matters, the seabird guide, six Explore cards (Mission, Conservation, Programmes, Knowledge Centre, FAQ, About), three quick answers, the team, the Journal and a closing banner. Existing texts were kept. Four photos of North Sea seabirds and coasts from Wikimedia Commons (CC BY-SA 4.0) were added with the authors and licence named on the page. The main menu went from ten to eight entries (About, Conservation and Resources now have sub-menus) and its Home link no longer goes through a redirect. The Imprint (EN/DE) was published with Mario Iraheta as the responsible person; the footer had linked to it while it was still a draft (404). A broken link from the English rankings post to the German one was fixed.

**Who:** Diego Aguilar.

**Reason:** Audit on 5 Nov: no X-Robots-Tag or noindex on our pages, sitemap fine, one H1 per page, no images without alt text; but 2 broken links (Imprint EN/DE), 2 links through redirects, a 645 px text column and a plain front page. On 5 Nov a new rival site took positions 1, 2 and 4 for "grohnpetrel" in Germany with long pages (about 1,000 to 1,700 words) whose addresses all contain the word; the other leading rival has a front page with 14 images.

**Outcome:** Pending. Check the tracker from 7 Nov; check the front page on desktop and mobile after publishing.

---

**Action:** Cheap experiment: added an `llms.txt` (a short markdown guide to the site for language models) at `/guillemots/llms.txt`, linked from every page head. We do not control the domain root, so it cannot sit at `/llms.txt`.

**Reason:** We are not cited in Google's AI Overview for "grohnpetrel"; no AI provider has confirmed it reads `llms.txt`, so we test it at near-zero cost.

**Outcome:** Pending.

## 2026-11-06

**Action:** Added Spanish and Chinese (Simplified) versions of the three main pages: front page (/es/, /zh/), What is Grohnpetrel? and the FAQ (15 questions each). The snippets now support any number of languages: every translated page lists all its translations in hreflang links and in the language switcher, sets the right html lang (es-ES, zh-CN), og:locale, reading time and structured-data language, and Spanish and Chinese pages get their own main menu. The English and German FAQ got a 15th question ("In which languages is Grohnpetrel available?"), the definition pages list the languages, the footer links to the Spanish and Chinese definitions, and llms.txt lists the new pages (and the corrected German address). The translated pages say that they were translated by the team with AI help and that the English text is the original.

**Who:** Diego Aguilar.

**Reason:** No rival site offers Spanish or Chinese, so these searches and AI answers in those languages have no competing Grohnpetrel page. Rival sites rank with many pages that each say "Grohnpetrel" clearly; six new pages in two more languages add that, with hreflang so search engines show each visitor the right language instead of treating them as duplicates. Note: Google is blocked in mainland China, so the Chinese pages mainly reach Google users in Hong Kong, Taiwan, Singapore and elsewhere, and AI assistants.

**Outcome:** Pending. Check that Google indexes /es/ and /zh/ (site: search, Search Console) and whether "grohnpetrel" queries in Spanish or Chinese show our pages.
