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

**Action:** Mentioned Bremen-Grohn on the front page, on "What is Grohnpetrel?" and in their meta descriptions.

**Reason:** On Google.de we were #2 behind another team's site, which leans heavily on Bremen and Grohn.

**Outcome:** No visible effect; the rise to #1 on 4 Nov followed the German version, published the same day.

---

**Action:** Published a full German version of the site under /de/ (https://business.constructor.university/guillemots/de/), linked to the English pages, and added a link to our GitHub repository.

**Reason:** We rank in Germany, but only two pages were in German; search engines prefer a separate, linked page per language.

**Outcome:** On 4 Nov "grohnpetrel" ranked #1 on Google in Germany (not in the top 10 the day before), and "what is grohnpetrel" #1 in Germany, the US and the UK.

---

**Action:** Linked our key pages from our public GitHub repository (https://github.com/CommanderTvis/dmfseo) and archived it on Zenodo with a DOI (https://doi.org/10.5281/zenodo.23926767).

**Reason:** Backlink building: GitHub and Zenodo are crawled often and trusted by search engines, Google Scholar and AI assistants, and they confirm our site as the source.

**Outcome:** Published 3 Nov; pickup by search engines and AI assistants pending.

---

## 2026-11-04

**Action:** Strengthened the pages that compete for "grohnpetrel", in English and German: "What is Grohnpetrel?" (220 → 580 words), the FAQ (8 → 14 questions) and the front page (550 → 950 words, with the six seabird species, the mascot and short answers); "| Grohnpetrel" in all seabird page titles; main images for share previews and structured data; and a Journal post on the ranking drop.

**Who:** Diego Aguilar.

**Reason:** On 3 Nov we were out of Google's top 10 for "grohnpetrel", while another team's site held positions 1 to 4 with longer pages that name Grohnpetrel clearly.

**Outcome:** No improvement: on 5 Nov we were still outside Google's top 10 for "grohnpetrel" in all three countries, and "what is grohnpetrel" dropped out too.

---

## 2026-11-05

**Action:** Matched the technical SEO of Yoast SEO (free, default settings) in our own code instead of installing the plugin: Yoast's robots rules (search results, date archives and 404 pages not indexed), title patterns, canonical links on archives, publication and update times and reading time in share previews, and structured data in Yoast's format, keeping our definition, FAQ and German breadcrumbs.

**Reason:** Search engines read these signals the same way on every WordPress site; matching the common defaults closes the gaps without a plugin we could not manage from GitHub.

**Outcome:** Pending.

---

**Action:** Sped up the pages: WebP images, lighter loading of styles and fonts.

**Reason:** PageSpeed Insights (5 Nov, mobile): 3.0 s until the main content showed.

**Outcome:** Pending.

---

**Action:** Redesigned the site in English and German: one look for every page (ocean-teal and ivory colours, serif headings, wider layout), a front page rebuilt into ten sections with the existing texts, four North Sea photos from Wikimedia Commons (CC BY-SA 4.0, credited on the page), a shorter main menu, the Imprint published, and broken and redirecting links fixed.

**Who:** Diego Aguilar.

**Reason:** Our 5 Nov audit found no indexing problems, but broken links to the unpublished Imprint, links through redirects, a narrow text column and a plain front page. Another team's site took positions 1, 2 and 4 for "grohnpetrel" in Germany that day with long pages.

**Outcome:** Pending.

---

## 2026-11-06

**Action:** Cheap experiment: added an `llms.txt` (a short markdown guide to the site for language models) at `/guillemots/llms.txt`, linked from every page head. We do not control the domain root, so it cannot sit at `/llms.txt`.

**Reason:** We are not cited in Google's AI Overview for "grohnpetrel"; no AI provider has confirmed it reads `llms.txt`, so we test it at near-zero cost.

**Outcome:** Pending.

---

**Action:** Added Spanish and Chinese (Simplified) versions of the three main pages: front page (/es/, /zh/), What is Grohnpetrel? and the FAQ (15 questions each). The snippets now support any number of languages: every translated page lists all its translations in hreflang links and in the language switcher, sets the right html lang (es-ES, zh-CN), og:locale, reading time and structured-data language, and Spanish and Chinese pages get their own main menu. The English and German FAQ got a 15th question ("In which languages is Grohnpetrel available?"), the definition pages list the languages, the footer links to the Spanish and Chinese definitions, and llms.txt lists the new pages (and the corrected German address). The translated pages say that they were translated by the team with AI help and that the English text is the original.

**Who:** Diego Aguilar.

**Reason:** No rival site offers Spanish or Chinese, so these searches and AI answers in those languages have no competing Grohnpetrel page. Rival sites rank with many pages that each say "Grohnpetrel" clearly; six new pages in two more languages add that, with hreflang so search engines show each visitor the right language instead of treating them as duplicates. Note: Google is blocked in mainland China, so the Chinese pages mainly reach Google users in Hong Kong, Taiwan, Singapore and elsewhere, and AI assistants.

**Outcome:** Pending. Check that Google indexes /es/ and /zh/ (site: search, Search Console) and whether "grohnpetrel" queries in Spanish or Chinese show our pages.

---

## 2026-11-07

**Action:** Audited the results page and three rival team sites (titles, headings, structured data, sitemaps, social profiles) and compared our rank tracker with the course's snapshots. Findings: for "grohnpetrel", about half of Google's top 10 are now Instagram posts, reels and YouTube videos from other teams; Google's AI Overview describes Grohnpetrel as a student brand of drinks and clothing and does not mention us; on 4, 5 and 7 Nov our non-personalised check found no team website at all in the US and UK top 10. Quoted "grohnpetrel" stays #1 in the US and UK, and Brave ranks our Zenodo record in its top 4 on most days. Our canonicals, hreflang and titles passed; no change needed there.

**Reason:** The course snapshots (Google.de, English, Bremen) put us #2 to #4 behind other teams from 2 to 7 Nov; we wanted evidence for why before changing anything.

**Outcome:** The gap is mainly off-site (no social posts or videos), not on-page. Next test (team): one clearly labelled video and post on team-owned channels linking to the site; compare the same queries for 14 days.

---

**Action:** Set category, tag and author archive pages to "noindex, follow" and removed them from the sitemap (a deliberate change from Yoast's defaults); added our Zenodo DOI to the project's `sameAs` in structured data; front pages in all four languages now open with one sentence that says what Grohnpetrel is, that it is fictional, and who made it; updated the SEO / GEO Lab (EN, DE) with ranks up to 7 Nov, the 3 to 7 Nov changes and the 7 Nov observations; added `scripts/check_pages.py` and a `site-checks` workflow that test pages before publishing.

**Reason:** Search Console showed /category/uncategorized/ getting impressions for "grohnpetrel" (2 Nov), competing with our real pages while only repeating the Journal. The AI Overview attributes Grohnpetrel to brands; a self-contained first sentence with our team's name is easier to quote. The Lab page had not been updated since 2 Nov.

**Outcome:** Pending. Check that /category/uncategorized/ shows `noindex` and is gone from wp-sitemap.xml, and whether the AI Overview or the course snapshot changes in the next week.

---

**Action:** Linked the team's new social media profiles (Instagram, YouTube, TikTok, Facebook, LinkedIn) from the site: a "Follow the project" row with icons on the front page in all four languages and on About and Contact (EN/DE), the profiles added to the project's `sameAs` in structured data, and a "Social media" section in llms.txt. On 7 Nov Instagram, TikTok and YouTube had no posts yet; Facebook could not be checked without logging in.

**Who:** Diego Aguilar.

**Reason:** The 7 Nov audit found that about half of Google's top 10 for "grohnpetrel" are other teams' Instagram and YouTube posts, and the gap is mainly off-site. Linking site and profiles both ways (site → profiles here, profiles → site in their bios) tells search engines and AI assistants that they belong to the same project, so future posts strengthen the site rather than compete with it.

**Outcome:** Pending. Next: add the website link to every profile bio, then publish the first video and posts (team).

## 2026-11-08

**Action:** Published a sourced in-depth article in English and German, "How Plastic Pollution Affects North Sea Seabirds" / "Wie Plastikmüll den Seevögeln der Nordsee schadet" (about 1,000 words each), as Journal posts with Article structured data: the fulmar plastic indicator on the German North Sea coast (German Environment Agency, OSPAR), gannet nests built with fishing nets (O'Hanlon et al. 2019; Helgoland: Schrey & Vauk 1987, NABU), the global picture (Wilcox et al. 2015), a table of key numbers and practical advice. Linked it from the threats and take-action pages, the Knowledge Centre, the gannet pages and the Journal lists on both front pages.

**Who:** Diego Aguilar.

**Reason:** The rank tracker showed our German definition page at #1 for "grohnpetrel" in Germany on 8 Nov, but rival sites hold several positions with long, specific pages, and our conservation content had no in-depth, sourced article yet. A useful article with verifiable numbers strengthens the site's topic and gives AI assistants citable facts next to our definition.

**Outcome:** Pending. Check indexing of the two new posts and whether they appear for seabird and plastic searches.

---

**Action:** Second round of the day. A second sourced article in English and German, "Why the Wadden Sea Matters for Birds" / "Warum das Wattenmeer für Vögel wichtig ist" (UNESCO World Heritage facts; long-term waterbird trends from the trilateral 2025 report), linked from the oystercatcher pages, the Knowledge Centre, the front-page Journal lists and the footer. The licensed gannet and puffin photos now also illustrate the gannet and puffin pages (EN/DE). Structured data: articles and pages with a Sources section now list those sources as `citation`, and the seabird guide overview (EN/DE) declares its six species pages as an `ItemList`.

**Who:** Diego Aguilar.

**Reason:** Rival sites added pages this week (a social media hub, "about" and collection pages) and rank with several long pages each; one rival marks up its product overview as an ItemList. Two well-sourced articles give the site more depth on its own topic, and machine-readable citations and lists make the facts easier for search engines and AI assistants to check and quote.

**Outcome:** Pending. Validate with Google's Rich Results Test / Schema Markup Validator; check indexing of the four new posts.

## 2026-11-09

**Action:** Two new page types in English and German. (1) "Grohnpetrel: Meanings of an Invented Word": explains that several student projects in the course use the word (drinks, beer and rain-gear brand concepts, and our conservation concept), how to tell them apart and which one this site is, without naming or linking other teams; linked from the definition pages, FAQ question 11 and the footer. (2) A "Seabird and Coast Glossary" with 21 short definitions (from petrel and bird cliff to Wadden Sea, ghost nets, microplastics and the fulmar plastic indicator), marked up as a DefinedTermSet; linked from the Knowledge Centre and the footer. llms.txt lists the new pages and the two 8 Nov articles.

**Who:** Diego Aguilar.

**Reason:** The course snapshot of 9 Nov has us at organic #1 (and #4), but Google's AI Overview describes Grohnpetrel as a Bremen drinks brand. An AI answer to "what is Grohnpetrel" has to deal with several meanings; a neutral page that lists them and states ours clearly is the kind of source such answers can cite. The glossary adds short, quotable definitions with machine-readable markup that no rival site has.

**Outcome:** Pending. Check whether the AI Overview or other AI answers mention the conservation meaning or cite the new pages.

---

**Action:** Removed Complianz: dropped the plugin from the site configuration, the cookie banner styles from the performance snippet, the Cookie Policy links from the footer menus, and the consent and Google Analytics wording from the Privacy Policy (English and German). The publish also deactivates the plugin and moves the Cookie Policy page to the trash.

**Reason:** Analytics was never connected, so the banner had nothing to ask consent for; it only added requests and layout work to every page.

**Outcome:** Pending.
