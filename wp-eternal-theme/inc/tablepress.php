<?php
/**
 * Optional TablePress integration.
 *
 * Restricts table editing/deletion to table authors and admins.
 * Provides client-side filtering of tables in the admin list.
 * All hooks are gated behind class_exists('TablePress').
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'plugins_loaded', 'wp_eternal_init_tablepress' );

function wp_eternal_init_tablepress() {
	if ( ! class_exists( 'TablePress' ) ) {
		return;
	}

	add_filter( 'tablepress_user_can_edit_table', 'wp_eternal_restrict_tablepress_edit', 10, 2 );
	add_filter( 'tablepress_user_can_delete_table', 'wp_eternal_restrict_tablepress_delete', 10, 2 );
	add_action( 'admin_enqueue_scripts', 'wp_eternal_tablepress_admin_script' );
}

function wp_eternal_restrict_tablepress_edit( $edit_access, $table_id ) {
	if ( ! class_exists( 'TablePress' ) || ! isset( TablePress::$model_table ) ) {
		return $edit_access;
	}

	$current_user_id = get_current_user_id();
	$table           = TablePress::$model_table->load( $table_id );

	if ( is_wp_error( $table ) ) {
		return $edit_access;
	}

	if ( (string) $table['author'] !== (string) $current_user_id && ! current_user_can( 'manage_options' ) ) {
		$edit_access = false;
	}

	return $edit_access;
}

function wp_eternal_restrict_tablepress_delete( $delete_access, $table_id ) {
	if ( ! class_exists( 'TablePress' ) || ! isset( TablePress::$model_table ) ) {
		return $delete_access;
	}

	$current_user_id = get_current_user_id();
	$table           = TablePress::$model_table->load( $table_id );

	if ( is_wp_error( $table ) ) {
		return $delete_access;
	}

	if ( (string) $table['author'] !== (string) $current_user_id && ! current_user_can( 'manage_options' ) ) {
		$delete_access = false;
	}

	return $delete_access;
}

function wp_eternal_tablepress_admin_script() {
	wp_enqueue_script(
		'wp-eternal-admin-tablepress',
		WP_ETERNAL_URI . '/admin-js/custom-admin.js',
		array( 'jquery' ),
		WP_ETERNAL_VERSION,
		true
	);

	$current_user = wp_get_current_user();
	wp_localize_script(
		'wp-eternal-admin-tablepress',
		'customAdminData',
		array(
			'display_name' => esc_js( $current_user->display_name ),
			'user_role'    => in_array( 'author', (array) $current_user->roles, true ),
		)
	);
}
