<?php
/**
 * Theme setup and support declarations.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', 'wp_eternal_theme_setup' );

function wp_eternal_theme_setup() {
	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable featured images.
	add_theme_support( 'post-thumbnails' );

	// Custom logo support.
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 350,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// HTML5 markup.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
		'navigation-widgets',
	) );

	// Automatic feed links.
	add_theme_support( 'automatic-feed-links' );

	// Wide alignment for block editor.
	add_theme_support( 'align-wide' );

	// Responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Editor styles.
	add_theme_support( 'editor-styles' );

	// Register navigation menus.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Header', 'wp-eternal-theme' ),
		'menu-2' => esc_html__( 'Footer', 'wp-eternal-theme' ),
	) );

	// Load text domain.
	load_theme_textdomain( 'wp-eternal-theme', WP_ETERNAL_DIR . '/languages' );
}
