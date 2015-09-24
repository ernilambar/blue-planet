<?php

add_action( 'admin_init', 'blue_planet_action_convert_settings_to_customizer' );

function blue_planet_action_convert_settings_to_customizer(){

  if ( ! isset( $_POST['blue_planet_convert_nonce_field'] ) || ! wp_verify_nonce( $_POST['blue_planet_convert_nonce_field'], 'blue_planet_convert_settings_to_customizer' ) ) {
    return;
  } else {

    // Valid nonce
    $old_options = get_option( 'blueplanet_options' );
    $new_options = $old_options;

    if ( isset( $old_options['main_slider_image'] ) && ! empty( $old_options['main_slider_image'] ) ) {
      for( $i = 0, $s = 1; $i < 5; $i++, $s++ ){

        if ( isset( $old_options['main_slider_image'][$i] ) ) {
          $new_options[ 'main_slider_image_' . $s ] = $old_options['main_slider_image'][$i];
        }
        if ( isset( $old_options['main_slider_url'][$i] ) ) {
          $new_options[ 'main_slider_url_' . $s ] = $old_options['main_slider_url'][$i];
        }
        if ( isset( $old_options['main_slider_caption'][$i] ) ) {
          $new_options[ 'main_slider_caption_' . $s ] = $old_options['main_slider_caption'][$i];
        }
        if ( isset( $old_options['main_slider_new_tab'][$i] ) ) {
          $new_options[ 'main_slider_new_tab_' . $s ] = $old_options['main_slider_new_tab'][$i];
        }
      }
    }

    set_theme_mod( 'blueplanet_options', $new_options );

    // redirect to Customize page
    wp_safe_redirect( admin_url( 'customize.php' ) );
    exit;

  }


}
