<?php
/**
 * Fallback footer template part.
 *
 * Displays when no Elementor Theme Builder footer is assigned.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<footer id="site-footer" role="contentinfo">
	<p><?php
		printf(
			/* translators: 1: copyright year, 2: site name */
			esc_html__( '&copy; %1$s %2$s', 'wp-eternal-theme' ),
			esc_html( gmdate( 'Y' ) ),
			esc_html( get_bloginfo( 'name' ) )
		);
	?></p>

	<?php
	if ( has_nav_menu( 'menu-2' ) ) {
		wp_nav_menu( array(
			'theme_location' => 'menu-2',
			'menu_class'     => 'footer-navigation',
			'container'      => 'nav',
			'container_aria_label' => esc_attr__( 'Footer menu', 'wp-eternal-theme' ),
			'depth'          => 1,
		) );
	}
	?>
</footer>
