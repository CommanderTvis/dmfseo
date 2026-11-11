# Change log — SEO/GEO sprint and Phase 2 refinement, 11 November 2026

Baseline: `main` at `e677912` (11 Nov, explainer video). Branch: `seo-geo-sprint-2026-11-11`. PR, merge commit and publish run are recorded in the PR and in PROJECT_LOG.

## Files changed and why

| File | Change | Reason |
|---|---|---|
| `pages/seabirds-of-the-north-sea.html`, `pages/de/seevoegel-der-nordsee.html` | Section "Is there a seabird called Grohnpetrel?" / "Gibt es einen Seevogel namens Grohnpetrel?"; link to the learning guide PDF | P0-B: the seabird guide had no explicit answer for people who search for a bird of that name |
| `pages/grohnpetrel-faq.html`, `pages/de/haeufige-fragen.html` | Questions 16 (threats) and 17 (how to help); date updated | Phase 2 §9: two required questions were missing |
| `snippets/schema.php` | FAQPage answers exclude small-print byline paragraphs | Defect: the last answer contained "By the Guillemots team · Last updated …" |
| `pages/grohnpetrel-seo-aeo-geo-lab.html`, `pages/de/seo-geo-labor.html` | Data report: method, chart, daily table, observations, hypotheses, limitations, data and code | P1-C |
| `scripts/rank_report.py` | New: derives the table and chart from the raw tracker CSV | P1-C reproducibility |
| `media/grohnpetrel-rank-chart-2026-11-11.webp` | Chart (generated) | P1-C |
| `media/six-north-sea-seabirds-learning-guide.pdf` | 4-page learning guide, text selectable, sources and photo credits | P1-D |
| `pages/grohnpetrel-knowledge-centre.html`, `pages/de/wissenszentrum.html` | Three topic cards at the top (Start here / Seabirds / Threats and action); item 8: guide download | Phase 2 §8 and P1-D; all existing text kept |
| `pages/about.html`, `pages/de/ueber-uns.html` | Photo beside "Why we created Grohnpetrel" (licensed, credited); merchandise-plan link; dated project timeline from PROJECT_LOG | Phase 2 §7; the merchandise plan had no contextual link |
| `pages/site.json` | Media entries for the PDF and the chart | Publish pipeline |
| `snippets/design.php` | Styles for timeline, topic cards, About photo | Phase 2 |
| `README.md` | Resources line (report, guide, video, reports/) | P1-E |
| `reports/*.md` | Four sprint reports | Deliverables |

Not changed: URLs, slugs, SEO titles, meta descriptions, canonicals, hreflang, robots settings, navigation menus, logo, colours, fonts, plugins, other team folders, server/root files.

## Phase 2 audit decisions

| Element | Current condition (11 Nov) | Decision | Expected improvement | Risk |
|---|---|---|---|---|
| Home hero | Photo hero with overlay, clear H1, two buttons, disclaimer | KEEP | — | — |
| Home sections | Alternating media-text, cards, table, video band (11 Nov) | KEEP | — | — |
| Typography / palette | Serif headings, Manrope body, teal/ivory/sand | KEEP | — | — |
| Header / footer | Full menus, Learn/Transparency footer | KEEP | — | — |
| About page | Team table and text only; no milestones | IMPROVE | Storytelling with photo and a dated timeline | Low (content only) |
| Knowledge Centre | Long numbered text list | IMPROVE | Topic cards for faster orientation; download | Low |
| FAQ | 15 clear answers; threats/help missing | IMPROVE | 17 questions; schema fixed | Low |
| Mission / Programmes / Threats / Take action | Readable, sourced | LEAVE UNCHANGED | A layout change would not add information | Medium (many pages) |
| Accordion FAQ | Considered | LEAVE UNCHANGED | Open answers are easier to read and quote | — |
| Animations / larger heroes | Considered | LEAVE UNCHANGED | Would cost speed (mobile score 97) | Medium |

## Measurements

PageSpeed Insights (lab, mobile, 11 Nov ~22:30 CET, before this PR): front page Performance 97, Accessibility 100, Best practices 100, SEO 100; LCP 1.8 s, CLS 0, TBT 0 ms, Speed Index 4.0 s. Definition page: 99/100/100/100; LCP 1.0 s, CLS 0. No field data (too little traffic). No performance change was needed or made.

## Tests

`scripts/check_pages.py`: 66 published entries, 0 errors, 0 warnings. `php -l` on all snippets. FAQ parser test: EN 17, DE 17, ES 15 questions, no byline in answers. Rank report output matches the public dashboard values for all 12 days.

## Rollback

Revert the merge commits of this PR on `main` (or revert single files) and push; `wp-publish` republishes the previous versions. The new media files stay in the WordPress library but are no longer linked.

## Blocked / pending

- Search Console URL Inspection and indexing requests: need an interactive login (Iaroslav).
- AI-assistant tests beyond Google's AI Overview: need logged-in accounts; worksheet provided in the private report.
- Social posting and any off-site placement: team-owned; nothing posted.
