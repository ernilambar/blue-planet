<?php
/**
 * Helper functions.
 *
 * @package Blue_Planet
 */

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
			'boxRain'            => _x( 'boxRain', 'Transition Effect', 'blue-planet' ),
			'boxRainGrow'        => _x( 'boxRainGrow', 'Transition Effect', 'blue-planet' ),
			'boxRainReverse'     => _x( 'boxRainReverse', 'Transition Effect', 'blue-planet' ),
			'boxRainGrowReverse' => _x( 'boxRainGrowReverse', 'Transition Effect', 'blue-planet' ),
			'boxRandom'          => _x( 'boxRandom', 'Transition Effect', 'blue-planet' ),
			'fade'               => _x( 'fade', 'Transition Effect', 'blue-planet' ),
			'fold'               => _x( 'fold', 'Transition Effect', 'blue-planet' ),
			'random'             => _x( 'random', 'Transition Effect', 'blue-planet' ),
			'sliceDown'          => _x( 'sliceDown', 'Transition Effect', 'blue-planet' ),
			'sliceDownLeft'      => _x( 'sliceDownLeft', 'Transition Effect', 'blue-planet' ),
			'sliceUp'            => _x( 'sliceUp', 'Transition Effect', 'blue-planet' ),
			'sliceUpDown'        => _x( 'sliceUpDown', 'Transition Effect', 'blue-planet' ),
			'sliceUpDownLeft'    => _x( 'sliceUpDownLeft', 'Transition Effect', 'blue-planet' ),
			'slideInRight'       => _x( 'slideInRight', 'Transition Effect', 'blue-planet' ),
			'slideInLeft'        => _x( 'slideInLeft', 'Transition Effect', 'blue-planet' ),
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

		$input = esc_attr( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;

if ( ! function_exists( 'blue_planet_get_image_alignment_options' ) ) :

	/**
	 * Returns image options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function blue_planet_get_image_alignment_options() {

		$choices = array(
			'none'   => _x( 'None', 'Alignment', 'blue-planet' ),
			'left'   => _x( 'Left', 'Alignment', 'blue-planet' ),
			'center' => _x( 'Center', 'Alignment', 'blue-planet' ),
			'right'  => _x( 'Right', 'Alignment', 'blue-planet' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'blue_planet_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $add_disable True for adding No Image option.
	 * @param array $allowed Allowed image size options.
	 * @param bool  $show_dimension True for displaying dimension.
	 * @return array Image size options.
	 */
	function blue_planet_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {

		global $_wp_additional_image_sizes;
		$get_intermediate_image_sizes = get_intermediate_image_sizes();
		$choices = array();
		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'blue-planet' );
		}
		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'blue-planet' );
		$choices['medium']    = esc_html__( 'Medium', 'blue-planet' );
		$choices['large']     = esc_html__( 'Large', 'blue-planet' );
		$choices['full']      = esc_html__( 'Full (original)', 'blue-planet' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ) {
					$choices[ $key ] .= ' ('. $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;

	}

endif;
