<?php

  // Reset Section
  $wp_customize->add_section( 'blue_planet_reset_section',
     array(
        'title'       => __( 'Reset Theme Settings', 'blue-planet' ),
        'description' => __( 'Caution: This will delete your customization and reset to default as installed first time. Please refresh the page to see effect.', 'blue-planet' ),
        'priority'    => 200,
        'capability'  => 'edit_theme_options',
     )
  );
  // reset_theme_settings
  $wp_customize->add_setting( 'blueplanet_options[reset_theme_settings]',
     array(
        'default'           => $new_defaults['reset_theme_settings'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'blue_planet_reset_all_theme_settings',
        'transport'         => 'postMessage',
     )
  );
  $wp_customize->add_control(
      'reset_theme_settings',
      array(
        'label'       => __( 'Reset Now', 'blue-planet' ),
        'section'     => 'blue_planet_reset_section',
        'settings'    => 'blueplanet_options[reset_theme_settings]',
        'type'        => 'checkbox',
        'priority'    => 35,
      )
    );
