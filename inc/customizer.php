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

	$new_defaults = blueplanet_get_default_options();
	$options = blueplanet_get_option_all();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

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

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blue_planet_customize_preview_js() {
	wp_enqueue_script( 'blue_planet_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'blue_planet_customize_preview_js' );
