<?php
/**
 * Grohnpetrel SEO head: per-page meta description and title, Open Graph and Twitter tags,
 * and hreflang links, a language switcher, German menus and the html lang attribute for translated pages.
 *
 * Runs on the site through the Code Snippets plugin. scripts/wp_sync.py publishes this file
 * and writes the page fields below from pages/manifest.json ("description", "seo_title",
 * "lang" and "alternate", the slug of the same page in the other language).
 * Edit here, not in WordPress: the next publish overwrites the snippet.
 */

if ( ! function_exists( 'grohnpetrel_language_pair' ) ) {
	/**
	 * The page's language, the other language and the published translation (path in the
	 * "alternate" field, e.g. "de/was-ist-grohnpetrel"), or null when it has none.
	 */
	function grohnpetrel_language_pair( $id ) {
		$alt = (string) get_post_meta( $id, 'grohnpetrel_alternate', true );
		if ( '' === $alt ) {
			return null;
		}
		$twin = get_page_by_path( $alt, OBJECT, array( 'page', 'post' ) );
		if ( ! $twin || 'publish' !== $twin->post_status ) {
			return null;
		}
		$lang = (string) get_post_meta( $id, 'grohnpetrel_lang', true );
		$here = '' !== $lang ? $lang : 'en';
		return array( 'here' => $here, 'there' => 'de' === $here ? 'en' : 'de', 'twin' => $twin );
	}
}

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
		array( 'name', 'twitter:card', 'summary_large_image' ),
	);
	// Share image: the page's featured image, else the Grohnpetrel mascot (media 11), else the logo.
	$img_id = has_post_thumbnail( $id ) ? (int) get_post_thumbnail_id( $id ) : 11;
	$img    = wp_get_attachment_image_src( $img_id, 'full' );
	$alt    = $img ? (string) get_post_meta( $img_id, '_wp_attachment_image_alt', true ) : '';
	if ( ! $img ) {
		$img = wp_get_attachment_image_src( (int) get_theme_mod( 'custom_logo' ), 'full' );
		$alt = get_bloginfo( 'name' ) . ' logo';
	}
	if ( $img ) {
		$tags[] = array( 'property', 'og:image', $img[0] );
		$tags[] = array( 'property', 'og:image:width', $img[1] );
		$tags[] = array( 'property', 'og:image:height', $img[2] );
		$tags[] = array( 'property', 'og:image:alt', '' !== $alt ? $alt : 'Grohnpetrel mascot' );
	}
	foreach ( $tags as $tag ) {
		if ( '' !== (string) $tag[2] ) {
			printf( "<meta %s=\"%s\" content=\"%s\" />\n", $tag[0], esc_attr( $tag[1] ), esc_attr( $tag[2] ) );
		}
	}
	// hreflang: a page and its translation point at each other; English is the x-default.
	$pair = grohnpetrel_language_pair( $id );
	if ( $pair ) {
		$links = array( $pair['here'] => wp_get_canonical_url( $id ), $pair['there'] => get_permalink( $pair['twin'] ) );
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

// Language switcher: a plain link to the translation at the top of every translated page.
add_filter( 'the_content', function ( $content ) {
	if ( ! is_singular() || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$pair = grohnpetrel_language_pair( get_the_ID() );
	if ( ! $pair ) {
		return $content;
	}
	$de = 'de' === $pair['there'];
	return sprintf(
		'<p class="grohnpetrel-lang"><a href="%s" hreflang="%s" lang="%s">%s</a></p>',
		esc_url( get_permalink( $pair['twin'] ) ), $pair['there'], $pair['there'], $de ? 'Deutsch' : 'English'
	) . $content;
}, 5 );

// German pages show the German menus: the navigation block's English menu (post ID) is swapped for
// the German menu with the slug below (pages/navigation-de-*.html, created by wp_sync.py).
add_filter( 'render_block_data', function ( $block ) {
	static $menus = array( 4 => 'navigation-de-main', 38 => 'navigation-de-lernen', 39 => 'navigation-de-transparenz' );
	if ( 'core/navigation' !== $block['blockName'] || empty( $block['attrs']['ref'] ) || ! is_singular() ) {
		return $block;
	}
	if ( 'de' !== get_post_meta( get_queried_object_id(), 'grohnpetrel_lang', true ) || ! isset( $menus[ $block['attrs']['ref'] ] ) ) {
		return $block;
	}
	$nav = get_page_by_path( $menus[ $block['attrs']['ref'] ], OBJECT, 'wp_navigation' );
	if ( $nav ) {
		$block['attrs']['ref'] = $nav->ID;
	}
	return $block;
} );

// Old addresses of the two German pages from before they moved under /de/ (WordPress does not
// keep old slugs of pages, so without this they would return 404).
add_action( 'template_redirect', function () {
	if ( ! is_404() ) {
		return;
	}
	$moved = array( 'was-ist-grohnpetrel' => 'de/was-ist-grohnpetrel', 'grohnpetrel-faq-de' => 'de/haeufige-fragen' );
	$slug  = basename( (string) wp_parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) );
	$page  = isset( $moved[ $slug ] ) ? get_page_by_path( $moved[ $slug ] ) : null;
	if ( $page ) {
		wp_safe_redirect( get_permalink( $page ), 301 );
		exit;
	}
}, 1 );
