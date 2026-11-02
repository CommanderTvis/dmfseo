# AGENTS.md

Study project for the course DMFSEO (Digital Marketing Fundamentals and SEO), Constructor University, Fall 2026. Team: Guillemots. Several other teams compete for the invented search term "Grohnpetrel". We build a WordPress site (https://business.constructor.university/guillemots/) to rank for it in Google and be cited by AI answers, keep a project log, and prepare a merchandise marketing plan for a CEO audience.

The site is a fictional coastal-conservation / seabird-education project. It is not a real NGO and takes no donations. Keep that disclaimer.

## Files

- `DMFSEO 07 SEO 2026.pdf`: lecture slides with the assignment, marking criteria, and project-log rules.
- `PLAN.md`: schedule and experiments.
- `pages/`: the site's pages as WordPress block HTML, one file per page, plus `manifest.json` (optional page ID, title, slug, status). This is the source of truth: edit here, never in the WordPress editor.
- `snippets/`: our PHP for the site (e.g. meta descriptions and social tags in the page head), run there by the Code Snippets plugin. Per-page descriptions live in `pages/manifest.json`.
- `scripts/wp_sync.py` and `.github/workflows/wp-publish.yml`: push `pages/` to WordPress by page ID or slug (a manifest entry without an ID creates the page if it does not exist). A push to `main` that touches `pages/` publishes live, then `scripts/gsc_sitemap.py` resubmits the sitemap to Search Console.
- `scripts/collect.py`, `scripts/gsc.py`, `.github/workflows/daily-check.yml`, `dashboard/`: daily rank tracker. Results and the dashboard live on the `gh-pages` branch (https://commandertvis.github.io/dmfseo/).

## Rules

- Writing to the site or sending anything to external services only when the user asks.
- Maintain `PROJECT_LOG.md`: add an entry (action, date, reason, outcome) for every SEO or content change, and fill in outcomes when they become known. Entries are copied to the Teams project log.
