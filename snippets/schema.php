<?php
/**
 * Grohnpetrel schema: JSON-LD structured data for every page and post.
 *
 * Runs on the site through the Code Snippets plugin; scripts/wp_sync.py publishes this file.
 * Edit here, not in WordPress: the next publish overwrites the snippet.
 *
 * Output: one @graph with the project (schema.org Project, a subtype of Organization), the
 * WebSite, the current page (WebPage, AboutPage, ContactPage, FAQPage or CollectionPage), a
 * BreadcrumbList and, where it applies, a DefinedTerm (definition page) or an Article (posts).
 * The FAQPage questions are read from the FAQ page itself (each h2 heading and the paragraphs
 * under it), so the structured data always matches the visible text.
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
			if ( '' !== $question && '' !== $answer && '?' === substr( $question, -1 ) ) {
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
	if ( ! is_singular() ) {
		return;
	}
	$home    = home_url( '/' );
	$post    = get_queried_object();
	$id      = $post->ID;
	$slug    = $post->post_name;
	$url     = wp_get_canonical_url( $id );
	$title   = wp_strip_all_tags( get_the_title( $id ) );
	$desc    = (string) get_post_meta( $id, 'grohnpetrel_description', true );
	$lang    = (string) get_post_meta( $id, 'grohnpetrel_lang', true );
	$lang    = '' !== $lang ? $lang : 'en';
	$project = $home . '#project';
	$website = $home . '#website';
	$logo    = wp_get_attachment_image_src( (int) get_theme_mod( 'custom_logo' ), 'full' );

	$graph = array();

	$org = array(
		'@type'                    => 'Project',
		'@id'                      => $project,
		'name'                     => 'Grohnpetrel',
		'url'                      => $home,
		'description'              => 'Grohnpetrel is a proposed coastal-conservation and seabird-education initiative.',
		'disambiguatingDescription' => 'A fictional academic proposal created in autumn 2026 by the Guillemots, a team of four students at Constructor University in Bremen, Germany, for the course Digital Marketing Fundamentals and Search Engine Optimisation. It is not a registered organisation, not a bird species, and it does not accept donations.',
		'foundingDate'             => '2026',
		'foundingLocation'         => array( '@type' => 'Place', 'name' => 'Bremen-Grohn, Germany' ),
		'knowsAbout'               => array( 'Seabird conservation', 'Coastal ecosystems', 'North Sea', 'Wadden Sea' ),
		'member'                   => array(
			array( '@type' => 'Person', 'name' => 'Ayoyemi Adeboyeyo' ),
			array( '@type' => 'Person', 'name' => 'Diego Aguilar' ),
			array( '@type' => 'Person', 'name' => 'Mario Iraheta' ),
			array( '@type' => 'Person', 'name' => 'Iaroslav Postovalov' ),
		),
	);
	if ( $logo ) {
		$org['logo'] = array( '@type' => 'ImageObject', 'url' => $logo[0], 'width' => $logo[1], 'height' => $logo[2] );
	}
	$graph[] = $org;

	$graph[] = array(
		'@type'      => 'WebSite',
		'@id'        => $website,
		'url'        => $home,
		'name'       => get_bloginfo( 'name' ),
		'publisher'  => array( '@id' => $project ),
		'inLanguage' => 'en',
	);

	$types = array(
		'about'                        => 'AboutPage',
		'contact'                      => 'ContactPage',
		'grohnpetrel-faq'              => 'FAQPage',
		'grohnpetrel-faq-de'           => 'FAQPage',
		'grohnpetrel-knowledge-centre' => 'CollectionPage',
		'seabirds-of-the-north-sea'    => 'CollectionPage',
		'journal'                      => 'CollectionPage',
	);
	$page = array(
		'@type'        => isset( $types[ $slug ] ) ? $types[ $slug ] : 'WebPage',
		'@id'          => $url . '#webpage',
		'url'          => $url,
		'name'         => wp_get_document_title(),
		'isPartOf'     => array( '@id' => $website ),
		'about'        => array( '@id' => $project ),
		'inLanguage'   => $lang,
		'dateModified' => get_post_modified_time( 'c', true, $id ),
		'breadcrumb'   => array( '@id' => $url . '#breadcrumb' ),
	);
	if ( '' !== $desc ) {
		$page['description'] = $desc;
	}
	if ( 'FAQPage' === $page['@type'] ) {
		$faq = grohnpetrel_schema_faq( $post->post_content );
		if ( $faq ) {
			$page['mainEntity'] = $faq;
		} else {
			$page['@type'] = 'WebPage';
		}
	}
	$graph[] = $page;

	$crumbs = array( array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $home ) );
	if ( 'post' === $post->post_type ) {
		$journal = get_page_by_path( 'journal' );
		if ( $journal ) {
			$crumbs[] = array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Journal', 'item' => get_permalink( $journal ) );
		}
	} elseif ( $post->post_parent ) {
		$crumbs[] = array( '@type' => 'ListItem', 'position' => 2, 'name' => wp_strip_all_tags( get_the_title( $post->post_parent ) ), 'item' => get_permalink( $post->post_parent ) );
	}
	if ( ! is_front_page() ) {
		$crumbs[] = array( '@type' => 'ListItem', 'position' => count( $crumbs ) + 1, 'name' => $title, 'item' => $url );
	}
	$graph[] = array( '@type' => 'BreadcrumbList', '@id' => $url . '#breadcrumb', 'itemListElement' => $crumbs );

	if ( in_array( $slug, array( 'what-is-grohnpetrel-2', 'was-ist-grohnpetrel' ), true ) ) {
		$graph[] = array(
			'@type'       => 'DefinedTerm',
			'@id'         => $home . '#term',
			'name'        => 'Grohnpetrel',
			'description' => 'A proposed coastal-conservation and seabird-education initiative; a fictional academic concept by the Guillemots student team at Constructor University, Bremen. The name combines Grohn, a district of Bremen, with petrel, a group of seabirds.',
			'url'         => $url,
			'inLanguage'  => $lang,
		);
	}

	if ( 'post' === $post->post_type ) {
		$graph[] = array(
			'@type'            => 'Article',
			'@id'              => $url . '#article',
			'headline'         => $title,
			'description'      => $desc,
			'datePublished'    => get_post_time( 'c', true, $id ),
			'dateModified'     => get_post_modified_time( 'c', true, $id ),
			'author'           => array( '@type' => 'Organization', 'name' => 'Team Guillemots', 'url' => home_url( '/about/' ) ),
			'publisher'        => array( '@id' => $project ),
			'mainEntityOfPage' => array( '@id' => $url . '#webpage' ),
			'inLanguage'       => $lang,
		);
	}

	echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}, 5 );
