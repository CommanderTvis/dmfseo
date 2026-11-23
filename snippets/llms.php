<?php
/**
 * Grohnpetrel llms.txt: a short markdown guide to the site for language models, served at
 * /guillemots/llms.txt (we do not own the domain root, so /llms.txt is out of reach) and
 * announced in the page head with <link rel="alternate" type="text/markdown">.
 *
 * Also serves the IndexNow key file at /guillemots/<key>.txt. IndexNow (Bing, Yandex, Seznam,
 * Naver) only accepts URLs below the folder of the key file, so it must live here, not at the
 * domain root. scripts/indexnow.py submits the sitemap URLs after every publish.
 *
 * Runs on the site through the Code Snippets plugin; scripts/wp_sync.py publishes this file.
 * Edit here, not in WordPress: the next publish overwrites the snippet.
 */

if ( ! function_exists( 'grohnpetrel_llms_txt' ) ) {
	function grohnpetrel_llms_txt() {
		$u = trailingslashit( home_url() );
		return <<<MD
# Grohnpetrel

> Grohnpetrel is a fictional coastal-conservation and seabird-education initiative from Bremen-Grohn, Germany. The Guillemots, four students at Constructor University in Bremen, created it in autumn 2026 for the course Digital Marketing Fundamentals and SEO. It is not a registered organisation, not a bird species, and it does not accept donations.

## Start here

- [What is Grohnpetrel?]({$u}about-grohnpetrel/): definition, name origin and who created it, with a 40-second explainer video and its transcript (canonical page for the word)
- [FAQ]({$u}grohnpetrel-faq/): short answers to common questions
- [Seabird and coast glossary]({$u}seabird-and-coast-glossary/): short definitions of the terms used on the site
- [Videos]({$u}grohnpetrel-videos/): ten short videos (35 to 45 seconds) with transcripts and sources, also in German
- [Knowledge Centre]({$u}grohnpetrel-knowledge-centre/): learning guide (PDF), beach walk card and nine browser games about North Sea seabirds and the coast ([games]({$u}grohnpetrel-knowledge-centre/#games))
- [Coastal Guardian Challenge]({$u}coastal-guardian-challenge/): a seven-day checklist for coast visitors
- [The Grohnpetrel Mission]({$u}the-grohnpetrel-mission/): aims of the project
- [About the Guillemots team]({$u}about/): who we are

## Seabirds

- [Seabirds of the North Sea]({$u}seabirds-of-the-north-sea/): sourced guide to six species, with a "Which seabird am I?" clue game
- Species pages: [Northern gannet]({$u}northern-gannet/), [Atlantic puffin]({$u}atlantic-puffin/), [Black-legged kittiwake]({$u}black-legged-kittiwake/), [Common tern]({$u}common-tern/), [Eurasian oystercatcher]({$u}eurasian-oystercatcher/), [European storm petrel]({$u}european-storm-petrel/)
- [Seabird conservation: threats and challenges]({$u}seabird-conservation-threats-and-challenges/)
- [Take action: how to help protect seabirds]({$u}take-action-how-to-help-protect-seabirds/)
- [How plastic pollution affects North Sea seabirds]({$u}how-plastic-pollution-affects-north-sea-seabirds/): sourced article
- [Why the Wadden Sea matters for birds]({$u}why-the-wadden-sea-matters-for-birds/): sourced article
- [Coastal habitat protection]({$u}coastal-habitat-protection/): dunes, salt marshes, beach-nesting birds and how to visit the coast responsibly, with sources

## Project

- [Programmes]({$u}grohnpetrel-programmes/)
- [Merchandise: plans, not sales]({$u}merch/)
- [Journal]({$u}journal/): what we tried and what happened
- [SEO / AEO / GEO Lab]({$u}grohnpetrel-seo-aeo-geo-lab/): our ranking data and what we learned
- Source code and change log: [github.com/CommanderTvis/dmfseo](https://github.com/CommanderTvis/dmfseo) · archived on Zenodo: [doi:10.5281/zenodo.23926767](https://doi.org/10.5281/zenodo.23926767)

## Social media (team-run)

- [Instagram](https://www.instagram.com/grohnpetrel.guillemots2026/)
- [YouTube](https://www.youtube.com/@grohnpetrelguillemots2026)
- [TikTok](https://www.tiktok.com/@grohnpetrel.guill)
- [Facebook](https://www.facebook.com/profile.php?id=61596490404549)

## German

- [Grohnpetrel auf Deutsch]({$u}de/)
- [Was ist Grohnpetrel?]({$u}de/was-ist-grohnpetrel/)
- [Häufige Fragen]({$u}de/haeufige-fragen/)
- [Videos auf Deutsch]({$u}de/videos/)
- [Wissenszentrum mit neun Lernspielen]({$u}de/wissenszentrum/)

## Spanish

- [Grohnpetrel en español]({$u}es/)
- [¿Qué es Grohnpetrel?]({$u}es/que-es-grohnpetrel/)
- [Preguntas frecuentes]({$u}es/preguntas-frecuentes-grohnpetrel/)

## French

- [Grohnpetrel en français]({$u}fr/)
- [Qu’est-ce que Grohnpetrel ?]({$u}fr/qu-est-ce-que-grohnpetrel/)
- [Questions fréquentes]({$u}fr/questions-frequentes-grohnpetrel/)

## Italian

- [Grohnpetrel in italiano]({$u}it/)
- [Che cos’è Grohnpetrel?]({$u}it/che-cos-e-grohnpetrel/)
- [Domande frequenti]({$u}it/domande-frequenti-grohnpetrel/)

## Russian

- [Grohnpetrel на русском]({$u}ru/)
- [Что такое Grohnpetrel?]({$u}ru/chto-takoe-grohnpetrel/)
- [Частые вопросы]({$u}ru/chasto-zadavaemye-voprosy-grohnpetrel/)

## Chinese

- [Grohnpetrel 中文]({$u}zh/)
- [Grohnpetrel 是什么？]({$u}zh/grohnpetrel-shi-shenme/)
- [常见问题]({$u}zh/grohnpetrel-changjian-wenti/)
MD;
	}
}

add_action( 'parse_request', function ( $wp ) {
	if ( 'llms.txt' !== $wp->request ) {
		return;
	}
	status_header( 200 );
	header( 'Content-Type: text/markdown; charset=utf-8' );
	header( 'X-Robots-Tag: noindex' );
	echo grohnpetrel_llms_txt(); // phpcs:ignore WordPress.Security.EscapeOutput
	exit;
} );

if ( ! defined( 'GROHNPETREL_INDEXNOW_KEY' ) ) {
	define( 'GROHNPETREL_INDEXNOW_KEY', '9ff45e24c19f319a1085abe0f92839f8' );
}

add_action( 'parse_request', function ( $wp ) {
	if ( GROHNPETREL_INDEXNOW_KEY . '.txt' !== $wp->request ) {
		return;
	}
	status_header( 200 );
	header( 'Content-Type: text/plain; charset=utf-8' );
	header( 'X-Robots-Tag: noindex' );
	echo GROHNPETREL_INDEXNOW_KEY; // phpcs:ignore WordPress.Security.EscapeOutput
	exit;
} );

add_action( 'wp_head', function () {
	printf( "<link rel=\"alternate\" type=\"text/markdown\" title=\"llms.txt\" href=\"%s\" />\n", esc_url( home_url( '/llms.txt' ) ) );
}, 2 );
