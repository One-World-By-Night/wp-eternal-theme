<?php
/**
 * Plugin dependency declarations via TGM Plugin Activation.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'tgmpa_register', 'wp_eternal_register_required_plugins' );

function wp_eternal_register_required_plugins() {

	$plugins = array(

		// Required: the theme is built for Elementor page building.
		array(
			'name'     => 'Elementor',
			'slug'     => 'elementor',
			'required' => true,
		),

		// Required: Theme Builder locations (header/footer/single/archive).
		array(
			'name'     => 'Elementor Pro',
			'slug'     => 'elementor-pro',
			'required' => true,
		),

		// Required: dark/light mode toggle with extensive CSS integration.
		array(
			'name'     => 'WP Dark Mode',
			'slug'     => 'wp-dark-mode',
			'required' => true,
		),

		// Recommended: documentation post type with author-scoped admin filtering.
		array(
			'name'     => 'BetterDocs',
			'slug'     => 'betterdocs',
			'required' => false,
		),

		// Recommended: table management with author-scoped access control.
		array(
			'name'     => 'TablePress',
			'slug'     => 'tablepress',
			'required' => false,
		),

		// Recommended: accessibility toolbar with OpenDyslexic font support.
		array(
			'name'     => 'Open Accessibility',
			'slug'     => 'open-accessibility',
			'required' => false,
		),
	);

	$config = array(
		'id'           => 'wp-eternal-theme',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
