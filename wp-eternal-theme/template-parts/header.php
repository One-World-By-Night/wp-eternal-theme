<?php
/**
 * Fallback header template part.
 *
 * Displays when no Elementor Theme Builder header is assigned.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<header id="site-header" role="banner">
	<div class="site-branding">
		<?php
		if ( has_custom_logo() ) {
			the_custom_logo();
		} else {
			?>
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php bloginfo( 'name' ); ?>
				</a>
			</h1>
			<?php
		}
		?>
	</div>

	<?php
	if ( has_nav_menu( 'menu-1' ) ) {
		wp_nav_menu( array(
			'theme_location' => 'menu-1',
			'menu_class'     => 'main-navigation',
			'container'      => 'nav',
			'container_aria_label' => esc_attr__( 'Primary menu', 'wp-eternal-theme' ),
		) );
	}
	?>
</header>
