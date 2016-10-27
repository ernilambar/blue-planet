<?php
/**
 * Theme Customizer.
 *
 * @package Blue_Planet
 */

// Customizer helper functions.
require get_template_directory() . '/inc/customizer-includes/helper.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blue_planet_customize_register( $wp_customize ) {

	$new_defaults = blue_planet_get_default_options();
	$options = blue_planet_get_option_all();

	// Custom Controls.
	require get_template_directory() . '/inc/customizer-includes/controls.php';

	// Theme Settings.
	require get_template_directory() . '/inc/customizer-includes/theme.php';

	// Slider Settings.
	require get_template_directory() . '/inc/customizer-includes/slider.php';

	// Reset Settings.
	require get_template_directory() . '/inc/customizer-includes/reset.php';

}

add_action( 'customize_register', 'blue_planet_customize_register' );
