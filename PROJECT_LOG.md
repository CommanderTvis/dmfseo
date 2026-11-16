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

**Outcome (15 Nov):** The analytics portal has no page-level result attributable to this footer change; Search Console data currently ends on 10 Nov. The affected pages are live, but the result is not measurable from the available portal data.

---

**Action:** Technical SEO on every page: structured data (JSON-LD for the project, website, page type, breadcrumbs, a definition on "What is Grohnpetrel?" and an FAQ built from the visible questions); keyword-first titles, e.g. "Grohnpetrel FAQ: What It Is, the Name, Who Made It"; German versions of "What is Grohnpetrel?" and the FAQ with hreflang links and `lang="de-DE"`; the home page's "About us" button now links to About, which is also in the main menu. The sync can now publish posts and translated pages.

**Who:** Diego Aguilar.

**Reason:** No page had structured data and titles were only the page name plus "– Grohnpetrel". This helps search engines and AI assistants identify what Grohnpetrel is and who made it, and lets German pages match searches like "Was ist Grohnpetrel".

**Outcome (15 Nov):** The analytics portal records no Rich Results Test result. Search Console and rank data show the site continuing to appear, but do not isolate an effect from structured data.

---

**Action:** Published new content: "Seabirds of the North Sea" (an overview and six sourced species pages), a Journal ("How We Defined Grohnpetrel", "What a Hidden Noindex Header Taught Us About SEO", "Why We Built a Seabird Guide for an Invented Keyword"), the SEO / GEO Lab page (method, dated 28 October baseline, rankings, list of changes) and a "Merchandise: Plans, Not Sales" page.

**Who:** Diego Aguilar.

**Reason:** We had 8 pages. Sourced pages and dated articles show real, ongoing work and give search engines, AI assistants and visitors more to rely on. The Lab page was an empty draft and is our main evidence page; the merch page shows the public side of the course's marketing plan.

**Outcome (15 Nov):** Search Console data through 10 Nov shows impressions for the seabird guide and Atlantic puffin page (the guide reached positions 2–10 for North Sea bird queries; the puffin page reached position 1–2 for several puffin queries). The portal does not isolate the effect of the new articles or every page in this batch.

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

**Outcome (15 Nov):** Google rank tracking shows the site still in the top 10 for monitored queries through 14 Nov, and Brave returns the Zenodo record for several queries. The portal has no AI-assistant citation metric, so pickup by AI assistants is unconfirmed.

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

**Outcome (15 Nov):** Search Console and rank tracking show the site continuing to appear, but the analytics portal has no Rich Results Test or structured-data validation result and cannot isolate a ranking effect from this change.

---

**Action:** Sped up the pages: WebP images, lighter loading of styles and fonts.

**Reason:** PageSpeed Insights (5 Nov, mobile): 3.0 s until the main content showed.

**Outcome (15 Nov):** The analytics portal has no Core Web Vitals or speed metric. Rank tracking still shows the site in Google's top 10 on several monitored queries through 14 Nov, but cannot attribute that visibility to the speed change.

---

**Action:** Redesigned the site in English and German: one look for every page (ocean-teal and ivory colours, serif headings, wider layout), a front page rebuilt into ten sections with the existing texts, four North Sea photos from Wikimedia Commons (CC BY-SA 4.0, credited on the page), a shorter main menu, the Imprint published, and broken and redirecting links fixed.

**Who:** Diego Aguilar.

**Reason:** Our 5 Nov audit found no indexing problems, but broken links to the unpublished Imprint, links through redirects, a narrow text column and a plain front page. Another team's site took positions 1, 2 and 4 for "grohnpetrel" in Germany that day with long pages.

**Outcome (15 Nov):** Google rank tracking shows the site at #2 in Germany for “grohnpetrel” on 14 Nov, #5 in the US and UK, and #4 in Germany for “what is grohnpetrel”. The portal cannot separate the redesign effect from the other changes published around it.

---

## 2026-11-06

**Action:** Cheap experiment: added an `llms.txt` (a short markdown guide to the site for language models) at `/guillemots/llms.txt`, linked from every page head. We do not control the domain root, so it cannot sit at `/llms.txt`.

**Reason:** We are not cited in Google's AI Overview for "grohnpetrel"; no AI provider has confirmed it reads `llms.txt`, so we test it at near-zero cost.

**Outcome (15 Nov):** No direct AI-crawler or citation metric is available in the portal. The site still appears in Google's tracked results through 14 Nov, but the effect of `llms.txt` is unmeasured.

---

**Action:** Added Spanish and Chinese (Simplified) versions of the three main pages: front page (/es/, /zh/), What is Grohnpetrel? and the FAQ (15 questions each). The snippets now support any number of languages: every translated page lists all its translations in hreflang links and in the language switcher, sets the right html lang (es-ES, zh-CN), og:locale, reading time and structured-data language, and Spanish and Chinese pages get their own main menu. The English and German FAQ got a 15th question ("In which languages is Grohnpetrel available?"), the definition pages list the languages, the footer links to the Spanish and Chinese definitions, and llms.txt lists the new pages (and the corrected German address). The translated pages say that they were translated by the team with AI help and that the English text is the original.

**Who:** Diego Aguilar.

