# Grohnpetrel: Guillemots SEO project

Site: https://business.constructor.university/guillemots/ · Rankings: https://commandertvis.github.io/dmfseo/ · Plan: [`PLAN.md`](PLAN.md)

Every page of the site is a file in `pages/`. Change the file, merge to `main`, and GitHub publishes it to the site within about a minute. Don't use the WordPress editor: the next publish overwrites it.

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

Then check the **Actions** tab: `wp-publish` green means the site is updated.

## Edit with Claude Code on the web

1. Get a GitHub account (https://github.com/signup) and ask the maintainer to add you to this repo. Accept the invitation email.
2. Open https://claude.ai/code and connect GitHub when asked. Install the Claude app on GitHub for the `dmfseo` repo only ("Only select repositories").
3. Select `CommanderTvis/dmfseo` and describe the change, for example "Rewrite the intro of pages/grohnpetrel-faq.html so the first sentence answers 'What is Grohnpetrel?'".
4. Read the changes. Check the facts.
5. Have it open a pull request, ask a teammate to look, then merge. Merging publishes.

## Rules

- Keep the disclaimer that Grohnpetrel is a fictional academic project, not an NGO, with no donations.
- A new page needs an empty draft created in WordPress and an entry in `pages/manifest.json` with its ID. Ask the team.
