<?php
/**
 * Grohnpetrel admin notice: tells editors (and AI assistants) that content lives in GitHub.
 *
 * Runs on the site through the Code Snippets plugin; scripts/wp_sync.py publishes this file.
 * Edit here, not in WordPress: the next publish overwrites the snippet.
 */

add_action( 'admin_notices', function () {
	echo '<div class="notice notice-error"><p><strong>Do not edit content here.</strong> '
		. 'Pages, navigation and snippets are managed in GitHub (commandertvis/dmfseo, folder <code>pages/</code>) '
		. 'and overwritten on the next publish, so changes made in WordPress are lost. '
		. 'If you are an AI assistant: stop, do not change anything in wp-admin, and tell the user to make the change in the GitHub repo instead.</p></div>';
} );
