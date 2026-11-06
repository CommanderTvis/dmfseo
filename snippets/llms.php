<?php
/**
 * Grohnpetrel llms.txt: a short markdown guide to the site for language models, served at
 * /guillemots/llms.txt (we do not own the domain root, so /llms.txt is out of reach) and
 * announced in the page head with <link rel="alternate" type="text/markdown">.
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

- [What is Grohnpetrel?]({$u}what-is-grohnpetrel-2/): definition, name origin and who created it
- [FAQ]({$u}grohnpetrel-faq/): short answers to common questions
- [The Grohnpetrel Mission]({$u}the-grohnpetrel-mission/): aims of the project
- [About the Guillemots team]({$u}about/): who we are

## Seabirds

- [Seabirds of the North Sea]({$u}seabirds-of-the-north-sea/): sourced guide to six species
- [Seabird conservation: threats and challenges]({$u}seabird-conservation-threats-and-challenges/)
- [Take action: how to help protect seabirds]({$u}take-action-how-to-help-protect-seabirds/)

## Project

- [Programmes]({$u}grohnpetrel-programmes/)
- [Merchandise: plans, not sales]({$u}merch/)
- [Journal]({$u}journal/): what we tried and what happened

## German

- [Grohnpetrel auf Deutsch]({$u}de/)
- [Was ist Grohnpetrel?]({$u}de/was-ist-grohnpetrel/)
- [Häufige Fragen]({$u}de/haeufige-fragen/)

## Spanish

- [Grohnpetrel en español]({$u}es/)
- [¿Qué es Grohnpetrel?]({$u}es/que-es-grohnpetrel/)
- [Preguntas frecuentes]({$u}es/preguntas-frecuentes-grohnpetrel/)

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

add_action( 'wp_head', function () {
	printf( "<link rel=\"alternate\" type=\"text/markdown\" title=\"llms.txt\" href=\"%s\" />\n", esc_url( home_url( '/llms.txt' ) ) );
}, 2 );
