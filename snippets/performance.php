<?php
/**
 * Grohnpetrel performance: page-speed fixes that need no access to the server's configuration.
 *
 * Runs on the site through the Code Snippets plugin; scripts/wp_sync.py publishes this file.
 * Edit here, not in WordPress: the next publish overwrites the snippet.
 *
 * - Small stylesheets that block the first paint (WordPress block styles) are put into the page
 *   instead of being loaded as separate files.
 * - The theme's main font is preloaded and shown with font-display: swap.
 * - WordPress's emoji script is left out (all current browsers draw emoji themselves).
 * - Images and fonts in the uploads folder get a one-year browser cache, through cache rules in
 *   wp-content/uploads/.htaccess. They are written once; if the folder stops serving files
 *   afterwards (the server does not allow these rules), they are taken out again at once.
 */

// WordPress puts small block stylesheets into the page up to this total size (default 20 kB).
add_filter( 'styles_inline_size_limit', function () {
	return 60000;
} );

// Fonts from the theme: shown with the fallback font until loaded (swap) instead of staying
// invisible for a moment, and the main font (Manrope) is requested right away.
add_filter( 'wp_theme_json_data_theme', function ( $theme_json ) {
	$data     = $theme_json->get_data();
	$families = isset( $data['settings']['typography']['fontFamilies'] ) ? $data['settings']['typography']['fontFamilies'] : null;
	if ( ! is_array( $families ) ) {
		return $theme_json;
	}
	foreach ( $families as $i => $family ) {
		if ( ! empty( $family['fontFace'] ) && is_array( $family['fontFace'] ) ) {
			foreach ( $family['fontFace'] as $j => $face ) {
				$families[ $i ]['fontFace'][ $j ]['fontDisplay'] = 'swap';
			}
		}
	}
	return $theme_json->update_with( array(
		'version'  => isset( $data['version'] ) ? $data['version'] : 3,
		'settings' => array( 'typography' => array( 'fontFamilies' => $families ) ),
	) );
} );

add_action( 'wp_head', function () {
	$font = 'assets/fonts/manrope/Manrope-VariableFont_wght.woff2';
	if ( file_exists( get_theme_file_path( $font ) ) ) {
		printf( "<link rel=\"preload\" href=\"%s\" as=\"font\" type=\"font/woff2\" crossorigin />\n", esc_url( get_theme_file_uri( $font ) ) );
	}
}, 1 );

// No emoji script and styles.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' );

// One-year browser cache for images and fonts in the uploads folder (written once, see above).
add_action( 'init', function () {
	$option = 'grohnpetrel_upload_cache_v1';
	if ( false !== get_option( $option ) ) {
		return;  // already applied, rolled back, or in progress
	}
	add_option( $option, 'pending', '', true );

	require_once ABSPATH . 'wp-admin/includes/misc.php';
	$uploads = wp_get_upload_dir();
	$dir     = trailingslashit( $uploads['basedir'] );
	$marker  = 'Grohnpetrel cache';
	$rules   = array(
		'<IfModule mod_headers.c>',
		'<FilesMatch "\.(avif|gif|ico|jpe?g|png|svg|webp|woff2?)$">',
		'Header set Cache-Control "public, max-age=31536000"',
		'</FilesMatch>',
		'</IfModule>',
	);
	if ( ! insert_with_markers( $dir . '.htaccess', $marker, $rules ) ) {
		update_option( $option, 'not writable' );
		return;
	}
	// Does the folder still serve files? If not, or if the check cannot run, take the rules out.
	$check = 'grohnpetrel-cache-check.txt';
	file_put_contents( $dir . $check, 'ok' );
	$response = wp_remote_get( trailingslashit( $uploads['baseurl'] ) . $check, array( 'timeout' => 10 ) );
	if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
		insert_with_markers( $dir . '.htaccess', $marker, array() );
		update_option( $option, 'rolled back: ' . ( is_wp_error( $response ) ? $response->get_error_message() : wp_remote_retrieve_response_code( $response ) ) );
		return;
	}
	update_option( $option, 'applied' );
} );
