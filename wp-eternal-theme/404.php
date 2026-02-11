<?php
/**
 * 404 Not Found template.
 *
 * @package WPEternalTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content" role="main">
	<h1><?php esc_html_e( 'Page Not Found', 'wp-eternal-theme' ); ?></h1>
	<p><?php esc_html_e( 'The page you are looking for could not be found. Please check the URL or navigate back to the homepage.', 'wp-eternal-theme' ); ?></p>
</main>

<?php
get_footer();
