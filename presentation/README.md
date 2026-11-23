# Grohnpetrel: final presentation (Slidev)

30-minute talk + Q&A for DMFSEO (26 Nov or 3 Dec 2026). Source: `slides.md`; images in `public/`; styles in `style.css`.

```bash
cd presentation
npm install
npm run dev      # presenter mode at http://localhost:3030 (press "p" for speaker notes)
npm run export   # PDF: grohnpetrel-slides.pdf
```

On every change to `presentation/` the `slides` GitHub Action exports the PDF (run artifact) and publishes the web version:

- Slides: https://commandertvis.github.io/dmfseo/slides/
- Presenter mode (notes, timer, next slide): https://commandertvis.github.io/dmfseo/slides/#/presenter/1
- PDF: https://commandertvis.github.io/dmfseo/slides/grohnpetrel-slides.pdf

The web version is `noindex` and `robots.txt` blocks the whole Pages site, so it never competes with our website in search.

Every slide is native Slidev (vector text and charts), in the look of the team's PowerPoint. Charts are Vue components in `components/`, drawn from `components/chart-data.json` (built from `data/results.csv` and `data/gsc.csv` on the gh-pages branch). Screenshots and mockups are in `public/img/`. Also used: `global-bottom.vue` (footer and page number), Google fonts (Lato, Source Serif 4), hash routing for GitHub Pages.

Rules for this deck: other teams appear by name only in the ranking comparison, never with their concepts; every number must come from the tracker (`public/rank-daily.csv`), Search Console or the course snapshots; update the Search Console numbers on the morning of the presentation.

Suggested speakers: Iaroslav (results, technical), Diego (strategy, content, GEO), Mario (reflection), Ayoyemi (marketing plan, close).
