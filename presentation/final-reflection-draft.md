# Final reflection (draft, about 700 words)

*Draft for the Teams channel. Each team member should read it, correct it and add their own view before posting. Numbers are from our tracker, Search Console and the course snapshots up to 12 Nov 2026; update them before the final version.*

## What we set out to do

We were given an invented word, "Grohnpetrel", and asked to win Google visibility for it. We decided early that the word should mean something we could support with real sources: a fictional coastal-conservation and seabird-education project from Bremen-Grohn. The name already contains a real place (Grohn) and a real bird family (petrels), so every page could link the invented word to checkable facts about North Sea seabirds. We built the site from a public GitHub repository that publishes to WordPress, tracked Google every day in Germany, the US and the UK, and wrote one log entry for every change.

## What worked, with evidence

**Fixing indexing first.** On day one the site sent a hidden `noindex` header, so Google could not index it. We found it by checking the HTTP response, not the WordPress settings. After the fix and the first publish on 31 October we ranked #2 to #4 for "grohnpetrel" straight away.

**A second language.** We published a full German version on 3 November. On 4 November we were #1 on Google Germany for "grohnpetrel", after not being in the top 10 the day before. Germany stayed our strongest market: in the top 10 on 11 of 13 tracked days and #1 on 4, 8 and 9 November. The lecturer's snapshot showed us #1 on 9 November.

**Exact-match stability.** For the quoted query "grohnpetrel" we were in the UK top 10 every day and #1 on 10 of 13 days. The definition, FAQ and front page answer the query clearly and consistently.

**A citable source.** We archived the project on Zenodo with a DOI. On 11 and 12 November Brave Search showed our Zenodo record as the top result for "what is grohnpetrel" in all three countries. This is the clearest sign that our GEO work (one quotable definition, structured data, `llms.txt`, an archived source) made us findable for engines that look for sources.

**Working in Git.** Every change went through a pull request with automatic checks, so we always knew what changed, when and why. This made the log easy to keep and made mistakes easy to correct.

## What did not work, and why

**More text did not help.** On 4 November we made the definition, FAQ and front page two to three times longer. The next day we were out of the top 10 in all countries. Other teams' pages were indexed at the same time, so we cannot prove cause, but length clearly was not what Google was missing.

**Social media came too late.** By 7 November about half of the top 10 for "grohnpetrel" were Instagram posts and YouTube videos from other teams, and Google's AI Overview built its answer on social posts and another team's site. We had profiles but posted nothing until our videos were ready on 11 November. On 12 November a YouTube Short was #1 on Google UK. This was our biggest gap.

**Describing other teams.** On 9 November we published a page explaining the word's other meanings, listing other teams' concepts, and linked it from every page. On 10 November we lost #1 in Germany to another team's site. It is a hypothesis, not proof, but by putting their topics next to our keyword on every page we may have helped them more than us. We removed those mentions on 12 November.

**Our pages competing with each other.** In Germany our front page, "Was ist Grohnpetrel?" and the FAQ all rank for the same query and split the position. We decided not to change titles again right away, because frequent edits were themselves a problem.

**Too many changes at once.** On some days we changed several things. With other teams also changing their sites, we could not always tell what caused a movement.

## Lessons

- Indexing and speed matter more than content length in the first week of a new keyword.
- For a new word, the results page is shared with social video; a site alone is not enough.
- Say clearly what you are; never describe what others are.
- One page per search intent, with stable titles.
- AI answers need a source they can find and cite; an archived record with a DOI worked better than we expected.
- Change one thing at a time and wait 48 hours before judging it.

## What we would do differently

We would post the first short video in the first week, write the multilingual plan on day one, seek a few real links from university and course pages, and agree a "no edits" window before each measurement. We would also keep competitor analysis entirely private from the start.
