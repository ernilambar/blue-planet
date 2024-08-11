<?php
/**
 * Theme Customizer
 *
 * @package Blue_Planet
 */

// Customizer helper functions.
require_once get_template_directory() . '/inc/customizer-includes/helper.php';

/**
 * Register custom controls, settings and options.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blue_planet_customize_register( $wp_customize ) {
	$new_defaults = blue_planet_get_default_options();
	$options      = blue_planet_get_option_all();

	// Custom Controls.
	require_once get_template_directory() . '/inc/controls/class-heading-control.php';
	require_once get_template_directory() . '/inc/controls/class-dropdown-taxonomies-control.php';

	$wp_customize->register_control_type( 'Blue_Planet_Customize_Heading_Control' );
	$wp_customize->register_control_type( 'Blue_Planet_Customize_Dropdown_Taxonomies_Control' );

	// Theme Settings.
	require_once get_template_directory() . '/inc/customizer-includes/theme.php';

	// Slider Settings.
	require_once get_template_directory() . '/inc/customizer-includes/slider.php';

	// Reset Settings.
	require_once get_template_directory() . '/inc/customizer-includes/reset.php';
}

add_action( 'customize_register', 'blue_planet_customize_register' );

/**
 * Customizer partials.
 *
 * @since 3.3.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blue_planet_customizer_partials( WP_Customize_Manager $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Partial blogname.
	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'            => '.site-title a',
			'container_inclusive' => false,
			'render_callback'     => function () {
				bloginfo( 'name' );
			},
		)
	);

	// Partial blogdescription.
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'            => '.site-description',
			'container_inclusive' => false,
			'render_callback'     => function () {
				bloginfo( 'description' );
			},
		)
	);
}

add_action( 'customize_register', 'blue_planet_customizer_partials', 99 );

/**
 * Register customizer controls scripts.
 *
 * @since 3.3.0
 */
function blue_planet_customize_controls_register_scripts() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_register_script( 'blue-planet-customize-controls', get_template_directory_uri() . '/js/customize-controls' . $min . '.js', array( 'customize-controls' ), BLUE_PLANET_VERSION, true );
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

		if ( 1 === $reset_theme_settings ) {
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
