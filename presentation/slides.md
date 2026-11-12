---
theme: default
title: "Grohnpetrel: How a student team competed for an invented word"
info: |
  Team Guillemots · DMFSEO Fall 2026 · Constructor University.
  30-minute presentation + Q&A. Run with `npx @slidev/cli slides.md`.
author: Team Guillemots
colorSchema: light
aspectRatio: 16/9
canvasWidth: 980
transition: fade
layout: cover
class: cover
---

<img src="/logo.webp" class="cover-logo" alt="Grohnpetrel mascot" />

# Grohnpetrel

## How we competed for an invented word in Google and AI answers

Team Guillemots · Ayoyemi Adeboyeyo · Diego Aguilar · Mario Iraheta · Iaroslav Postovalov

Digital Marketing Fundamentals & SEO · Constructor University · Fall 2026

<!--
Speaker: all four introduce themselves (20 s).
Suggested split (≈7 min each): Iaroslav = results and technical setup; Diego = strategy, content and GEO; Mario = critical reflection; Ayoyemi = marketing plan for the CEO and close.
Total: 30 min. Timing per part is in the top-right of each section slide.
-->

---
layout: default
---

# The task and our answer

<div class="grid2">
<div>

### The assignment

- Compete for the best Google visibility for **“Grohnpetrel”**, a word with no meaning
- Apply SEO **and GEO** to a WordPress site, experiment, document every step
- Plan future merchandise and convince a CEO

</div>
<div>

### Our answer in one sentence

> **Grohnpetrel is a fictional coastal-conservation and seabird-education project from Bremen-Grohn, Germany, created in 2026 by the Guillemots student team at Constructor University.**

*Grohn* = the university's district · *petrel* = a group of seabirds

</div>
</div>

<!--
Why this meaning: the name already contains a real bird family and a real place. That gives us a topic with real facts (seabirds, North Sea) we can cite, which is what search engines and AI answers trust. A brand or product meaning would have nothing to cite.
Same sentence on every page, in every language, in structured data and in llms.txt.
-->

---
layout: default
---

# Agenda

| Part | What we show | Time |
|---|---|---|
| 1 · Results and analysis | Rankings over time, Search Console, AI visibility, rivals | 10 min |
| 2 · Strategy and implementation | Objectives, technical SEO, content, structured data, GEO, links | 7 min |
| 3 · Critical reflection | What worked, what didn't, surprises, lessons | 6 min |
| 4 · Marketing plan for the CEO | Merchandise plan, budget, KPIs, the decision we ask for | 5 min |
| 5 · Process and summary | Project log, take-aways | 2 min |

All numbers come from our tracker, Search Console or the course snapshots. Nothing is estimated unless the slide says so.

---
layout: section
---

# 1 · Results and analysis

<span class="time">10 min</span>

---
layout: default
---

# Headline results (31 Oct – 12 Nov)

<div class="kpis">
<div><b>#1</b><span>Google DE for “grohnpetrel” on 4, 8 and 9 Nov</span></div>
<div><b>13/13</b><span>days in Google UK top 10 for "grohnpetrel" (quoted), #1 on 10 days</span></div>
<div><b>11/13</b><span>days in Google DE top 10 for grohnpetrel</span></div>
<div><b>1,412</b><span>Search Console impressions, 29 clicks (28 days to 12 Nov)</span></div>
</div>

- Course snapshot (lecturer): **#1 on 9 Nov**, #3 on 10 Nov, #2 on 11 and 12 Nov
- 79 pages and posts · 7 languages · 12 short videos · 1 public data report · 1 DOI

<!--
Explain the two queries: bare grohnpetrel (what the course measures) and the quoted "grohnpetrel" (exact match, fewer social results).
Explain the tracker: Serper API, Google with hl=en, countries DE/US/GB, top 10, once or twice a day, public dashboard. The course snapshot is a different browser and place, so small differences are normal.
-->

---
layout: default
---

# Rankings over time

<img src="/rank-chart.png" class="full" alt="Daily Google rank for grohnpetrel and quoted grohnpetrel in DE, US and GB, 31 Oct to 12 Nov 2026" />

<p class="caption">Our best organic position per day (last check of the day). × = not in the top 10. Source: our tracker, <code>scripts/rank_report.py</code>.</p>

<!--
Read the chart left to right:
1) 31 Oct: first publish, already #2–#4 (few competitors indexed).
2) 3–5 Nov: we drop out of the bare-query top 10 in all countries except a #1 in DE on 4 Nov, the day after the German site went live.
3) 8–9 Nov: #1 in DE again; the quoted query is #1 in US and UK almost every day.
4) 10–12 Nov: #2 in DE behind another team's German front page.
The quoted query is stable; the bare query is volatile because social posts and videos take half the results.
-->

---
layout: two-cols
---

