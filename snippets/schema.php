<?php
/**
 * Grohnpetrel schema: JSON-LD structured data for every page and post.
 *
 * Runs on the site through the Code Snippets plugin; scripts/wp_sync.py publishes this file.
 * Edit here, not in WordPress: the next publish overwrites the snippet.
 *
 * Output: one @graph per view, shaped like Yoast SEO's (same node types, @id scheme and links
 * between nodes): the project as the site's organisation (schema.org Project, a subtype of
 * Organization, "#organization", with its logo "#/schema/logo/image/"), the WebSite with its
 * SearchAction, the current page (WebPage, AboutPage, ContactPage, FAQPage or CollectionPage,
 * "@id" = its URL) with its main image ("#primaryimage") and ReadAction, a BreadcrumbList, and
 * an Article on posts. Archives get a CollectionPage, search results a SearchResultsPage, author
 * archives a ProfilePage. Beyond Yoast: the DefinedTerm on the definition pages, and FAQ
 * questions read from the FAQ page itself (each h2 heading and the paragraphs under it), so the
 * structured data always matches the visible text.
 */

if ( ! function_exists( 'grohnpetrel_schema_faq' ) ) {
	/** Questions and answers from a page whose questions are h2 headings, e.g. "1. What is X?". */
	function grohnpetrel_schema_faq( $content ) {
		$items = array();
		$parts = preg_split( '/<h2[^>]*>/i', $content );
		array_shift( $parts );
		foreach ( $parts as $part ) {
			$end = stripos( $part, '</h2>' );
			if ( false === $end ) {
				continue;
			}
			$question = trim( preg_replace( '/^\s*\d+\.\s*/', '', wp_strip_all_tags( substr( $part, 0, $end ) ) ) );
			preg_match_all( '/<p[^>]*>(.*?)<\/p>/is', substr( $part, $end ), $paras );
			$answer = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( implode( ' ', $paras[1] ) ) ) );
			if ( '' !== $question && '' !== $answer && preg_match( '/[?？]$/u', $question ) ) {
				$items[] = array(
					'@type'          => 'Question',
					'name'           => $question,
					'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $answer ),
				);
			}
		}
		return $items;
	}
}

