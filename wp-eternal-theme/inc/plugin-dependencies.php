<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'tgmpa_register', 'wp_eternal_register_required_plugins' );

function wp_eternal_register_required_plugins() {

	$plugins = array(
		array(
			'name'     => 'Elementor',
			'slug'     => 'elementor',
			'required' => true,
		),
		array(
			'name'     => 'Elementor Pro',
			'slug'     => 'elementor-pro',
			'required' => true,
		),
		array(
			'name'     => 'WP Dark Mode',
			'slug'     => 'wp-dark-mode',
			'required' => true,
		),
		array(
			'name'     => 'BetterDocs',
			'slug'     => 'betterdocs',
			'required' => false,
		),
		array(
			'name'     => 'TablePress',
			'slug'     => 'tablepress',
			'required' => false,
		),
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