# Evidence: tracker and Search Console

- Public dashboard updated every day (GitHub Pages), raw CSV in the repo
- Same settings every day → trends are comparable
- Search Console (28 days to 12 Nov): **1,412 impressions, 29 clicks**
- On 11 Nov, 742 of 1,221 impressions were for “grohnpetrel” queries; the rest came from seabird and Wadden Sea pages

::right::

<img src="/tracker-dashboard.jpg" class="shot" alt="Screenshot of the Grohnpetrel SEO tracker dashboard" />

<!--
Point at the dashboard: one row per query and country, colour = rank.
Search Console caveat: the sitemap report shows "indexed: 0", which is a deprecated field; URL inspection shows the pages indexed.
Update the GSC numbers on the morning of the presentation.
-->

---
layout: default
---

# AI visibility (GEO)

| Date | Where | What it said | Cited us? |
|---|---|---|---|
| 28 Oct | AI assistants (Lab baseline) | “Grohnpetrel” unknown | – |
| 11 Nov | Google AI Overview | Described another team's concept, citing social posts and another team's site | No |
| 11–12 Nov | Brave Search (tracker) | **Our Zenodo archive is the top result for “what is grohnpetrel”** in DE, US and UK | Yes |
| 12 Nov | Brave Search, US | Our Zenodo archive is #1 for grohnpetrel | Yes |

**Interpretation:** engines that rely on their own index and on documents found our archived, citable record. Google's AI Overview leaned on social media, where we had not posted yet.

<!--
This is the most honest slide: GEO partly worked (Brave, archive), partly did not (Google AI Overview).
Our Zenodo DOI record contains the definition, the team and links back to the site.
Do not claim citations we did not see: we only show what we recorded.
-->

---
layout: default
---

# Competitor comparison (12 Nov)

| Google, “grohnpetrel”, 12 Nov | Us | Rival A | Rival B | Rival C | Rival D |
|---|---|---|---|---|---|
| Germany | **#2** | #1 | #6 | – | – |
| United States | #4 | #1 | – | #2 | #5 |

- Rival A: **10 languages** with hreflang (we have 7) and its own German front page
- Audit 7 Nov: about **half of the top 10** for the bare query were Instagram posts and YouTube videos from other teams
- Our advantages: the only **citable archive with a DOI**, the only public data report, 10 structured-data types

Rivals are other student teams; we name them orally, not in public files. Concept names are left out on purpose (see Reflection).

<!--
Name the teams orally if asked.
Key insight: the rival that overtook us in Germany has more languages and posts on social media; content quality was not the difference.
-->

---
layout: default
---

# What moved the ranking (interpretation)

| Change | Date | Effect seen | Confidence |
|---|---|---|---|
| Removed hidden `noindex` header, published | 31 Oct | #2–#4 from day one | High |
| German version of the site | 3 Nov | #1 in Google DE on 4 Nov | Medium |
| Longer definition, FAQ, front page | 4 Nov | Out of top 10 on 5 Nov | Low (other teams indexed at the same time) |
| Rival teams' Instagram and YouTube posts | from 7 Nov | Half of the top 10 became social posts | High |
| Meanings page naming other concepts | 9 Nov | Lost DE #1 on 10 Nov | Hypothesis |
| YouTube Short ranks #1 in Google UK | 12 Nov | Videos can outrank websites | High |

<!--
Be clear: one change per day was the plan, but several teams changed things at the same time, so most effects are correlation, not proof.
The German version is our strongest positive signal; social video is the strongest external factor.
-->

---
layout: section
---

# 2 · Strategy and implementation

<span class="time">7 min</span>

---
layout: default
---

# Objectives and strategy

1. **Be crawlable first:** whoever is indexed first and cleanly wins an empty keyword
2. **Be the clearest definition:** one sentence, repeated everywhere, in every language
3. **Be distinctive and citable:** real seabird facts with sources, not a made-up product
4. **Be machine-readable:** structured data, `llms.txt`, transcripts, archive with DOI
5. **Measure daily, change one thing at a time, log everything**

<div class="note">Why not a brand or a product? A brand has nothing to cite. Seabirds and the North Sea give us sources (UNESCO, German Environment Agency, IUCN), which builds trust for both Google and AI answers.</div>

---
layout: two-cols
---

# Our pipeline: GitHub → WordPress

- Every page is a file in a public GitHub repository
- A GitHub Action publishes to WordPress in about a minute
- Checks on every pull request: page checker, PHP lint
- A second Action tracks rankings daily and builds the dashboard
- `PROJECT_LOG.md`: one entry per change (action, who, why, outcome)

**Why:** reviewable changes, history for the log, no manual edits in wp-admin, fast rollback.

::right::

```text
 edit pages/*.html
        │
  pull request ──► site-checks, php-lint
        │
  rebase & merge
        │
  wp-publish Action ──► WordPress (live)
        │
  sitemap resubmitted to Search Console
```

