<?php
/**
 * Single post/page fallback template.
 *
 * Elementor Theme Builder overrides this via the 'single' location.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'single' ) ) {
	// Elementor handles the content.
} else {
	while ( have_posts() ) :
		the_post();
		?>
		<main id="content" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<?php the_title( '<h1>', '</h1>' ); ?>
				</header>
				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-eternal-theme' ),
						'after'  => '</div>',
					) );
					?>
				</div>
			</article>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</main>
		<?php
	endwhile;
}

get_footer();
