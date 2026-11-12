# Grohnpetrel: final presentation (Slidev)

30-minute talk + Q&A for DMFSEO (26 Nov or 3 Dec 2026). Source: `slides.md`; images in `public/`; styles in `style.css`.

```bash
cd presentation
npm install
npm run dev      # presenter mode at http://localhost:3030 (press "p" for speaker notes)
npm run export   # PDF: grohnpetrel-slides.pdf
```

The `slides` GitHub Action builds the PDF on every change to `presentation/` and attaches it to the run as an artifact.

Rules for this deck: no other team's name or concept in public files (say them orally); every number must come from the tracker (`public/rank-daily.csv`), Search Console or the course snapshots; update the Search Console numbers on the morning of the presentation.

Suggested speakers: Iaroslav (results, technical), Diego (strategy, content, GEO), Mario (reflection), Ayoyemi (marketing plan, close).
