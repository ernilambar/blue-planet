<?php
/**
 * @package Blue Planet
 * @since Blue Planet 1.0.0
 */

/**
 * Set the default values for all the settings. If no user-defined values
 * is available for any setting, these defaults will be used.
 */

global $blueplanet_options_settings;

$blueplanet_options_settings = get_option( 'blueplanet_options' );


function blueplanet_get_option( $key ){

	// global $blueplanet_options_settings;

  $defaults = blueplanet_get_default_options();
  $options = blueplanet_get_option_all();
  // nspre($options,'op');
  // return $options[$key];

  $output = '';

  if ( array_key_exists( $key,  $defaults ) ) {
    $output = $defaults[ $key ];
  }

  if ( array_key_exists( $key,  $options ) ) {
    $output = $options[ $key ];
  }
  return $output;



	// Set default value first
	if ( is_array( $defaults ) && isset( $defaults[$key] ) ) {
		$output = $defaults[$key];
	}

	// Has any value?
	if ( is_array( $blueplanet_options_settings ) && isset( $blueplanet_options_settings[$key] ) ) {
		$output = $blueplanet_options_settings[$key];
	}

	return $output;

}

function blueplanet_get_option_all(){

  $defaults = blueplanet_get_default_options();

  $output = get_theme_mod( 'blueplanet_options', $defaults );

  $output = array_merge( $defaults, $output );

  return $output;

}

function blueplanet_get_default_options(){

	$defaults = array(
      // 'custom_favicon'               => 'http://staging.dev/wp-content/uploads/2011/07/img_0767.jpg',
      'custom_favicon'               => '',
      'custom_css'                   => '*{outline:none;}',
      'feedburner_url'               => '',
      'flg_enable_goto_top'          => '0',
      'banner_background_color'      => '#00ADB3',
      'search_placeholder'           => __( 'Search here...', 'blue-planet' ),
      'flg_hide_search_box'          => '1',
      'flg_hide_social_icons'        => '0',
      'flg_enable_footer_widgets'    => '0',
      'number_of_footer_widgets'     => '3',
      'copyright_text'               => __( 'Copyright &copy; All Rights Reserved.', 'blue-planet' ),
      'flg_hide_powered_by'          => '1',
      'flg_hide_footer_social_icons' => '0',
      'default_layout'               => 'right-sidebar',
      'content_layout'               => 'excerpt',
      'read_more_text'               => __( 'Read more', 'blue-planet' ),
      'excerpt_length'               => '50',
      'slider_status'                => 'none',
      'transition_effect'            => 'fade',
      'direction_nav'                => '1',
      'slider_autoplay'              => '1',
      'transition_delay'             => 4,
      'transition_length'            => 1,
      'main_slider_image'            => array(),
      'main_slider_caption'            => array(),
      'main_slider_url'            => array(),
      'main_slider_new_tab'            => array(),
      'slider_status_2'              => 'none',
      'number_of_slides_2'           => 3,
      'slider_category_2'            => '',
      'control_nav_2'                => '1',
      'direction_nav_2'              => '1',
      'transition_effect_2'          => 'fade',
      'slider_autoplay_2'            => '1',
      'slider_caption_2'             => '1',
      'transition_delay_2'           => 4,
      'transition_length_2'          => 1,
      'javascript_header'            => '',
      'javascript_footer'            => '',
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

      'reset_theme_settings'                  => 0,
  );

  for( $i = 1; $i <= 5 ; $i++ ){
    $defaults[ 'main_slider_image_' . $i ]   = '';
    $defaults[ 'main_slider_url_' . $i ]     = '';
    $defaults[ 'main_slider_caption_' . $i ] = '';
    $defaults[ 'main_slider_new_tab_' . $i ] = 0;
  }

  return $defaults;

}
