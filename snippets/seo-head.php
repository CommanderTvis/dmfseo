<?php
/**
 * Grohnpetrel SEO head: per-page meta description and title, Open Graph and Twitter tags.
 *
 * Runs on the site through the Code Snippets plugin. scripts/wp_sync.py publishes this file
 * and writes the page fields below from pages/manifest.json ("description", "seo_title").
 * Edit here, not in WordPress: the next publish overwrites the snippet.
 */

add_action( 'init', function () {
	foreach ( array( 'grohnpetrel_description', 'grohnpetrel_title' ) as $key ) {
		register_post_meta( 'page', $key, array(
			'type'          => 'string',
			'single'        => true,
			'default'       => '',
			'show_in_rest'  => true,
			'auth_callback' => function () {
				return current_user_can( 'edit_pages' );
			},
		) );
	}
} );

add_filter( 'pre_get_document_title', function ( $title ) {
	if ( is_page() ) {
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
	$desc = is_page() ? get_post_meta( $id, 'grohnpetrel_description', true ) : '';
	$tags = array(
		array( 'name', 'description', $desc ),
		array( 'property', 'og:type', is_front_page() ? 'website' : 'article' ),
		array( 'property', 'og:locale', get_locale() ),
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
}, 1 );
