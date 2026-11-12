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
			// Skip the small byline paragraph ("By the Guillemots team · Last updated …") after the last answer.
			preg_match_all( '/<p(?![^>]*has-small-font-size)[^>]*>(.*?)<\/p>/is', substr( $part, $end ), $paras );
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

if ( ! function_exists( 'grohnpetrel_schema_sources' ) ) {
	/**
	 * External links listed under a "Sources" heading (h2 or h3; also "Sources and further reading", Quellen, Fuentes, 资料来源) in the content,
	 * for the Article's "citation". Empty when the page has no such section.
	 */
	function grohnpetrel_schema_sources( $content ) {
		if ( ! preg_match( '/<h([23])[^>]*>\s*(Sources|Quellen|Fuentes|资料来源)[^<]*<\/h\1>(.*?)(<h[23]|$)/isu', $content, $m ) ) {
			return array();
		}
		preg_match_all( '/<a[^>]+href="(https?:\/\/[^"]+)"/i', $m[3], $links );
		$home = home_url( '/' );
		return array_values( array_unique( array_filter( $links[1], function ( $u ) use ( $home ) {
			return 0 !== strpos( $u, $home );
		} ) ) );
	}
}

if ( ! function_exists( 'grohnpetrel_schema_glossary' ) ) {
	/** Glossary terms: every H3 heading and the first paragraph after it, as name and description. */
	function grohnpetrel_schema_glossary( $content ) {
		$terms = array();
		$parts = preg_split( '/<h3[^>]*>/i', $content );
		array_shift( $parts );
		foreach ( $parts as $part ) {
			$end = stripos( $part, '</h3>' );
			if ( false === $end || ! preg_match( '/<p[^>]*>(.*?)<\/p>/is', substr( $part, $end ), $m ) ) {
				continue;
			}
			$name = trim( wp_strip_all_tags( substr( $part, 0, $end ) ) );
			$desc = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $m[1] ) ) );
			if ( '' !== $name && '' !== $desc ) {
				$terms[] = array( 'name' => $name, 'description' => $desc );
			}
		}
		return $terms;
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
	$codes   = array( 'de' => 'de-DE', 'es' => 'es-ES', 'fr' => 'fr-FR', 'it' => 'it-IT', 'ru' => 'ru-RU', 'zh' => 'zh-CN' );
	$in_lang = isset( $codes[ $lang ] ) ? $codes[ $lang ] : str_replace( '_', '-', get_locale() );
	$site    = get_bloginfo( 'name' );

	$org = array(
		'@type'                     => 'Project',
		'@id'                       => $org_id,
		'name'                      => 'Grohnpetrel',
		'url'                       => $home,
		'publishingPrinciples'      => $home . ( $de ? 'de/redaktionsrichtlinien/' : 'editorial-policy/' ),
		'sameAs'                    => array( 'https://github.com/CommanderTvis/dmfseo', 'https://doi.org/10.5281/zenodo.23926767', 'https://www.instagram.com/grohnpetrel.guillemots2026/', 'https://www.youtube.com/@grohnpetrelguillemots2026', 'https://www.tiktok.com/@grohnpetrel.guill', 'https://www.facebook.com/profile.php?id=61596490404549', 'https://www.linkedin.com/in/grohnpetrel-guillemots-115ab9449/' ),
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
	} elseif ( 'fr' === $lang ) {
		$org['description']               = 'Grohnpetrel est une initiative proposée de conservation côtière et d’éducation sur les oiseaux marins.';
		$org['disambiguatingDescription'] = 'Un projet académique fictif créé à l’automne 2026 par les Guillemots, une équipe de quatre étudiants de la Constructor University à Brême (Allemagne), pour le cours Digital Marketing Fundamentals and Search Engine Optimisation. Ce n’est pas une organisation enregistrée ni une espèce d’oiseau, et il n’accepte pas de dons.';
		$org['foundingLocation']['name']  = 'Brême-Grohn, Allemagne';
		$org['knowsAbout']                = array( 'Protection des oiseaux marins', 'Écosystèmes côtiers', 'Mer du Nord', 'Mer des Wadden' );
	} elseif ( 'it' === $lang ) {
		$org['description']               = 'Grohnpetrel è un’iniziativa proposta di tutela delle coste ed educazione sugli uccelli marini.';
		$org['disambiguatingDescription'] = 'Un progetto accademico fittizio creato nell’autunno 2026 dai Guillemots, un team di quattro studenti della Constructor University di Brema (Germania), per il corso Digital Marketing Fundamentals and Search Engine Optimisation. Non è un’organizzazione registrata né una specie di uccello e non accetta donazioni.';
		$org['foundingLocation']['name']  = 'Brema-Grohn, Germania';
		$org['knowsAbout']                = array( 'Tutela degli uccelli marini', 'Ecosistemi costieri', 'Mare del Nord', 'Mare dei Wadden' );
	} elseif ( 'ru' === $lang ) {
		$org['description']               = 'Grohnpetrel — предлагаемая инициатива по охране побережья и просвещению о морских птицах.';
		$org['disambiguatingDescription'] = 'Вымышленный учебный проект, созданный осенью 2026 года командой Guillemots — четырьмя студентами Constructor University в Бремене (Германия) — для курса Digital Marketing Fundamentals and Search Engine Optimisation. Это не зарегистрированная организация и не вид птиц; пожертвования не принимаются.';
		$org['foundingLocation']['name']  = 'Бремен-Грон, Германия';
		$org['knowsAbout']                = array( 'Охрана морских птиц', 'Прибрежные экосистемы', 'Северное море', 'Ваттовое море' );
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
		'questions-frequentes-grohnpetrel' => 'FAQPage',
		'domande-frequenti-grohnpetrel' => 'FAQPage',
		'chasto-zadavaemye-voprosy-grohnpetrel' => 'FAQPage',
		'grohnpetrel-videos'           => 'CollectionPage',
		'videos'                       => 'CollectionPage',
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
		$sources = grohnpetrel_schema_sources( $post->post_content );
		if ( $sources ) {
			$article['citation'] = $sources;
		}
		$graph[] = $article;
	}
	// Pages with a Sources section (seabird guides, threats) cite them too; posts do so in the Article.
	if ( 'post' !== $post->post_type ) {
		$sources = grohnpetrel_schema_sources( $post->post_content );
		if ( $sources ) {
			$page['citation'] = $sources;
		}
	}
	// Glossary pages: the terms as a DefinedTermSet.
	if ( in_array( $slug, array( 'seabird-and-coast-glossary', 'glossar-seevoegel-und-kueste' ), true ) ) {
		$set_id = $url . '#glossary';
		$terms  = array();
		foreach ( grohnpetrel_schema_glossary( $post->post_content ) as $t ) {
			$terms[] = array( '@type' => 'DefinedTerm', 'name' => $t['name'], 'description' => $t['description'], 'inDefinedTermSet' => array( '@id' => $set_id ), 'inLanguage' => $in_lang );
		}
		if ( $terms ) {
			$page['mainEntity'] = array( '@type' => 'DefinedTermSet', '@id' => $set_id, 'name' => $title, 'url' => $url, 'inLanguage' => $in_lang, 'hasDefinedTerm' => $terms );
		}
	}
	// The seabird guide overview lists its six species pages.
	$guides = array(
		'seabirds-of-the-north-sea' => array( 'northern-gannet', 'atlantic-puffin', 'black-legged-kittiwake', 'common-tern', 'eurasian-oystercatcher', 'european-storm-petrel' ),
		'seevoegel-der-nordsee'     => array( 'de/basstoelpel', 'de/papageitaucher', 'de/dreizehenmoewe', 'de/flussseeschwalbe', 'de/austernfischer', 'de/sturmschwalbe' ),
	);
	if ( isset( $guides[ $slug ] ) ) {
		$items = array();
		foreach ( $guides[ $slug ] as $path ) {
			$species = get_page_by_path( $path );
			if ( $species && 'publish' === $species->post_status ) {
				$items[] = array( '@type' => 'ListItem', 'position' => count( $items ) + 1, 'name' => wp_strip_all_tags( get_the_title( $species ) ), 'url' => get_permalink( $species ) );
			}
		}
		if ( $items ) {
			$page['mainEntity'] = array( '@type' => 'ItemList', 'numberOfItems' => count( $items ), 'itemListElement' => $items );
		}
	}
	// Every video block gets a VideoObject: name from the heading above it, description from its caption,
	// transcript from the "gp-transcript" details block that follows it, duration and size from the upload.
	// The first video keeps the id "#video"; further ones are "#video-2", "#video-3", ...
	preg_match_all( '/<video\b([^>]*)>/i', $post->post_content, $vms, PREG_OFFSET_CAPTURE | PREG_SET_ORDER );
	$vrefs = array();
	foreach ( $vms as $vi => $vm ) {
		if ( ! preg_match( '/\bsrc="([^"]+)"/', $vm[1][0], $vsrc ) ) {
			continue;
		}
		$vid    = $url . ( 0 === $vi ? '#video' : '#video-' . ( $vi + 1 ) );
		$before = substr( $post->post_content, 0, $vm[0][1] );
		$next   = isset( $vms[ $vi + 1 ] ) ? $vms[ $vi + 1 ][0][1] : strlen( $post->post_content );
		$after  = substr( $post->post_content, $vm[0][1], $next - $vm[0][1] );
		preg_match_all( '/<h[23][^>]*>(.*?)<\/h[23]>/is', $before, $vh );
		$vcap  = preg_match( '/<figcaption[^>]*>(.*?)<\/figcaption>/is', $after, $vc ) ? trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $vc[1] ) ) ) : '';
		$video = array(
			'@type'            => 'VideoObject',
			'@id'              => $vid,
			'name'             => $vh[1] ? trim( wp_strip_all_tags( end( $vh[1] ) ) ) : $title,
			'description'      => '' !== $vcap ? $vcap : $title,
			'contentUrl'       => $vsrc[1],
			'inLanguage'       => $in_lang,
			'isFamilyFriendly' => true,
			'publisher'        => array( '@id' => $org_id ),
			'uploadDate'       => $page['datePublished'],
		);
		if ( preg_match( '/\bposter="([^"]+)"/', $vm[1][0], $vposter ) ) {
			$video['thumbnailUrl'] = $vposter[1];
		}
		$vatt = attachment_url_to_postid( $vsrc[1] );
		if ( $vatt ) {
			$video['uploadDate'] = get_post_time( 'c', true, $vatt );
			$vmeta               = wp_get_attachment_metadata( $vatt );
			if ( ! empty( $vmeta['length'] ) ) {
				$video['duration'] = 'PT' . (int) $vmeta['length'] . 'S';
			}
			if ( ! empty( $vmeta['width'] ) && ! empty( $vmeta['height'] ) ) {
				$video['width']  = (int) $vmeta['width'];
				$video['height'] = (int) $vmeta['height'];
			}
		}
		if ( preg_match( '/<details[^>]*gp-transcript[^>]*>(.*?)<\/details>/is', $after, $vt ) ) {
			$video['transcript'] = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( preg_replace( '/<summary.*?<\/summary>|<\/p>/is', ' ', $vt[1] ) ) ) );
		}
		$graph[] = $video;
		$vrefs[] = array( '@id' => $vid );
	}
	if ( $vrefs ) {
		$page['video'] = 1 === count( $vrefs ) ? $vrefs[0] : $vrefs;
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
	$home_names = array( 'de' => 'Startseite', 'es' => 'Inicio', 'fr' => 'Accueil', 'it' => 'Pagina iniziale', 'ru' => 'Главная', 'zh' => '首页' );
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

	if ( in_array( $slug, array( 'what-is-grohnpetrel-2', 'was-ist-grohnpetrel', 'que-es-grohnpetrel', 'qu-est-ce-que-grohnpetrel', 'che-cos-e-grohnpetrel', 'chto-takoe-grohnpetrel', 'grohnpetrel-shi-shenme' ), true ) ) {
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
