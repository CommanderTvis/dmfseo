<?php
/**
 * Grohnpetrel design: the site's colours, type and the components the pages use (gp-* classes).
 *
 * Runs on the site through the Code Snippets plugin; scripts/wp_sync.py publishes this file.
 * Edit here, not in WordPress: the next publish overwrites the snippet. To undo the redesign,
 * remove this snippet from pages/site.json (the theme's own styles then apply again).
 *
 * Direction: a North Sea field guide. Deep teal and seafoam come from the mascot, the terracotta
 * accent from its beak (also the colour the "In brief" boxes already carry). Pages read like
 * plates in a guide: ruled entries instead of boxed cards, data tables set like reference tables,
 * one aligned grid from header to footer.
 *
 * Palette: ink #0E3940, teal #124E5A (links, buttons), sea #2A6B66, text #1D3236, muted #4E6267,
 * mist #EEF4F1 and tide #E2ECE7 (the two section tints), beak #C8714F (marks only, never text),
 * beak ink #9E4A2B (accent text), focus #B85A36. All text pairs meet WCAG AA.
 *
 * Type: Platypi for headings and Manrope for text. Both ship with the Twenty Twenty-Five theme,
 * so the fonts load from this site's own server: no third-party font requests.
 */

add_action( 'wp_head', function () {
	$platypi = get_theme_file_uri( 'assets/fonts/platypi/Platypi-VariableFont_wght.woff2' );
	ob_start(); // the stylesheet below stays readable here and is sent minified
	?>
<link rel="preload" href="<?php echo esc_url( $platypi ); ?>" as="font" type="font/woff2" crossorigin data-gp-font>
<style id="grohnpetrel-design">
@font-face{font-family:Platypi;font-style:normal;font-weight:300 800;font-display:swap;src:url('<?php echo esc_url( $platypi ); ?>') format('woff2')}

/* ---------- Tokens ---------- */
body{
	--gp-ink:#0E3940;--gp-teal:#124E5A;--gp-sea:#2A6B66;--gp-text:#1D3236;--gp-muted:#4E6267;
	--gp-paper:#FFFFFF;--gp-mist:#EEF4F1;--gp-tide:#E2ECE7;--gp-line:#D5E1DD;--gp-line-strong:#A9BDB7;
	--gp-beak:#C8714F;--gp-beak-ink:#9E4A2B;--gp-focus:#B85A36;
	--gp-on-dark:#C9DAD5;--gp-on-dark-muted:#9FBBB4;
	/* names kept for snippets/challenge.php and older markup */
	--gp-teal-dark:var(--gp-ink);--gp-ivory:#F7FAF8;--gp-foam:var(--gp-mist);--gp-sand:var(--gp-tide);--gp-gold:var(--gp-beak);
	--gp-serif:Platypi,Georgia,"Iowan Old Style","Palatino Linotype",serif;
	--gp-sans:Manrope,system-ui,-apple-system,"Segoe UI",sans-serif;
	--gp-wide:1180px;--gp-content:44rem;
	--gp-pad:clamp(1.25rem,4vw,3rem);
	--gp-section:clamp(3.5rem,8vw,6.5rem);
	--gp-radius:4px;
	--gp-tideline:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 120' fill='none' stroke='black' stroke-width='1'%3E%3Cpath d='M0 18Q25 21 38 22Q50 22 62 22Q75 22 88 21Q100 21 112 20Q125 20 138 20Q150 20 162 20Q175 20 188 20Q200 20 212 18Q225 17 238 16Q250 15 262 14Q275 13 288 13Q300 13 312 14Q325 15 338 16Q350 17 362 17Q375 18 388 18Q400 18 412 18Q425 18 438 19Q450 19 462 20Q475 21 488 22Q500 23 512 23Q525 23 538 22Q550 21 562 20Q575 19 588 18Q600 16 612 16Q625 16 638 16Q650 16 662 16Q675 16 688 16Q700 15 712 15Q725 14 738 14Q750 14 762 14Q775 15 788 17L800 18' opacity='0.90'/%3E%3Cpath d='M0 46Q25 46 38 45Q50 44 62 44Q75 43 88 43Q100 42 112 42Q125 42 138 42Q150 41 162 40Q175 39 188 37Q200 35 212 34Q225 33 238 33Q250 33 262 34Q275 35 288 37Q300 38 312 39Q325 40 338 40Q350 41 362 41Q375 41 388 42Q400 43 412 44Q425 45 438 45Q450 46 462 46Q475 46 488 45Q500 44 512 42Q525 41 538 39Q550 38 562 37Q575 36 588 36Q600 36 612 36Q625 36 638 36Q650 36 662 36Q675 35 688 35Q700 35 712 36Q725 37 738 39Q750 40 762 42Q775 44 788 45L800 46' opacity='0.76'/%3E%3Cpath d='M0 68Q25 66 38 65Q50 64 62 64Q75 63 88 63Q100 62 112 61Q125 59 138 58Q150 56 162 55Q175 54 188 54Q200 54 212 55Q225 56 238 58Q250 60 262 61Q275 62 288 63Q300 64 312 64Q325 65 338 65Q350 66 362 67Q375 68 388 68Q400 69 412 69Q425 69 438 68Q450 67 462 65Q475 63 488 61Q500 59 512 58Q525 57 538 57Q550 56 562 57Q575 57 588 57Q600 57 612 57Q625 57 638 57Q650 57 662 58Q675 59 688 61Q700 63 712 65Q725 67 738 68Q750 69 762 69Q775 69 788 69L800 68' opacity='0.62'/%3E%3Cpath d='M0 86Q25 85 38 84Q50 83 62 81Q75 80 88 79Q100 77 112 76Q125 75 138 75Q150 75 162 76Q175 78 188 80Q200 82 212 83Q225 85 238 86Q250 87 262 88Q275 89 288 89Q300 90 312 90Q325 91 338 91Q350 92 362 92Q375 91 388 90Q400 89 412 86Q425 84 438 82Q450 80 462 79Q475 77 488 77Q500 77 512 77Q525 77 538 78Q550 78 562 78Q575 79 588 79Q600 80 612 81Q625 82 638 84Q650 86 662 88Q675 90 688 91Q700 93 712 93Q725 93 738 92Q750 91 762 90Q775 88 788 87L800 86' opacity='0.48'/%3E%3Cpath d='M0 103Q25 101 38 99Q50 98 62 97Q75 96 88 96Q100 96 112 98Q125 99 138 102Q150 104 162 106Q175 108 188 110Q200 111 212 112Q225 112 238 113Q250 113 262 114Q275 114 288 114Q300 114 312 114Q325 113 338 112Q350 110 362 108Q375 105 388 103Q400 101 412 99Q425 98 438 97Q450 97 462 97Q475 98 488 99Q500 99 512 100Q525 101 538 101Q550 102 562 104Q575 105 588 107Q600 109 612 111Q625 113 638 115Q650 116 662 116Q675 116 688 115Q700 114 712 112Q725 111 738 109Q750 108 762 106Q775 105 788 104L800 103' opacity='0.34'/%3E%3C/svg%3E");
	--gp-chart:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1600 700' fill='none' stroke='black' stroke-width='1'%3E%3Cpath d='M-40 30Q10 43 35 49Q60 55 85 59Q110 64 135 67Q160 70 185 71Q210 72 235 71Q260 70 285 68Q310 65 335 63Q360 60 385 58Q410 56 435 55Q460 53 485 54Q510 54 535 55Q560 57 585 58Q610 60 635 61Q660 63 685 63Q710 63 735 62Q760 60 785 57Q810 53 835 48Q860 43 885 37Q910 31 935 25Q960 19 985 14Q1010 9 1035 6Q1060 3 1085 3Q1110 2 1135 3Q1160 5 1185 8Q1210 11 1235 14Q1260 18 1285 21Q1310 25 1335 27Q1360 30 1385 31Q1410 32 1435 31Q1460 31 1485 30Q1510 29 1535 28Q1560 27 1585 27L1610 27'/%3E%3Cpath d='M-40 130Q10 135 35 136Q60 136 85 135Q110 134 135 131Q160 129 185 127Q210 124 235 123Q260 121 285 121Q310 120 335 121Q360 122 385 124Q410 125 435 127Q460 129 485 131Q510 132 535 132Q560 131 585 129Q610 127 635 123Q660 119 685 114Q710 108 735 102Q760 96 785 90Q810 84 835 80Q860 75 885 73Q910 70 935 70Q960 70 985 72Q1010 73 1035 76Q1060 79 1085 83Q1110 86 1135 89Q1160 92 1185 94Q1210 95 1235 96Q1260 96 1285 96Q1310 95 1335 94Q1360 92 1385 91Q1410 90 1435 90Q1460 90 1485 92Q1510 94 1535 97Q1560 101 1585 106L1610 111'/%3E%3Cpath d='M-40 197Q10 193 35 191Q60 189 85 188Q110 187 135 187Q160 187 185 189Q210 190 235 193Q260 195 285 197Q310 199 335 200Q360 201 385 201Q410 200 435 198Q460 195 485 191Q510 186 535 180Q560 175 585 168Q610 162 635 157Q660 151 685 147Q710 143 735 141Q760 139 785 139Q810 139 835 141Q860 143 885 146Q910 149 935 152Q960 155 985 158Q1010 160 1035 161Q1060 162 1085 162Q1110 162 1135 161Q1160 159 1185 158Q1210 156 1235 155Q1260 154 1285 155Q1310 155 1335 157Q1360 159 1385 163Q1410 167 1435 172Q1460 178 1485 183Q1510 189 1535 194Q1560 200 1585 203L1610 207'/%3E%3Cpath d='M-40 251Q10 254 35 256Q60 258 85 261Q110 263 135 265Q160 268 185 269Q210 270 235 269Q260 268 285 265Q310 262 335 258Q360 253 385 247Q410 241 435 235Q460 229 485 224Q510 219 535 216Q560 212 585 211Q610 209 635 210Q660 211 685 213Q710 215 735 218Q760 221 785 223Q810 226 835 228Q860 230 885 230Q910 230 935 230Q960 229 985 227Q1010 226 1035 224Q1060 222 1085 221Q1110 221 1135 221Q1160 222 1185 224Q1210 227 1235 231Q1260 235 1285 241Q1310 246 1335 252Q1360 257 1385 262Q1410 267 1435 270Q1460 273 1485 274Q1510 275 1535 274Q1560 273 1585 270L1610 267'/%3E%3Cpath d='M-40 329Q10 334 35 335Q60 336 85 335Q110 334 135 331Q160 328 185 323Q210 318 235 313Q260 307 285 301Q310 296 335 291Q360 287 385 284Q410 281 435 281Q460 280 485 281Q510 282 535 285Q560 287 585 290Q610 293 635 295Q660 298 685 299Q710 300 735 300Q760 300 785 299Q810 297 835 296Q860 294 885 292Q910 290 935 290Q960 289 985 290Q1010 291 1035 294Q1060 297 1085 302Q1110 306 1135 312Q1160 317 1185 323Q1210 328 1235 332Q1260 337 1285 339Q1310 342 1335 342Q1360 342 1385 340Q1410 338 1435 335Q1460 332 1485 327Q1510 323 1535 319Q1560 315 1585 312L1610 309'/%3E%3Cpath d='M-40 397Q10 390 35 386Q60 381 85 375Q110 370 135 365Q160 360 185 356Q210 352 235 351Q260 349 285 349Q310 349 335 351Q360 353 385 356Q410 359 435 361Q460 364 485 367Q510 369 535 370Q560 371 585 370Q610 370 635 369Q660 367 685 365Q710 363 735 362Q760 360 785 360Q810 360 835 362Q860 363 885 367Q910 370 935 375Q960 380 985 386Q1010 391 1035 396Q1060 402 1085 405Q1110 409 1135 411Q1160 413 1185 412Q1210 412 1235 409Q1260 407 1285 403Q1310 399 1335 395Q1360 390 1385 386Q1410 382 1435 380Q1460 377 1485 375Q1510 374 1535 373Q1560 373 1585 374L1610 374'/%3E%3Cpath d='M-40 429Q10 420 35 417Q60 415 85 414Q110 413 135 414Q160 415 185 418Q210 420 235 424Q260 427 285 430Q310 433 335 435Q360 438 385 439Q410 439 435 439Q460 438 485 437Q510 436 535 434Q560 433 585 432Q610 431 635 431Q660 432 685 435Q710 437 735 441Q760 445 785 451Q810 456 835 462Q860 468 885 473Q910 478 935 481Q960 485 985 486Q1010 487 1035 486Q1060 485 1085 482Q1110 479 1135 475Q1160 471 1185 466Q1210 462 1235 458Q1260 454 1285 452Q1310 449 1335 448Q1360 446 1385 446Q1410 446 1435 446Q1460 446 1485 446Q1510 445 1535 444Q1560 442 1585 439L1610 436'/%3E%3Cpath d='M-40 472Q10 476 35 480Q60 483 85 487Q110 490 135 494Q160 497 185 499Q210 502 235 503Q260 504 285 503Q310 503 335 502Q360 501 385 500Q410 499 435 499Q460 499 485 501Q510 503 535 506Q560 510 585 515Q610 520 635 526Q660 532 685 538Q710 545 735 550Q760 555 785 558Q810 561 835 562Q860 563 885 562Q910 561 935 558Q960 555 985 550Q1010 546 1035 542Q1060 538 1085 534Q1110 531 1135 529Q1160 526 1185 525Q1210 524 1235 524Q1260 523 1285 523Q1310 523 1335 522Q1360 521 1385 518Q1410 516 1435 511Q1460 507 1485 501Q1510 495 1535 488Q1560 481 1585 473L1610 466'/%3E%3Cpath d='M-40 548Q10 555 35 557Q60 559 85 560Q110 561 135 561Q160 561 185 561Q210 561 235 561Q260 561 285 562Q310 563 335 566Q360 569 385 574Q410 579 435 585Q460 592 485 599Q510 606 535 613Q560 620 585 625Q610 631 635 634Q660 637 685 638Q710 640 735 638Q760 637 785 634Q810 632 835 628Q860 624 885 621Q910 617 935 614Q960 612 985 610Q1010 608 1035 608Q1060 607 1085 607Q1110 606 1135 606Q1160 605 1185 604Q1210 602 1235 598Q1260 595 1285 590Q1310 584 1335 577Q1360 570 1385 562Q1410 554 1435 546Q1460 538 1485 531Q1510 523 1535 518Q1560 513 1585 510L1610 507'/%3E%3Cpath d='M-40 612Q10 612 35 613Q60 613 85 614Q110 615 135 617Q160 620 185 625Q210 629 235 635Q260 642 285 650Q310 657 335 666Q360 674 385 681Q410 689 435 695Q460 701 485 705Q510 709 535 711Q560 712 585 712Q610 711 635 709Q660 707 685 704Q710 702 735 699Q760 697 785 695Q810 694 835 693Q860 692 885 693Q910 693 935 693Q960 693 985 692Q1010 692 1035 690Q1060 688 1085 684Q1110 680 1135 673Q1160 667 1185 659Q1210 651 1235 643Q1260 634 1285 625Q1310 617 1335 609Q1360 602 1385 596Q1410 591 1435 587Q1460 584 1485 583Q1510 582 1535 582Q1560 583 1585 584L1610 585'/%3E%3C/svg%3E");
	--gp-arrow:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='none' stroke='black' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M4 10h11'/%3E%3Cpath d='m11 5.5 4.5 4.5-4.5 4.5'/%3E%3C/svg%3E");
	--wp--style--global--content-size:var(--gp-content);--wp--style--global--wide-size:var(--gp-wide);
	--wp--style--root--padding-left:var(--gp-pad);--wp--style--root--padding-right:var(--gp-pad);
	background:var(--gp-paper);color:var(--gp-text);
	font-family:var(--gp-sans);font-weight:400;font-size:clamp(1rem,.94rem + .28vw,1.125rem);line-height:1.65;
	-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;
}
::selection{background:#CFE3DD;color:var(--gp-ink)}
body :where(input,textarea,select){accent-color:var(--gp-teal);caret-color:var(--gp-teal)}
body p,body li,body td{line-height:1.65;overflow-wrap:break-word}
body strong,body b{font-weight:700}

/* ---------- Type ---------- */
h1,h2,h3,h4,.wp-block-post-title,.wp-block-heading{font-family:var(--gp-serif);color:var(--gp-ink);font-weight:500;letter-spacing:-.012em;text-wrap:balance;font-optical-sizing:auto}
h1,.wp-block-post-title{font-size:clamp(2.375rem,1.55rem + 3.3vw,4rem);line-height:1.04;letter-spacing:-.02em}
h2.wp-block-heading{font-size:clamp(1.75rem,1.3rem + 1.8vw,2.625rem);line-height:1.1;letter-spacing:-.016em}
h3.wp-block-heading{font-size:clamp(1.25rem,1.12rem + .55vw,1.5rem);line-height:1.22;font-weight:550}
h4.wp-block-heading{font-family:var(--gp-sans);font-size:1rem;font-weight:700;letter-spacing:0;line-height:1.4}
p,li{text-wrap:pretty}
a{color:var(--gp-teal);text-decoration-line:underline;text-decoration-thickness:1px;text-decoration-color:rgba(18,78,90,.4);text-underline-offset:.2em;transition:color .15s,text-decoration-color .15s}
a:hover{color:var(--gp-ink);text-decoration-color:var(--gp-beak)}
:where(body) :focus-visible{outline:2px solid var(--gp-focus);outline-offset:3px;border-radius:2px}
.wp-block-post-content li::marker{color:var(--gp-beak)}
.wp-block-post-content :where(ul.wp-block-list>li+li,ol.wp-block-list>li+li){margin-top:.4em}
figcaption,.wp-element-caption{color:var(--gp-muted);font-size:.8125rem;line-height:1.5;text-align:left;margin-top:.6rem}
.has-small-font-size{font-size:.875rem!important;line-height:1.6}
.wp-block-post-content p.has-small-font-size{color:var(--gp-muted)}
hr.wp-block-separator{border:0;border-top:1px solid var(--gp-line);opacity:1}

/* Reading rhythm inside articles: more room above a heading than below it */
.wp-block-post-content>h2.wp-block-heading{margin-top:clamp(2.5rem,5vw,3.5rem)}
.wp-block-post-content>h3.wp-block-heading{margin-top:2.25rem}
.wp-block-post-content>:where(h2,h3)+*{margin-top:.85rem}
.wp-block-post-content>p{margin-top:1.1em}

/* ---------- Header and navigation ---------- */
header.wp-block-template-part{background:var(--gp-paper);border-bottom:1px solid var(--gp-line)}
header.wp-block-template-part>.wp-block-group>.wp-block-group>.alignwide{padding-top:1rem!important;padding-bottom:1rem!important}
header .wp-block-site-logo img{border-radius:var(--gp-radius);width:40px;height:40px}
header .wp-block-site-title{font-family:var(--gp-serif);font-size:1.375rem;font-weight:600;letter-spacing:-.01em;line-height:1}
header .wp-block-site-title a{color:var(--gp-ink);text-decoration:none}
header.wp-block-template-part .wp-block-navigation{font-size:.9375rem;font-weight:500;gap:.25rem 1.6rem}
header.wp-block-template-part .wp-block-navigation a{color:var(--gp-text);text-decoration:none}
header.wp-block-template-part .wp-block-navigation .wp-block-navigation-item__content{padding-block:.5rem}
header.wp-block-template-part .wp-block-navigation a:hover,header.wp-block-template-part .wp-block-navigation [aria-current="page"]{color:var(--gp-teal);text-decoration:underline;text-decoration-color:var(--gp-beak);text-decoration-thickness:2px;text-underline-offset:.45em}
header .wp-block-navigation .wp-block-navigation__submenu-container{background:var(--gp-paper)!important;border:1px solid var(--gp-line)!important;border-radius:6px;padding:.5rem!important;box-shadow:0 12px 32px -8px rgba(14,57,64,.16);min-width:15rem!important}
header .wp-block-navigation .wp-block-navigation__submenu-container .wp-block-navigation-item__content{padding:.55rem .75rem!important;border-radius:var(--gp-radius)}
header .wp-block-navigation .wp-block-navigation__submenu-container a:hover{background:var(--gp-mist);text-decoration:none}
header .wp-block-navigation__submenu-icon svg{stroke:var(--gp-muted)}
header .wp-block-navigation__responsive-container-open{padding:10px;margin:-10px;color:var(--gp-ink)}
header .wp-block-navigation__responsive-container.is-menu-open{background:var(--gp-paper)!important;color:var(--gp-text)!important;padding:1.25rem var(--gp-pad) 2rem!important}
header .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__responsive-container-content{padding-top:3.5rem;align-items:flex-start;gap:0}
header .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__container{gap:0;width:100%;align-items:stretch}
header .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation-item{width:100%;border-bottom:1px solid var(--gp-line);align-items:flex-start}
header .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation-item__content{font-size:1.125rem;padding:.8rem 0!important}
header .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__submenu-container{border:0!important;box-shadow:none;padding:0 0 .6rem 1rem!important;min-width:0!important;background:transparent!important}
header .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__submenu-container .wp-block-navigation-item{border:0}
header .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__submenu-container .wp-block-navigation-item__content{font-size:1rem;color:var(--gp-muted);padding:.5rem 0!important}
header .wp-block-navigation__responsive-container-close{padding:10px;margin:-10px}
header .wp-block-navigation__responsive-container.is-menu-open :is(.wp-block-navigation__responsive-container-content,.wp-block-navigation__container,.wp-block-navigation-item,.wp-block-navigation__submenu-container){align-items:flex-start!important;text-align:left;justify-content:flex-start}
header.wp-block-template-part :focus-visible{outline:2px solid var(--gp-focus)!important;outline-offset:2px}
header.wp-block-template-part :focus:not(:focus-visible){outline:none}

/* Language row (printed by snippets/seo-head.php before the content) */
.grohnpetrel-lang{box-sizing:border-box;max-width:var(--gp-content);margin:1rem auto 2.25rem!important;padding:0;border:0;text-align:left;font-size:.8125rem;color:var(--gp-muted);line-height:1.6}
.grohnpetrel-lang a{color:var(--gp-teal);text-decoration-color:rgba(18,78,90,.3)}
.page-template-page-no-title .grohnpetrel-lang{max-width:var(--gp-wide);margin:0 auto!important;padding:.6rem 0 0;text-align:right;background:var(--gp-ink);box-shadow:0 0 0 100vmax var(--gp-ink);clip-path:inset(0 -100vmax);color:var(--gp-on-dark-muted);position:relative;z-index:3}
.page-template-page-no-title .grohnpetrel-lang a{color:var(--gp-on-dark);text-decoration-color:rgba(255,255,255,.3)}
.page-template-page-no-title .grohnpetrel-lang a:hover{color:#fff}
.page-template-page-no-title .grohnpetrel-lang :focus-visible{outline-color:#fff}

/* Page masthead on templates with a title */
main.wp-block-group:has(>.wp-block-group .wp-block-post-title){margin-top:0!important}
main>.wp-block-group:has(.wp-block-post-title){padding-top:clamp(2.5rem,6vw,5rem)!important;padding-bottom:var(--gp-section)!important}
main .wp-block-post-title{margin-top:.5rem!important;font-size:clamp(2.25rem,1.5rem + 2.8vw,3.5rem)}
/* post byline (theme template): close under the title, no dead band before the text */
main .wp-block-post-title+.wp-block-group.has-small-font-size{margin-top:.9rem!important;margin-bottom:0!important;color:var(--gp-muted);font-size:.8125rem!important}

/* ---------- Buttons ---------- */
.wp-element-button,.wp-block-button__link{display:inline-flex;align-items:center;justify-content:center;gap:.5em;min-height:44px;box-sizing:border-box;background-color:var(--gp-teal)!important;color:#fff!important;border:1.5px solid var(--gp-teal);border-radius:6px;padding:.7em 1.3em;font-family:var(--gp-sans);font-size:.9375rem;font-weight:600;letter-spacing:.005em;line-height:1.25;text-decoration:none;transition:background-color .15s,border-color .15s,color .15s}
.wp-element-button:hover,.wp-block-button__link:hover{background-color:var(--gp-ink)!important;border-color:var(--gp-ink);color:#fff!important}
.is-style-outline .wp-block-button__link{background-color:transparent!important;color:var(--gp-teal)!important;border-color:var(--gp-teal)}
.is-style-outline .wp-block-button__link:hover{background-color:var(--gp-teal)!important;color:#fff!important}
.wp-block-buttons{gap:.75rem}

/* ---------- Tables: set like reference tables ---------- */
.wp-block-table{overflow-x:auto}
.wp-block-table table{border-collapse:collapse;background:transparent;border-radius:0;font-size:.9375rem;font-variant-numeric:tabular-nums lining-nums;border-top:2px solid var(--gp-ink)}
.wp-block-table thead{border-bottom:0}
.wp-block-table th{background:transparent;color:var(--gp-ink);text-align:left;font-weight:700;font-size:.8125rem;letter-spacing:.02em;vertical-align:bottom}
.wp-block-table th,.wp-block-table td{border:0;border-bottom:1px solid var(--gp-line);padding:.75em 1.1em .75em 0;line-height:1.5}
.wp-block-table thead th{border-bottom:1px solid var(--gp-ink)}
.wp-block-table:not(:has(tr>:nth-child(3))) td:first-child{font-weight:600;color:var(--gp-ink)}
.wp-block-table :where(th,td):last-child{padding-right:0}
.wp-block-table.is-style-stripes{border-bottom:0}
.wp-block-table.is-style-stripes tbody tr:nth-child(odd){background:transparent}
.wp-block-table figcaption{margin-top:.75rem}

/* ---------- "In brief" and other boxed groups ---------- */
.wp-block-group[style*="border-left-color:#d8794b"]{background-color:transparent!important;border:0!important;border-top:2px solid var(--gp-ink)!important;border-bottom:1px solid var(--gp-line)!important;border-radius:0;padding:1.1rem 0 1.25rem!important;font-size:1.125rem;line-height:1.6;color:var(--gp-ink)}
.wp-block-group[style*="border-left-color:#d8794b"] strong:first-child{color:var(--gp-beak-ink)}
.wp-block-group[style*="border-left-color:#d8794b"]>*{margin-top:0}
.wp-block-group[style*="border-left-color:#d8794b"]>*+*{margin-top:.75rem}

/* ---------- Images and media ---------- */
.wp-block-image img{border-radius:2px}
.gp-media .wp-block-media-text__media img{border-radius:2px}
.gp-media.wp-block-media-text{gap:0}
.gp-media .wp-block-media-text__content{padding:0 0 0 clamp(1.5rem,5vw,4.5rem)}
.gp-media.has-media-on-the-right .wp-block-media-text__content{padding:0 clamp(1.5rem,5vw,4.5rem) 0 0}
.gp-media .wp-block-media-text__content>:first-child{margin-top:0}
.gp-section>.gp-media+*{margin-top:clamp(3rem,6vw,4.5rem)!important}
.gp-credit{font-size:.75rem!important;line-height:1.5;color:var(--gp-muted)!important;max-width:var(--gp-wide);margin:.6rem auto 0!important;padding:0}
.gp-credit a{color:inherit}
/* the photo credit under the closing banner joins the footer band instead of floating on white */
.gp-banner+.gp-credit{margin-top:0!important;padding:.9rem 0;background:var(--gp-ink);box-shadow:0 0 0 100vmax var(--gp-ink);clip-path:inset(0 -100vmax);color:var(--gp-on-dark-muted)!important;border-bottom:1px solid rgba(255,255,255,.12)}
.gp-banner+.gp-credit a{color:var(--gp-on-dark);text-decoration-color:rgba(255,255,255,.3)}

/* ---------- Page sections (full-width bands) ---------- */
.gp-section{padding:var(--gp-section) var(--gp-pad)!important;margin-top:0!important;margin-bottom:0!important}
.gp-bg-white{background:var(--gp-paper)}.gp-bg-foam{background:var(--gp-mist)}.gp-bg-sand{background:var(--gp-tide)}.gp-bg-ivory{background:var(--gp-paper)}
.gp-section>*{margin-left:auto;margin-right:auto}
.gp-section+.gp-section.gp-bg-white,.gp-section.gp-bg-white+.gp-section{border-top:0}
.gp-kicker{font-family:var(--gp-sans);font-size:.75rem!important;font-weight:700;letter-spacing:.14em;text-transform:uppercase;line-height:1.4;color:var(--gp-beak-ink)!important;margin-bottom:0!important}
.gp-kicker+h1,.gp-kicker+h2{margin-top:.75rem!important}
.gp-section .gp-kicker{font-family:var(--gp-serif);font-style:italic;font-weight:400;font-size:1rem!important;letter-spacing:0;text-transform:none;color:var(--gp-muted)!important}
.gp-section .gp-kicker+h2{margin-top:.4rem!important}
.gp-section h2.wp-block-heading+*{margin-top:1.1rem}
.gp-lead{font-size:clamp(1.0625rem,1rem + .35vw,1.25rem);line-height:1.6;color:var(--gp-text)}
.gp-section>.gp-measure{max-width:40rem;margin-left:max(0px,calc((100% - var(--gp-wide))/2))!important;margin-right:auto!important}
.gp-section>.wp-block-heading+.gp-grid,.gp-section>.gp-measure+.gp-grid{margin-top:clamp(2rem,4vw,3rem)!important}
.gp-note{font-size:.8125rem!important;line-height:1.55;color:var(--gp-muted)}

/* ---------- Hero and closing banner (cover blocks) ---------- */
.gp-hero,.gp-banner{margin-top:0!important;margin-bottom:0!important;padding-left:0!important;padding-right:0!important}
.gp-hero{min-height:min(84vh,780px)!important;padding-top:clamp(4rem,10vw,7rem)!important;padding-bottom:clamp(3.5rem,8vw,6rem)!important}
.gp-banner{min-height:0!important;padding-top:var(--gp-section)!important;padding-bottom:var(--gp-section)!important}
.gp-hero .wp-block-cover__inner-container,.gp-banner .wp-block-cover__inner-container{max-width:none!important;width:100%;margin:0!important;box-sizing:border-box;padding-left:max(var(--gp-pad),calc((100% - var(--gp-wide))/2))!important;padding-right:var(--gp-pad)!important}
.gp-hero .wp-block-cover__inner-container>*,.gp-banner .wp-block-cover__inner-container>*{margin-left:0!important;margin-right:0!important;max-width:42rem}
.gp-hero .wp-block-cover__background,.gp-banner .wp-block-cover__background{background:linear-gradient(90deg,rgba(14,57,64,.95) 0%,rgba(14,57,64,.86) 40%,rgba(14,57,64,.42) 60%,rgba(14,57,64,0) 80%)!important;opacity:1!important}
.gp-hero .wp-block-cover__image-background{transform:translateX(12%) scale(1.25);transform-origin:70% 50%}
.gp-banner .wp-block-cover__background{background:linear-gradient(90deg,rgba(14,57,64,.95) 0%,rgba(14,57,64,.82) 42%,rgba(14,57,64,.25) 100%)!important}
.gp-hero h1,.gp-hero h2,.gp-hero p,.gp-banner h2,.gp-banner p{color:#fff!important}
.gp-hero h1{font-size:clamp(2.5rem,1.45rem + 3.9vw,4.5rem);line-height:1.02;letter-spacing:-.024em;text-shadow:none}
.gp-hero .wp-block-cover__inner-container>h1{max-width:11.5em}
.gp-banner h2{max-width:20ch}
.gp-hero .gp-kicker,.gp-banner .gp-kicker{color:#F0C9B6!important}
.gp-hero .gp-lead,.gp-banner p:not(.gp-note):not(.gp-kicker){max-width:38rem;font-size:clamp(1.0625rem,1rem + .4vw,1.25rem);line-height:1.6;color:#E3EEEA!important}
.gp-hero .wp-block-buttons,.gp-banner .wp-block-buttons{margin-top:2rem!important}
.gp-hero .wp-block-button__link,.gp-banner .wp-block-button__link,.gp-cgc-promo .wp-block-button__link{background-color:var(--gp-beak-ink)!important;border-color:var(--gp-beak-ink);color:#fff!important}
.gp-hero .wp-block-button__link:hover,.gp-banner .wp-block-button__link:hover,.gp-cgc-promo .wp-block-button__link:hover{background-color:#fff!important;border-color:#fff;color:var(--gp-ink)!important}
.gp-hero .is-style-outline .wp-block-button__link,.gp-banner .is-style-outline .wp-block-button__link{background-color:transparent!important;border-color:rgba(255,255,255,.7);color:#fff!important}
.gp-hero .is-style-outline .wp-block-button__link:hover,.gp-banner .is-style-outline .wp-block-button__link:hover{background-color:#fff!important;border-color:#fff;color:var(--gp-ink)!important}
.gp-hero .gp-note,.gp-banner .gp-note{color:var(--gp-on-dark)!important;margin-top:1.75rem!important;max-width:38rem}
.gp-hero :focus-visible,.gp-banner :focus-visible,footer.wp-block-template-part :focus-visible{outline-color:#fff}

/* ---------- Ruled entries (formerly cards) ---------- */
.gp-grid{display:grid!important;grid-template-columns:repeat(3,minmax(0,1fr))!important;gap:clamp(2rem,4vw,3rem) clamp(1.75rem,3.5vw,3rem)!important}
.gp-grid-4{grid-template-columns:repeat(4,minmax(0,1fr))!important;gap:clamp(2rem,4vw,3rem) clamp(1.5rem,2.5vw,2.25rem)!important;margin-top:clamp(2rem,4vw,3rem)!important;margin-bottom:clamp(1.5rem,3vw,2.25rem)!important}
.gp-card{background:transparent;border:0;border-top:1px solid var(--gp-line-strong);border-radius:0;padding:1.4rem 0 0!important;box-shadow:none;display:flex;flex-direction:column;height:100%;box-sizing:border-box}
.gp-card>*{margin-top:0}
.gp-card>*+*{margin-top:.7rem}
.gp-card h3{margin-bottom:0;font-size:clamp(1.1875rem,1.1rem + .35vw,1.375rem)!important}
.gp-card p{font-size:.9688rem;line-height:1.6}
.gp-card .wp-block-buttons{margin-top:auto!important;padding-top:.75rem}
.gp-card .wp-block-button__link,.gp-card .is-style-outline .wp-block-button__link{background:transparent!important;border:0;border-radius:0;padding:.6rem 0;min-height:44px;color:var(--gp-teal)!important;font-size:.9375rem;font-weight:700;text-align:left;justify-content:flex-start}
.gp-card .wp-block-button__link::after{content:"";flex:0 0 auto;width:1.05em;height:1.05em;background:var(--gp-beak);-webkit-mask:var(--gp-arrow) center/contain no-repeat;mask:var(--gp-arrow) center/contain no-repeat;transition:transform .2s cubic-bezier(.2,.7,.2,1)}
.gp-card .wp-block-button__link:hover{background:transparent!important;color:var(--gp-ink)!important}
.gp-card .wp-block-button__link:hover::after{transform:translateX(3px)}
.gp-card .gp-num{font-family:var(--gp-serif);color:var(--gp-beak);font-size:2.25rem!important;font-weight:400;line-height:1;margin:0 0 .4rem!important;font-variant-numeric:lining-nums}
.gp-grid-4 .gp-card{padding:1.25rem 0 0!important}

/* Icons above entry headings: a plain line icon, no tile */
.gp-ico{position:relative}
.gp-ico::before{content:none}
.gp-ico::after{content:none}
.gp-ico-bird{--gp-i:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M2 10c3.5 0 6.5 1.6 10 5.5 3.5-3.9 6.5-5.5 10-5.5'/%3E%3Cpath d='M12 15.5V19'/%3E%3Ccircle cx='12' cy='7' r='1.6'/%3E%3C/svg%3E")}
.gp-ico-alert{--gp-i:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 3 22 20H2z'/%3E%3Cpath d='M12 10v4.5'/%3E%3Cpath d='M12 17.5h.01'/%3E%3C/svg%3E")}
.gp-ico-shield{--gp-i:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 3 20 6v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z'/%3E%3Cpath d='m8.5 12.5 2.5 2.5 4.5-5'/%3E%3C/svg%3E")}
.gp-ico-compass{--gp-i:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='12' r='9'/%3E%3Cpath d='m15.5 8.5-2 5-5 2 2-5z'/%3E%3C/svg%3E")}
.gp-ico-cap{--gp-i:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M2 9l10-5 10 5-10 5z'/%3E%3Cpath d='M6 11v5c3.5 2.5 8.5 2.5 12 0v-5'/%3E%3C/svg%3E")}
.gp-ico-book{--gp-i:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M3 5c3-1 6-1 9 1 3-2 6-2 9-1v14c-3-1-6-1-9 1-3-2-6-2-9-1z'/%3E%3Cpath d='M12 6v14'/%3E%3C/svg%3E")}
.gp-ico-question{--gp-i:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='12' r='9'/%3E%3Cpath d='M9.5 9.5a2.5 2.5 0 1 1 3.4 2.3c-.6.3-.9.8-.9 1.5v.7'/%3E%3Cpath d='M12 17h.01'/%3E%3C/svg%3E")}
.gp-ico-people{--gp-i:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='9' cy='8' r='3'/%3E%3Cpath d='M3 20c0-3.3 2.7-5.5 6-5.5s6 2.2 6 5.5'/%3E%3Cpath d='M16 5.2a3 3 0 0 1 0 5.6'/%3E%3Cpath d='M18.5 14.8c1.6.8 2.5 2.4 2.5 4.2'/%3E%3C/svg%3E")}

/* Species and habitat plates: photo, name, Latin name, facts */
.gp-species{padding:0!important;border-top:0;overflow:visible}
.gp-species>*{padding-left:0;padding-right:0}
.gp-species>.wp-block-image{padding:0;margin:0!important}
.gp-species .wp-block-image img{width:100%;aspect-ratio:3/2;object-fit:cover;display:block;border-radius:2px}
.gp-species .wp-block-image figcaption{font-size:.6875rem;line-height:1.4;color:var(--gp-muted);margin:.5rem 0 0;text-align:left}
.gp-species h3{font-size:1.375rem!important;margin-top:1.1rem!important;padding-top:1rem;border-top:1px solid var(--gp-line-strong)}
.gp-species h3 a{text-decoration:none;color:var(--gp-ink)}
.gp-species h3 a:hover{color:var(--gp-teal);text-decoration:underline;text-decoration-color:var(--gp-beak)}
.gp-species__latin{font-size:.875rem;color:var(--gp-muted);margin-top:.2rem!important;font-style:italic}
.gp-species p{font-size:.9375rem!important;line-height:1.6}
.gp-species__facts{list-style:none;padding-left:0!important;font-size:.875rem!important;line-height:1.5}
.gp-species__facts li{margin:0;padding:.45rem 0;border-top:1px solid var(--gp-line)}
.gp-species__facts li:last-child{border-bottom:1px solid var(--gp-line)}
.gp-species__links{font-size:.875rem;margin-top:auto!important;padding-top:.8rem;padding-bottom:0}

/* ---------- Video ---------- */
.gp-video{max-width:340px;margin-left:auto!important;margin-right:auto!important}
.gp-video video{width:100%;aspect-ratio:9/16;border-radius:var(--gp-radius);background:var(--gp-ink);display:block}
.gp-video figcaption{text-align:left}
.gp-video-split{max-width:var(--gp-wide)!important;gap:clamp(2rem,6vw,6rem)!important}
.gp-video-split .gp-video{max-width:320px;margin-right:0!important}
.gp-video-grid .gp-video{max-width:100%}
.gp-video-card h3{font-size:1.1875rem!important;min-height:2.5em}
.gp-video-card .gp-transcript{margin-top:.5rem}
.gp-transcript{background:transparent;border:0;border-top:1px solid var(--gp-line);border-bottom:1px solid var(--gp-line);border-radius:0;padding:0}
.gp-transcript summary{cursor:pointer;font-weight:700;font-size:.9375rem;color:var(--gp-teal);padding:.75rem 0;min-height:44px;box-sizing:border-box;display:flex;align-items:center;gap:.5rem;list-style:none}
.gp-transcript summary::-webkit-details-marker{display:none}
.gp-transcript summary::before{content:"";flex:0 0 auto;width:.8rem;height:.8rem;background:var(--gp-beak);-webkit-mask:var(--gp-arrow) center/contain no-repeat;mask:var(--gp-arrow) center/contain no-repeat;transform:rotate(90deg);transition:transform .2s}
.gp-transcript:not([open]) summary::before{transform:none}
.gp-transcript p{font-size:.9375rem;padding-bottom:.25rem}
.wp-block-details:not(.gp-transcript) summary{cursor:pointer;font-weight:700;color:var(--gp-ink)}

/* ---------- Lists and sequences ---------- */
.gp-list{list-style:none;padding-left:0!important;border-bottom:1px solid var(--gp-line)}
.gp-list li{background:transparent;border:0;border-top:1px solid var(--gp-line);border-radius:0;padding:1rem 0;margin:0;color:var(--gp-muted);font-size:.9375rem}
.gp-list li a{font-family:var(--gp-serif);font-size:1.1875rem;font-weight:500;line-height:1.35;color:var(--gp-ink);text-decoration:none;margin-right:.35rem}
.gp-list li a:hover{color:var(--gp-teal);text-decoration:underline;text-decoration-color:var(--gp-beak)}
.gp-steps{list-style:none;padding-left:0!important;counter-reset:gp-step;border-bottom:1px solid var(--gp-line)}
.gp-steps li{counter-increment:gp-step;position:relative;background:transparent;border:0;border-top:1px solid var(--gp-line);border-radius:0;padding:1.4rem 0 1.4rem 4rem;margin:0;box-shadow:none;font-size:1.0313rem;line-height:1.6}
.gp-steps li::before{content:counter(gp-step);position:absolute;left:0;top:1.15rem;width:auto;height:auto;border-radius:0;background:none;color:var(--gp-beak);font-family:var(--gp-serif);font-size:2.25rem;font-weight:400;line-height:1;display:block;font-variant-numeric:lining-nums}
.gp-steps li strong{display:block;color:var(--gp-ink);font-family:var(--gp-serif);font-weight:550;font-size:1.25rem;margin-bottom:.3rem}
.gp-timeline{list-style:none;padding-left:0!important;border-left:1px solid var(--gp-line-strong);margin-left:.3rem}
.gp-timeline li{position:relative;padding:0 0 1.4rem 1.6rem;margin:0}
.gp-timeline li::before{content:"";position:absolute;left:-5px;top:.5em;width:9px;height:9px;border-radius:50%;background:var(--gp-teal);box-shadow:0 0 0 3px var(--gp-paper)}
.gp-timeline li strong{color:var(--gp-beak-ink);display:block;font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;margin-bottom:.15rem}
.gp-topics{margin-top:1.5rem!important;margin-bottom:2.25rem!important}
.gp-topic-links{padding-left:1.1rem!important;margin:0}
.gp-topic-links li{margin:.3rem 0}
.gp-about-media{margin-bottom:.4rem!important}
.gp-about-media .wp-block-media-text__content p{margin-top:0}
.gp-about-media+.gp-credit{max-width:var(--gp-content);padding:0}
.gp-jump{box-sizing:border-box;background:var(--gp-mist);border:0;border-radius:var(--gp-radius);padding:.8rem 1.1rem;font-size:.875rem;line-height:1.9}

/* ---------- Journal: latest posts ---------- */
.wp-block-latest-posts.wp-block-latest-posts__list{padding-left:0;border-bottom:1px solid var(--gp-line)}
.wp-block-latest-posts__list li{margin:0!important;padding:1.4rem 0 1.5rem;border-top:1px solid var(--gp-line)}
.wp-block-latest-posts__post-title{display:block;font-family:var(--gp-serif);font-size:clamp(1.25rem,1.15rem + .45vw,1.5rem);font-weight:500;line-height:1.25;letter-spacing:-.01em;color:var(--gp-ink);text-decoration:none;text-wrap:balance}
.wp-block-latest-posts__post-title:hover{color:var(--gp-teal);text-decoration:underline;text-decoration-color:var(--gp-beak)}
.wp-block-latest-posts__post-date{display:block;margin-top:.35rem;font-size:.8125rem;color:var(--gp-muted);font-variant-numeric:tabular-nums}
.wp-block-latest-posts__post-excerpt{margin-top:.6rem;font-size:.9688rem;line-height:1.6;color:var(--gp-text)}
.wp-block-latest-posts__post-excerpt a{font-weight:600}

/* ---------- Continue exploring and About this page (printed by seo-head.php) ---------- */
.gp-continue{max-width:var(--gp-content);margin:clamp(3rem,6vw,4.5rem) auto 0;padding:0;border-radius:0;background:transparent}
.gp-continue__title{font-family:var(--gp-serif);font-weight:500;color:var(--gp-ink);font-size:1.5rem;letter-spacing:-.01em;margin:0 0 1rem!important}
.gp-continue li{margin:0!important}
.gp-continue ul{list-style:none;margin:0;padding:0;align-items:start;display:grid;grid-template-columns:repeat(auto-fit,minmax(12.5rem,1fr));gap:0 1.75rem}
.gp-continue li a{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;height:100%;box-sizing:border-box;background:transparent;border:0;border-top:1px solid var(--gp-ink);border-radius:0;padding:.9rem 0 1.1rem;text-decoration:none;color:var(--gp-ink);font-weight:600;font-size:.9688rem;line-height:1.4}
.gp-continue li a::after{content:"";flex:0 0 auto;width:1.1rem;height:1.1rem;margin-top:.1rem;background:var(--gp-beak);-webkit-mask:var(--gp-arrow) center/contain no-repeat;mask:var(--gp-arrow) center/contain no-repeat;transition:transform .2s cubic-bezier(.2,.7,.2,1)}
.gp-continue li a:hover,.gp-continue li a:focus-visible{color:var(--gp-teal);border-color:var(--gp-beak)}
.gp-continue li a:hover::after{transform:translateX(3px)}
.gp-page-info{max-width:var(--gp-content);margin:clamp(2.5rem,5vw,3.5rem) auto 0;padding:1.25rem 0 0;border:0;border-top:1px solid var(--gp-line);border-radius:0;background:transparent;font-size:.8125rem;color:var(--gp-muted)}
.gp-page-info p{margin:.25rem 0!important;line-height:1.6}
.gp-page-info .gp-page-info__title{font-family:var(--gp-sans);font-weight:700;color:var(--gp-ink);font-size:.8125rem;margin-bottom:.4rem!important}
.gp-page-info a{color:var(--gp-teal)}

/* ---------- Breadcrumbs, fact panels, flow diagrams, learn-more links ---------- */
.gp-breadcrumbs{font-size:.8125rem;line-height:1.5;color:var(--gp-muted);margin-bottom:.25rem!important}
.gp-breadcrumbs ol{list-style:none;margin:0;padding:0;display:flex;flex-wrap:wrap;gap:.15rem .5rem}
.gp-breadcrumbs li{margin:0}
.gp-breadcrumbs li+li::before{content:"/";color:var(--gp-line-strong);margin-right:.5rem}
.gp-breadcrumbs a{color:var(--gp-teal);text-decoration-color:rgba(18,78,90,.3)}
.gp-breadcrumbs [aria-current]{color:var(--gp-muted)}
.gp-factpanel{box-sizing:border-box;max-width:var(--gp-content);background:var(--gp-mist);border:0;border-radius:var(--gp-radius);padding:1.5rem 1.6rem 1.3rem!important;margin:1.75rem auto 2.25rem!important;box-shadow:none}
.gp-factpanel h3{margin:0 0 1rem!important}
.gp-factpanel__source{font-size:.8125rem!important;color:var(--gp-muted);margin-top:1rem!important;margin-bottom:0!important}
.gp-facts{list-style:none;padding:0!important;margin:0!important;display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1.25rem 1.75rem}
.gp-facts li{font-size:.9375rem;line-height:1.55;margin:0;padding:.8rem 0 0;border:0;border-top:1px solid var(--gp-line-strong)}
.gp-facts strong{display:block;font-family:var(--gp-serif);font-weight:500;color:var(--gp-ink);font-size:1.5rem;line-height:1.15;margin-bottom:.2rem;font-variant-numeric:lining-nums}
.gp-flow-wrap{margin-top:1.5rem!important;margin-bottom:2.25rem!important}
.gp-flow{list-style:none;padding:0!important;margin:0!important;display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:1.75rem}
.gp-flow li{position:relative;background:transparent;border:0;border-top:2px solid var(--gp-ink);border-radius:0;padding:1rem 0 0;box-shadow:none;font-size:.9375rem;line-height:1.55;margin:0}
.gp-flow li:not(:last-child)::after{content:"";position:absolute;right:-1.45rem;top:-.6rem;width:1.1rem;height:1.1rem;background:var(--gp-beak);-webkit-mask:var(--gp-arrow) center/contain no-repeat;mask:var(--gp-arrow) center/contain no-repeat;transform:none;left:auto;bottom:auto}
.gp-flow strong{display:block;font-family:var(--gp-serif);font-weight:550;color:var(--gp-ink);font-size:1.125rem;line-height:1.3;margin:.2rem 0 .35rem}
.gp-flow svg{width:1.75rem;height:1.75rem;display:block;margin-bottom:.75rem;padding:0;border-radius:0;background:none;color:var(--gp-teal);box-sizing:border-box}
.gp-flow__caption{font-size:.8125rem!important;color:var(--gp-muted);margin-top:.9rem!important}
.gp-flow__step{display:block;font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--gp-beak-ink)}
.gp-habitats{margin-top:2rem!important;margin-bottom:2.5rem!important}
.gp-learn{list-style:none;padding:0!important;display:grid;grid-template-columns:repeat(auto-fit,minmax(13rem,1fr));gap:0 1.75rem}
.gp-learn li{margin:0}
.gp-learn a{display:block;height:100%;box-sizing:border-box;background:transparent;border:0;border-top:1px solid var(--gp-line-strong);border-radius:0;padding:.85rem 0 1rem;text-decoration:none;color:var(--gp-text);font-size:.9375rem;line-height:1.5}
.gp-learn a strong{display:block;color:var(--gp-ink);font-size:1rem}
.gp-learn a:hover,.gp-learn a:focus-visible{border-color:var(--gp-beak)}
.gp-learn a:hover strong{color:var(--gp-teal)}

/* ---------- Social links: one quiet style, no platform colours ---------- */
.gp-connect .gp-social{margin-top:1.5rem!important;margin-bottom:1.25rem!important}
.gp-follow{margin-bottom:.4rem!important}
.gp-social{gap:.6rem!important}
.gp-social .wp-social-link{background:transparent!important;color:var(--gp-teal)!important;border:1px solid var(--gp-line-strong);border-radius:6px!important;transition:border-color .15s,background-color .15s}
.gp-social .wp-social-link a{color:inherit!important;padding:.55em 1em!important;min-height:44px;box-sizing:border-box;gap:.5em;text-decoration:none}
.gp-social .wp-social-link-label{font-size:.875rem!important;font-weight:600;padding-inline-start:0!important}
.gp-social .wp-social-link svg{fill:currentColor;width:1.1rem;height:1.1rem}
.gp-social .wp-social-link:hover{border-color:var(--gp-teal);background:var(--gp-paper)!important;transform:none}

/* ---------- Footer ---------- */
footer.wp-block-template-part{margin-top:0!important}
footer.wp-block-template-part>.has-background{background-color:var(--gp-ink)!important;color:var(--gp-on-dark)!important;padding:clamp(3.5rem,7vw,5.5rem) var(--gp-pad) 2rem!important;font-size:.9375rem}
footer.wp-block-template-part .wp-block-columns{max-width:var(--gp-wide);margin-left:auto;margin-right:auto;gap:clamp(2rem,5vw,4.5rem)}
footer.wp-block-template-part .wp-block-columns>.wp-block-column:first-child{flex-basis:44%!important;flex-grow:0}
footer.wp-block-template-part p,footer.wp-block-template-part li{color:var(--gp-on-dark)}
footer.wp-block-template-part a{color:#fff;text-decoration-color:rgba(255,255,255,.35)}
footer.wp-block-template-part a:hover{color:#fff;text-decoration-color:var(--gp-beak)}
footer.wp-block-template-part .wp-block-column:first-child>p:first-child{font-family:var(--gp-serif);font-size:1.375rem!important;font-weight:600!important;letter-spacing:.08em!important;line-height:1.1;margin-bottom:1.1rem}
footer.wp-block-template-part .wp-block-column:first-child>p:first-child a{text-decoration:none;color:#fff}
footer.wp-block-template-part h2{font-family:var(--gp-sans);font-size:.75rem!important;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--gp-on-dark-muted)!important;margin-bottom:1rem}
footer.wp-block-template-part .wp-block-navigation{font-size:.9375rem}
footer.wp-block-template-part .wp-block-navigation a{text-decoration:none;color:#fff}
footer.wp-block-template-part .wp-block-navigation a:hover{text-decoration:underline;text-decoration-color:var(--gp-beak);text-underline-offset:.3em}
footer.wp-block-template-part .wp-block-navigation__container{gap:.55rem!important}
footer.wp-block-template-part .gp-footer-langs,footer.wp-block-template-part .gp-footer-social{margin-top:1.5rem;font-size:.875rem;line-height:1.9}
footer.wp-block-template-part .gp-footer-social{margin-top:1rem}
footer.wp-block-template-part .gp-footer-langs a,footer.wp-block-template-part .gp-footer-social a{color:#fff;text-decoration:underline;text-decoration-color:rgba(255,255,255,.35);text-underline-offset:.2em}
footer.wp-block-template-part .gp-footer-langs [aria-current]{font-weight:700}
.gp-footer-langs__label{display:block;font-family:var(--gp-sans);font-size:.75rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--gp-on-dark-muted);margin-bottom:.2rem}
footer.wp-block-template-part hr.wp-block-separator{max-width:var(--gp-wide);margin:clamp(2.5rem,5vw,3.5rem) auto 1.25rem!important;border-top:1px solid rgba(255,255,255,.16)!important;background:none!important;color:transparent!important;height:0}
footer.wp-block-template-part>.has-background>p:last-child{max-width:var(--gp-wide);margin-left:auto;margin-right:auto;font-size:.8125rem!important;line-height:1.6;color:var(--gp-on-dark-muted)}

/* =====================================================================
   SIGNATURE LAYER: the field guide, the tide line, the cinematic cover
   ===================================================================== */
:root{--gp-header-h:73px}
body{--gp-ease:cubic-bezier(.16,1,.3,1)}
@media (prefers-reduced-motion:no-preference){html{scroll-behavior:smooth}}

/* Sticky header with a tide gauge (reading progress) on article pages */
header.wp-block-template-part{position:sticky;top:var(--wp-admin--admin-bar--height,0px);z-index:50;transition:box-shadow .25s}
header.wp-block-template-part.is-stuck{box-shadow:0 10px 30px -22px rgba(14,57,64,.45)}
@supports (animation-timeline:scroll()){
	body:not(.page-template-page-no-title) header.wp-block-template-part::after{content:"";position:absolute;left:0;right:0;bottom:-1px;height:2px;background:var(--gp-beak);transform-origin:0 50%;transform:scaleX(0);animation:gp-gauge linear both;animation-timeline:scroll(root)}
}
@keyframes gp-gauge{to{transform:scaleX(1)}}
/* top-level navigation: an underline that draws from the left */
header.wp-block-template-part .wp-block-navigation__container>.wp-block-navigation-item>.wp-block-navigation-item__content{position:relative;text-decoration:none!important}
header.wp-block-template-part .wp-block-navigation__container>.wp-block-navigation-item>.wp-block-navigation-item__content::after{content:"";position:absolute;left:0;right:0;bottom:.2rem;height:2px;background:var(--gp-beak);transform:scaleX(0);transform-origin:0 50%;transition:transform .35s var(--gp-ease)}
header.wp-block-template-part .wp-block-navigation__container>.wp-block-navigation-item>.wp-block-navigation-item__content:hover::after,header.wp-block-template-part .wp-block-navigation__container>.wp-block-navigation-item>.wp-block-navigation-item__content[aria-current="page"]::after{transform:scaleX(1)}
header .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation-item__content::after{display:none}

/* ---------- Cover: the hero as a magazine cover ---------- */
.gp-hero{min-height:min(92vh,860px)!important;overflow:hidden}
.gp-hero .wp-block-cover__inner-container{position:relative;z-index:2}
.gp-hero::after{content:"";position:absolute;left:0;bottom:0;z-index:1;width:calc(100% + 800px);height:120px;pointer-events:none;background:#fff;-webkit-mask:var(--gp-tideline) 0 100%/800px 120px repeat-x;mask:var(--gp-tideline) 0 100%/800px 120px repeat-x;opacity:.42}
.gp-hero .gp-kicker{display:flex;align-items:center;gap:.9rem}
.gp-hero .gp-kicker::before{content:"";flex:0 0 2.5rem;height:1px;background:currentColor;opacity:.7}
@media (prefers-reduced-motion:no-preference){
	.gp-hero::after{animation:gp-drift 4.5s var(--gp-ease) both}
	.gp-hero .wp-block-cover__image-background{animation:gp-settle 2.4s var(--gp-ease) both}
	.gp-hero .wp-block-cover__inner-container>*{animation:gp-rise 1.1s var(--gp-ease) both}
	.gp-hero .wp-block-cover__inner-container>h1{animation-name:gp-rise-solid}
	.gp-hero .wp-block-cover__inner-container>:nth-child(2){animation-delay:.08s}
	.gp-hero .wp-block-cover__inner-container>:nth-child(3){animation-delay:.2s}
	.gp-hero .wp-block-cover__inner-container>:nth-child(4){animation-delay:.3s}
	.gp-hero .wp-block-cover__inner-container>:nth-child(5){animation-delay:.4s}
}
@keyframes gp-drift{from{transform:translateX(-160px);opacity:0}}
@keyframes gp-settle{from{transform:translateX(12%) scale(1.32)}}
@keyframes gp-settle-m{from{transform:scale(1.08)}}
@media (max-width:781px) and (prefers-reduced-motion:no-preference){.gp-hero .wp-block-cover__image-background{animation-name:gp-settle-m}}
@keyframes gp-rise{from{opacity:0;transform:translateY(18px)}}
@keyframes gp-rise-solid{from{transform:translateY(22px)}}
/* the photo credit becomes the cover's caption */
@media (min-width:782px){
	.gp-hero+.gp-credit{position:relative;z-index:3;margin-top:-2.6rem!important;margin-bottom:1.4rem!important;text-align:right;color:rgba(255,255,255,.78)!important;pointer-events:auto}
	.gp-hero+.gp-credit a{color:#fff;text-decoration-color:rgba(255,255,255,.4)}
}

/* ---------- Dark "chart" bands: video, closing banner, footer ---------- */
.gp-section:has(>.gp-video-split),footer.wp-block-template-part>.has-background{position:relative;isolation:isolate}
.gp-section:has(>.gp-video-split){background:var(--gp-ink)!important;color:var(--gp-on-dark);padding-top:clamp(3rem,6vw,5rem)!important;padding-bottom:clamp(3rem,6vw,5rem)!important}
.gp-section:has(>.gp-video-split) h2.wp-block-heading{font-size:clamp(2.25rem,1.5rem + 3.2vw,4.25rem);line-height:1;letter-spacing:-.024em}
.gp-section:has(>.gp-video-split)::before,footer.wp-block-template-part>.has-background::before{content:"";position:absolute;inset:0;z-index:-1;pointer-events:none;background:#fff;-webkit-mask:var(--gp-chart) center/cover no-repeat;mask:var(--gp-chart) center/cover no-repeat;opacity:.15}
footer.wp-block-template-part>.has-background::before{opacity:.08}
.gp-section:has(>.gp-video-split) :is(h2,h3){color:#fff}
.gp-section:has(>.gp-video-split) .gp-kicker{color:#F0C9B6!important}
.gp-section:has(>.gp-video-split) p{color:var(--gp-on-dark)}
.gp-section:has(>.gp-video-split) .gp-lead,.gp-section:has(>.gp-video-split) .wp-block-column:first-child p:not(.gp-kicker){font-size:clamp(1.0625rem,1rem + .35vw,1.25rem)}
.gp-section:has(>.gp-video-split) a{color:#fff;text-decoration-color:rgba(255,255,255,.4)}
.gp-section:has(>.gp-video-split) a:hover{text-decoration-color:var(--gp-beak)}
.gp-section:has(>.gp-video-split) figcaption{color:var(--gp-on-dark-muted)}
.gp-section:has(>.gp-video-split) video{box-shadow:0 30px 60px -30px rgba(0,0,0,.6)}
.gp-section:has(>.gp-video-split) :focus-visible{outline-color:#fff}
.gp-banner .wp-block-cover__inner-container{position:relative;z-index:2}
.gp-banner::after{content:"";position:absolute;inset:0;z-index:1;pointer-events:none;background:#fff;-webkit-mask:var(--gp-chart) center/cover no-repeat;mask:var(--gp-chart) center/cover no-repeat;opacity:.14}
.gp-banner h2{font-size:clamp(2rem,1.3rem + 3vw,3.75rem)!important;line-height:1.02;letter-spacing:-.022em}

/* ---------- Homepage rhythm ---------- */
/* opening statement: the first paragraph after "What is Grohnpetrel?" reads as a lede */
.gp-section:has(>.gp-media):has(>.wp-block-table) .wp-block-media-text__content>h2+p{font-size:clamp(1.125rem,1.02rem + .45vw,1.375rem);line-height:1.55;color:var(--gp-ink)}
/* goals: oversized numerals between vertical hairlines */
.gp-grid:has(.gp-num) .gp-card{border-top:0;border-left:1px solid var(--gp-line-strong);padding:0 0 0 clamp(1.25rem,2.5vw,2rem)!important}
.gp-grid:has(.gp-num) .gp-num{font-size:clamp(3.25rem,2.4rem + 3vw,5.25rem)!important;font-weight:300;letter-spacing:-.03em;margin-bottom:1rem!important}
/* the challenge as a statement band on chart paper */
.gp-cgc-promo{background:var(--gp-ink)!important;color:var(--gp-on-dark);position:relative;isolation:isolate}
.gp-cgc-promo::before{content:"";position:absolute;inset:0;z-index:-1;pointer-events:none;background:#fff;-webkit-mask:var(--gp-chart) center/cover no-repeat;mask:var(--gp-chart) center/cover no-repeat;opacity:.15}
.gp-cgc-promo h2.wp-block-heading{color:#fff}
.gp-cgc-promo .gp-kicker{color:#F0C9B6!important}
.gp-cgc-promo p:not(.gp-kicker){color:var(--gp-on-dark)}
.gp-cgc-promo .wp-block-button__link{min-height:52px;padding-inline:1.75rem;font-size:1rem}
.gp-cgc-promo :focus-visible{outline-color:#fff}
.gp-cgc-promo h2.wp-block-heading{font-size:clamp(2.25rem,1.4rem + 3.6vw,4.25rem);line-height:1;letter-spacing:-.025em}
.gp-cgc-promo p:not(.gp-kicker){font-size:clamp(1.0625rem,1rem + .35vw,1.25rem);max-width:36rem;margin-inline:auto}
.gp-cgc-promo .wp-block-buttons{margin-top:2rem!important}
/* region: the aerial photograph stands as a tall plate (its source is 673 px wide, so it is never upscaled past that) */
@media (min-width:782px){
	.gp-region .gp-media .wp-block-media-text__media{align-self:stretch}
	.gp-region .gp-media .wp-block-media-text__media img{height:100%;min-height:clamp(22rem,36vw,30rem);object-fit:cover}
}
/* contents page: numbered entries */
.gp-discover{counter-reset:gp-d;grid-template-columns:repeat(2,minmax(0,1fr))!important;gap:0 clamp(2rem,5vw,4.5rem)!important}
.gp-discover .gp-card{counter-increment:gp-d;position:relative;padding:1.4rem 0 1.6rem 4.25rem!important}
.gp-discover .gp-card::after{content:counter(gp-d,decimal-leading-zero);position:absolute;top:1.15rem;left:0;font-family:var(--gp-serif);font-size:2.25rem;font-weight:300;line-height:1;color:var(--gp-beak);font-variant-numeric:lining-nums}
.gp-discover .gp-card .wp-block-buttons{padding-top:.25rem}
/* quick answers: a reference list, question left, answer right */
.gp-section>.gp-grid:not(.gp-grid-4):not(:has(.gp-num)){grid-template-columns:1fr!important;gap:0!important}
.gp-section>.gp-grid:not(.gp-grid-4):not(:has(.gp-num))>.gp-card{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1.6fr);grid-auto-rows:min-content;gap:0 clamp(2rem,5vw,4.5rem);padding:1.5rem 0!important;height:auto}
.gp-section>.gp-grid:not(.gp-grid-4):not(:has(.gp-num))>.gp-card>*+*:not(h3){margin-top:.6rem!important}
.gp-section>.gp-grid:not(.gp-grid-4):not(:has(.gp-num))>.gp-card>*{margin-top:0!important;grid-column:2}
.gp-section>.gp-grid:not(.gp-grid-4):not(:has(.gp-num))>.gp-card>h3{grid-column:1;grid-row:1/span 9}
.gp-section>.gp-grid:not(.gp-grid-4):not(:has(.gp-num))>.gp-card:last-child{border-bottom:1px solid var(--gp-line-strong)}

/* ---------- Specimen index: the six-species tables ---------- */
:is(table.gp-specimen,table:has(a[href*="northern-gannet"]),table:has(a[href*="basstoelpel"])) tbody{counter-reset:gp-sp}
:is(table.gp-specimen,table:has(a[href*="northern-gannet"]),table:has(a[href*="basstoelpel"])) tbody tr{counter-increment:gp-sp;transition:background-color .2s}
:is(table.gp-specimen,table:has(a[href*="northern-gannet"]),table:has(a[href*="basstoelpel"])) tbody tr:hover{background:rgba(255,255,255,.55)}
:is(table.gp-specimen,table:has(a[href*="northern-gannet"]),table:has(a[href*="basstoelpel"])) tbody td:first-child{white-space:nowrap}
/* five-column guide table: names may wrap so the notes column keeps a readable width */
table:has(tr>:nth-child(5)) tbody td:first-child{white-space:normal}
table:has(tr>:nth-child(5)) tbody td:first-child a{font-size:1.0625rem}
table:has(tr>:nth-child(5)) .gp-scale{min-width:6.5rem}
table:has(tr>:nth-child(5)) td:last-child{min-width:10rem}
:is(table.gp-specimen,table:has(a[href*="northern-gannet"]),table:has(a[href*="basstoelpel"])) tbody td:first-child{position:relative;padding-left:2.2rem}
:is(table.gp-specimen,table:has(a[href*="northern-gannet"]),table:has(a[href*="basstoelpel"])) tbody td:first-child::before{content:counter(gp-sp,decimal-leading-zero);position:absolute;left:0;top:.95em;display:block;font-family:var(--gp-serif);font-size:.875rem;font-weight:400;color:var(--gp-beak-ink);font-variant-numeric:lining-nums}
:is(table.gp-specimen,table:has(a[href*="northern-gannet"]),table:has(a[href*="basstoelpel"])) tbody td:first-child a{font-family:var(--gp-serif);font-size:1.1875rem;font-weight:500;color:var(--gp-ink);text-decoration:none}
:is(table.gp-specimen,table:has(a[href*="northern-gannet"]),table:has(a[href*="basstoelpel"])) tbody td:first-child a:hover{color:var(--gp-teal);text-decoration:underline;text-decoration-color:var(--gp-beak)}
:is(table.gp-specimen,table:has(a[href*="northern-gannet"]),table:has(a[href*="basstoelpel"])) td:nth-child(2){font-style:italic}
@media (min-width:1100px){
	.wp-block-table:has(table.gp-specimen){overflow:visible}
	table.gp-specimen tbody td:first-child{padding-left:0}
	table.gp-specimen tbody td:first-child::before{left:-2.6rem}
}

/* ---------- Specimen labels: two-column fact tables ---------- */
.wp-block-table:not(:has(tr>:nth-child(3))) table{border-collapse:separate;border-spacing:0;border:1px solid var(--gp-ink);border-top-width:2px}
.wp-block-table:not(:has(tr>:nth-child(3))) :is(td,th){padding:.8em 1.2em}
.wp-block-table:not(:has(tr>:nth-child(3))) td:first-child{width:32%;font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--gp-muted);vertical-align:top;padding-top:1.05em}
.wp-block-table:not(:has(tr>:nth-child(3))) tr:last-child td{border-bottom:0}

/* ---------- Field-guide plates (Seabirds of the North Sea) ---------- */
.gp-species-grid{counter-reset:gp-plate}
.gp-species{counter-increment:gp-plate;scroll-margin-top:calc(var(--gp-header-h) + 5rem)}
.gp-species>.wp-block-image{position:relative;overflow:hidden}
.gp-species .wp-block-image figcaption{font-size:.75rem!important;position:relative;padding-left:3.1rem;min-height:2.4em}
.gp-species .wp-block-image figcaption::before{content:counter(gp-plate,decimal-leading-zero);position:absolute;left:0;top:0;width:2.2rem;padding-right:.6rem;border-right:1px solid var(--gp-line-strong);font-family:var(--gp-serif);font-size:1.25rem;font-weight:400;line-height:1;color:var(--gp-beak-ink);font-variant-numeric:lining-nums}
.gp-species .wp-block-image img{transition:transform 1.2s var(--gp-ease)}
@media (hover:hover){.gp-species:hover .wp-block-image img{transform:scale(1.035)}}
/* species index bar (built by the script below from the plate headings) */
.gp-species-index{position:sticky;top:calc(var(--wp-admin--admin-bar--height,0px) + var(--gp-header-h));z-index:30;margin:1.5rem auto 2rem!important;max-width:var(--gp-wide)!important;background:rgba(255,255,255,.96);border-top:1px solid var(--gp-ink);border-bottom:1px solid var(--gp-line)}
.gp-species-index ol{list-style:none;margin:0;padding:0;display:flex;gap:0;overflow-x:auto;scroll-snap-type:x proximity;scrollbar-width:none}
.gp-species-index ol::-webkit-scrollbar{display:none}
@media (max-width:1100px){.gp-species-index ol{-webkit-mask-image:linear-gradient(90deg,#000 82%,transparent);mask-image:linear-gradient(90deg,#000 82%,transparent);padding-right:2rem}}
.gp-species-index li{flex:1 0 auto;margin:0;scroll-snap-align:start}
.gp-species-index a{display:flex;align-items:baseline;gap:.5rem;min-height:44px;box-sizing:border-box;padding:.75rem 1rem .7rem 0;margin-right:1rem;white-space:nowrap;font-size:.875rem;font-weight:600;color:var(--gp-text);text-decoration:none;border-bottom:2px solid transparent;transition:color .2s,border-color .2s}
.gp-species-index a span{font-family:var(--gp-serif);font-weight:400;color:var(--gp-beak-ink);font-variant-numeric:lining-nums}
.gp-species-index a:hover,.gp-species-index a.is-current{color:var(--gp-ink);border-bottom-color:var(--gp-beak)}
/* length scale drawn beside each "87–100 cm" (built by the script from the table) */
.gp-scale{display:block;position:relative;height:9px;margin-top:.5rem;min-width:9rem;background:linear-gradient(90deg,var(--gp-line-strong) 1px,transparent 1px) 0 0/calc(100% / var(--gp-ticks,10)) 100% repeat-x;border-bottom:1px solid var(--gp-line-strong)}
.gp-scale>span{position:absolute;top:1px;bottom:1px;background:var(--gp-beak);border-radius:1px}
/* conservation status: species of concern get a mark (class added by the script, text unchanged) */
.gp-status{white-space:nowrap}
.gp-status--concern{font-weight:700;color:var(--gp-beak-ink)}
.gp-status--concern::before{content:"";display:inline-block;width:.5em;height:.5em;margin-right:.45em;border-radius:50%;background:var(--gp-beak);vertical-align:.08em}
.gp-scale>span::before,.gp-scale>span::after{content:"";position:absolute;top:-2px;bottom:-2px;width:1px;background:var(--gp-ink)}
.gp-scale>span::before{left:0}.gp-scale>span::after{right:0}

/* ---------- Editorial articles ---------- */
/* lead photographs widen past the text column like a magazine spread */
.wp-block-post-content>figure.wp-block-image:not(.is-resized):not(.alignleft):not(.alignright):not(.size-medium):not(.size-thumbnail){max-width:min(100%,62rem)}
.wp-block-post-content>figure.wp-block-image:not(.is-resized) figcaption{max-width:var(--gp-content);margin-inline:auto}
/* photo reveal on scroll: images start visible; the script only arms ones below the fold */
.gp-reveal{clip-path:inset(0 0 100% 0);transform:translateY(24px)}
.gp-reveal.is-in,.gp-species .wp-block-image img.gp-reveal.is-in{clip-path:inset(0 0 0 0);transform:none;transition:clip-path 1.2s var(--gp-ease),transform 1.2s var(--gp-ease)}
@media print{.gp-reveal{clip-path:none!important;transform:none!important}}

/* ---------- Languages without Latin glyphs in Platypi ---------- */
:lang(ru) :is(h1,h2,h3,h4,.wp-block-post-title,.wp-block-heading,.gp-num,.gp-continue__title){font-family:Georgia,"Times New Roman",serif;font-weight:400;letter-spacing:-.015em}
:lang(zh) body,:lang(zh) :is(h1,h2,h3,h4,.wp-block-heading,.wp-block-post-title,.gp-continue__title){font-family:"PingFang SC","Hiragino Sans GB","Noto Sans SC","Microsoft YaHei",sans-serif;letter-spacing:0}
:lang(zh) :is(h1,h2,h3,.wp-block-heading){font-weight:600}
:lang(zh) .gp-kicker{letter-spacing:.05em}
:lang(zh) :is(.grohnpetrel-lang,.gp-footer-langs) a:not(:lang(zh)){font-family:var(--gp-sans)}

/* ---------- Responsive ---------- */
@media (min-width:600px) and (max-width:1100px){
	/* tablets: the full menu stays on one line (the theme only collapses it below 600px) */
	header.wp-block-template-part .wp-block-navigation{font-size:.875rem;gap:.25rem .95rem}
	header .wp-block-site-title{font-size:1.2rem}
	header .wp-block-site-logo img{width:34px;height:34px}
}
@media (min-width:600px) and (max-width:959px){
	/* tablets: the full menu cannot fit beside the wordmark (English or German), so use the theme's overlay menu */
	header .wp-block-navigation__responsive-container-open:not(.always-shown){display:flex!important}
	header .wp-block-navigation__responsive-container:not(.hidden-by-default):not(.is-menu-open){display:none!important}
	header .wp-block-navigation__responsive-container.is-menu-open{display:flex!important;position:fixed;inset:0;z-index:100000;overflow:auto}
	header .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__responsive-container-close{display:flex!important}
	header .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__container{flex-direction:column}
	header .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__submenu-container{position:static;opacity:1;visibility:visible;height:auto;width:auto}
	header .wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__submenu-icon{display:none}
}
@media (max-width:1000px){
	.gp-grid{grid-template-columns:repeat(2,minmax(0,1fr))!important}
	.gp-flow{grid-template-columns:repeat(2,minmax(0,1fr));gap:1.75rem 2.25rem}
	.gp-flow li:nth-child(2n)::after{display:none}
}
@media (max-width:781px){
	.gp-grid-4{grid-template-columns:repeat(2,minmax(0,1fr))!important}
	/* the mascot follows the text at a modest size instead of filling the first screen */
	.gp-media:has(img[src*="grohnpetrel-mascot"]) .wp-block-media-text__media{grid-row:2!important;max-width:9rem;margin-top:1.75rem}
	.gp-media:has(img[src*="grohnpetrel-mascot"]) .wp-block-media-text__content{grid-row:1!important;padding-top:0!important}
	/* phones: the gannet shows above the type, then the photograph darkens beneath the copy */
	.gp-hero{padding-top:min(70vw,19rem)!important;background:var(--gp-ink)}
	.gp-hero .wp-block-cover__image-background{transform:none;top:0;bottom:auto;height:min(86vw,24rem);object-position:74% 50%}
	.gp-hero .wp-block-cover__background{background:linear-gradient(180deg,rgba(14,57,64,.08) 0,rgba(14,57,64,.35) min(46vw,13rem),rgba(14,57,64,1) min(86vw,24rem))!important}
	.gp-video-split .gp-video{margin-left:0!important;margin-right:auto!important}
	.gp-banner .wp-block-cover__background{background:linear-gradient(180deg,rgba(14,57,64,.7) 0%,rgba(14,57,64,.92) 55%,rgba(14,57,64,.96) 100%)!important}
	.gp-hero{min-height:0!important}
	.gp-media .wp-block-media-text__content,.gp-media.has-media-on-the-right .wp-block-media-text__content{padding:1.75rem 0 0!important}
	footer.wp-block-template-part .wp-block-columns>.wp-block-column:first-child{flex-basis:100%!important}
}
@media (max-width:600px){
	.gp-section>.gp-grid:not(.gp-grid-4):not(:has(.gp-num))>.gp-card{grid-template-columns:1fr}
	.gp-section>.gp-grid:not(.gp-grid-4):not(:has(.gp-num))>.gp-card>*{grid-column:1!important;grid-row:auto!important}
	/* wide tables become labelled stacks (labels come from the column headers) */
	.wp-block-table table.gp-stack{border-top-width:2px}
	.gp-stack thead{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap}
	.gp-stack tbody,.gp-stack tr,.gp-stack td{display:block}
	.gp-stack tr{padding:.9rem 0 1rem;border-bottom:1px solid var(--gp-line)}
	.gp-stack td{border:0!important;padding:.2rem 0!important;white-space:normal!important}
	.gp-stack td:first-child{padding-bottom:.4rem!important;font-size:1rem}
	.gp-stack td+td::before{content:attr(data-label);display:block;font-family:var(--gp-sans);font-style:normal;font-size:.6875rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--gp-muted);margin-top:.35rem}
	.gp-stack .gp-scale{max-width:12rem}
	/* specimen stacks keep the numeral in its own gutter */
	.gp-stack.gp-specimen td{padding-left:2.2rem!important}
	.gp-stack.gp-specimen td:first-child::before{top:.3rem}
	/* on stacks the cell label owns ::before; the status keeps its colour and weight */
	.gp-stack td.gp-status::before{display:block;width:auto;height:auto;margin:.35rem 0 0;border-radius:0;background:none;vertical-align:baseline}
	/* three-column specimen index: name, then Latin and note in one quiet line each, no labels */
	table.gp-stack:not(:has(tr>:nth-child(4))) td+td::before{display:none}
	table.gp-stack:not(:has(tr>:nth-child(4))) tr{padding:.7rem 0 .8rem}
	table.gp-stack:not(:has(tr>:nth-child(4))) td:nth-child(n+2){padding-left:2.1rem!important;font-size:.875rem;color:var(--gp-muted)}
	.gp-grid,.gp-grid-4{grid-template-columns:1fr!important}
	.gp-flow{grid-template-columns:1fr;gap:1.5rem}
	.gp-flow li::after{display:none!important}
	.gp-facts{grid-template-columns:1fr}
	.gp-steps li{padding-left:3rem}
	.gp-steps li::before{font-size:1.875rem}
	.wp-block-table table{font-size:.875rem}
	.wp-block-table th,.wp-block-table td{padding:.6em .8em .6em 0;hyphens:manual}
	/* two-column fact tables: field name above its value */
	.wp-block-table:not(:has(tr>:nth-child(3))) :is(tbody,tr,td){display:block}
	.wp-block-table:not(:has(tr>:nth-child(3))) tr{padding:.75rem 1rem;border-bottom:1px solid var(--gp-line)}
	.wp-block-table:not(:has(tr>:nth-child(3))) tr:last-child{border-bottom:0}
	.wp-block-table:not(:has(tr>:nth-child(3))) td{width:auto!important;border:0!important;padding:0!important}
	.wp-block-table:not(:has(tr>:nth-child(3))) td:first-child{margin-bottom:.15rem}
	.gp-hero .wp-block-buttons,.gp-banner .wp-block-buttons{flex-direction:column;align-items:stretch}
	.gp-hero .wp-block-button,.gp-banner .wp-block-button{width:100%}
	.gp-hero .wp-block-button__link,.gp-banner .wp-block-button__link{width:100%}
	h1,h2,.wp-block-post-title{hyphens:auto;overflow-wrap:break-word}
	.grohnpetrel-lang{text-align:left}
}
@media (prefers-reduced-motion:reduce){
	body *,body *::before,body *::after{transition:none!important;animation:none!important;scroll-behavior:auto!important}
}
</style>
	<?php
	$css = ob_get_clean();
	$css = preg_replace( '#/\*.*?\*/#s', '', $css );
	echo preg_replace( '/\s*\n\s*/', '', $css ) . "\n";
}, 20 );


/**
 * Progressive enhancement only: every page is complete without this script.
 * It adds the sticky-header state, the species index on the seabird guide,
 * length scales next to existing "87–100 cm" values, and photo reveals.
 */
add_action( 'wp_footer', function () {
	?>
<script id="grohnpetrel-enhance">
(function () {
	var d = document, root = d.documentElement;
	var calm = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;

	/* Header: expose its height for sticky offsets, mark it once the page scrolls */
	var header = d.querySelector('header.wp-block-template-part');
	if (header) {
		var size = function () { root.style.setProperty('--gp-header-h', header.offsetHeight + 'px'); };
		size(); addEventListener('resize', size, { passive: true });
		var busy = false;
		addEventListener('scroll', function () {
			if (busy) { return; } busy = true;
			requestAnimationFrame(function () { header.classList.toggle('is-stuck', scrollY > 8); busy = false; });
		}, { passive: true });
	}

	/* Seabird guide: an index of the plates, built from their own headings */
	var grid = d.querySelector('.gp-species-grid');
	if (grid && grid.querySelectorAll('.gp-species').length >= 5) { /* species guides only, not the three habitat cards */
		var plates = grid.querySelectorAll('.gp-species');
		var heading = grid.previousElementSibling;
		while (heading && !/^H[23]$/.test(heading.tagName)) { heading = heading.previousElementSibling; }
		var nav = d.createElement('nav'), list = d.createElement('ol'), links = [];
		nav.className = 'gp-species-index';
		if (heading) { heading.id = heading.id || 'gp-species-profiles'; nav.setAttribute('aria-labelledby', heading.id); }
		Array.prototype.forEach.call(plates, function (plate, i) {
			var h = plate.querySelector('h3'); if (!h) { return; }
			plate.id = plate.id || 'gp-plate-' + (i + 1);
			var li = d.createElement('li'), a = d.createElement('a'), n = d.createElement('span');
			a.href = '#' + plate.id; n.setAttribute('aria-hidden', 'true'); n.textContent = (i < 9 ? '0' : '') + (i + 1);
			a.appendChild(n); a.appendChild(d.createTextNode(h.textContent.trim()));
			li.appendChild(a); list.appendChild(li); links.push([plate, a]);
		});
		if (links.length) {
			nav.appendChild(list); grid.parentNode.insertBefore(nav, grid);
			/* mark every plate of the row being read (plates sit three to a row on wide screens) */
			var mark = function () {
				var line = innerHeight * 0.4, row = null;
				links.forEach(function (l) { var t = l[0].getBoundingClientRect().top; if (t <= line && (row === null || t > row)) { row = t; } });
				var first = true;
				links.forEach(function (l) {
					var r = l[0].getBoundingClientRect(), on = row !== null && Math.abs(r.top - row) < 2 && r.bottom > line;
					l[1].classList.toggle('is-current', on);
					if (on && first) { l[1].setAttribute('aria-current', 'location'); first = false; } else { l[1].removeAttribute('aria-current'); }
				});
			};
			var queued = false;
			addEventListener('scroll', function () { if (queued) { return; } queued = true; requestAnimationFrame(function () { mark(); queued = false; }); }, { passive: true });
			mark();
		}
	}

	/* Length scales: draw each "min–max cm" range on a shared 0–max ruler */
	var re = /(\d+(?:[.,]\d+)?)\s*[–-]\s*(\d+(?:[.,]\d+)?)\s*cm/;
	Array.prototype.forEach.call(d.querySelectorAll('.wp-block-table table'), function (t) {
		var rows = t.querySelectorAll('tbody tr'); if (rows.length < 4) { return; }
		var cols = rows[0].children.length;
		for (var c = 0; c < cols; c++) {
			var cells = [], ok = true, max = 0;
			for (var r = 0; r < rows.length; r++) {
				var cell = rows[r].children[c], m = cell && cell.textContent.match(re);
				if (!m) { ok = false; break; }
				var lo = parseFloat(m[1].replace(',', '.')), hi = parseFloat(m[2].replace(',', '.'));
				cells.push([cell, lo, hi]); if (hi > max) { max = hi; }
			}
			if (!ok || !max) { continue; }
			var ruler = Math.ceil(max / 10) * 10;
			cells.forEach(function (x) {
				var s = d.createElement('span'), b = d.createElement('span');
				s.className = 'gp-scale'; s.setAttribute('aria-hidden', 'true'); s.style.setProperty('--gp-ticks', ruler / 10);
				b.style.left = (x[1] / ruler * 100) + '%'; b.style.width = Math.max((x[2] - x[1]) / ruler * 100, 1.5) + '%';
				s.appendChild(b); x[0].appendChild(s);
			});
		}
	});

	/* Specimen tables: a first column linking to five or more pages is an index of species */
	Array.prototype.forEach.call(d.querySelectorAll('.wp-block-table table'), function (t) {
		var firsts = t.querySelectorAll('tbody tr > td:first-child a[href]');
		if (firsts.length >= 5 && firsts.length === t.querySelectorAll('tbody tr').length) { t.classList.add('gp-specimen'); }
		/* conservation status cells: mark the species of concern (wording untouched) */
		Array.prototype.forEach.call(t.querySelectorAll('td'), function (c) {
			var v = c.textContent.trim();
			if (/^(Vulnerable|Near Threatened|Endangered|Critically Endangered|Gefährdet|Potenziell gefährdet|Stark gefährdet|Vorwarnliste)$/i.test(v)) { c.classList.add('gp-status', 'gp-status--concern'); }
			else if (/^(Least Concern|Nicht gefährdet)$/i.test(v)) { c.classList.add('gp-status'); }
		});
		/* two-column fact tables stack on phones: keep their table semantics explicit */
		if (!t.querySelector('thead') && t.querySelector('tr') && t.querySelector('tr').children.length === 2) {
			t.setAttribute('role', 'table');
			Array.prototype.forEach.call(t.querySelectorAll('tbody'), function (g) { g.setAttribute('role', 'rowgroup'); });
			Array.prototype.forEach.call(t.querySelectorAll('tr'), function (r) {
				r.setAttribute('role', 'row');
				r.children[0].setAttribute('role', 'rowheader'); r.children[1].setAttribute('role', 'cell');
			});
		}
	});

	/* Wide tables: give each cell its column name so phones can show rows as labelled stacks */
	Array.prototype.forEach.call(d.querySelectorAll('.wp-block-table table'), function (t) {
		var heads = t.querySelectorAll('thead th'); if (heads.length < 3) { return; }
		var names = Array.prototype.map.call(heads, function (h) { return h.textContent.trim(); });
		t.classList.add('gp-stack'); t.setAttribute('role', 'table');
		Array.prototype.forEach.call(t.querySelectorAll('thead, tbody'), function (g) { g.setAttribute('role', 'rowgroup'); });
		Array.prototype.forEach.call(t.querySelectorAll('tr'), function (r) {
			r.setAttribute('role', 'row');
			Array.prototype.forEach.call(r.children, function (c, i) {
				c.setAttribute('role', c.tagName === 'TH' ? 'columnheader' : 'cell');
				if (c.tagName === 'TD' && names[i]) { c.setAttribute('data-label', names[i]); }
			});
		});
	});

	/* Photo reveals: only images still below the fold are armed, so nothing visible ever disappears */
	if (!calm && 'IntersectionObserver' in window) {
		var imgs = d.querySelectorAll('.gp-media .wp-block-media-text__media img, .gp-species .wp-block-image img, .wp-block-post-content > figure.wp-block-image img');
		var seen = new IntersectionObserver(function (es) {
			es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); seen.unobserve(e.target); } });
		}, { rootMargin: '0px 0px -12% 0px' });
		Array.prototype.forEach.call(imgs, function (img) {
			if (img.getBoundingClientRect().top > innerHeight) { img.classList.add('gp-reveal'); seen.observe(img); }
		});
	}
})();
</script>
	<?php
}, 20 );