add_action( 'wp_head', function () {
	$home    = home_url( '/' );
	$org_id  = $home . '#organization';
	$website = $home . '#website';
	$logo_id = $home . '#/schema/logo/image/';
	$lang    = is_singular() ? (string) get_post_meta( get_queried_object_id(), 'grohnpetrel_lang', true ) : '';
	$lang    = '' !== $lang ? $lang : 'en';
	$de      = 'de' === $lang;
	$codes   = array( 'de' => 'de-DE', 'es' => 'es-ES', 'zh' => 'zh-CN' );
	$in_lang = isset( $codes[ $lang ] ) ? $codes[ $lang ] : str_replace( '_', '-', get_locale() );
	$site    = get_bloginfo( 'name' );

	$org = array(
		'@type'                     => 'Project',
		'@id'                       => $org_id,
		'name'                      => 'Grohnpetrel',
		'url'                       => $home,
		'sameAs'                    => array( 'https://github.com/CommanderTvis/dmfseo' ),
		'description'               => 'Grohnpetrel is a proposed coastal-conservation and seabird-education initiative.',
		'disambiguatingDescription' => 'A fictional academic proposal created in autumn 2026 by the Guillemots, a team of four students at Constructor University in Bremen, Germany, for the course Digital Marketing Fundamentals and Search Engine Optimisation. It is not a registered organisation, not a bird species, and it does not accept donations.',
		'foundingDate'              => '2026',
		'foundingLocation'          => array( '@type' => 'Place', 'name' => 'Bremen-Grohn, Germany' ),
		'knowsAbout'                => array( 'Seabird conservation', 'Coastal ecosystems', 'North Sea', 'Wadden Sea' ),
		'member'                    => array(
			array( '@type' => 'Person', 'name' => 'Ayoyemi Adeboyeyo' ),
			array( '@type' => 'Person', 'name' => 'Diego Aguilar' ),
			array( '@type' => 'Person', 'name' => 'Mario Iraheta' ),
			array( '@type' => 'Person', 'name' => 'Iaroslav Postovalov' ),
		),
	);
	if ( $de ) {
		$org['description']               = 'Grohnpetrel ist eine geplante Initiative für Küstenschutz und Bildung über Seevögel.';
		$org['disambiguatingDescription'] = 'Ein fiktiver Studienentwurf aus dem Herbst 2026, erstellt von den Guillemots, einem Team aus vier Studierenden der Constructor University in Bremen, im Kurs Digital Marketing Fundamentals and Search Engine Optimisation. Es ist keine eingetragene Organisation, keine Vogelart und nimmt keine Spenden an.';
		$org['foundingLocation']['name']  = 'Bremen-Grohn, Deutschland';
		$org['knowsAbout']                = array( 'Seevogelschutz', 'Küstenökosysteme', 'Nordsee', 'Wattenmeer' );
	} elseif ( 'es' === $lang ) {
		$org['description']               = 'Grohnpetrel es una iniciativa propuesta de conservación costera y educación sobre aves marinas.';
		$org['disambiguatingDescription'] = 'Una propuesta académica ficticia creada en otoño de 2026 por los Guillemots, un equipo de cuatro estudiantes de la Constructor University de Bremen (Alemania), para la asignatura Digital Marketing Fundamentals and Search Engine Optimisation. No es una organización registrada, no es una especie de ave y no acepta donaciones.';
		$org['foundingLocation']['name']  = 'Bremen-Grohn, Alemania';
		$org['knowsAbout']                = array( 'Conservación de aves marinas', 'Ecosistemas costeros', 'Mar del Norte', 'Mar de Frisia' );
	} elseif ( 'zh' === $lang ) {
		$org['description']               = 'Grohnpetrel 是一个构想中的海岸保护与海鸟教育项目。';
		$org['disambiguatingDescription'] = '这是一个虚构的学术项目，由德国不来梅康斯特大学（Constructor University）的四名学生组成的 Guillemots 团队于 2026 年秋季为“数字营销基础与搜索引擎优化”课程创建。它不是注册组织，不是一种鸟类，也不接受捐款。';
		$org['foundingLocation']['name']  = '德国不来梅 Grohn 区';
		$org['knowsAbout']                = array( '海鸟保护', '海岸生态系统', '北海', '瓦登海' );
	}
	// Logo: the site logo, else the Grohnpetrel mascot (media 11).
	$logo = wp_get_attachment_image_src( (int) get_theme_mod( 'custom_logo' ), 'full' );
	$logo = $logo ? $logo : wp_get_attachment_image_src( 11, 'full' );
	if ( $logo ) {
		$org['logo']  = array( '@type' => 'ImageObject', 'inLanguage' => $in_lang, '@id' => $logo_id, 'url' => $logo[0], 'contentUrl' => $logo[0], 'width' => $logo[1], 'height' => $logo[2], 'caption' => $site );
		$org['image'] = array( '@id' => $logo_id );
	}

	$graph   = array();
	$graph[] = array(
		'@type'           => 'WebSite',
		'@id'             => $website,
		'url'             => $home,
		'name'            => $site,
		'description'     => get_bloginfo( 'description' ),
		'publisher'       => array( '@id' => $org_id ),
		'potentialAction' => array( array(
			'@type'       => 'SearchAction',
			'target'      => array( '@type' => 'EntryPoint', 'urlTemplate' => $home . '?s={search_term_string}' ),
			'query-input' => array( '@type' => 'PropertyValueSpecification', 'valueRequired' => true, 'valueName' => 'search_term_string' ),
		) ),
		'inLanguage'      => $in_lang,
	);
	$graph[] = $org;

	if ( is_404() ) {
		echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
		return;
	}

	if ( ! is_singular() ) {
		// Archives and search results: a collection page and its breadcrumb (Home > this view).
		$url = function_exists( 'grohnpetrel_current_url' ) ? grohnpetrel_current_url() : home_url( add_query_arg( array() ) );
		if ( is_search() ) {
			$type  = array( 'CollectionPage', 'SearchResultsPage' );
			$crumb = sprintf( 'You searched for %s', get_search_query() );
		} elseif ( is_author() ) {
			$type  = 'ProfilePage';
			$crumb = sprintf( 'Archives for %s', get_the_author_meta( 'display_name', get_queried_object_id() ) );
		} elseif ( is_date() ) {
			$type  = 'CollectionPage';
			$crumb = sprintf( 'Archives for %s', wp_strip_all_tags( get_the_archive_title() ) );
		} else {
			$type  = 'CollectionPage';
			$crumb = is_home() ? 'Journal' : single_term_title( '', false );
		}
		$graph[] = array(
			'@type'      => $type,
			'@id'        => $url,
			'url'        => $url,
			'name'       => wp_get_document_title(),
			'isPartOf'   => array( '@id' => $website ),
			'breadcrumb' => array( '@id' => $url . '#breadcrumb' ),
			'inLanguage' => $in_lang,
		);
		$graph[] = array( '@type' => 'BreadcrumbList', '@id' => $url . '#breadcrumb', 'itemListElement' => array(
			array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $home ),
			array( '@type' => 'ListItem', 'position' => 2, 'name' => $crumb ),
		) );
		echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
		return;
	}

	$post   = get_queried_object();
	$id     = $post->ID;
	$slug   = $post->post_name;
	$url    = wp_get_canonical_url( $id );
	$title  = wp_strip_all_tags( get_the_title( $id ) );
	$desc   = (string) get_post_meta( $id, 'grohnpetrel_description', true );
	$img_id = has_post_thumbnail( $id ) ? (int) get_post_thumbnail_id( $id ) : 11;  // else the mascot
	$img    = wp_get_attachment_image_src( $img_id, 'full' );
	$img_ref = $url . '#primaryimage';

	$types = array(
		'about'                        => 'AboutPage',
		'contact'                      => 'ContactPage',
		'ueber-uns'                    => 'AboutPage',
		'kontakt'                      => 'ContactPage',
		'grohnpetrel-faq'              => 'FAQPage',
		'haeufige-fragen'              => 'FAQPage',
		'preguntas-frecuentes-grohnpetrel' => 'FAQPage',
		'grohnpetrel-changjian-wenti'  => 'FAQPage',
		'grohnpetrel-knowledge-centre' => 'CollectionPage',
		'wissenszentrum'               => 'CollectionPage',
		'seabirds-of-the-north-sea'    => 'CollectionPage',
		'seevoegel-der-nordsee'        => 'CollectionPage',
		'journal'                      => 'CollectionPage',
		'projekt-journal'              => 'CollectionPage',
	);
	$page = array(
		'@type'    => isset( $types[ $slug ] ) ? $types[ $slug ] : 'WebPage',
		'@id'      => $url,
		'url'      => $url,
		'name'     => wp_get_document_title(),
		'isPartOf' => array( '@id' => $website ),
		'about'    => array( '@id' => $org_id ),
	);
	if ( $img ) {
		$page['primaryImageOfPage'] = array( '@id' => $img_ref );
		$page['image']              = array( '@id' => $img_ref );
		$page['thumbnailUrl']       = $img[0];
	}
	$page['datePublished'] = get_post_time( 'c', true, $id );
	$page['dateModified']  = get_post_modified_time( 'c', true, $id );
	// Posts are written by the team (Yoast would name the WordPress user here).
	$author = array( '@type' => 'Organization', 'name' => 'Team Guillemots', 'url' => home_url( $de ? '/de/ueber-uns/' : '/about/' ) );
	if ( 'post' === $post->post_type ) {
		$page['author'] = $author;
	}
	if ( '' !== $desc ) {
		$page['description'] = $desc;
	}
	$page['breadcrumb']      = array( '@id' => $url . '#breadcrumb' );
	$page['inLanguage']      = $in_lang;
	$page['potentialAction'] = array( array( '@type' => 'ReadAction', 'target' => array( $url ) ) );
	if ( 'FAQPage' === $page['@type'] ) {
		$faq = grohnpetrel_schema_faq( $post->post_content );
		if ( $faq ) {
			$page['mainEntity'] = $faq;
		} else {
			$page['@type'] = 'WebPage';
		}
	}

	if ( 'post' === $post->post_type ) {
		$words   = preg_split( '/\s+/u', trim( wp_strip_all_tags( $post->post_content ) ), -1, PREG_SPLIT_NO_EMPTY );
		$article = array(
			'@type'            => 'Article',
			'@id'              => $url . '#article',
			'isPartOf'         => array( '@id' => $url ),
			'author'           => $author,
			'headline'         => $title,
			'datePublished'    => get_post_time( 'c', true, $id ),
			'dateModified'     => get_post_modified_time( 'c', true, $id ),
			'mainEntityOfPage' => array( '@id' => $url ),
			'wordCount'        => is_array( $words ) ? count( $words ) : 0,
			'commentCount'     => (int) get_comments_number( $id ),
			'publisher'        => array( '@id' => $org_id ),
		);
		if ( $img ) {
			$article['image']        = array( '@id' => $img_ref );
			$article['thumbnailUrl'] = $img[0];
		}
		$sections = wp_list_pluck( get_the_category( $id ), 'name' );
		if ( $sections ) {
			$article['articleSection'] = array_values( $sections );
		}
		$article['inLanguage'] = $in_lang;
		if ( comments_open( $id ) ) {
			$article['potentialAction'] = array( array( '@type' => 'CommentAction', 'name' => 'Comment', 'target' => array( $url . '#respond' ) ) );
		}
		$graph[] = $article;
	}
	$graph[] = $page;

	if ( $img ) {
		$graph[] = array(
			'@type'      => 'ImageObject',
			'inLanguage' => $in_lang,
			'@id'        => $img_ref,
			'url'        => $img[0],
			'contentUrl' => $img[0],
			'width'      => $img[1],
			'height'     => $img[2],
			'caption'    => (string) get_post_meta( $img_id, '_wp_attachment_image_alt', true ),
		);
	}

	// Breadcrumb as Yoast builds it (the current page last, without a link); German, Spanish and
	// Chinese pages start at their language's front page (/de/, /es/, /zh/), the parent of all of them.
	$home_names = array( 'de' => 'Startseite', 'es' => 'Inicio', 'zh' => '首页' );
	$de_home    = isset( $home_names[ $lang ] ) ? get_page_by_path( $lang ) : null;
	$is_home    = is_front_page() || ( $de_home && $de_home->ID === $id );
	$crumbs     = array( array( '@type' => 'ListItem', 'position' => 1, 'name' => $de_home ? $home_names[ $lang ] : 'Home' ) );
	if ( ! $is_home ) {
		$crumbs[0]['item'] = $de_home ? get_permalink( $de_home ) : $home;
		if ( 'post' === $post->post_type ) {
			$journal = get_page_by_path( $de ? 'de/projekt-journal' : 'journal' );
			if ( $journal ) {
				$crumbs[] = array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Journal', 'item' => get_permalink( $journal ) );
			}
		} elseif ( $post->post_parent && ! ( $de_home && $de_home->ID === $post->post_parent ) ) {
			$crumbs[] = array( '@type' => 'ListItem', 'position' => 2, 'name' => wp_strip_all_tags( get_the_title( $post->post_parent ) ), 'item' => get_permalink( $post->post_parent ) );
		}
		$crumbs[] = array( '@type' => 'ListItem', 'position' => count( $crumbs ) + 1, 'name' => $title );
	}
	$graph[] = array( '@type' => 'BreadcrumbList', '@id' => $url . '#breadcrumb', 'itemListElement' => $crumbs );

	if ( in_array( $slug, array( 'what-is-grohnpetrel-2', 'was-ist-grohnpetrel', 'que-es-grohnpetrel', 'grohnpetrel-shi-shenme' ), true ) ) {
		$graph[] = array(
			'@type'       => 'DefinedTerm',
			'@id'         => $home . '#term',
			'name'        => 'Grohnpetrel',
			'description' => 'A proposed coastal-conservation and seabird-education initiative; a fictional academic concept by the Guillemots student team at Constructor University, Bremen. The name combines Grohn, a district of Bremen, with petrel, a group of seabirds.',
			'url'         => $url,
			'inLanguage'  => $in_lang,
		);
	}

	echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}, 5 );
