<?php
/**
 * Grohnpetrel SEO head: what Yoast SEO (free, default settings) puts in the page head, without the
 * plugin: titles, robots meta, meta description, canonical, Open Graph, article times and Twitter
 * labels for pages, posts and archives, plus Yoast's attachment and ?replytocom redirects. Also
 * hreflang links, a language switcher, German menus and the html lang attribute for translated pages.
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

if ( ! function_exists( 'grohnpetrel_canonical' ) ) {
	/**
	 * Canonical URL of the current view, as Yoast sets it: the page, post, term or author URL
	 * (with the page number on later pages). None for views that are noindex (search, dates, 404).
	 */
	function grohnpetrel_canonical() {
		if ( is_singular() ) {
			return (string) wp_get_canonical_url( get_queried_object_id() );
		}
		if ( is_category() || is_tag() || is_tax() ) {
			$url = get_term_link( get_queried_object() );
		} elseif ( is_author() ) {
			$url = get_author_posts_url( get_queried_object_id() );
		} elseif ( is_home() ) {
			$for_posts = (int) get_option( 'page_for_posts' );
			$url       = $for_posts ? get_permalink( $for_posts ) : home_url( '/' );
		} else {
			return '';
		}
		if ( is_wp_error( $url ) || ! $url ) {
			return '';
		}
		$paged = max( 1, (int) get_query_var( 'paged' ) );
		return $paged > 1 ? get_pagenum_link( $paged ) : $url;
	}
}

if ( ! function_exists( 'grohnpetrel_current_url' ) ) {
	/** URL of the current view: the canonical URL, else the requested address (search, dates). */
	function grohnpetrel_current_url() {
		$canonical = grohnpetrel_canonical();
		if ( '' !== $canonical ) {
			return $canonical;
		}
		if ( is_search() ) {
			return get_search_link();
		}
		return home_url( user_trailingslashit( (string) $GLOBALS['wp']->request ) );
	}
}

if ( ! function_exists( 'grohnpetrel_reading_minutes' ) ) {
	/** Estimated reading time in minutes, like Yoast: words divided by the language's reading speed. */
	function grohnpetrel_reading_minutes( $post, $lang ) {
		$text  = trim( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ) );
		$parts = '' !== $text ? preg_split( '/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY ) : array();
		$words = is_array( $parts ) ? count( $parts ) : 0;
		return max( 1, (int) ceil( $words / ( 'de' === $lang ? 179 : 238 ) ) );
	}
}

// Titles as Yoast writes them: "Page - Site", "Name Archives - Site", "You searched for x - Site".
add_filter( 'document_title_separator', function () {
	return '-';
} );

add_filter( 'document_title_parts', function ( $parts ) {
	if ( is_search() ) {
		$parts['title'] = sprintf( 'You searched for %s', get_search_query() );
	} elseif ( is_author() ) {
		return array( 'title' => sprintf( '%s, Author at %s', get_the_author_meta( 'display_name', get_queried_object_id() ), get_bloginfo( 'name' ) ) );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$parts['title'] = sprintf( '%s Archives', single_term_title( '', false ) );
	}
	return $parts;
} );

// Robots meta as Yoast sets it: indexable views get "index, follow, max-image-preview:large,
// max-snippet:-1, max-video-preview:-1"; search results, date archives, 404 pages and authors
// without posts get "noindex, follow".
add_filter( 'wp_robots', function ( $robots ) {
	$noindex = is_search() || is_404() || is_date()
		|| ( is_author() && ! count_user_posts( (int) get_queried_object_id() ) );
	if ( $noindex || ! empty( $robots['noindex'] ) ) {
		return empty( $robots['nofollow'] ) ? array( 'noindex' => true, 'follow' => true ) : array( 'noindex' => true, 'nofollow' => true );
	}
	return array_merge( array( 'index' => true, 'follow' => true ), $robots,
		array( 'max-image-preview' => 'large', 'max-snippet' => '-1', 'max-video-preview' => '-1' ) );
} );

// Our canonical link replaces WordPress's own, so archives get one too (as with Yoast).
remove_action( 'wp_head', 'rel_canonical' );

