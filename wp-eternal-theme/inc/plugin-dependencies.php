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

add_action( 'admin_notices', 'wp_eternal_elementor_pro_notice' );

/**
 * Tells admins who can install plugins to install or activate Elementor Pro, which the plugin installer can't fetch: it
 * isn't in the WordPress plugin directory. Shown on the Dashboard, the Plugins screen and Install Required Plugins.
 */
function wp_eternal_elementor_pro_notice() {
	if ( defined( 'ELEMENTOR_PRO_VERSION' ) || ! current_user_can( 'install_plugins' ) ) {
		return;
	}
	$screen = get_current_screen();
	if ( ! $screen || ! in_array( $screen->id, array( 'dashboard', 'plugins', 'appearance_page_tgmpa-install-plugins' ), true ) ) {
		return;
	}
	$message = file_exists( WP_PLUGIN_DIR . '/elementor-pro/elementor-pro.php' )
		? __( 'WP Eternal Theme needs Elementor Pro for its header and footer. Activate it on the Plugins screen.', 'wp-eternal-theme' )
		: __( 'WP Eternal Theme needs Elementor Pro for its header and footer. It isn\'t in the WordPress plugin directory: upload its zip from Plugins → Add New → Upload Plugin, then activate it.', 'wp-eternal-theme' );
	echo '<div class="notice notice-warning"><p>' . esc_html( $message ) . '</p></div>';
}
