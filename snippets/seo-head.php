<?php
/**
 * Grohnpetrel SEO head: what Yoast SEO (free, default settings) puts in the page head, without the
 * plugin: titles, robots meta, meta description, canonical, Open Graph, article times and Twitter
 * labels for pages, posts and archives, plus Yoast's attachment and ?replytocom redirects. Also
 * hreflang links, a language switcher, German menus and the html lang attribute for translated pages.
 *
 * Runs on the site through the Code Snippets plugin. scripts/wp_sync.py publishes this file
 * and writes the page fields below from pages/manifest.json ("description", "seo_title",
 * "lang" and "alternate", the slugs of the same page in the other languages, comma-separated,
 * e.g. "de/was-ist-grohnpetrel,es/que-es-grohnpetrel"). Languages: en (default), de, es, zh.
 * Edit here, not in WordPress: the next publish overwrites the snippet.
 */

if ( ! function_exists( 'grohnpetrel_translations' ) ) {
	/**
	 * The page and its published translations, keyed by language code (en, de, es, zh), read from
	 * the "alternate" field (comma-separated paths, e.g. "de/was-ist-grohnpetrel,es/que-es-grohnpetrel").
	 * An empty array when the page has no published translation.
	 */
	function grohnpetrel_translations( $id ) {
		$alt = (string) get_post_meta( $id, 'grohnpetrel_alternate', true );
		if ( '' === $alt ) {
			return array();
		}
		$lang = (string) get_post_meta( $id, 'grohnpetrel_lang', true );
		$out  = array( '' !== $lang ? $lang : 'en' => get_post( $id ) );
		foreach ( array_filter( array_map( 'trim', explode( ',', $alt ) ) ) as $path ) {
			$twin = get_page_by_path( $path, OBJECT, array( 'page', 'post' ) );
			if ( ! $twin || 'publish' !== $twin->post_status ) {
				continue;
			}
			$code = (string) get_post_meta( $twin->ID, 'grohnpetrel_lang', true );
			$code = '' !== $code ? $code : 'en';
			if ( ! isset( $out[ $code ] ) ) {
				$out[ $code ] = $twin;
			}
		}
		return count( $out ) > 1 ? $out : array();
	}

	/** Locale-style codes and names for the site's languages. */
	function grohnpetrel_language_info( $code ) {
		$all = array(
			'en' => array( 'html' => 'en-US', 'og' => 'en_US', 'name' => 'English' ),
			'de' => array( 'html' => 'de-DE', 'og' => 'de_DE', 'name' => 'Deutsch' ),
			'es' => array( 'html' => 'es-ES', 'og' => 'es_ES', 'name' => 'Español' ),
			'zh' => array( 'html' => 'zh-CN', 'og' => 'zh_CN', 'name' => '中文' ),
		);
		return isset( $all[ $code ] ) ? $all[ $code ] : $all['en'];
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
		if ( 'zh' === $lang ) {  // Chinese has no spaces between words: count characters instead
			$chars = mb_strlen( (string) preg_replace( '/\s+/u', '', $text ) );
			return max( 1, (int) ceil( $chars / 300 ) );
		}
		$speed = array( 'de' => 179, 'es' => 218 );
		return max( 1, (int) ceil( $words / ( isset( $speed[ $lang ] ) ? $speed[ $lang ] : 238 ) ) );
	}
}

