# Grohnpetrel design system

The site's look lives in one place: `snippets/design.php` (styles in `wp_head`, a small enhancement script in `wp_footer`), published to WordPress by `scripts/wp_sync.py` like every other snippet. The quiz keeps its own styles in `snippets/challenge.php`. Page files in `pages/` carry content only; nothing in this system changes their text, links, images, metadata or structured data.

## Direction

Three directions were weighed before building:

| | Idea | Verdict |
|---|---|---|
| A. North Sea Editorial | Magazine cover typography, documentary photography, restrained grids | Strong first impression, but on its own it is the template any team could reach. Kept only for the two cover moments. |
| B. The Living Coast | Tidal motion, layered imagery, organic transitions | Most atmospheric, but the costliest for performance, accessibility and an SEO-judged site, and it fights the reading-heavy content. One motif kept: the tide line. |
| C. Modern Naturalist's Field Guide | Numbered plates, specimen labels, reference tables, fine scientific linework | Chosen. It is what the content already is: a sourced guide to six real species, with facts, Latin names and citations. |

**Result:** a field guide to the North Sea (C), with cover typography for the hero and closing banner (A) and the tide line as the single moving motif (B).

## Tokens

| Token | Value | Use |
|---|---|---|
| `--gp-ink` | `#0E3940` | Headings, dark bands, footer |
| `--gp-teal` | `#124E5A` | Links, primary buttons (9.3:1 on white) |
| `--gp-text` | `#1D3236` | Body text (13.4:1 on white) |
| `--gp-muted` | `#4E6267` | Secondary text (≥5.3:1 on every band) |
| `--gp-paper` | `#FFFFFF` | Ground |
| `--gp-mist` / `--gp-tide` | `#EEF4F1` / `#E2ECE7` | The two section tints (from the mascot's background) |
| `--gp-line` / `--gp-line-strong` | `#D5E1DD` / `#A9BDB7` | Hairlines and rules |
| `--gp-beak` | `#C8714F` | The only accent, from the mascot's beak; marks only, never text |
| `--gp-beak-ink` | `#9E4A2B` | Accent text (kickers, numerals) |
| `--gp-focus` | `#B85A36` | Focus rings on light surfaces (white on dark ones) |
| `--gp-wide` / `--gp-content` | `1180px` / `44rem` | Page grid / reading measure |
| `--gp-pad` / `--gp-section` | fluid | Side gutter / vertical rhythm between sections |
| `--gp-chart` / `--gp-tideline` | inline SVG | Contour linework, drawn once and tinted per surface with CSS masks |

Older names (`--gp-gold`, `--gp-foam`, `--gp-sand`, `--gp-ivory`, `--gp-teal-dark`) are kept as aliases so `challenge.php` and older markup keep working.

## Type

- **Platypi** (headings, numerals): a contemporary wedge-serif. **Manrope** (text, labels) at weight 400. Both ship with Twenty Twenty-Five and load from the site's own server; no third-party font requests.
- Fluid sizes with `clamp()`: page title 2.4–4rem, section heading 1.75–2.6rem, entry heading 1.2–1.5rem, body 16–18px at a 1.65 line height and a ~70-character measure.
- Russian headings are set in Georgia so Cyrillic and Latin glyphs match within a heading; Chinese uses the system CJK stack.

## Components

- **Running heads**: the short labels above section headings are set as italic serif captions, as in a field guide, rather than tracked uppercase eyebrows. The hero keeps the only uppercase line.
- **Ruled entries** replace cards: a hairline on top, heading, text, and a text link with a drawn arrow. No boxes, no shadows, no glyph icons.
- **Contents page** (Discover): two columns of numbered entries with the numeral hanging in its own gutter. **Reference list** (Quick answers): question left, answer right, ruled rows. **Goals**: oversized numerals between vertical hairlines.
- **Specimen labels**: two-column fact tables (Key facts, At a glance) get a thin ink frame and small-caps field names.
- **Reference tables**: wider tables use a 2px ink top rule and hairline rows; tables with four or more columns widen past the text column; on phones they become labelled stacks.
- **Specimen index**: the six-species tables are numbered 01–06 with Latin names in italics.
- **Plates**: species photos carry a paper number tab, then name, Latin name, ruled facts and links.
- **In brief** boxes: mist panel with the "In brief" label in accent ink.
- **Buttons**: 6px radius, 44px minimum height. The accent carries action: primary buttons on the covers and the challenge band are beak ink (`#9E4A2B`, white text, ~6:1); elsewhere teal.
- **Status marks**: in species tables, Vulnerable and Near Threatened get a beak dot and accent weight (class added by the script; wording unchanged).
- **Quiz** (`challenge.php`): ruled answer rows with serif letters, a 2px ink top rule instead of a boxed card, plain facts line instead of pills.
- **Header**: sticky, with a nav underline that draws from the left; between 600 and 959px the theme's overlay menu is used, because the full menu cannot sit beside the wordmark (English or German). **Footer**: ink band on the page grid, with contour linework.
- **Language links**: under the title as a quiet dateline on content pages; on landing pages the strip joins the hero's ink so there is no white seam.

## Signature experiences

1. **The tide line.** Five hairline waves settle along the foot of the hero once, in under five seconds (WCAG 2.2.2). The same contour drawing textures the dark bands (video, closing banner, footer) and the challenge band. On article pages a 2px accent line under the sticky header fills as you read, driven by CSS scroll timelines with no script.
2. **The field guide.** Numbered plates and specimen tables, a sticky species index on the seabird guide built from the plates' own headings, and length-range scales drawn next to the existing "87–100 cm" values on a shared ruler. No new figures are introduced; the scales only plot numbers already on the page.
3. **The cover.** The gannet photograph is art-directed per screen: on wide screens it shifts right so the bird flies clear of the type; on phones it becomes a band above the type and fades into ink. A staggered entrance for the hero copy (the headline is never hidden, so LCP is unaffected), a slow settle on the photograph, the photo credit set as an in-image caption, and photographs that reveal once as they scroll into view.

## Motion and accessibility rules

- Every effect sits inside `prefers-reduced-motion: no-preference`; with reduced motion nothing moves and nothing is hidden.
- Reveals only arm images that start below the fold, so nothing visible ever disappears; print styles cancel them.
- The script is progressive enhancement. Without it every page is complete; with it, generated navigation uses `aria-labelledby` and `aria-current`, and stacked tables keep explicit table roles.
- Focus rings are always visible: 2px, offset, in the focus colour or white on dark surfaces.
- On phones, tables with three or more columns become labelled stacks (labels copied from the column headers); two-column fact tables put the field name above its value. Both keep explicit table roles.

## Performance

The stylesheet is written readably in `design.php` and minified at output (comments and line breaks stripped): about 14 KB gzipped per page, including the linework drawings, which ship once as CSS custom properties and are tinted with masks. Fonts are the theme's own (one extra file, Platypi, preloaded). The script is about 7 KB unminified (2.6 KB gzipped) and adds no dependencies.

## Where things are

`snippets/design.php`, in order: tokens → type → header → buttons → tables → boxes → media → sections → cover → entries and icons → plates → video → lists → journal → continue/about boxes → breadcrumbs and fact panels → social → footer → signature layer → language fallbacks → responsive → reduced motion → enhancement script.
