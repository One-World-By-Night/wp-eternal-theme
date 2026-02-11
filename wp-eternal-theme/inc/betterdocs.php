<?php
/**
 * Optional BetterDocs integration.
 *
 * Provides author-scoped doc categories, tags, and post filtering
 * in the WordPress admin. All hooks are gated behind a post_type_exists
 * check so the theme works cleanly without BetterDocs installed.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'wp_eternal_init_betterdocs', 20 );

function wp_eternal_init_betterdocs() {
	if ( ! post_type_exists( 'docs' ) ) {
		return;
	}

	// Term fields for doc_category.
	add_action( 'doc_category_add_form_fields', 'wp_eternal_doc_category_add_fields' );
	add_action( 'created_doc_category', 'wp_eternal_doc_category_save_fields' );

	// Term fields for doc_tag.
	add_action( 'doc_tag_add_form_fields', 'wp_eternal_doc_tag_add_fields' );
	add_action( 'created_doc_tag', 'wp_eternal_doc_tag_save_fields' );

	// Filter terms for authors.
	add_action( 'pre_get_terms', 'wp_eternal_filter_doc_terms' );

	// Meta box for docs.
	add_action( 'add_meta_boxes', 'wp_eternal_docs_meta_box' );
	add_action( 'save_post_docs', 'wp_eternal_docs_meta_save' );

	// Filter docs list for authors.
	add_action( 'pre_get_posts', 'wp_eternal_filter_docs_list' );
	add_filter( 'views_edit-docs', 'wp_eternal_docs_views_counts' );

	// BetterDocs admin redirect.
	add_action( 'admin_init', 'wp_eternal_betterdocs_redirect' );
}

// --- Doc Category Term Fields ---

function wp_eternal_doc_category_add_fields( $taxonomy ) {
	$current_user_id = get_current_user_id();
	echo '<div class="form-field">';
	echo '<input type="hidden" name="user_id_text" id="user_id_text" value="' . esc_attr( $current_user_id ) . '" />';
	wp_nonce_field( 'wp_eternal_doc_cat_nonce_action', 'wp_eternal_doc_cat_nonce' );
	echo '</div>';
}

function wp_eternal_doc_category_save_fields( $term_id ) {
	if ( ! isset( $_POST['wp_eternal_doc_cat_nonce'] )
		|| ! wp_verify_nonce(
			sanitize_text_field( wp_unslash( $_POST['wp_eternal_doc_cat_nonce'] ) ),
			'wp_eternal_doc_cat_nonce_action'
		)
	) {
		return;
	}

	if ( isset( $_POST['user_id_text'] ) ) {
		update_term_meta(
			$term_id,
			'user_id_text',
			absint( $_POST['user_id_text'] )
		);
	}
}

// --- Doc Tag Term Fields ---

function wp_eternal_doc_tag_add_fields( $taxonomy ) {
	$current_user_id = get_current_user_id();
	echo '<div class="form-field">';
	echo '<input type="hidden" name="user_id_text_tag" id="user_id_text_tag" value="' . esc_attr( $current_user_id ) . '" />';
	wp_nonce_field( 'wp_eternal_doc_tag_nonce_action', 'wp_eternal_doc_tag_nonce' );
	echo '</div>';
}

function wp_eternal_doc_tag_save_fields( $term_id ) {
	if ( ! isset( $_POST['wp_eternal_doc_tag_nonce'] )
		|| ! wp_verify_nonce(
			sanitize_text_field( wp_unslash( $_POST['wp_eternal_doc_tag_nonce'] ) ),
			'wp_eternal_doc_tag_nonce_action'
		)
	) {
		return;
	}

	if ( isset( $_POST['user_id_text_tag'] ) ) {
		update_term_meta(
			$term_id,
			'user_id_text_tag',
			absint( $_POST['user_id_text_tag'] )
		);
	}
}

// --- Filter Terms for Authors ---

function wp_eternal_filter_doc_terms( $query ) {
	if ( ! is_admin() ) {
		return;
	}

	$current_user = wp_get_current_user();
	if ( ! in_array( 'author', (array) $current_user->roles, true ) ) {
		return;
	}

	$taxonomy = isset( $_GET['taxonomy'] )
		? sanitize_key( wp_unslash( $_GET['taxonomy'] ) )
		: '';

	if ( 'doc_category' === $taxonomy ) {
		$query->query_vars['meta_query'] = array(
			array(
				'key'     => 'user_id_text',
				'value'   => $current_user->ID,
				'compare' => '=',
			),
		);
	} elseif ( 'doc_tag' === $taxonomy ) {
		$query->query_vars['meta_query'] = array(
			array(
				'key'     => 'user_id_text_tag',
				'value'   => $current_user->ID,
				'compare' => '=',
			),
		);
	}
}

// --- Meta Box for User ID on Docs ---

function wp_eternal_docs_meta_box() {
	add_meta_box(
		'wp_eternal_post_user_id',
		__( 'User Id', 'wp-eternal-theme' ),
		'wp_eternal_docs_meta_callback',
		'docs',
		'normal',
		'default'
	);
}

function wp_eternal_docs_meta_callback( $post ) {
	wp_nonce_field( 'wp_eternal_docs_meta_nonce_action', 'wp_eternal_docs_meta_nonce' );

	$value = get_post_meta( $post->ID, 'post_created_by_user_id', true );

	echo '<label style="display:none;" for="wp_eternal_user_id_field">'
		. esc_html__( 'User Id:', 'wp-eternal-theme' ) . '</label>';

	if ( $value ) {
		echo '<input type="text" readonly id="wp_eternal_user_id_field"'
			. ' name="post_created_by_user_id" value="'
			. esc_attr( $value ) . '" style="width:100%; display:none;" />';
	} else {
		echo '<input type="text" readonly id="wp_eternal_user_id_field"'
			. ' name="post_created_by_user_id" value="'
			. esc_attr( get_current_user_id() ) . '" style="width:100%;" />';
	}
}

function wp_eternal_docs_meta_save( $post_id ) {
	if ( ! isset( $_POST['wp_eternal_docs_meta_nonce'] )
		|| ! wp_verify_nonce(
			sanitize_text_field( wp_unslash( $_POST['wp_eternal_docs_meta_nonce'] ) ),
			'wp_eternal_docs_meta_nonce_action'
		)
	) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['post_created_by_user_id'] ) ) {
		update_post_meta(
			$post_id,
			'post_created_by_user_id',
			absint( $_POST['post_created_by_user_id'] )
		);
	}
}

// --- Filter Docs List for Authors ---

function wp_eternal_filter_docs_list( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	$post_type = isset( $_GET['post_type'] )
		? sanitize_key( wp_unslash( $_GET['post_type'] ) )
		: '';

	if ( 'docs' !== $post_type ) {
		return;
	}

	$current_user = wp_get_current_user();
	if ( ! in_array( 'author', (array) $current_user->roles, true ) ) {
		return;
	}

	$query->set( 'meta_query', array(
		array(
			'key'     => 'post_created_by_user_id',
			'value'   => get_current_user_id(),
			'compare' => '=',
		),
	) );
}

// --- Docs Views Counts ---

function wp_eternal_docs_views_counts( $views ) {
	$current_user = wp_get_current_user();
	if ( ! in_array( 'author', (array) $current_user->roles, true ) ) {
		return $views;
	}

	global $wpdb;

	$meta_key   = 'post_created_by_user_id';
	$meta_value = get_current_user_id();
	$post_type  = 'docs';

	$all_posts = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT COUNT(DISTINCT p.ID)
			FROM $wpdb->posts p
			INNER JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
			WHERE p.post_type = %s
			AND p.post_status IN ('publish', 'draft', 'pending', 'future', 'private')
			AND pm.meta_key = %s
			AND pm.meta_value = %d",
			$post_type,
			$meta_key,
			$meta_value
		)
	);

	$all_published = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT COUNT(DISTINCT p.ID)
			FROM $wpdb->posts p
			INNER JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
			WHERE p.post_type = %s
			AND p.post_status = 'publish'
			AND pm.meta_key = %s
			AND pm.meta_value = %d",
			$post_type,
			$meta_key,
			$meta_value
		)
	);

	$all_draft = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT COUNT(DISTINCT p.ID)
			FROM $wpdb->posts p
			INNER JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
			WHERE p.post_type = %s
			AND p.post_status = 'draft'
			AND pm.meta_key = %s
			AND pm.meta_value = %d",
			$post_type,
			$meta_key,
			$meta_value
		)
	);

	$all_trash = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT COUNT(DISTINCT p.ID)
			FROM $wpdb->posts p
			INNER JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
			WHERE p.post_type = %s
			AND p.post_status = 'trash'
			AND pm.meta_key = %s
			AND pm.meta_value = %d",
			$post_type,
			$meta_key,
			$meta_value
		)
	);

	if ( isset( $views['all'] ) ) {
		$views['all'] = preg_replace( '/\(\d+\)/', '(' . intval( $all_posts ) . ')', $views['all'] );
	}
	if ( isset( $views['mine'] ) ) {
		$views['mine'] = preg_replace( '/\(\d+\)/', '(' . intval( $all_posts ) . ')', $views['mine'] );
	}
	if ( isset( $views['publish'] ) ) {
		$views['publish'] = preg_replace( '/\(\d+\)/', '(' . intval( $all_published ) . ')', $views['publish'] );
	}
	if ( isset( $views['draft'] ) ) {
		$views['draft'] = preg_replace( '/\(\d+\)/', '(' . intval( $all_draft ) . ')', $views['draft'] );
	}
	if ( isset( $views['trash'] ) ) {
		$views['trash'] = preg_replace( '/\(\d+\)/', '(' . intval( $all_trash ) . ')', $views['trash'] );
	}

	return $views;
}

// --- BetterDocs Admin Redirect ---

function wp_eternal_betterdocs_redirect() {
	if ( ! is_admin() ) {
		return;
	}

	$page = isset( $_GET['page'] )
		? sanitize_text_field( wp_unslash( $_GET['page'] ) )
		: '';

	if ( 'betterdocs-admin' === $page ) {
		wp_safe_redirect( admin_url( 'edit.php?post_type=docs&bdocs_view=classic' ) );
		exit;
	}
}
