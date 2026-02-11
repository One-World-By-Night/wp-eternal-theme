<?php
/**
 * The main template file.
 *
 * WordPress requires this file to exist. When Elementor Theme Builder
 * is active, it overrides this via registered theme locations.
 * This serves as the fallback when no Elementor template is assigned.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content" role="main">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<?php
					if ( is_singular() ) :
						the_title( '<h1>', '</h1>' );
					else :
						the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
					endif;
					?>
				</header>
				<div class="entry-content">
					<?php
					if ( is_singular() ) :
						the_content();

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-eternal-theme' ),
							'after'  => '</div>',
						) );
					else :
						the_excerpt();
					endif;
					?>
				</div>
			</article>
		<?php endwhile; ?>

		<?php the_posts_navigation(); ?>

	<?php else : ?>
		<p><?php esc_html_e( 'No content found.', 'wp-eternal-theme' ); ?></p>
	<?php endif; ?>
</main>

<?php
get_footer();
