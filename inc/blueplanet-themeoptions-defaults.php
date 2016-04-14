<?php
/**
 * Theme defaults.
 *
 * Set the default values for all the settings. If no user-defined values is available for any setting, these defaults will be used.
 *
 * @package Blue_Planet
 */

/**
 * Get theme option.
 *
 * @since 3.0.0
 *
 * @param string $key Option key.
 * @return mixed Option value.
 */
function blue_planet_get_option( $key ) {

	$defaults = blue_planet_get_default_options();
	$options = blue_planet_get_option_all();

	$output = '';

	if ( array_key_exists( $key,  $defaults ) ) {
		$output = $defaults[ $key ];
	}

	if ( array_key_exists( $key,  $options ) ) {
		$output = $options[ $key ];
	}
	return $output;

}

/**
 * Get all theme options.
 *
 * @since 3.0.0
 *
 * @return array Theme options.
 */
function blue_planet_get_option_all() {

	$defaults = blue_planet_get_default_options();

	$output = get_theme_mod( 'blueplanet_options', $defaults );

	$output = array_merge( $defaults, $output );

	return $output;

}

/**
 * Get default theme options.
 *
 * @since 3.0.0
 *
 * @return array Default theme options.
 */
function blue_planet_get_default_options() {

	$defaults = array(
		'custom_css'                   => '',
		'flg_enable_goto_top'          => 1,
		'banner_background_color'      => '#00ADB3',
		'search_placeholder'           => esc_html__( 'Search...', 'blue-planet' ),
		'flg_hide_search_box'          => 1,
		'flg_hide_social_icons'        => 1,
		'copyright_text'               => esc_html__( 'Copyright &copy; All Rights Reserved.', 'blue-planet' ),
		'flg_hide_powered_by'          => 0,
		'flg_hide_footer_social_icons' => 0,
		'default_layout'               => 'right-sidebar',
		'content_layout'               => 'excerpt', // Archive layout.
		'archive_image'                => 'large',
		'archive_image_alignment'      => 'center',
		'single_image'                 => 'large',
		'single_image_alignment'       => 'center',
		'read_more_text'               => esc_html__( 'Read more', 'blue-planet' ),
		'excerpt_length'               => 50,
		'slider_status'                => 'none',
		'transition_effect'            => 'fade',
		'direction_nav'                => 1,
		'slider_autoplay'              => 1,
		'transition_delay'             => 4,
		'transition_length'            => 1,
		'main_slider_image'            => array(),
		'main_slider_caption'          => array(),
		'main_slider_url'              => array(),
		'main_slider_new_tab'          => array(),
		'slider_status_2'              => 'none',
		'number_of_slides_2'           => 3,
		'slider_category_2'            => '',
		'control_nav_2'                => 1,
		'direction_nav_2'              => 1,
		'transition_effect_2'          => 'fade',
		'slider_autoplay_2'            => 1,
		'slider_caption_2'             => 1,
		'transition_delay_2'           => 4,
		'transition_length_2'          => 1,
		'social_facebook'              => '',
		'social_twitter'               => '',
		'social_googleplus'            => '',
		'social_youtube'               => '',
		'social_pinterest'             => '',
		'social_linkedin'              => '',
		'social_vimeo'                 => '',
		'social_flickr'                => '',
		'social_tumblr'                => '',
		'social_dribbble'              => '',
		'social_deviantart'            => '',
		'social_rss'                   => '',
		'social_instagram'             => '',
		'social_skype'                 => '',
		'social_500px'                 => '',
		'social_email'                 => '',
		'social_forrst'                => '',
		'social_stumbleupon'           => '',
		'social_digg'                  => '',

		'reset_theme_settings'         => 0,
	);

	for ( $i = 1; $i <= 5 ; $i++ ) {
		$defaults[ 'main_slider_image_' . $i ]   = '';
		$defaults[ 'main_slider_url_' . $i ]     = '';
		$defaults[ 'main_slider_caption_' . $i ] = '';
		$defaults[ 'main_slider_new_tab_' . $i ] = 0;
	}

	return $defaults;

}
