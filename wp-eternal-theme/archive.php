<?php
/**
 * Archive/listing fallback template.
 *
 * Elementor Theme Builder overrides this via the 'archive' location.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'archive' ) ) {
	// Elementor handles the content.
} else {
	?>
	<main id="content" role="main">
		<header>
			<?php the_archive_title( '<h1>', '</h1>' ); ?>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
		</header>

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div>
				</article>
				<?php
			endwhile;

			the_posts_navigation();
		else :
			?>
			<p><?php esc_html_e( 'No posts found.', 'wp-eternal-theme' ); ?></p>
		<?php endif; ?>
	</main>
	<?php
}

get_footer();