<!--
Every change went through a pull request. This is also our evidence for the log: every change has a date and a reason.
-->

---
layout: default
---

# Technical SEO

<div class="grid2">
<div>

- **Found a hidden `X-Robots-Tag: noindex` header** on day 1: the site was invisible to Google
- Sitemap submitted and re-sent on every publish
- Clean titles: keyword first, one H1, meta descriptions
- Canonicals, redirects for old URLs, archives set to `noindex, follow`

</div>
<div>

- **hreflang** across 7 languages (en, de, es, fr, it, ru, zh)
- WebP images, lighter fonts and styles
- Lighthouse mobile: **97–100** on the main pages, CLS 0
- Yoast-level technical SEO written in our own code (no extra plugin)

</div>
</div>

<!--
The noindex story is our best "lesson learned" for technical SEO: the WordPress setting looked fine, the header did not. We only saw it by checking the HTTP response.
-->

---
layout: two-cols
---

# Content strategy

- **Definition page** + **FAQ** (17 questions) + **front page**: three different intents
- **Seabird guide**: six real North Sea species, every fact sourced
- **Articles**: plastic and seabirds; the Wadden Sea
- Glossary, Knowledge Centre, a free 4-page **PDF learning guide**
- **12 short videos** (6 topics × EN/DE) with transcripts
- **7 languages** for the core pages

::right::

<img src="/site-home.jpg" class="shot" alt="Screenshot of the Grohnpetrel front page" />

<!--
Topical authority: the invented word sits inside a real topic. Pages answer real searches (seabirds of the North Sea, storm petrel) and link back to the definition.
-->

---
layout: default
---

# Structured data and GEO

<div class="grid2">
<div>

### Structured data (JSON-LD)

- Project with `sameAs` (GitHub, Zenodo, social profiles)
- `DefinedTerm` on 7 definition pages, `DefinedTermSet` glossary
- `FAQPage` in 7 languages
- `Article` with `citation`, `VideoObject` per video
- `ItemList`, `CollectionPage`, breadcrumbs, `publishingPrinciples`

</div>
<div>

### Generative engine optimisation

- One quotable definition sentence everywhere
- `llms.txt`: a short guide to the site for language models
- Zenodo archive with a **DOI**: a stable, citable source
- **Public data report** (SEO / GEO Lab) with chart and daily table
- Video transcripts, “About this page” box, editorial policy and corrections log (E-E-A-T)

</div>
</div>

---
layout: two-cols
---

# Links and off-site signals

- Public GitHub repository linking every key page
- Zenodo archive (DOI) → our definition
- Social profiles on Instagram, YouTube, TikTok, Facebook and LinkedIn, linked from the site and in structured data
- 12 videos ready; posting plan from 13 Nov

**Honest gap:** we did no outreach for backlinks and posted on social media late. The ranking data shows this was our biggest weakness.

::right::

<img src="/site-videos.jpg" class="shot" alt="Screenshot of the Grohnpetrel videos page" />

---
layout: section
---

# 3 · Critical reflection

<span class="time">6 min</span>

---
layout: two-cols
---

# What worked, and why

- **Checking the HTTP headers** → found the hidden noindex; indexed within days
- **A second language** → German site, #1 in Google DE the next day
- **Daily measurement** → we can show trends, not single screenshots
- **Citable, archived source** → Brave shows our Zenodo record first
- **GitHub workflow** → every change reviewed and dated

::right::

# What did not, and why

- **More words on 4 Nov** did not help: Google already understood the page
- **The meanings page** named other teams' concepts and was linked from every page; it may have tied our site to their meaning. Fixed 12 Nov.
- **Three German pages** compete for the same query (cannibalisation)
- **No social posts** while rivals filled half the top 10 with them
- **Too many changes** in some days → hard to say what caused what

<!--
Mario: this is the core of the reflection. Each point has evidence in the log.
-->

---
layout: default
---

# Unexpected outcomes

- A **YouTube Short** is #1 in Google UK for “grohnpetrel” (12 Nov): the SERP is not only websites
- Google's **AI Overview** relied on social posts more than on websites to define the word
- On Brave, a **GitHub release** and our **Zenodo record** rank above team websites: developer and archive platforms carry authority
- Explaining that other meanings exist **may have helped rivals more than us**
- The rival that passed us in Germany has **10 languages and a German front page**; page length was not the difference

---
layout: default
---

# Lessons and what we would do differently

<div class="grid2">
<div>

### Lessons about SEO / GEO

- Indexing beats content in week one
- For a new word, the SERP is shared with social video
- Say what you are, never what others are
- One page per intent, stable titles
- AI answers need sources they can cite and find

</div>
<div>

### Next time we would

