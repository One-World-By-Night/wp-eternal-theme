<?php
/**
 * Enqueue theme styles and scripts.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts', 'wp_eternal_enqueue_assets' );

function wp_eternal_enqueue_assets() {
	// Theme stylesheet.
	wp_enqueue_style(
		'wp-eternal-style',
		get_stylesheet_uri(),
		array(),
		WP_ETERNAL_VERSION
	);

	// Frontend JavaScript.
	wp_enqueue_script(
		'wp-eternal-theme-js',
		WP_ETERNAL_URI . '/assets/js/theme.js',
		array( 'jquery' ),
		WP_ETERNAL_VERSION,
		true
	);
}

add_action( 'admin_enqueue_scripts', 'wp_eternal_admin_styles' );

function wp_eternal_admin_styles() {
	wp_enqueue_style(
		'wp-eternal-admin-style',
		WP_ETERNAL_URI . '/admin-style.css',
		array(),
		WP_ETERNAL_VERSION
	);
}