add_action( 'wp_head', function () {
	$out = array();
	$tag = function ( $attr, $key, $value ) use ( &$out ) {
		if ( '' !== (string) $value ) {
			$out[] = sprintf( '<meta %s="%s" content="%s" />', $attr, esc_attr( $key ), esc_attr( $value ) );
		}
	};
	$canonical = grohnpetrel_canonical();
	$site      = get_bloginfo( 'name' );
	$title     = wp_get_document_title();

	if ( is_singular() ) {
		$id   = get_queried_object_id();
		$post = get_post( $id );
		$desc = (string) get_post_meta( $id, 'grohnpetrel_description', true );
		$lang = (string) get_post_meta( $id, 'grohnpetrel_lang', true );
		$de   = 'de' === $lang;
		$home = is_front_page() || ( 'de' === $post->post_name && ! $post->post_parent );  // English or German front page
		$tag( 'name', 'description', $desc );
		$out[] = sprintf( '<link rel="canonical" href="%s" />', esc_url( $canonical ) );
		$tag( 'property', 'og:locale', $de ? 'de_DE' : get_locale() );
		$tag( 'property', 'og:type', $home ? 'website' : 'article' );
		$tag( 'property', 'og:title', $title );
		$tag( 'property', 'og:description', $desc );
		$tag( 'property', 'og:url', $canonical );
		$tag( 'property', 'og:site_name', $site );
		if ( 'post' === $post->post_type ) {
			$tag( 'property', 'article:published_time', get_post_time( 'c', true, $id ) );
		}
		$tag( 'property', 'article:modified_time', get_post_modified_time( 'c', true, $id ) );
		// Share image: the page's featured image, else the Grohnpetrel mascot (media 11), else the logo.
		$img_id = has_post_thumbnail( $id ) ? (int) get_post_thumbnail_id( $id ) : 11;
		$img    = wp_get_attachment_image_src( $img_id, 'full' );
		$alt    = $img ? (string) get_post_meta( $img_id, '_wp_attachment_image_alt', true ) : '';
		if ( ! $img ) {
			$img_id = (int) get_theme_mod( 'custom_logo' );
			$img    = wp_get_attachment_image_src( $img_id, 'full' );
			$alt    = $site . ' logo';
		}
		if ( $img ) {
			$tag( 'property', 'og:image', $img[0] );
			$tag( 'property', 'og:image:width', $img[1] );
			$tag( 'property', 'og:image:height', $img[2] );
			$tag( 'property', 'og:image:alt', '' !== $alt ? $alt : 'Grohnpetrel mascot' );
			$tag( 'property', 'og:image:type', (string) get_post_mime_type( $img_id ) );
		}
		$labels = array();
		if ( 'post' === $post->post_type ) {
			$tag( 'name', 'author', 'Team Guillemots' );
			$labels[] = array( $de ? 'Verfasst von' : 'Written by', 'Team Guillemots' );
		}
		$tag( 'name', 'twitter:card', 'summary_large_image' );
		if ( ! $home ) {
			$min      = grohnpetrel_reading_minutes( $post, $lang );
			$labels[] = $de
				? array( 'Geschätzte Lesezeit', 1 === $min ? '1 Minute' : $min . ' Minuten' )
				: array( 'Est. reading time', 1 === $min ? '1 minute' : $min . ' minutes' );
		}
		foreach ( $labels as $i => $label ) {
			$tag( 'name', 'twitter:label' . ( $i + 1 ), $label[0] );
			$tag( 'name', 'twitter:data' . ( $i + 1 ), $label[1] );
		}
		// hreflang: a page and its translation point at each other; English is the x-default.
		$pair = grohnpetrel_language_pair( $id );
		if ( $pair ) {
			$links = array( $pair['here'] => $canonical, $pair['there'] => get_permalink( $pair['twin'] ) );
			$links['x-default'] = $links['en'];
			foreach ( $links as $code => $href ) {
				$out[] = sprintf( '<link rel="alternate" hreflang="%s" href="%s" />', esc_attr( $code ), esc_url( $href ) );
			}
		}
	} else {
		// Archives, search results and 404 pages.
		$desc = ( is_category() || is_tag() || is_tax() ) ? trim( wp_strip_all_tags( term_description() ) ) : '';
		$tag( 'name', 'description', $desc );
		if ( '' !== $canonical ) {
			$out[] = sprintf( '<link rel="canonical" href="%s" />', esc_url( $canonical ) );
		}
		global $wp_query;
		$paged = max( 1, (int) get_query_var( 'paged' ) );
		if ( ! is_404() && $paged > 1 ) {
			$out[] = sprintf( '<link rel="prev" href="%s" />', esc_url( get_pagenum_link( $paged - 1 ) ) );
		}
		if ( ! is_404() && $paged < (int) $wp_query->max_num_pages ) {
			$out[] = sprintf( '<link rel="next" href="%s" />', esc_url( get_pagenum_link( $paged + 1 ) ) );
		}
		$tag( 'property', 'og:locale', get_locale() );
		if ( ! is_404() ) {
			$tag( 'property', 'og:type', is_author() ? 'profile' : ( is_date() ? 'website' : 'article' ) );
		}
		$tag( 'property', 'og:title', $title );
		$tag( 'property', 'og:description', $desc );
		if ( ! is_404() ) {
			$tag( 'property', 'og:url', grohnpetrel_current_url() );
		}
		$tag( 'property', 'og:site_name', $site );
		if ( ! is_404() ) {
			$tag( 'name', 'twitter:card', 'summary_large_image' );
		}
		if ( is_search() ) {
			$tag( 'name', 'twitter:title', $title );
		}
	}
	echo implode( "\n", $out ) . "\n";
}, 1 );

// Attachment pages redirect to the file itself, and ?replytocom links to the comment, as Yoast does.
add_action( 'template_redirect', function () {
	if ( is_attachment() ) {
		$file = wp_get_attachment_url( get_queried_object_id() );
		if ( $file ) {
			wp_redirect( $file, 301 );
			exit;
		}
	}
	if ( isset( $_GET['replytocom'] ) ) {
		$comment = (int) $_GET['replytocom'];
		wp_safe_redirect( remove_query_arg( 'replytocom' ) . ( $comment ? '#comment-' . $comment : '' ), 301 );
		exit;
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
