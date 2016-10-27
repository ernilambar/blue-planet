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

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 3.3.0
 *
 * @return void
 */
function blue_planet_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 3.3.0
 *
 * @return void
 */
function blue_planet_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Customizer partials.
 *
 * @since 3.3.0
 */
function blue_planet_customizer_partials( WP_Customize_Manager $wp_customize ) {

    // Abort if selective refresh is not available.
    if ( ! isset( $wp_customize->selective_refresh ) ) {
        return;
    }

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

    // Partial blogname.
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'            => '.site-title a',
		'container_inclusive' => false,
		'render_callback'     => 'blue_planet_customize_partial_blogname',
    ) );

    // Partial blogdescription.
    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'            => '.site-description',
		'container_inclusive' => false,
		'render_callback'     => 'blue_planet_customize_partial_blogdescription',
    ) );
}
add_action( 'customize_register', 'blue_planet_customizer_partials', 99 );
