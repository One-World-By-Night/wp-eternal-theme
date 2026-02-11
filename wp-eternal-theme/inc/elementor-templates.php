<?php
/**
 * Elementor Theme Builder default templates.
 *
 * Creates starter header and footer templates on theme activation
 * so the site has a working Elementor-designed layout out of the box.
 * Templates are only created if none exist; re-activating the theme
 * will not duplicate them.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_switch_theme', 'wp_eternal_maybe_create_elementor_templates' );

/**
 * Create default Elementor Theme Builder templates if none exist.
 */
function wp_eternal_maybe_create_elementor_templates() {
	if ( ! did_action( 'elementor/loaded' ) ) {
		return;
	}

	wp_eternal_create_template( 'header' );
	wp_eternal_create_template( 'footer' );
}

/**
 * Create a single Theme Builder template if one doesn't already exist.
 *
 * @param string $type 'header' or 'footer'.
 */
function wp_eternal_create_template( $type ) {
	$existing = get_posts( array(
		'post_type'      => 'elementor_library',
		'posts_per_page' => 1,
		'post_status'    => 'any',
		'meta_query'     => array(
			array(
				'key'   => '_elementor_template_type',
				'value' => $type,
			),
		),
	) );

	if ( ! empty( $existing ) ) {
		return;
	}

	$data_fn = "wp_eternal_{$type}_data";
	if ( ! function_exists( $data_fn ) ) {
		return;
	}

	$title = 'header' === $type
		? 'WP Eternal – Header'
		: 'WP Eternal – Footer';

	$post_id = wp_insert_post( array(
		'post_type'   => 'elementor_library',
		'post_title'  => $title,
		'post_status' => 'publish',
	) );

	if ( is_wp_error( $post_id ) ) {
		return;
	}

	update_post_meta( $post_id, '_elementor_template_type', $type );
	update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $post_id, '_elementor_version', '3.29.1' );
	update_post_meta( $post_id, '_wp_page_template', 'default' );
	update_post_meta( $post_id, '_elementor_data', wp_json_encode( $data_fn() ) );
	update_post_meta( $post_id, '_elementor_conditions', array( 'include/general' ) );
	update_post_meta( $post_id, '_elementor_page_settings', array() );

	// Register in Elementor Pro's conditions cache so templates are active immediately.
	$conditions = get_option( 'elementor_pro_theme_builder_conditions', array() );
	if ( ! isset( $conditions[ $type ] ) ) {
		$conditions[ $type ] = array();
	}
	$conditions[ $type ][ (string) $post_id ] = array( 'include/general' );
	update_option( 'elementor_pro_theme_builder_conditions', $conditions );
}

// ---------- helpers ----------

/**
 * Generate a short random ID for Elementor elements.
 *
 * @return string 7-char hex string.
 */
function wp_eternal_eid() {
	return substr( md5( wp_rand() . microtime() ), 0, 7 );
}

// ---------- header template data ----------

/**
 * Build the Elementor JSON data array for the default header.
 *
 * Structure:
 *   Section  .main--header  (full-width, fixed)
 *     └─ Column 1  .site--logo--section  →  Site Logo
 *     └─ Column 2  .heade--navbar--sec   →  Nav Menu (menu-1)
 *
 * Dark-mode toggle is handled by WP Dark Mode's floating switch.
 *
 * @return array Elementor element tree.
 */
function wp_eternal_header_data() {
	return array(
		array(
			'id'       => wp_eternal_eid(),
			'elType'   => 'section',
			'isInner'  => false,
			'settings' => array(
				'layout'          => 'full_width',
				'stretch_section' => 'section-stretched',
				'css_classes'     => 'main--header',
				'content_position' => 'middle',
				'padding'         => array(
					'unit'     => 'px',
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'isLinked' => false,
				),
			),
			'elements' => array(
				// Column 1: Logo.
				array(
					'id'       => wp_eternal_eid(),
					'elType'   => 'column',
					'isInner'  => false,
					'settings' => array(
						'_column_size' => 25,
						'_inline_size' => 25,
						'css_classes'  => 'site--logo--section',
					),
					'elements' => array(
						array(
							'id'         => wp_eternal_eid(),
							'elType'     => 'widget',
							'widgetType' => 'image',
							'isInner'    => false,
							'settings'   => array(
								'image'      => array(
									'url' => 'https://www.owbn.net/sites/all/themes/owbn_responsive/images/logo/OWBN-logo_wht-red.png',
									'id'  => '',
								),
								'image_size' => 'full',
								'width'      => array(
									'unit' => 'px',
									'size' => 150,
								),
								'align'      => 'left',
								'link_to'    => 'custom',
								'link'       => array( 'url' => home_url( '/' ) ),
							),
							'elements'   => array(),
						),
					),
				),
				// Column 2: Navigation.
				array(
					'id'       => wp_eternal_eid(),
					'elType'   => 'column',
					'isInner'  => false,
					'settings' => array(
						'_column_size' => 75,
						'_inline_size' => 75,
						'css_classes'  => 'heade--navbar--sec',
					),
					'elements' => array(
						array(
							'id'         => wp_eternal_eid(),
							'elType'     => 'widget',
							'widgetType' => 'nav-menu',
							'isInner'    => false,
							'settings'   => array(
								'menu'             => '',
								'layout'           => 'horizontal',
								'align_items'      => 'flex-end',
								'pointer'          => 'none',
								'submenu_icon'     => array(
									'value'   => 'fas fa-caret-down',
									'library' => 'fa-solid',
								),
							),
							'elements'   => array(),
						),
					),
				),
			),
		),
	);
}

// ---------- footer template data ----------

/**
 * Build the Elementor JSON data array for the default footer.
 *
 * @return array Elementor element tree.
 */
function wp_eternal_footer_data() {
	return array(
		array(
			'id'       => wp_eternal_eid(),
			'elType'   => 'section',
			'isInner'  => false,
			'settings' => array(
				'layout'          => 'full_width',
				'stretch_section' => 'section-stretched',
				'padding'         => array(
					'unit'     => 'px',
					'top'      => '20',
					'right'    => '30',
					'bottom'   => '20',
					'left'     => '30',
					'isLinked' => false,
				),
			),
			'elements' => array(
				array(
					'id'       => wp_eternal_eid(),
					'elType'   => 'column',
					'isInner'  => false,
					'settings' => array(
						'_column_size' => 100,
						'_inline_size' => 100,
					),
					'elements' => array(
						array(
							'id'         => wp_eternal_eid(),
							'elType'     => 'widget',
							'widgetType' => 'heading',
							'isInner'    => false,
							'settings'   => array(
								'title'       => '&copy; ' . gmdate( 'Y' ) . ' One World by Night',
								'header_size' => 'p',
								'align'       => 'center',
							),
							'elements'   => array(),
						),
					),
				),
			),
		),
	);
}
