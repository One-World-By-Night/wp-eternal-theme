<?php
/**
 * Elementor Theme Builder integration.
 *
 * Registers all core theme locations so Elementor Pro's Theme Builder
 * can override header, footer, single, and archive templates.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'elementor/theme/register_locations', 'wp_eternal_register_elementor_locations' );

function wp_eternal_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_all_core_location();
}
