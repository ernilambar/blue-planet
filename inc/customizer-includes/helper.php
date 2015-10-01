<?php
/**
 * Helper functions.
 *
 * @package Blue_Planet
 */

/**
 * Reset theme settings.
 *
 * @since 1.0.0
 *
 * @param int $input Input value.
 * @return bool Always false.
 */
function blue_planet_reset_all_theme_settings( $input ) {

	if ( true === $input ) {

		$defaults = blueplanet_get_default_options();
		$key      = 'blueplanet_options';

		set_theme_mod( $key, $defaults );

	}
	return false;

}

/**
 * Sanitize checkbox for output.
 *
 * Customizer check callback: DB  -> Customizer.
 *
 * @since 1.0.0
 *
 * @param bool $input Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function blue_planet_sanitize_checkbox_output( $input ) {

	if ( 1 === $input ) {
		$input = true;
	} else {
		$input = false;
	}
	return $input;
}

/**
 * Sanitize checkbox for input.
 *
 * Customizer check callback: Customizer  -> DB.
 *
 * @since 1.0.0
 *
 * @param bool $input Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function blue_planet_sanitize_checkbox_input( $input ) {

	if ( true === $input ) {
		$input = 1;
	} else {
		$input = 0;
	}
	return $input;
}

/**
 * Check if footer widget is active
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blue_planet_check_footer_widgets_status_cb( $control ) {

	if ( true === $control->manager->get_setting( 'blueplanet_options[flg_enable_footer_widgets]' )->value() ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Check if main slider is enabled
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blue_planet_check_main_slider_status_cb( $control ) {

	$current_value = $control->manager->get_setting( 'blueplanet_options[slider_status]' )->value();
	if ( in_array( $current_value, array( 'home', 'all' ) ) ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Check if secondary slider is enabled
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blue_planet_check_secondary_slider_status_cb( $control ) {

	if ( 'home' === $control->manager->get_setting( 'blueplanet_options[slider_status_2]' )->value() ) {
		return true;
	} else {
		return false;
	}

}

if ( ! function_exists( 'blue_planet_get_slider_transition_effects' ) ) :

	/**
	 * Returns the slider transition effects.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options.
	 */
	function blue_planet_get_slider_transition_effects() {

		$choices = array(
			'boxRain'            => __( 'boxRain', 'blue-planet' ),
			'boxRainGrow'        => __( 'boxRainGrow', 'blue-planet' ),
			'boxRainReverse'     => __( 'boxRainReverse', 'blue-planet' ),
			'boxRainGrowReverse' => __( 'boxRainGrowReverse', 'blue-planet' ),
			'boxRandom'          => __( 'boxRandom', 'blue-planet' ),
			'fade'               => __( 'fade', 'blue-planet' ),
			'fold'               => __( 'fold', 'blue-planet' ),
			'random'             => __( 'random', 'blue-planet' ),
			'sliceDown'          => __( 'sliceDown', 'blue-planet' ),
			'sliceDownLeft'      => __( 'sliceDownLeft', 'blue-planet' ),
			'sliceUp'            => __( 'sliceUp', 'blue-planet' ),
			'sliceUpDown'        => __( 'sliceUpDown', 'blue-planet' ),
			'sliceUpDownLeft'    => __( 'sliceUpDownLeft', 'blue-planet' ),
			'slideInRight'       => __( 'slideInRight', 'blue-planet' ),
			'slideInLeft'        => __( 'slideInLeft', 'blue-planet' ),
		);
		$output = apply_filters( 'blue_planet_filter_slider_transition_effects', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'blue_planet_get_on_off_options' ) ) :

	/**
	 * Returns on off options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options.
	 */
	function blue_planet_get_on_off_options() {

		$choices = array(
		'1' => __( 'On', 'blue-planet' ),
		'0' => __( 'Off', 'blue-planet' ),
		);
		return $choices;

	}

endif;


if ( ! function_exists( 'blue_planet_get_show_hide_options' ) ) :

	/**
	 * Returns show hide options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options.
	 */
	function blue_planet_get_show_hide_options() {

		$choices = array(
			'1' => __( 'Show', 'blue-planet' ),
			'0' => __( 'Hide', 'blue-planet' ),
		);
		return $choices;

	}

endif;


if ( ! function_exists( 'blue_planet_sanitize_number_absint' ) ) :

	/**
	 * Sanitize positive integer.
	 *
	 * @since 1.0.0
	 *
	 * @param int                  $input Number to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return int Sanitized number; otherwise, the setting default.
	 */
	function blue_planet_sanitize_number_absint( $input, $setting ) {

		$input = absint( $input );
		return ( $input ? $input : $setting->default );

	}

endif;


if ( ! function_exists( 'blue_planet_sanitize_select' ) ) :

	/**
	 * Sanitize select.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed                $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
	 */
	function blue_planet_sanitize_select( $input, $setting ) {

		$input = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;