// Titles as Yoast writes them: "Page - Site", "Name Archives - Site", "You searched for x - Site".
// The separator is the entity for "-": WordPress's typography filter would turn a plain " - "
// in the title into an en dash, which Yoast's titles do not have.
add_filter( 'document_title_separator', function () {
	return '&#45;';
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
		$home = is_front_page() || ( in_array( $post->post_name, array( 'de', 'es', 'zh' ), true ) && ! $post->post_parent );  // a language's front page
		$tag( 'name', 'description', $desc );
		$out[] = sprintf( '<link rel="canonical" href="%s" />', esc_url( $canonical ) );
		$tag( 'property', 'og:locale', '' !== $lang ? grohnpetrel_language_info( $lang )['og'] : get_locale() );
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
			$by       = array( 'de' => 'Verfasst von', 'es' => 'Escrito por', 'zh' => '作者' );
			$labels[] = array( isset( $by[ $lang ] ) ? $by[ $lang ] : 'Written by', 'Team Guillemots' );
		}
		$tag( 'name', 'twitter:card', 'summary_large_image' );
		if ( ! $home ) {
			$min      = grohnpetrel_reading_minutes( $post, $lang );
			if ( $de ) {
				$labels[] = array( 'Geschätzte Lesezeit', 1 === $min ? '1 Minute' : $min . ' Minuten' );
			} elseif ( 'es' === $lang ) {
				$labels[] = array( 'Tiempo de lectura', 1 === $min ? '1 minuto' : $min . ' minutos' );
			} elseif ( 'zh' === $lang ) {
				$labels[] = array( '预计阅读时间', $min . ' 分钟' );
			} else {
				$labels[] = array( 'Est. reading time', 1 === $min ? '1 minute' : $min . ' minutes' );
			}
		}
		foreach ( $labels as $i => $label ) {
			$tag( 'name', 'twitter:label' . ( $i + 1 ), $label[0] );
			$tag( 'name', 'twitter:data' . ( $i + 1 ), $label[1] );
		}
		// hreflang: a page and all its translations point at each other; English is the x-default.
		$langs = grohnpetrel_translations( $id );
		if ( $langs ) {
			$links = array();
			foreach ( $langs as $code => $p ) {
				$links[ $code ] = (int) $p->ID === (int) $id ? $canonical : get_permalink( $p );
			}
			if ( isset( $links['en'] ) ) {
				$links['x-default'] = $links['en'];
			}
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
	$lang = is_singular() ? (string) get_post_meta( get_queried_object_id(), 'grohnpetrel_lang', true ) : '';
	if ( in_array( $lang, array( 'de', 'es', 'zh' ), true ) ) {
		$output = preg_replace( '/lang="[^"]*"/', 'lang="' . grohnpetrel_language_info( $lang )['html'] . '"', $output );
	}
	return $output;
} );

// Language switcher: plain links to the page's translations at the top of every translated page,
// each named in its own language.
add_filter( 'the_content', function ( $content ) {
	if ( ! is_singular() || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$id    = get_the_ID();
	$langs = grohnpetrel_translations( $id );
	if ( ! $langs ) {
		return $content;
	}
	$links = array();
	foreach ( array( 'en', 'de', 'es', 'zh' ) as $code ) {
		if ( isset( $langs[ $code ] ) && (int) $langs[ $code ]->ID !== (int) $id ) {
			$links[] = sprintf( '<a href="%s" hreflang="%s" lang="%s">%s</a>', esc_url( get_permalink( $langs[ $code ] ) ), $code, $code, esc_html( grohnpetrel_language_info( $code )['name'] ) );
		}
	}
	return '<p class="grohnpetrel-lang">' . implode( ' · ', $links ) . '</p>' . $content;
}, 5 );

// Translated pages show their language's menus: the navigation block's English menu (post ID) is
// swapped for the menu with the slug below (pages/navigation-*.html, created by wp_sync.py).
// Spanish and Chinese have their own main menu; their footers stay in English.
add_filter( 'render_block_data', function ( $block ) {
	static $menus = array(
		'de' => array( 4 => 'navigation-de-main', 38 => 'navigation-de-lernen', 39 => 'navigation-de-transparenz' ),
		'es' => array( 4 => 'navigation-es-main' ),
		'zh' => array( 4 => 'navigation-zh-main' ),
	);
	if ( 'core/navigation' !== $block['blockName'] || empty( $block['attrs']['ref'] ) || ! is_singular() ) {
		return $block;
	}
	$lang = (string) get_post_meta( get_queried_object_id(), 'grohnpetrel_lang', true );
	if ( ! isset( $menus[ $lang ][ $block['attrs']['ref'] ] ) ) {
		return $block;
	}
	$nav = get_page_by_path( $menus[ $lang ][ $block['attrs']['ref'] ], OBJECT, 'wp_navigation' );
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
