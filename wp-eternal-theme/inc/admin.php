<?php
/**
 * Admin menu customizations.
 *
 * Hides admin menu items from non-admin users.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_menu', 'wp_eternal_hide_admin_menus', 999 );

function wp_eternal_hide_admin_menus() {
	if ( current_user_can( 'manage_options' ) ) {
		return;
	}

	remove_menu_page( 'tools.php' );
	remove_menu_page( 'edit.php?post_type=elementor_library' );
}
