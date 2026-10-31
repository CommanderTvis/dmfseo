# Grohnpetrel: Guillemots SEO project

We want https://business.constructor.university/guillemots/ to rank first for "Grohnpetrel" against the other teams, and to be cited by AI assistants. Course context: DMFSEO, Constructor University. Plan: [`PLAN.md`](PLAN.md). Live ranking: https://commandertvis.github.io/dmfseo/

## How to contribute

Every page of the site is a file in `pages/`. Change the file, push to `main`, and GitHub publishes it to the site within about a minute. The WordPress editor is not used: anything edited there gets overwritten by the next publish.

### Without Git (easiest)

1. Open a file in `pages/` on GitHub and click the pencil icon.
2. Edit the text. Leave the `<!-- wp:… -->` comments in place.
3. Commit directly to `main`.

### With Git

```
git clone git@github.com:CommanderTvis/dmfseo.git
cd dmfseo
# edit pages/*.html
git commit -am "Short description of the change" && git push
```

After a push, check the **Actions** tab: `wp-publish` green means the site is updated. Red means open the log and fix it.

### With an AI agent

Any agent that can edit files in the cloned repo works (Claude Code, Codex, Cursor, …). Tell it what you want and point it at `pages/`. It reads `AGENTS.md` for the project background. Example requests:

- "Rewrite the intro of pages/grohnpetrel-faq.html so the first sentence answers 'What is Grohnpetrel?'"
- "Check every internal link in pages/ against the slugs in pages/manifest.json."
- "Add FAQPage structured data to the FAQ page."

Review its diff before pushing, because anything pushed to `main` goes live. It writes plausible text that can be wrong, so check facts. To get a teammate's review first, work on a branch and open a pull request, then merge it.

## Rules

- Keep the disclaimer that Grohnpetrel is a fictional academic project, not an NGO, and takes no donations.
- Write each change into the Teams project log: what, when, why, and the outcome later. The log is 20% of the mark, and entries written afterwards score low.
- Change one thing at a time where you can, so we can tell what moved the ranking.
- A new page needs an empty draft created in WordPress and an entry in `pages/manifest.json` with its ID. Ask in the team chat.
- Don't add keys or passwords to any file.
