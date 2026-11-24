# Iaroslav: speaker notes

Your part, slides 6–11, 7.5 minutes. The same text is in the speaker notes of `slides.md`.

## Git repository and deploy to WordPress using GitHub Actions (0:00–1:00)

- Thank you, Diego. Now our site’s infrastructure: the setup that let AI do real work for us, while we saw exactly what it changed and gave it all the information it needed
- First: apart from a couple of first drafts, we put every article into a Git repository on GitHub, which coding agents can work with directly. The alternatives were to spend time learning how WordPress works in detail, or to rely on browser agents, which cost far too many tokens and lead to very unpredictable outcomes
- Second: I wrote a guide for the team on using the repository. Diego, who took the role of content creator, ended up sending even more pull requests than I did, although using Git was my idea
- Third: GitHub Actions, a technology for automating deployment and code checks, was a perfect fit to apply every change to WordPress automatically through its API, and we use the same GitHub Actions to run our daily ranking checks
- Next, analytics

## Analytics portal (1:00–1:45)

- To know whether anything works, we measure it every day. GitHub Actions checks our rank for the bare word in Germany, the US and the UK, in Google through the Serper API, a paid service that runs a Google search for a program and returns the results as data, like a clean browser set to a chosen country, without anyone’s personal history. It uses the same settings every day, so we see trends, not one lucky screenshot. Brave is not part of the assessment; I track it through my Brave API key out of curiosity and to gather more data
- I also registered the site in Search Console and connected it through a Google Cloud service account, so the same robot reads its data and resubmits the sitemap after every publish
- All of it is public on this dashboard and sits in the same repository as the pages, so the AI agent sees what we changed right next to what happened to our rank. Here is what it shows

## Our Google rank over three weeks (1:45–4:15)

- Here is our Google rank for the bare word, every day, in Germany, the US and the UK; orange dots are number one
- Right after the first publish we were in the top four everywhere, and the German site gave us number one in Germany the next day
- Then a long, stable second place in Germany behind one rival, while in the US and the UK other teams’ videos and posts pushed most team sites out of the top ten
- After we merged our pages into one, number one came back, first in the US and then in all three countries
- The grey dots are gaps in our own tracker: on those days the search API it uses auto-corrected the word to similar names, so those checks are invalid

## Search Console impressions (4:15–5:15)

- Search Console shows how Google sees us before anyone clicks. Most impressions come from the word grohnpetrel itself, so the main goal works
- Many more come from real seabird searches like “atlantic puffin”, which means Google files us under seabird education, the meaning we chose. We compete for the search engine’s attention, not for real visitors, so impressions are what matter for us

## Where AI answers cite us (5:15–6:30)

- Ranking is half of the task; the other half is AI answers. At first, Google’s AI Overview did not mention us at all, only other teams’ meanings
- Later we saw Google’s AI Overview list our meaning first and link our About page and our repository, like in this screenshot
- What made us citable is a public repository, a DOI archive and one sentence repeated everywhere. One caveat: AI answers are not deterministic, so the same question can get a different answer for another person or on another day

## What I noticed and what we changed (6:30–7:30)

- Finally, two moments when I noticed something in the data and we changed course
- First, we dropped out of the top ten in all three countries. I saw that the leading team’s German version was complete, so maybe Google thought theirs was the proper site to show in Germany. We built a full German localization, and the next day we were number one in Germany
- Later we were stuck at number two behind the drinks team. Our own Meanings page mentioned beer in its intro, table and description, which tied us to the drinks meaning, and our own pages were splitting the position between them. We removed the beer and merged everything into one canonical page. Number one came back, first in the US and then in all three countries
- This is correlation, not proof, because other teams changed their sites at the same time. Diego, over to you
