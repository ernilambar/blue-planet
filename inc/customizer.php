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

	$wp_customize->register_control_type( 'Blue_Planet_Customize_Heading_Control' );
	$wp_customize->register_control_type( 'Blue_Planet_Customize_Dropdown_Taxonomies_Control' );

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

/**
 * Register customizer controls scripts.
 *
 * @since 3.3.0
 */
function blue_planet_customize_controls_register_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_register_script( 'blue-planet-customize-controls', get_template_directory_uri() . '/js/customize-controls' . $min . '.js', array( 'customize-controls' ), null, true );

}

add_action( 'customize_controls_enqueue_scripts', 'blue_planet_customize_controls_register_scripts', 0 );

if ( ! function_exists( 'blue_planet_customizer_reset_callback' ) ) :

	/**
	 * Callback for reset in Customizer.
	 *
	 * @since 3.4.0
	 */
	function blue_planet_customizer_reset_callback() {

		$reset_theme_settings = blue_planet_get_option( 'reset_theme_settings' );

		if ( 1 == $reset_theme_settings ) {

			// Reset custom theme options.
			set_theme_mod( 'blueplanet_options', array() );

			// Reset custom header and backgrounds.
			remove_theme_mod( 'header_image' );
			remove_theme_mod( 'header_image_data' );
			remove_theme_mod( 'background_image' );
			remove_theme_mod( 'background_color' );
		}

	}
endif;

add_action( 'customize_save_after', 'blue_planet_customizer_reset_callback' );

/**
 * Hide Custom CSS.
 *
 * @since 3.5.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blue_planet_hide_custom_css( $wp_customize ) {

	// Bail if not WP 4.7.
	if ( ! function_exists( 'wp_get_custom_css_post' ) ) {
		return;
	}

	$wp_customize->remove_control( 'blueplanet_options[custom_css]' );

}

add_action( 'customize_register', 'blue_planet_hide_custom_css', 99 );