**Reason:** No rival site offers Spanish or Chinese, so these searches and AI answers in those languages have no competing Grohnpetrel page. Rival sites rank with many pages that each say "Grohnpetrel" clearly; six new pages in two more languages add that, with hreflang so search engines show each visitor the right language instead of treating them as duplicates. Note: Google is blocked in mainland China, so the Chinese pages mainly reach Google users in Hong Kong, Taiwan, Singapore and elsewhere, and AI assistants.

**Outcome (15 Nov):** The portal has no Search Console rows for the Spanish or Chinese pages through 10 Nov and no corresponding multilingual rank checks. Their indexing and ranking outcome is therefore not yet evidenced.

---

## 2026-11-07

**Action:** Audited the results page and three rival team sites (titles, headings, structured data, sitemaps, social profiles) and compared our rank tracker with the course's snapshots. Findings: for "grohnpetrel", about half of Google's top 10 are now Instagram posts, reels and YouTube videos from other teams; Google's AI Overview describes Grohnpetrel as a student brand of drinks and clothing and does not mention us; on 4, 5 and 7 Nov our non-personalised check found no team website at all in the US and UK top 10. Quoted "grohnpetrel" stays #1 in the US and UK, and Brave ranks our Zenodo record in its top 4 on most days. Our canonicals, hreflang and titles passed; no change needed there.

**Reason:** The course snapshots (Google.de, English, Bremen) put us #2 to #4 behind other teams from 2 to 7 Nov; we wanted evidence for why before changing anything.

**Outcome:** The gap is mainly off-site (no social posts or videos), not on-page. Next test (team): one clearly labelled video and post on team-owned channels linking to the site; compare the same queries for 14 days.

---

