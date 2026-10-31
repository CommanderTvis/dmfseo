# Project log

Newest entries at the bottom. Format: what was done, when, why, and the outcome (when known). Copy entries into the Teams project log.

## 2026-10-28

Action: Created the first draft pages for the site (Home, About, FAQ, Knowledge Centre, Programmes, SEO / AEO / GEO Lab, Mission, Seabird Conservation, Take Action) with AI-generated text.
Reason: Get a first content structure in place for the "Grohnpetrel" topic.
Outcome: Pages existed only as drafts. The site also had a technical problem at the time: the server blocked Googlebot, so Google could not crawl it even if the pages had been public.

## 2026-10-31

Action: Fixed the Googlebot block on the server.
Reason: A blocked crawler cannot index the site, so nothing else would matter.
Outcome: Googlebot is no longer blocked, as of today.

Action: Published the pages on the live site. Set "Grohnpetrel" as the front page and replaced the placeholder menu (header and "Footer – Learn") with links to all published pages, including a Knowledge Centre dropdown.
Reason: Google can only index what is public. The old front page was the default "Hello world" blog and the menu pointed only to draft pages, so crawlers had nothing to follow.
Outcome: Eight pages public. The SEO / AEO / GEO Lab page is still a draft. The "What is Grohnpetrel?" page got the URL `/what-is-grohnpetrel-2/` because an old placeholder draft still holds the clean slug.

Action: Claimed `business.constructor.university/guillemots` in Google Search Console.
Reason: Needed to see indexing status and search data, and to submit pages.
Outcome: Property verified. Data from the Search Console API is not coming through yet: the service account connection returns a 403 (access not fixed yet).

Action: Created the GitHub repo (https://github.com/CommanderTvis/dmfseo). The page HTML is the source of truth and a GitHub Action publishes it to WordPress by page ID.
Reason: Version history, teammates can contribute without the WordPress editor, and no accidental duplicate pages.
Outcome: Publishing works end to end. A change pushed to `main` goes live in about a minute.

Action: Set up the daily rank check (GitHub Action plus dashboard at https://commandertvis.github.io/dmfseo/). It searches Google (DE, US, GB) and DuckDuckGo for "grohnpetrel", the quoted "grohnpetrel", "what is grohnpetrel" and "grohnpetrel seabird", and records where we and the other teams rank.
Reason: Evidence for the results and analysis, and to see which changes move the ranking.
Outcome: Baseline, first check on 2026-10-31. Google "grohnpetrel": rank 2 in the US, 6 in Germany and the UK. Google quoted "grohnpetrel": rank 2 in all three. "what is grohnpetrel" and "grohnpetrel seabird": not in the top 10. The Puffins team is #1 for the main query. DuckDuckGo: we are not in its results, which show Giant petrel pages.
