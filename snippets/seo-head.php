<?php
/**
 * Grohnpetrel SEO head: per-page meta description and title, Open Graph and Twitter tags,
 * and hreflang links plus the html lang attribute for translated pages.
 *
 * Runs on the site through the Code Snippets plugin. scripts/wp_sync.py publishes this file
 * and writes the page fields below from pages/manifest.json ("description", "seo_title",
 * "lang" and "alternate", the slug of the same page in the other language).
 * Edit here, not in WordPress: the next publish overwrites the snippet.
 */

add_action( 'init', function () {
	foreach ( array( 'page', 'post' ) as $type ) {
		foreach ( array( 'grohnpetrel_description', 'grohnpetrel_title', 'grohnpetrel_lang', 'grohnpetrel_alternate' ) as $key ) {
			register_post_meta( $type, $key, array(
				'type'          => 'string',
				'single'        => true,
				'default'       => '',
				'show_in_rest'  => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_pages' );
				},
			) );
		}
	}
} );

add_filter( 'pre_get_document_title', function ( $title ) {
	if ( is_singular() ) {
		$custom = get_post_meta( get_queried_object_id(), 'grohnpetrel_title', true );
		if ( '' !== $custom ) {
			return $custom;
		}
	}
	return $title;
} );

add_action( 'wp_head', function () {
	if ( ! is_singular() ) {
		return;
	}
	$id   = get_queried_object_id();
	$desc = (string) get_post_meta( $id, 'grohnpetrel_description', true );
	$lang = (string) get_post_meta( $id, 'grohnpetrel_lang', true );
	$tags = array(
		array( 'name', 'description', $desc ),
		array( 'property', 'og:type', is_front_page() ? 'website' : 'article' ),
		array( 'property', 'og:locale', 'de' === $lang ? 'de_DE' : get_locale() ),
		array( 'property', 'og:site_name', get_bloginfo( 'name' ) ),
		array( 'property', 'og:title', wp_get_document_title() ),
		array( 'property', 'og:description', $desc ),
		array( 'property', 'og:url', wp_get_canonical_url( $id ) ),
		array( 'name', 'twitter:card', 'summary' ),
	);
	$logo = wp_get_attachment_image_src( (int) get_theme_mod( 'custom_logo' ), 'full' );
	if ( $logo ) {
		$tags[] = array( 'property', 'og:image', $logo[0] );
		$tags[] = array( 'property', 'og:image:width', $logo[1] );
		$tags[] = array( 'property', 'og:image:height', $logo[2] );
		$tags[] = array( 'property', 'og:image:alt', get_bloginfo( 'name' ) . ' logo' );
	}
	foreach ( $tags as $tag ) {
		if ( '' !== (string) $tag[2] ) {
			printf( "<meta %s=\"%s\" content=\"%s\" />\n", $tag[0], esc_attr( $tag[1] ), esc_attr( $tag[2] ) );
		}
	}
	// hreflang: a page and its translation point at each other; English is the x-default.
	$alt  = (string) get_post_meta( $id, 'grohnpetrel_alternate', true );
	$twin = '' !== $alt ? get_page_by_path( $alt ) : null;
	if ( $twin && 'publish' === $twin->post_status ) {
		$here  = '' !== $lang ? $lang : 'en';
		$there = 'de' === $here ? 'en' : 'de';
		$links = array( $here => wp_get_canonical_url( $id ), $there => get_permalink( $twin ) );
		$links['x-default'] = $links['en'];
		foreach ( $links as $code => $href ) {
			printf( "<link rel=\"alternate\" hreflang=\"%s\" href=\"%s\" />\n", esc_attr( $code ), esc_url( $href ) );
		}
	}
}, 1 );

// Translated pages declare their own language in <html lang="...">.
add_filter( 'language_attributes', function ( $output ) {
	if ( is_singular() && 'de' === get_post_meta( get_queried_object_id(), 'grohnpetrel_lang', true ) ) {
		$output = preg_replace( '/lang="[^"]*"/', 'lang="de-DE"', $output );
	}
	return $output;
} );
