<?php
/**
 * The template for displaying comments.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			printf(
				/* translators: 1: comment count, 2: post title */
				esc_html( _n(
					'%1$s comment on &ldquo;%2$s&rdquo;',
					'%1$s comments on &ldquo;%2$s&rdquo;',
					$comment_count,
					'wp-eternal-theme'
				) ),
				esc_html( number_format_i18n( $comment_count ) ),
				esc_html( get_the_title() )
			);
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
			) );
			?>
		</ol>

		<?php
		the_comments_navigation();
	endif;

	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'wp-eternal-theme' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</div>
