<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	if ( hello_elementor_display_header_footer() ) {
		if ( did_action( 'elementor/loaded' ) && hello_header_footer_experiment_active() ) {
			get_template_part( 'template-parts/dynamic-footer' );
		} else {
			get_template_part( 'template-parts/footer' );
		}
	}
}
?>
<?php wp_footer(); ?>
<script>
jQuery(document).ready(function(){
	jQuery('.chronicle_shortcode1').css('display','block');
    if (jQuery('.User_chronicleInfo').length > 0) {
        jQuery('.arm_directory_form_top, .chronicle_shortcode2, .chroniclepage_heading').css('display','none');
    } else {
		jQuery('.chronicle_shortcode1').css('display','none');
    }
});
</script>

</body>
</html>
