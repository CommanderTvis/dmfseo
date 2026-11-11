<?php
/**
 * Grohnpetrel design: the site's colours, type and the components the pages use (gp-* classes).
 *
 * Runs on the site through the Code Snippets plugin; scripts/wp_sync.py publishes this file.
 * Edit here, not in WordPress: the next publish overwrites the snippet. To undo the redesign,
 * remove this snippet from pages/site.json (the theme's own styles then apply again).
 *
 * Palette: deep ocean teal #124E5A, dark coastal teal #103F46, warm ivory #F7F4ED,
 * pale seafoam #E7F0EE, sandy beige #F2EBDD, muted gold #C49A47 (accents only, not text),
 * dark text #243A3F. Headings use a system serif stack (no web-font requests), body text the
 * theme's Manrope.
 */

add_action( 'wp_head', function () {
	?>
<style id="grohnpetrel-design">
body{
	--gp-teal:#124E5A;--gp-teal-dark:#103F46;--gp-ivory:#F7F4ED;--gp-foam:#E7F0EE;--gp-sand:#F2EBDD;
	--gp-gold:#C49A47;--gp-text:#243A3F;--gp-muted:#52666B;--gp-line:#D9E3E1;
	--gp-serif:Georgia,"Iowan Old Style","Palatino Linotype","Book Antiqua",Palatino,serif;
	--wp--style--global--content-size:760px;--wp--style--global--wide-size:1180px;
	background:var(--gp-ivory);color:var(--gp-text);
}
body p,body li,body td{line-height:1.7}
h1,h2,h3,.wp-block-post-title,.wp-block-heading{font-family:var(--gp-serif);color:var(--gp-teal-dark);font-weight:600;letter-spacing:0;text-wrap:balance}
h1,.wp-block-post-title{font-size:clamp(2.1rem,4.2vw,3.3rem);line-height:1.15}
h2.wp-block-heading{font-size:clamp(1.65rem,2.8vw,2.3rem);line-height:1.2}
h3.wp-block-heading{font-size:clamp(1.2rem,1.8vw,1.4rem);line-height:1.3}
a{color:var(--gp-teal);text-underline-offset:.18em}
a:hover{color:var(--gp-teal-dark)}
a:focus-visible,.wp-element-button:focus-visible{outline:3px solid var(--gp-gold);outline-offset:2px}

/* Header and footer */
header.wp-block-template-part{background:#fff;border-bottom:1px solid var(--gp-line)}
header.wp-block-template-part .wp-block-navigation a{color:var(--gp-text)}
header.wp-block-template-part .wp-block-navigation a:hover{color:var(--gp-teal);text-decoration:underline}
footer.wp-block-template-part>.has-background{background-color:var(--gp-teal-dark)!important}
footer.wp-block-template-part h2{font-family:var(--gp-serif)}

/* Buttons */
.wp-element-button,.wp-block-button__link{background-color:var(--gp-teal)!important;color:#fff!important;border:2px solid var(--gp-teal);border-radius:8px;padding:.75em 1.35em;font-weight:600;text-decoration:none;transition:background-color .15s,border-color .15s}
.wp-element-button:hover,.wp-block-button__link:hover{background-color:var(--gp-teal-dark)!important;border-color:var(--gp-teal-dark)}
.is-style-outline .wp-block-button__link{background-color:transparent!important;color:var(--gp-teal)!important;border-color:var(--gp-teal)}
.is-style-outline .wp-block-button__link:hover{background-color:var(--gp-teal)!important;color:#fff!important}

/* Tables, captions, boxes */
.wp-block-table table{border-collapse:collapse;background:#fff;border-radius:10px;overflow:hidden}
.wp-block-table th{background:var(--gp-teal);color:#fff;text-align:left}
.wp-block-table th,.wp-block-table td{border:1px solid var(--gp-line);padding:.6em .8em}
.wp-block-table.is-style-stripes tbody tr:nth-child(odd){background:var(--gp-foam)}
figcaption,.wp-element-caption{color:var(--gp-muted);font-size:.875rem}
[style*="border-left-color:#d8794b"]{border-left-color:var(--gp-gold)!important;background-color:var(--gp-foam)!important;border-radius:0 10px 10px 0}
.wp-block-image img{border-radius:10px}
.grohnpetrel-lang{max-width:var(--wp--style--global--wide-size);margin:.75rem auto!important;text-align:right;font-size:.9rem}

/* Page sections (full-width bands) */
.gp-section{padding:clamp(2.5rem,6vw,4.5rem) clamp(1rem,4vw,2rem)!important;margin-top:0!important;margin-bottom:0!important}
.gp-bg-white{background:#fff}.gp-bg-foam{background:var(--gp-foam)}.gp-bg-sand{background:var(--gp-sand)}.gp-bg-ivory{background:var(--gp-ivory)}
.gp-section>*{margin-left:auto;margin-right:auto}
.gp-kicker{font-size:.8rem!important;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--gp-teal)!important;margin-bottom:.25rem!important}
.gp-lead{font-size:1.15rem;color:var(--gp-text)}

/* Hero and closing banner (cover blocks) */
.gp-hero,.gp-banner{margin-top:0!important;margin-bottom:0!important}
.gp-hero{min-height:min(78vh,720px)!important}
.gp-hero h1,.gp-hero p,.gp-banner h2,.gp-banner p{color:#fff!important}
.gp-hero h1{font-size:clamp(2.2rem,5vw,3.8rem);max-width:18ch;text-shadow:0 1px 12px rgba(0,0,0,.25)}
.gp-hero .gp-kicker{color:#F2EBDD!important}
.gp-hero .wp-block-cover__inner-container,.gp-banner .wp-block-cover__inner-container{max-width:var(--wp--style--global--wide-size)!important;width:100%;margin-left:auto!important;margin-right:auto!important;padding:0 clamp(1rem,4vw,2rem);box-sizing:border-box}
.gp-hero .wp-block-cover__inner-container>*,.gp-banner .wp-block-cover__inner-container>*{margin-left:0!important;margin-right:0!important}
.gp-hero .wp-block-cover__background,.gp-banner .wp-block-cover__background{background:linear-gradient(90deg,rgba(16,63,70,.94) 0%,rgba(16,63,70,.78) 45%,rgba(16,63,70,.25) 100%)!important;opacity:1!important}
.gp-hero .gp-lead{max-width:44rem;font-size:clamp(1.05rem,1.6vw,1.25rem)}
.gp-hero .wp-block-button__link,.gp-banner .wp-block-button__link{background-color:var(--gp-gold)!important;border-color:var(--gp-gold);color:#1B2B2F!important}
.gp-hero .wp-block-button__link:hover,.gp-banner .wp-block-button__link:hover{background-color:#D9B466!important;border-color:#D9B466}
.gp-hero .is-style-outline .wp-block-button__link,.gp-banner .is-style-outline .wp-block-button__link{background-color:transparent!important;border-color:#fff;color:#fff!important}
.gp-hero .is-style-outline .wp-block-button__link:hover,.gp-banner .is-style-outline .wp-block-button__link:hover{background-color:#fff!important;color:var(--gp-teal-dark)!important}
.gp-note{font-size:.85rem!important;opacity:.95}
.gp-credit{font-size:.75rem!important;color:var(--gp-muted)!important;max-width:var(--wp--style--global--wide-size);margin:.4rem auto 0!important;padding:0 1rem}

/* Cards */
.gp-card{background:#fff;border:1px solid var(--gp-line);border-radius:14px;padding:1.5rem 1.5rem 1.6rem!important;box-shadow:0 1px 2px rgba(16,63,70,.06),0 6px 18px rgba(16,63,70,.05);display:flex;flex-direction:column;height:100%}
.gp-card>*{margin-top:0}
.gp-card>*+*{margin-top:.75rem}
.gp-card .wp-block-buttons{margin-top:auto!important;padding-top:.9rem}
.gp-card h3{margin-bottom:0}
.gp-card .gp-num{font-family:var(--gp-serif);color:var(--gp-gold);font-size:1.6rem!important;line-height:1;margin:0!important}
.gp-grid{display:grid!important;grid-template-columns:repeat(3,minmax(0,1fr))!important;gap:1.5rem!important}
.gp-media .wp-block-media-text__media img{border-radius:14px}
.gp-media.wp-block-media-text{gap:0}
.gp-media .wp-block-media-text__content{padding:0 0 0 clamp(1rem,4vw,3rem)}
.gp-media.has-media-on-the-right .wp-block-media-text__content{padding:0 clamp(1rem,4vw,3rem) 0 0}
.gp-list{list-style:none;padding-left:0!important}
.gp-list li{background:#fff;border:1px solid var(--gp-line);border-left:4px solid var(--gp-gold);border-radius:10px;padding:.75rem 1rem;margin-bottom:.6rem}

:lang(zh) body,:lang(zh) h1,:lang(zh) h2,:lang(zh) h3,:lang(zh) .wp-block-heading{font-family:"PingFang SC","Hiragino Sans GB","Noto Sans SC","Microsoft YaHei",sans-serif;letter-spacing:0}
.gp-follow{margin-bottom:.4rem!important}
.gp-social{gap:.6rem!important}
.gp-social .wp-social-link a{padding:.35em .7em!important}
:lang(zh) .gp-kicker{letter-spacing:.05em}
.gp-video{max-width:380px;margin-left:auto!important;margin-right:auto!important}
.gp-video video{width:100%;aspect-ratio:9/16;border-radius:14px;background:#103F46;display:block}
.gp-video figcaption{text-align:center}
.gp-transcript{background:#fff;border:1px solid var(--gp-line);border-radius:10px;padding:.75rem 1rem}
.gp-transcript summary{cursor:pointer;font-weight:600;color:var(--gp-teal-dark)}
.gp-transcript p{font-size:.95rem}
/* About: project timeline; Knowledge Centre: topic cards */
.gp-timeline{list-style:none;padding-left:0!important;border-left:3px solid var(--gp-line);margin-left:.4rem}
.gp-timeline li{position:relative;padding:0 0 .9rem 1.4rem}
.gp-timeline li::before{content:"";position:absolute;left:-.55rem;top:.45em;width:.8rem;height:.8rem;border-radius:50%;background:var(--gp-gold);border:2px solid var(--gp-ivory)}
.gp-timeline li strong{color:var(--gp-teal-dark);display:inline-block;min-width:6.5rem}
.gp-topics{margin-top:1.5rem!important;margin-bottom:2.25rem!important}
.gp-topic-links{padding-left:1.1rem!important;margin:0}
.gp-topic-links li{margin:.3rem 0}
.gp-about-media{margin-bottom:.4rem!important}
.gp-about-media .wp-block-media-text__content p{margin-top:0}
@media (max-width:600px){.wp-block-table td,.wp-block-table th{padding:.45em .55em;font-size:.9rem}}
@media (max-width:1000px){.gp-grid{grid-template-columns:repeat(2,minmax(0,1fr))!important}}
@media (max-width:781px){
	.gp-grid{grid-template-columns:1fr!important}
	.gp-hero .wp-block-cover__background,.gp-banner .wp-block-cover__background{background:rgba(16,63,70,.78)!important}
	.gp-media .wp-block-media-text__content,.gp-media.has-media-on-the-right .wp-block-media-text__content{padding:1.25rem 0 0!important}
	.gp-hero{min-height:560px!important}
	.grohnpetrel-lang{padding:0 1rem}
}
</style>
	<?php
}, 20 );