**Action:** Set category, tag and author archive pages to "noindex, follow" and removed them from the sitemap (a deliberate change from Yoast's defaults); added our Zenodo DOI to the project's `sameAs` in structured data; front pages in all four languages now open with one sentence that says what Grohnpetrel is, that it is fictional, and who made it; updated the SEO / GEO Lab (EN, DE) with ranks up to 7 Nov, the 3 to 7 Nov changes and the 7 Nov observations; added `scripts/check_pages.py` and a `site-checks` workflow that test pages before publishing.

**Reason:** Search Console showed /category/uncategorized/ getting impressions for "grohnpetrel" (2 Nov), competing with our real pages while only repeating the Journal. The AI Overview attributes Grohnpetrel to brands; a self-contained first sentence with our team's name is easier to quote. The Lab page had not been updated since 2 Nov.

**Outcome (15 Nov):** The portal sitemap report was processed on 14 Nov with 0 errors and 0 warnings; it reports 79 submitted and 0 indexed URLs, but does not expose the category URL's `noindex` state. The portal has no AI Overview measurement.

---

**Action:** Linked the team's new social media profiles (Instagram, YouTube, TikTok, Facebook, LinkedIn) from the site: a "Follow the project" row with icons on the front page in all four languages and on About and Contact (EN/DE), the profiles added to the project's `sameAs` in structured data, and a "Social media" section in llms.txt. On 7 Nov Instagram, TikTok and YouTube had no posts yet; Facebook could not be checked without logging in.

**Who:** Diego Aguilar.

**Reason:** The 7 Nov audit found that about half of Google's top 10 for "grohnpetrel" are other teams' Instagram and YouTube posts, and the gap is mainly off-site. Linking site and profiles both ways (site → profiles here, profiles → site in their bios) tells search engines and AI assistants that they belong to the same project, so future posts strengthen the site rather than compete with it.

**Outcome (15 Nov):** The portal has no social-profile or referral analytics. Google tracking shows YouTube/rival social results in the monitored top 10, but does not show whether the team's profiles link back or whether this change helped.

## 2026-11-08

**Action:** Published a sourced in-depth article in English and German, "How Plastic Pollution Affects North Sea Seabirds" / "Wie Plastikmüll den Seevögeln der Nordsee schadet" (about 1,000 words each), as Journal posts with Article structured data: the fulmar plastic indicator on the German North Sea coast (German Environment Agency, OSPAR), gannet nests built with fishing nets (O'Hanlon et al. 2019; Helgoland: Schrey & Vauk 1987, NABU), the global picture (Wilcox et al. 2015), a table of key numbers and practical advice. Linked it from the threats and take-action pages, the Knowledge Centre, the gannet pages and the Journal lists on both front pages.

**Who:** Diego Aguilar.

**Reason:** The rank tracker showed our German definition page at #1 for "grohnpetrel" in Germany on 8 Nov, but rival sites hold several positions with long, specific pages, and our conservation content had no in-depth, sourced article yet. A useful article with verifiable numbers strengthens the site's topic and gives AI assistants citable facts next to our definition.

**Outcome (15 Nov):** Search Console through 10 Nov shows the site's seabird content receiving impressions, including the guide for “north sea bird” (position 8) and “northern seabirds” (position 2); it contains no plastic-article query rows. The two new posts' indexing and effect are not separately established.

---

**Action:** Second round of the day. A second sourced article in English and German, "Why the Wadden Sea Matters for Birds" / "Warum das Wattenmeer für Vögel wichtig ist" (UNESCO World Heritage facts; long-term waterbird trends from the trilateral 2025 report), linked from the oystercatcher pages, the Knowledge Centre, the front-page Journal lists and the footer. The licensed gannet and puffin photos now also illustrate the gannet and puffin pages (EN/DE). Structured data: articles and pages with a Sources section now list those sources as `citation`, and the seabird guide overview (EN/DE) declares its six species pages as an `ItemList`.

**Who:** Diego Aguilar.

**Reason:** Rival sites added pages this week (a social media hub, "about" and collection pages) and rank with several long pages each; one rival marks up its product overview as an ItemList. Two well-sourced articles give the site more depth on its own topic, and machine-readable citations and lists make the facts easier for search engines and AI assistants to check and quote.

**Outcome (15 Nov):** The analytics portal contains no Rich Results Test or Schema Validator result. Search Console through 10 Nov shows the Wadden Sea article only once (“vögel im wattenmeer”, position 39), while the portal does not establish indexing of all four posts.

## 2026-11-09

**Action:** Two new page types in English and German. (1) "Grohnpetrel: Meanings of an Invented Word": explains that several student projects in the course use the word (drinks, beer and rain-gear brand concepts, and our conservation concept), how to tell them apart and which one this site is, without naming or linking other teams; linked from the definition pages, FAQ question 11 and the footer. (2) A "Seabird and Coast Glossary" with 21 short definitions (from petrel and bird cliff to Wadden Sea, ghost nets, microplastics and the fulmar plastic indicator), marked up as a DefinedTermSet; linked from the Knowledge Centre and the footer. llms.txt lists the new pages and the two 8 Nov articles.

**Who:** Diego Aguilar.

**Reason:** The course snapshot of 9 Nov has us at organic #1 (and #4), but Google's AI Overview describes Grohnpetrel as a Bremen drinks brand. An AI answer to "what is Grohnpetrel" has to deal with several meanings; a neutral page that lists them and states ours clearly is the kind of source such answers can cite. The glossary adds short, quotable definitions with machine-readable markup that no rival site has.

**Outcome (15 Nov):** The portal has no AI-answer or citation metric. Google rank tracking through 14 Nov continues to show the site for the monitored queries, but cannot measure whether the meanings page or glossary changed AI answers.

---

**Action:** Removed Complianz: dropped the plugin from the site configuration, the cookie banner styles from the performance snippet, the Cookie Policy links from the footer menus, and the consent and Google Analytics wording from the Privacy Policy (English and German). The publish also deactivates the plugin and moves the Cookie Policy page to the trash.

**Reason:** Analytics was never connected, so the banner had nothing to ask consent for; it only added requests and layout work to every page.

**Outcome (15 Nov):** Search Console data contains no analytics rows after the removal and no consent/traffic data; the portal therefore records no measurable outcome for removing Complianz.

## 2026-11-11

**Action:** Published an English and German explainer video, “What is Grohnpetrel?”, on the website with transcripts and prepared versions for social media.

**Who:** Diego Aguilar.

**Reason:** Course results: on 10 Nov we fell from #1 to #3, on 11 Nov back to #2 (rank tracker 11 Nov: #2 in Google DE, where a rival's "about" page is #1; #7 in the US; still #1 for "grohnpetrel" in quotes in the US and for "what is grohnpetrel" in the US and UK). In the UK a YouTube Short is the top result for "grohnpetrel", and the AI Overview describes the word through other teams' social posts. Our social profiles are still empty. A video on the site can appear in Google's video results, and the same video gives the team its first social post.

**Outcome (15 Nov):** The portal has no video-indexing report. Rank tracking after publication shows “grohnpetrel” on 14 Nov at #2 in Germany, #5 in the US and UK; the tracker cannot determine whether the video caused those positions.

---

**Action:** SEO/GEO sprint and Phase 2 refinement: audited technical SEO, improved FAQ and seabird content, updated the SEO / GEO Lab with reproducible results, added a six-seabird learning guide, and improved the Knowledge Centre and About pages in English and German.

**Who:** Diego Aguilar.

**Reason:** Course snapshot of 11 Nov: #2. The audit found no technical fault, so the work targets content gaps (seabird searches, missing FAQ answers), original citable data and a reusable resource, and makes existing content easier to find. A mobile PageSpeed test (97/100/100/100) showed no performance problem, so performance was left unchanged.

**Outcome (15 Nov):** Search Console through 10 Nov shows the seabird guide gaining impressions for North Sea queries, including position 2 for “northern seabird” and position 4 for “northern sea birds”. The portal has no separate row for the Lab report or the new Grohnpetrel answer.

---

**Action:** Added five educational videos in English and German, published them on the relevant pages, and launched French, Italian and Russian versions of the main pages with a simplified multilingual footer.

**Who:** Diego Aguilar.

**Reason:** The team asked for more videos to post on Instagram, TikTok and YouTube, and for the same videos on the site; the footer had become crowded (17 links in one column, English headings on German pages); new languages extend the approach that worked for Spanish and Chinese (one clear definition and FAQ per language). The French, Italian and Russian texts were translated with AI help and say so; a native speaker should review them.

**Outcome (15 Nov):** The portal has no video-indexing report and no Search Console rows for the French, Italian or Russian pages through 10 Nov. Google rank tracking shows no multilingual queries, so indexing is unconfirmed.

## 2026-11-12

**Action:** Added an Editorial Policy and Corrections page in English and German, plus an “About this page” transparency box across the educational content in all seven languages.

**Who:** Diego Aguilar.

**Reason:** Activity 2 asked for two improvements per E-E-A-T dimension. Grohnpetrel is fictional, so trust has to come from transparency and checkable work. Of our eight proposals, these two (Trustworthiness 1 and 2, plus Expertise 1) can be done in code; the others need the team (a field visit with own photos, an expert review with permission, approved mentions, active social profiles).

**Outcome (15 Nov):** Search Console data through 10 Nov contains no rows for the editorial-policy pages or the “About this page” boxes. The analytics portal therefore provides no measurable search outcome yet.

---

**Action:** Simplified the English and German “Meanings of Grohnpetrel” pages by removing unnecessary product references that could associate our site with another team’s concept.

**Who:** Diego Aguilar.

**Reason:** Google.de #1 for "grohnpetrel" went from us (8 and 9 Nov) to another team's drinks site (10 and 11 Nov), the day after we published the page. Our page, linked from every footer, named beer as a meaning of the word and may have tied our site to the drinks meaning, which that site answers better. This is a hypothesis, not proven: the page itself never appeared in the recorded top 10, and the other site's pages did not change.

**Outcome (15 Nov):** After the fix, Google.de “grohnpetrel” was #2 on 12–14 Nov; the 14 Nov result was the German FAQ. The portal shows recovery from the 10 Nov drop to #2, but cannot attribute it solely to this wording change.

---

**Action:** After team review, removed references to other teams’ concepts from the meanings page, front pages and FAQs, and reduced its site-wide prominence to avoid search cannibalisation.

**Who:** Diego Aguilar, after feedback from Iaroslav Postovalov.

**Reason:** Even without the word beer, our pages still put the words drinks and clothing next to "Grohnpetrel" on every front page and, through the footer, on every page. That can tie our site to meanings that other teams' sites answer better. Tracker, 12 Nov: Google.de #2 behind another team's German front page; Google.co.uk shows a YouTube Short at #1 for "grohnpetrel". Cannibalisation (front page, What is Grohnpetrel? and FAQ all ranking for "grohnpetrel" in German): we keep the three pages because they answer different intents (project, definition, questions) and deliberately do not change titles or slugs now, to avoid more churn; we review after 7 days of stable pages.

**Outcome (15 Nov):** The latest comparable check (14 Nov) puts “grohnpetrel” at #2 in Germany, #5 in the US and #5 in the UK; the German FAQ ranked in Germany. The requested 19 Nov comparison is outside the portal's current data.

---

**Action:** Started the final presentation with results, strategy, reflection, the CEO merchandise plan and the project log; added a draft final reflection and prepared social-media copy.

**Who:** Diego Aguilar.

**Reason:** The presentation is 80% of the grade and covers results, strategy, reflection, communication and the CEO marketing plan; starting it now lets the team rehearse and fill in the last numbers. The tracker shows a YouTube Short at #1 on Google UK on 12 Nov, so the team starts posting the videos from 13 Nov. Other teams are not named in the public deck; we name them orally.

**Outcome (15 Nov):** The public analytics dashboard is available and the tracker data through 14 Nov is reflected in the deck materials. The portal has no data about team review or proofreading; the presentation PDF URL checked here returned 404.

---

**Action:** Improved the presentation deck and published a web version with the PDF, speaker notes and presenter mode on GitHub Pages; blocked it from search indexing.

**Who:** Diego Aguilar.

**Reason:** The team chose Slidev (Iaroslav: Markdown suits both the team and AI tools) and wants one link to present and proofread from, with no local install. The deck must not rank for "grohnpetrel" and split our position, which is the cannibalisation lesson from 12 Nov.

**Outcome (15 Nov):** The slides page is reachable, but the checked PDF path returned 404. The analytics portal has no evidence about proofreading or pull requests.

## 2026-11-14

**Action:** Phase 3: added a sourced coastal-habitat page in English and German, improved the front-page layout and conservation navigation, and made verified social links easier to find across the site.

**Who:** Diego Aguilar.

**Reason:** The team's Phase 3 brief: make coastal education easier to find, use screen space better and make verified social channels easy to find, without rebuilding the site. Titles, meta descriptions, slugs and H1s of existing pages are unchanged. This breaks the "no edits until 19 Nov" plan of 12 Nov, so ranking changes after 14 Nov cannot be attributed to the 12 Nov meanings fix alone.

**Outcome (15 Nov):** The portal has no Search Console data after 10 Nov and no social referral data, so it cannot yet show indexing or link usage for the new page. The 21 Nov check remains outside the available data.

---

**Action:** Fixed the coastal-habitat cards and front-page alignment after the Phase 3 live check.

**Who:** Diego Aguilar.

**Reason:** Found in the live desktop check on 14 Nov. Mobile check (390 px): no horizontal scrolling, cards stack in one column, buttons at least 41 px high.

**Outcome (15 Nov):** The live layout check reported no horizontal scrolling at 390 px and correctly stacked cards; the portal has no layout or usability metric to add.

---

**Action:** Phase 4: expanded the English and German seabird guide with species profiles, improved the homepage and Knowledge Centre, strengthened the conservation glossary and Take Action page, and added links between related educational content without creating duplicate pages.

**Who:** Diego Aguilar.

**Reason:** Team brief for Phase 4. A separate "North Sea Seabirds: Species, Threats & Conservation" page was not created because the seabird guide already covers the same intent and a second page would compete with it in search (the cannibalisation problem we saw on 12 Nov); the guide keeps its URL and title and gains the requested profiles. The same rule applied to the homepage section, the glossary and Take Action: existing sections were improved, not duplicated.

**Outcome (15 Nov):** Search Console through 10 Nov already shows impressions for the existing guide and species content (the Atlantic puffin page reached position 1–2 for several queries), but contains no post-14 Nov data for this update and no image-search breakdown. The 21 Nov check remains outstanding.

---

**Action:** Balanced typography on the species cards and Take Action steps, and aligned the glossary navigation after the Phase 4 live check.

**Who:** Diego Aguilar.

**Reason:** Found on the live desktop check on 14 Nov.

**Outcome (15 Nov):** The live CSS check is complete: the species-card and “5 Ways” typography was corrected and the glossary jump box aligns with the text column. The analytics portal has no CSS or layout metric.

## 2026-11-15

**Action:** Phase 5: "Coastal Guardian Challenge", a five-question learning game on a new page, `/coastal-guardian-challenge/` (English). Each question gives a coastal situation with three answers; after "Check Answer" the visitor sees whether the answer was right, an explanation, the correct answer if needed and a link to the page that covers the topic. One point per correct answer; six result messages for 0–5 points; "Try Again" resets everything. The page contains all questions, answers, explanations and the score table as normal HTML, so it works without JavaScript and can be read by search engines; a separate snippet (`snippets/challenge.php`) turns it into the game on that page only. No plugin, no external requests, no cookies or stored scores. Entry points: a small "Become a Coastal Guardian" section on the English front page after "Protect Our Coasts", a link in the Knowledge Centre topic list and one under "5 Ways" on Take Action, and a "Continue exploring" box on the challenge page.

**Who:** Diego Aguilar.

**Reason:** Team brief for Phase 5: an interactive, educational feature that keeps visitors on the site and links them to the existing guides. No similar page existed (`/coastal-guardian-challenge/` returned 404 on 15 Nov). Question 3 (injured bird) links to NABU's official guidance because our site has no rescue advice and must not invent rescue contacts.

**Outcome:** Before publishing, an automated browser test played all six possible scores at desktop and phone width, a mixed run, a keyboard-only answer and a run without JavaScript: all correct. Live check pending after publishing.

---

**Action:** Coastal Guardian Challenge, first live check: the feedback repeated "Not quite" / "Correct" (status line and message) and "Learn more:" twice. The status line now shows the icon with the first words of the message, and the link line appears once.

**Who:** Diego Aguilar.

**Reason:** Found while playing the published game on 15 Nov.

**Outcome:** Automated test of all six scores, keyboard and no-JavaScript fallback passed again before publishing; live check after publishing.

---

**Action:** Phase 6: multimedia SEO and content credibility. (1) Images: the eight openly licensed photos now carry licence details in the structured data (licence, creator, credit line and the Wikimedia Commons page where the licence can be checked), so Google Images can show "Licensable" details; the six photo captions in the seabird guide (English and German) now say what the photo shows before the credit. No files were renamed; alt texts, sizes and formats were already good and stay unchanged. (2) Video: the team's "Our Story" video is not published yet (the YouTube channel has only the two short explainer videos), so no video section was added. (3) Credibility: "Sources" lists on Take Action, the seabird guide and the glossary (English and German) and on the Coastal Guardian Challenge, using only sources already cited elsewhere on the site; the About timeline (English and German) now lists the 12, 14 and 15 Nov steps from this log; the "About this page" box links to the page's sources when a page has them.

**Who:** Diego Aguilar.

**Reason:** Team brief for Phase 6. These pages stated facts without a sources list on the page itself, and the timeline stopped at 11 Nov. Licence data and descriptive captions give image search more context about each photo. Checked on 15 Nov: no `X-Robots-Tag` header on any checked page and the pages send `index, follow`, so the day-1 `noindex` problem stays fixed.

**Outcome:** Offline page check and PHP syntax check passed before publishing; live check after publishing.

## 2026-11-16

**Action:** Phase 7: Wadden Sea spotlight. Instead of a new page, we extended the existing article "Why the Wadden Sea Matters for Birds" (English and German, same URLs, titles and descriptions): three habitat cards (tidal mudflats, salt marshes, dunes and beaches) with openly licensed photos, an original four-step illustration "How coastal habitats support wildlife", a sourced fact panel "Why this ecosystem matters", a "Learn more" block linking Seabird Conservation, the seabird guide, Coastal Care, Take Action and the Knowledge Centre, two more sources and an "updated 16 November" note. A sentence now states that Grohnpetrel only uses the Wadden Sea as an educational example and does no conservation work there. New front-page section "From Bremen to the North Sea" / "Von Bremen an die Nordsee" after the seabird guide section, with an aerial photo of Neuwerk and a button to the article. Contextual links from the seabird guide and Seabird Conservation (threat 5) in both languages. The article's "Continue exploring" box now suggests other pages, so it does not repeat the new links. Three photos fetched from Wikimedia Commons (Ralf Roletschek, CC BY-SA 3.0; Ssprmannheim and Dietmar Rabich, CC BY-SA 4.0) with credits and licence data.

**Who:** Diego Aguilar.

**Reason:** Team brief for Phase 7. A separate "wadden-sea-conservation" page would have competed with the existing Wadden Sea article (published 8 Nov), so the team chose to improve that article and keep its title. Facts come from UNESCO (property 1314) and the Common Wadden Sea Secretariat; the International Wadden Sea School website returned a database error on 16 Nov, so it is not cited.

**Outcome:** Offline page check (82 entries, 0 errors), PHP syntax check and a local layout preview at 1280 px and 390 px passed before publishing; live check after publishing.

---

**Action:** Phase 8: technical SEO check of the whole site and three small fixes. (1) Visible breadcrumbs above the page title on educational pages, following the main menu: Knowledge Centre → seabird guide, glossary, videos, Coastal Guardian Challenge and journal; the six species pages inside the seabird guide; Conservation → Take Action and Coastal Habitats; journal posts under Knowledge Centre → Journal (English and German). The BreadcrumbList structured data on these pages now uses the same trail. Front pages, About, Mission, FAQ and "What is Grohnpetrel?" are unchanged. (2) Long words such as e-mail addresses now wrap (the Contact page scrolled sideways by 4 px at 390 px width). (3) German table headings may hyphenate on phones, and the mobile menu button has a 44 px tap area instead of 24 px.

**Who:** Diego Aguilar.

**Reason:** Team brief for Phase 8. Checked on 16 Nov before changing anything: all 82 sitemap URLs return 200, are "index, follow", have a self-canonical, one H1, no image without alt text or size, and no X-Robots-Tag header; old URLs redirect or return 404; archives stay noindex. PageSpeed Insights (lab data; no field data yet) gave 99–100 for performance, accessibility, best practices and SEO on the front page, the Wadden Sea article, the challenge and the seabird guide, mobile and desktop; the remaining hints (cache lifetimes, server response time) are server settings of the university. Google's Rich Results Test found only valid items on the front page, the Wadden Sea article and the gannet page. business.constructor.university/ returns 500 and has no robots.txt or favicon.ico; these are university-level and were not touched.

**Outcome:** PHP syntax check and an offline test of the breadcrumb function passed; live check after publishing.

---

**Action:** Made bare "grohnpetrel" our main metric (dashboard); merged the two "meanings" pages into /about-grohnpetrel/ (renamed from "What is Grohnpetrel?"), old URLs redirect.

**Reason:** Bare "grohnpetrel" fell from #2 (GB, 8 Nov) to outside the top 10 and the ranking page kept switching, so our own pages compete. Puffins and skuas rank with an /about-grohnpetrel/ page.

**Outcome:** Pending; check from 19 Nov. Stacked on the 14 Nov updates, so effects can't be separated.

---

## 2026-11-18

**Action:** Daily check with the bare query "grohnpetrel" as the main metric, competitor comparison and Search Console review; updated the final presentation (main metric, results to 18 Nov, competitor scoreboard, phases 3–8, the one-canonical-page decision, AI Overview evidence, marketing plan with customer segments and the 4 Ps, speaker timings) and the final-reflection draft.

**Who:** Diego Aguilar.

**Reason:** Measure the first days after the 16 Nov consolidation and prepare the 26 Nov presentation against the course criteria (results and analysis, strategy and implementation, critical reflection, communication, marketing plan).

**Outcome:** Bare "grohnpetrel" on 18 Nov: #1 in Google US, #7 UK, not in the top 10 in DE; Google still showed the redirected old addresses. All internal links already pointed to /about-grohnpetrel/. No website change, so the consolidation can be judged from 19 Nov. Google's AI Overview for "what is grohnpetrel" listed our meaning first and cited our repository (signed-in browser, 18 Nov).

## 2026-11-19

**Action:** Design experiment, phase 1, built in a private copy of this repository so the live site and the daily tracking were not affected: visual redesign of the whole site through `snippets/design.php` (and the quiz styles in `snippets/challenge.php`). No page text, links, images, structured data or scripts changed. Direction: a North Sea field guide. Colours come from the mascot (deep teal, seafoam) with its beak terracotta as the only accent, replacing the gold; headings use Platypi and text uses Manrope at a readable weight, both served by the theme from our own server (no third-party font requests). Boxed cards with shadows became ruled entries, data tables are set as reference tables, the hero, sections and footer share one 1180 px grid, and focus rings, mobile menu and touch targets were reworked.

**Who:** The team, as an experiment in a private copy of the repository, with AI assistance.

**Reason:** Sections used four background colours and up to four different left edges, cards repeated full-width dark buttons, body text used a thin 300 weight, and the footer did not line up with the page.

**Outcome:** Checked before publishing on a local preview of the live pages: all 82 published pages show the same visible words in the same order as before; no horizontal scrolling at 320, 390, 768, 1024 or 1440 px; text contrast meets WCAG AA; quiz, menus and keyboard focus work. PHP syntax check and `scripts/check_pages.py` pass. Live check after publishing.

## 2026-11-20

**Action:** Design experiment, phase 2 (same private copy), "North Sea field guide", still only in `snippets/design.php` (styles, plus a small script in the page footer) and the quiz styles in `snippets/challenge.php`; documented in the new `DESIGN.md`. Three directions were compared (editorial magazine, immersive "living coast", naturalist's field guide); the field guide was chosen, with cover typography for the hero and closing banner and one moving motif, the tide line. New: art-directed gannet hero (bird clear of the text on desktop, above it on phones), contour linework on dark bands, a reading-progress line on articles, numbered specimen tables, length-range scales drawn from the existing "87–100 cm" values, conservation-status marks, numbered species plates, a sticky species index on the seabird guide, labelled table stacks on phones, a tablet menu, and the accent colour on primary actions. An independent design review was run on the first pass and its main points fixed.

**Who:** The team, as an experiment in a private copy of the repository, with AI assistance.

**Reason:** Make the site's design and creativity competitive while keeping every word, link, image, translation and SEO element as it was.

**Outcome:** Checked before publishing on a local preview of the live pages: 80 of 82 published pages show exactly the same visible words; the two seabird-guide pages (English, German) only add the species index, built from their own plate headings. Title, description, canonical, hreflang, JSON-LD, robots, headings, image alt text and links are identical on all 82 pages. No horizontal scrolling at 320, 390, 768, 1024 or 1440 px (410 checks), no script errors, motion off under reduced-motion settings. PHP syntax check and `scripts/check_pages.py` pass. Live check after publishing.

## 2026-11-20

**Action:** Brought the design experiment from the private copy into this repository (PR #43: `snippets/design.php`, quiz styles in `snippets/challenge.php`, `DESIGN.md` and the two log entries above). Fixed the publish script so manifest entries that are already in the WordPress trash are skipped instead of crashing it (PR #44).

**Who:** Diego Aguilar.

**Reason:** We tried the redesign in a copy first, so we could experiment freely and bring it into the original in one step once it was ready. Before merging we checked that the copy (made on 15 Nov) still fits the current site: its styles already cover the components added later (Wadden Sea panels, breadcrumbs, the merged About page); no page text, link, title, description, canonical or structured data changes; and its script and styles, injected into the live pages, showed no horizontal scrolling and no script errors on 12 pages at phone and desktop width; the Coastal Guardian Challenge still worked. The publish run for PR #43 updated both snippets but then stopped at the two "meanings" pages trashed on 16 Nov (they have no file and are no longer found by slug), so the pages after them and the sitemap notice were not processed.

**Outcome:** The redesign is live since 20 Nov and the publish run after PR #44 completed. All 80 sitemap URLs return 200. PageSpeed (mobile, front page): before 100 / 100 / 100 / 100, LCP 1.7 s, CLS 0.007; after 99 / 100 / 100 / 100, LCP 2.1 s (the new heading font; still under Google's 2.5 s "good" limit), CLS 0. No ranking effect is expected from a style-only change; measure from 22 Nov.

## 2026-11-20

**Action:** Added six learning games in English and German, a play-along video and a printable resource, all inside existing pages (no new URLs): "Which seabird am I?" (three clues per bird, 3/2/1 points) and "Line them up" (order the six birds by size) on the seabird guide; "Take it, leave it or get help?" (eight beach finds) on the plastic article; "Wadden Sea: true or false?" (seven statements) on the Wadden Sea article; a glossary quiz built from the glossary's own definitions; and a photo-and-name memory game on the Knowledge Centre, which now lists all seven games (with the Coastal Guardian Challenge) under "Play and learn". New: the video "Which seabird am I? Play along" (EN/DE, 56 s, on the Knowledge Centre and the videos pages, with transcript) and the two-page "North Sea beach walk card" PDF (EN/DE). The front pages link to the games. Code: `snippets/seabird-game.php` and `snippets/games.php`.

**Who:** Diego Aguilar, with AI assistance.

**Reason:** Give visitors more to do on the site and more reasons to click through to the species pages and articles, while keeping one page per search intent: each game sits on the page whose topic it practises and repeats only facts that page already states with sources. Like the Coastal Guardian Challenge, every game is plain HTML first (questions, answers, explanations and score bands are readable by search engines and without JavaScript) and the snippets turn it into the game; nothing is stored or sent, and nothing loads from other servers. Photos in the memory game and the video are the openly licensed Wikimedia Commons photos already on the site, credited next to the game and on screen.

**Outcome:** Tested before publishing by injecting each game into the live pages: all seven play through to the end in English and German at phone width (390 px) and on desktop, with no script errors and no horizontal scrolling. `scripts/check_pages.py` and the PHP syntax check pass. Titles, descriptions, canonicals and structured data of the pages are unchanged; the new video gets a VideoObject automatically. Live check after publishing.

## 2026-11-20

**Action:** Final presentation for 26 Nov rebuilt as a PowerPoint deck (35 slides: 32 main, 3 backup, speaker, time and script in the notes of every slide), and the web version replaced by the same slides with the same notes. New: results to 20 Nov counted per country-day, new charts (daily rank per country, competitors, Search Console), the 20 Nov AI Overview, three key decisions, a live QR game for the audience, and prototype mockups of the three planned merchandise items for the CEO part.

**Who:** Diego Aguilar, with AI assistance.

**Reason:** Check the deck against every point of the course rubric (results 30, strategy 20, reflection 15, communication 15, marketing plan, log), bring the numbers up to date, add visual evidence and audience engagement, and have a file that runs without Wi-Fi.

**Outcome:** Timing adds up to 30:00 (Diego 2:30 + 7:00 + 1:00, Iaroslav 8:30, Mario 5:00 + 0:30, Ayoyemi 5:30). Numbers to be refreshed on 25 Nov.

## 2026-11-22

**Action:** Daily check with the bare query "grohnpetrel" as the main metric, competitor comparison, Search Console and AI answers; refreshed the presentation to the 21 Nov data; made the "Pair found" message in the memory game green instead of the error colour (`snippets/games.php`).

**Who:** Diego Aguilar, with AI assistance.

**Reason:** Keep the main metric and the presentation numbers current, and check whether the 16 Nov consolidation is working before the 26 Nov presentation.

**Outcome:** On 21 Nov we were #1 in Google for the bare query in the US and the UK and #2 in Germany, and Google ranked /about-grohnpetrel/ itself for the first time (US, UK) instead of the redirected addresses. On 20 Nov Google showed no team site in the top 10 in any country. Whole period (22 days, 66 country-days): top 10 on 39, #1 on 10, tied first with one rival for top-10 presence. Search Console to 19 Nov: 2,334 impressions, 46 clicks. Google's AI Overview (22 Nov) still lists our meaning first; Brave shows our DOI record first. No SEO content change: measurement freeze until the presentation.

**Note (22 Nov):** the web version of the presentation now gives every slide a title, so the slide overview and presenter navigation show names instead of "undefined".

## 2026-11-23

**Action:** Three new short videos in English and German, each on the page it belongs to and on the videos pages, with transcripts: "The gannet: the North Sea's plunge diver" (gannet pages), "The Atlantic puffin in 40 seconds" (puffin pages) and "Dunes, salt marshes, beaches: three coastal habitats in 35 seconds" (coastal-habitats pages). Two new activities in English and German with the same game engine: "Which threat is it?" (eight situations, six threats) on the threats page and "Dune, salt marsh or beach?" on the coastal-habitats page. The Knowledge Centre now lists nine games; the front pages link to "all our seabird games".

**Who:** Diego Aguilar, with AI assistance.

**Reason:** More to watch and do on the pages people already reach (species, threats, habitats), using only facts those pages already state with sources, without adding URLs that compete for the main query.

**Outcome:** Both activities played through to the end at phone width in English and German before publishing, with no script errors and no horizontal scrolling; `scripts/check_pages.py` passes. The videos use our own graphics plus the openly licensed gannet and puffin photos already on the site, credited on screen. Live after publishing (PR #49): all six videos load and both activities run on the live pages.

**Action (23 Nov, second change):** Exposure outside Google. (1) IndexNow: `scripts/indexnow.py` sends the sitemap URLs to Bing, Yandex, Seznam and Naver after every publish (new step in `wp-publish`); the key file is served by `snippets/llms.php` under /guillemots/, because IndexNow only accepts URLs below the key file's folder. (2) llms.txt updated: canonical About page, ten videos, nine games, the species pages, the SEO lab, the repository and the Zenodo DOI. (3) README: links point to the canonical /about-grohnpetrel/ instead of the old redirected address, plus videos, games and German pages. (4) Video counts corrected ("six" to "ten") in the videos pages' meta descriptions and on the English front page. (5) GitHub release v2.0, which Zenodo archives as a new version of our record.

**Who:** Diego Aguilar, with AI assistance.

**Reason:** In our tracker the site has never appeared in Brave (0 of 312 checks) or DuckDuckGo, which use their own or Bing's index and feed AI assistants. In Brave our GitHub repository fills most of the top 10 for "grohnpetrel" (release v1.0, pull requests) and our Zenodo record is #1 for "what is grohnpetrel", so those pages are where people and AI tools meet us first. They should link to the canonical page and to the current content. No new site page: nothing competes with /about-grohnpetrel/ for the main query.

**Outcome:** First IndexNow submission in `wp-publish` run 56: 80 URLs, response 202 (received, key check pending). The live llms.txt lists the ten videos and nine games; the key file answers with 200. Release v2.0 published on GitHub on 23 Nov. Still open: whether Bing and DuckDuckGo list the site before 26 Nov (not guaranteed in three days).

**Note (23 Nov):** before release v2.0, `.zenodo.json` (the metadata Zenodo copies into each new version) now points to /about-grohnpetrel/ instead of the old redirected address and lists the videos and Knowledge Centre pages.

**Action (23 Nov, third change):** Final presentation updated for 26 Nov: four speakers with 7.5 minutes each (Diego: opening and strategy; Iaroslav: results; Mario: content, off-site and reflection; Ayoyemi: CEO plan, launch campaign, log and summary); numbers and charts to 23 Nov; a new slide "Launch campaign: Scan. Play. Give seabirds space." (six weeks of Phase 0, 150 interest-list sign-ups as go / no-go, no media budget); a backup slide "Who did what"; the web version shows the same 37 slides and notes. The scheduled daily check did not start today, so we started it by hand.

**Who:** Diego Aguilar, with AI assistance.

**Reason:** Equal speaking time and clear ownership, so each of us presents and answers for our own part; the CEO plan needed a concrete launch campaign; the numbers had to include the latest days.

**Outcome:** 23 Nov, bare "grohnpetrel": #1 in Germany (/de/was-ist-grohnpetrel/) and #1 in the UK (/about-grohnpetrel/); in the US no team site in the top 10, the first eight results are YouTube Shorts and Instagram posts. Whole period: #1 on 13 of 72 country-days, top 10 on 42, the most of any team. Brave, the same day as the release: release v2.0 is the #1 result for the bare word in the UK and for "what is grohnpetrel" in all three countries, and our DOI record is #1 for the bare word in the US.


---

**Action:** Added a "Sources behind our seabird and coast content" section (UNESCO, BirdLife, NABU, OSPAR, Wadden Sea bodies) to the "What is Grohnpetrel?" page, EN and DE.

**Reason:** The page the bare term ranks on had no citations; rivals have none either. Visible links to recognised organisations, plus the editorial policy, make the page look checkable and trustworthy. Also linked the page to Constructor University (constructor.university), which the site never linked to. The page still says we are not an NGO and take no donations.

**Outcome:** Pending; check bare "grohnpetrel" from 19 Nov.
