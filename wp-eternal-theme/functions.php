<?php
/**
 * WP Eternal Theme - Functions and definitions.
 *
 * @package WPEternalTheme
 * @version 2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WP_ETERNAL_VERSION', '2.1.2' );
define( 'WP_ETERNAL_DIR', get_template_directory() );
define( 'WP_ETERNAL_URI', get_template_directory_uri() );

// Core theme setup.
require_once WP_ETERNAL_DIR . '/inc/theme-setup.php';
require_once WP_ETERNAL_DIR . '/inc/enqueue.php';
require_once WP_ETERNAL_DIR . '/inc/elementor.php';
require_once WP_ETERNAL_DIR . '/inc/elementor-templates.php';

// Plugin dependency notices.
require_once WP_ETERNAL_DIR . '/inc/tgm/class-tgm-plugin-activation.php';
require_once WP_ETERNAL_DIR . '/inc/plugin-dependencies.php';

// Optional plugin integrations (each file gates itself).
require_once WP_ETERNAL_DIR . '/inc/betterdocs.php';
require_once WP_ETERNAL_DIR . '/inc/tablepress.php';
require_once WP_ETERNAL_DIR . '/inc/admin.php';
