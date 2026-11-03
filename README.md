# Guillemots DMFSEO project

Site: https://business.constructor.university/guillemots/ · Rankings: https://commandertvis.github.io/dmfseo/ · Plan: [`PLAN.md`](PLAN.md)

## What is Grohnpetrel?

[Grohnpetrel](https://business.constructor.university/guillemots/) is a fictional coastal-conservation and seabird-education project from Bremen-Grohn, Germany. The Guillemots, a team of four students at Constructor University in Bremen, created it in autumn 2026 for the course Digital Marketing Fundamentals and Search Engine Optimisation. The name combines Grohn, the Bremen district on the Weser, with petrel, a group of seabirds. It is not a registered organisation and does not accept donations.

- English: [What is Grohnpetrel?](https://business.constructor.university/guillemots/what-is-grohnpetrel-2/) · [FAQ](https://business.constructor.university/guillemots/grohnpetrel-faq/) · [Seabirds of the North Sea](https://business.constructor.university/guillemots/seabirds-of-the-north-sea/)
- Deutsch: [Grohnpetrel auf Deutsch](https://business.constructor.university/guillemots/de/) · [Was ist Grohnpetrel?](https://business.constructor.university/guillemots/de/was-ist-grohnpetrel/) · [Häufige Fragen](https://business.constructor.university/guillemots/de/haeufige-fragen/)

This repository holds the site's pages and the scripts that publish them. Archived on Zenodo: [doi:10.5281/zenodo.23926767](https://doi.org/10.5281/zenodo.23926767) (every GitHub release adds a new version).

Every page of the site is a file in `pages/`. Change the file, merge to `main`, and GitHub publishes it to the site within about a minute. Don't use the WordPress editor: the next publish overwrites it.

How that works: GitHub Actions is GitHub's built-in way to run a script automatically when something happens in the repo. Ours (`wp-publish`) starts whenever `pages/` changes on `main`. It logs in to WordPress and copies the files into the matching pages. So the WordPress site is a copy of this repo, and the repo is the original.

## Before you start

Get a GitHub account (https://github.com/signup) and ask the maintainer to add you to this repo. Accept the invitation email. All three ways of editing below need this.

## Edit without Git

1. Open a file in `pages/` on GitHub and click the pencil icon.
2. Edit the text. Leave the `<!-- wp:… -->` comments in place.
3. Commit to `main`.

## Edit with Git

```
git clone git@github.com:CommanderTvis/dmfseo.git
cd dmfseo
# edit pages/*.html
git commit -am "Short description" && git push
```

Then open the **Actions** tab on GitHub: a green `wp-publish` run means the site is updated. A red one means publishing failed, so open it to see why.

## Edit with Claude Code on the web

1. Open https://claude.ai/code and connect GitHub when asked. Install the Claude app on GitHub for the `dmfseo` repo only ("Only select repositories").
2. Select `CommanderTvis/dmfseo` and describe the change, for example "Rewrite the intro of pages/...faq so the first sentence answers 'Who are we?'".
3. Read the changes. Check the facts.
4. Have it open a pull request, ask a teammate to look, then merge. Merging publishes.

## Rules

- Keep the disclaimer that Grohnpetrel is a fictional academic project, not an NGO, with no donations.
- A new page needs a file in `pages/` and an entry in `pages/manifest.json` (no ID needed). The next publish creates it.
