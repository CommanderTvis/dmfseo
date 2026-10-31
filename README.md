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

### With an AI agent (step by step)

Claude Code on the web needs no installation. Any other agent that edits files in a clone of the repo also works.

1. Get a GitHub account. Skip this if you have one. Otherwise sign up for free at https://github.com/signup.
2. Get access to this repo. Send the maintainer your GitHub username and ask to be added as a collaborator. Accept the invitation in the email GitHub sends you (or at https://github.com/CommanderTvis/dmfseo).
3. Sign in at https://claude.ai (create an account if you don't have one). Claude Code is only available on some plans, so if https://claude.ai/code doesn't open for you, ask which plan the team uses.
4. Open https://claude.ai/code and connect GitHub when asked. You are sent to GitHub to install the Claude app. Choose "Only select repositories" and tick `dmfseo`, so it can't see your other repos. Then return to Claude.
5. Select the `CommanderTvis/dmfseo` repo and describe the change in plain language. The agent reads `AGENTS.md` for the project background. Example requests:
   - "Rewrite the intro of pages/grohnpetrel-faq.html so the first sentence answers 'What is Grohnpetrel?'"
   - "Check every internal link in pages/ against the slugs in pages/manifest.json."
   - "Add FAQPage structured data to the FAQ page."
6. Read the changes it shows you. It can write plausible text that is wrong, so check the facts and ask it to fix anything off.
7. Have it open a pull request. Ask a teammate to look at it, then merge it. Merging to `main` publishes to the live site, and the `wp-publish` run in the **Actions** tab should turn green.

The menus and button names change from time to time. If a step doesn't match what you see, follow the on-screen prompts or ask the team.

## Rules

- Keep the disclaimer that Grohnpetrel is a fictional academic project, not an NGO, and takes no donations.
- Write each change into the Teams project log: what, when, why, and the outcome later. The log is 20% of the mark, and entries written afterwards score low.
- Change one thing at a time where you can, so we can tell what moved the ranking.
- A new page needs an empty draft created in WordPress and an entry in `pages/manifest.json` with its ID. Ask in the team chat.
- Don't add keys or passwords to any file.