- Post the first video on day 3, not day 12
- Change one thing per day, with a 48-hour wait
- Write the multilingual plan on day 1
- Get 3–5 real links (university, course pages, partners)
- Agree a “do not edit” freeze before each check

</div>
</div>

---
layout: section
---

# 4 · Marketing plan for the CEO

<span class="time">5 min</span>

---
layout: default
---

# The proposal in one slide

**Goal:** turn the audience we built (search, 7 languages, 12 videos) into a small, honest merchandise line that **teaches before it sells**.

| Item | Job in the range | Planned price* | QR learning link |
|---|---|---|---|
| Sticker sheet with mascot and tips | Low-cost entry | €3 | Take action |
| A3 poster “Seabirds of the North Sea” (EN/DE) | Teaching, schools | €9 | Seabird guide |
| Cotton tote bag with mascot | Signature item, visible in public | €14 | What is Grohnpetrel? |

<p class="caption">*Planning assumptions, to be checked against supplier quotes. Nothing is sold while Grohnpetrel is a fictional student project.</p>

<!--
Ayoyemi: the CEO wants to know what, for whom, why, how much, and how we know it works.
-->

---
layout: two-cols
---

# Audience, channels, roadmap

### Audiences
1. Coastal visitors and families (North Sea, Wadden Sea)
2. Teachers and schools in Bremen and Lower Saxony
3. University community (open days, campus events)

### Channels
Search (our site) · short video · QR codes on every product · free PDF guide for schools · campus pop-up

::right::

### Roadmap

| Phase | When | What |
|---|---|---|
| 0 | now – Jan | Content and interest list, **no sales** |
| 1 | after registration | Pilot: 100 sticker sheets, 50 posters, 50 totes, campus pre-orders |
| 2 | if pilot meets KPIs | School packs, coastal visitor centres, print on demand |

---
layout: two-cols
---

# Budget and KPIs (plan)

### Pilot budget (estimate)

| Item | Qty | Est. unit cost | Total |
|---|---|---|---|
| Sticker sheets | 100 | €0.80 | €80 |
| A3 posters | 50 | €3 | €150 |
| Tote bags | 50 | €6 | €300 |
| **Cap** | | | **€600** |

Revenue if sold out at planned prices: €1,450.

::right::

### KPIs and go / no-go

- Interest-list sign-ups before the pilot: **≥ 150**
- QR scans per product sold: **≥ 0.5**
- Pre-order conversion from the list: **≥ 10%**
- Video → site clicks per 1,000 views
- **No-go** if the pilot sells < 40% in 8 weeks

### Safeguards
No sales before registration · every printed fact is on the site with a source · organic cotton, small runs

<!--
These are targets, not results. The decision we ask from the CEO: approve Phase 0 now and a pilot budget cap of €600, released only after the project is registered and the supplier quotes are in.
-->

---
layout: section
---

# 5 · Process and summary

<span class="time">2 min</span>

---
layout: default
---

# How we worked: the project log

- **33 dated entries** in `PROJECT_LOG.md` and the Teams channel, 28 Oct – 12 Nov: action, who, why, outcome
- More than 20 pull requests, each checked automatically and published by the pipeline
- Daily rank data (CSV) and a public dashboard
- Reports: technical indexation, original data, competitive opportunities
- Use of AI disclosed on the site and in the log; texts reviewed by the team

<div class="note">The log was written as we went. Outcomes were filled in when we had data, and “pending” where we did not.</div>

---
layout: center
class: text-center
---

# Summary

**We were #1 on Google Germany three times and in the top 2 most days, with a fictional project built on real facts.**

What made the difference: indexing early, a second language, a clear definition and daily measurement.

What we would change: social video from day 3, fewer changes at once, and never describing other teams' meanings.

### Thank you · Questions?

business.constructor.university/guillemots · github.com/CommanderTvis/dmfseo

---
layout: default
---

# Backup: daily ranks (tracker)

| Date | DE | US | GB | "DE" | "US" | "GB" |
|---|---|---|---|---|---|---|
| 31 Oct | 4 | 2 | 4 | 3 | 2 | 4 |
| 1 Nov | 2 | 1 | 1 | 2 | 1 | 1 |
| 4 Nov | 1 | – | – | 2 | 2 | 1 |
| 6 Nov | 4 | 2 | – | 6 | 1 | 1 |
| 8 Nov | 1 | – | 2 | 1 | 1 | 1 |
| 9 Nov | 1 | – | – | 1 | 1 | 1 |
| 10 Nov | 2 | – | – | 1 | – | 1 |
| 11 Nov | 2 | 7 | – | 2 | 1 | 4 |
| 12 Nov | 2 | 4 | – | 5 | 5 | 1 |

<p class="caption">Columns in quotes = exact-match query. – = not in the top 10. Full table: <code>public/rank-daily.csv</code>.</p>
