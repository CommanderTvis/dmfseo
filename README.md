# Grohnpetrel: Guillemots SEO project

Course project for DMFSEO (Constructor University, Fall 2026). We compete with other teams to rank for the invented search term "Grohnpetrel", then present results and a merchandise marketing plan. The marks and deadlines are in the lecture slides and in `PLAN.md`.

- Live site: https://business.constructor.university/guillemots/
- Ranking dashboard: https://commandertvis.github.io/dmfseo/ (updated daily)
- Schedule and experiments: [`PLAN.md`](PLAN.md)

## How this repo works

This repo, not the WordPress editor, is the source of truth for the site's pages. You change a page here, and GitHub publishes it.

```
pages/*.html   the pages, as WordPress block HTML
pages/manifest.json   page ID, title, slug, status (publish/draft) for each page
        │  push to main
        ▼
GitHub Action "wp-publish"  →  updates the matching WordPress page by ID
```

- Pages are matched by their WordPress ID, so a run only updates existing pages. It never creates new ones, so you can't get duplicates.
- Don't edit pages in the WordPress editor. A later publish would overwrite your edit. If someone already did, run the `wp-pull` workflow first: it copies the live HTML back into `pages/`.
- To add a new page, make an empty draft in WordPress, then add it to `manifest.json` with its ID. Ask in the team chat if unsure.
- A page with `"status": "draft"` is not published.

## Changing a page

The normal Git flow works. You need a GitHub account with access to this repo.

1. Pull the latest: `git pull`.
2. Edit the HTML file in `pages/`. Keep the `<!-- wp:… -->` comments around each block. They are what lets the WordPress editor show proper blocks.
3. Commit and push to `main`. The push publishes to the live site within about a minute.
4. Check the run in the **Actions** tab of the GitHub repo (`wp-publish`). Green means done. Red means open the log.

To see what would change without publishing: Actions → `wp-publish` → Run workflow → leave "dry run" ticked.

Every change should also go into the Teams project log: what, when, why, outcome. The log is 20% of the mark.

## The daily rank check

The Action `daily-check` runs every day at 06:00 UTC. It searches Google (Germany, US, UK) and DuckDuckGo for "grohnpetrel" and two variants, records where we rank and where other teams rank, and pulls Search Console numbers. Results are stored on the `gh-pages` branch and shown on the dashboard. You can start it by hand from the Actions tab. DuckDuckGo results are unreliable, and Bing is not covered.

## Secrets (maintainers only)

Stored under repo Settings → Secrets and variables → Actions. Never put keys in files or chat.

| Secret | For |
|---|---|
| `SERPER_API_KEY` | Google search results (serper.dev) |
| `WP_USER`, `WP_APP_PASSWORD` | publishing to WordPress (an Application Password, not the login password) |
| `GSC_SERVICE_ACCOUNT_JSON` | Search Console data (optional; skipped if missing) |

## Using Claude Code in this repo

Claude Code is an AI assistant that runs in your terminal and works directly on your files. Unlike a chat window, it can read this repo, edit files, and run commands such as `git` and `gh`.

1. Install it: `npm install -g @anthropic-ai/claude-code`, or follow the current instructions at https://claude.com/claude-code.
2. Clone the repo, open a terminal in it, and run `claude`. Sign in the first time.
3. Describe what you want in plain language, for example:
   - "Rewrite the intro of pages/grohnpetrel-faq.html to answer 'what is Grohnpetrel' in one sentence"
   - "Check all internal links in pages/ against the slugs in manifest.json"
   - "Add FAQPage structured data to the FAQ page"
4. It shows its edits and asks permission before running commands. Read what it proposes. Reject anything you don't understand.

The file `AGENTS.md` is the briefing the assistant reads about this project. Keep it short and up to date.

Good habits:
- Ask it to make changes on a branch and open a pull request if you want a teammate to review before publishing, since anything merged to `main` goes live.
- Check the result in the browser. The assistant can write plausible but wrong text, so verify facts and claims on the pages.
- It doesn't remember earlier sessions unless the information is written in the repo, so put decisions in `PLAN.md` or `AGENTS.md`.
- Don't paste passwords or API keys into it.
