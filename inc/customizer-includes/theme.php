<?php

  // Temp option
  $temp_option = get_option('blueplanet_options');

  // Add Panel
  $wp_customize->add_panel( 'blue_planet_options_panel',
     array(
        'title'       => __( 'Blue Planet Options', 'blue-planet' ),
        'priority'    => 99,
        'capability'  => 'edit_theme_options',
     )
  );
  // General Section
  $wp_customize->add_section( 'blue_planet_options_general',
     array(
        'title'      => __( 'General', 'blue-planet' ),
        'priority'   => 10,
        'capability' => 'edit_theme_options',
        'panel'      => 'blue_planet_options_panel',
     )
  );
  // custom_favicon
  $wp_customize->add_setting( 'blueplanet_options[custom_favicon]',
     array(
        'default'              => $new_defaults['custom_favicon'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
    $wp_customize,
    'blueplanet_options[custom_favicon]',
    array(
        'label'       => __( 'Favicon', 'blue-planet' ),
        'description' => __( 'Upload your favicon. Recommended size 16px X 16px', 'blue-planet' ),
        'section'     => 'blue_planet_options_general',
        'settings'    => 'blueplanet_options[custom_favicon]',
        'priority'    => 15,
    ) )
  );

  // custom_css
  $wp_customize->add_setting( 'blueplanet_options[custom_css]',
     array(
        'default'              => $new_defaults['custom_css'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'wp_filter_nohtml_kses',
        'sanitize_js_callback' => 'wp_filter_nohtml_kses',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[custom_css]',
      array(
        'label'       => __( 'Custom CSS', 'blue-planet' ),
        'description' => __( 'Enter your Custom CSS here.', 'blue-planet' ),
        'section'     => 'blue_planet_options_general',
        'settings'    => 'blueplanet_options[custom_css]',
        'type'        => 'textarea',
        'priority'    => 20,
      )
    );

  $feedburner_url = '';
  if ( isset( $temp_option['feedburner_url'] ) && ! empty( $temp_option['feedburner_url'] )  ) {
    $feedburner_url = $temp_option['feedburner_url'];
  }

  if ( '' != $feedburner_url ) {
    // feedburner_url
    $wp_customize->add_setting( 'blueplanet_options[feedburner_url]',
       array(
          'default'              => $new_defaults['feedburner_url'],
          // 'type'                 => 'option',
          'capability'           => 'edit_theme_options',
          'sanitize_callback'    => 'esc_url_raw',
          'sanitize_js_callback' => 'esc_url',
       )
    );
    $wp_customize->add_control(
        'blueplanet_options[feedburner_url]',
        array(
          'label'       => __( 'Feedburner URL', 'blue-planet' ),
          'description' => __( 'Enter FeedbBurner URL.', 'blue-planet' ),
          'section'     => 'blue_planet_options_general',
          'settings'    => 'blueplanet_options[feedburner_url]',
          'type'        => 'text',
          'priority'    => 25,
        )
      );
  } // end if

  // search_placeholder
  $wp_customize->add_setting( 'blueplanet_options[search_placeholder]',
     array(
        'default'              => $new_defaults['search_placeholder'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'sanitize_text_field',
        'sanitize_js_callback' => 'esc_attr',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[search_placeholder]',
      array(
        'label'       => __( 'Default text in Search box', 'blue-planet' ),
        'description' => __( 'Enter default text in Search box', 'blue-planet' ),
        'section'     => 'blue_planet_options_general',
        'settings'    => 'blueplanet_options[search_placeholder]',
        'type'        => 'text',
        'priority'    => 30,
      )
    );

  // flg_enable_goto_top
  $wp_customize->add_setting( 'blueplanet_options[flg_enable_goto_top]',
     array(
        'default'              => $new_defaults['flg_enable_goto_top'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'blue_planet_sanitize_checkbox_input',
        'sanitize_js_callback' => 'blue_planet_sanitize_checkbox_output',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[flg_enable_goto_top]',
      array(
        'label'       => __( 'Enable Goto Top', 'blue-planet' ),
        'section'     => 'blue_planet_options_general',
        'settings'    => 'blueplanet_options[flg_enable_goto_top]',
        'type'        => 'checkbox',
        'priority'    => 35,
      )
    );

  // Header Section
  $wp_customize->add_section( 'blue_planet_options_header',
     array(
        'title'      => __( 'Header', 'blue-planet' ),
        'priority'   => 15,
        'capability' => 'edit_theme_options',
        'panel'      => 'blue_planet_options_panel',
     )
  );
  // banner_background_color
  $wp_customize->add_setting( 'blueplanet_options[banner_background_color]',
     array(
        'default'              => $new_defaults['banner_background_color'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'sanitize_hex_color',
        'sanitize_js_callback' => 'sanitize_hex_color',
     )
  );
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
    $wp_customize,
    'blueplanet_options[banner_background_color]',
    array(
        'label'       => __( 'Banner background color', 'blue-planet' ),
        'section'     => 'blue_planet_options_header',
        'settings'    => 'blueplanet_options[banner_background_color]',
        'priority'    => 40,
    ) )
  );

  // flg_hide_social_icons
  $wp_customize->add_setting( 'blueplanet_options[flg_hide_social_icons]',
     array(
        'default'              => $new_defaults['flg_hide_social_icons'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'blue_planet_sanitize_checkbox_input',
        'sanitize_js_callback' => 'blue_planet_sanitize_checkbox_output',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[flg_hide_social_icons]',
      array(
        'label'       => __( 'Hide Social icons', 'blue-planet' ),
        'section'     => 'blue_planet_options_header',
        'settings'    => 'blueplanet_options[flg_hide_social_icons]',
        'type'        => 'checkbox',
        'priority'    => 45,
      )
    );

  // Footer Section
  $wp_customize->add_section( 'blue_planet_options_footer',
     array(
        'title'      => __( 'Footer', 'blue-planet' ),
        'priority'   => 20,
        'capability' => 'edit_theme_options',
        'panel'      => 'blue_planet_options_panel',
     )
  );

  // flg_enable_footer_widgets
  $wp_customize->add_setting( 'blueplanet_options[flg_enable_footer_widgets]',
     array(
        'default'              => $new_defaults['flg_enable_footer_widgets'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'blue_planet_sanitize_checkbox_input',
        'sanitize_js_callback' => 'blue_planet_sanitize_checkbox_output',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[flg_enable_footer_widgets]',
      array(
        'label'       => __( 'Enable Footer Widgets', 'blue-planet' ),
        'section'     => 'blue_planet_options_footer',
        'settings'    => 'blueplanet_options[flg_enable_footer_widgets]',
        'type'        => 'checkbox',
        'priority'    => 45,
      )
    );

  // number_of_footer_widgets
  $wp_customize->add_setting( 'blueplanet_options[number_of_footer_widgets]',
     array(
        'default'              => $new_defaults['number_of_footer_widgets'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_attr',
        'sanitize_js_callback' => 'esc_attr',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[number_of_footer_widgets]',
      array(
        'label'       => __( 'Number of Footer widgets', 'blue-planet' ),
        'section'     => 'blue_planet_options_footer',
        'settings'    => 'blueplanet_options[number_of_footer_widgets]',
        'active_callback'    => 'blue_planet_check_footer_widgets_status_cb',
        'type'        => 'select',
        'priority'    => 50,
        'choices'    => array(
            '1' => __( '1', 'blue-planet' ),
            '2' => __( '2', 'blue-planet' ),
            '3' => __( '3', 'blue-planet' ),
            '4' => __( '4', 'blue-planet' ),
            '6' => __( '6', 'blue-planet' ),
          ),
      )
    );

  // copyright_text
  $wp_customize->add_setting( 'blueplanet_options[copyright_text]',
     array(
        'default'              => $new_defaults['copyright_text'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'sanitize_text_field',
        'sanitize_js_callback' => 'esc_html',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[copyright_text]',
      array(
        'label'       => __( 'Copyright text', 'blue-planet' ),
        'section'     => 'blue_planet_options_footer',
        'settings'    => 'blueplanet_options[copyright_text]',
        'type'        => 'text',
        'priority'    => 55,
      )
    );


  // flg_hide_powered_by
  $wp_customize->add_setting( 'blueplanet_options[flg_hide_powered_by]',
     array(
        'default'              => $new_defaults['flg_hide_powered_by'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'blue_planet_sanitize_checkbox_input',
        'sanitize_js_callback' => 'blue_planet_sanitize_checkbox_output',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[flg_hide_powered_by]',
      array(
        'label'       => __( 'Hide Powered By', 'blue-planet' ),
        'section'     => 'blue_planet_options_footer',
        'settings'    => 'blueplanet_options[flg_hide_powered_by]',
        'type'        => 'checkbox',
        'priority'    => 65,
      )
    );

  // flg_hide_footer_social_icons
  $wp_customize->add_setting( 'blueplanet_options[flg_hide_footer_social_icons]',
     array(
        'default'              => $new_defaults['flg_hide_footer_social_icons'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'blue_planet_sanitize_checkbox_input',
        'sanitize_js_callback' => 'blue_planet_sanitize_checkbox_output',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[flg_hide_footer_social_icons]',
      array(
        'label'       => __( 'Hide Social icons in footer', 'blue-planet' ),
        'section'     => 'blue_planet_options_footer',
        'settings'    => 'blueplanet_options[flg_hide_footer_social_icons]',
        'type'        => 'checkbox',
        'priority'    => 75,
      )
    );


  // Layout Section
  $wp_customize->add_section( 'blue_planet_options_layout',
     array(
        'title'      => __( 'Layout', 'blue-planet' ),
        'priority'   => 25,
        'capability' => 'edit_theme_options',
        'panel'      => 'blue_planet_options_panel',
     )
  );

  // default_layout
  $wp_customize->add_setting( 'blueplanet_options[default_layout]',
     array(
        'default'              => $new_defaults['default_layout'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'blue_planet_sanitize_select',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[default_layout]',
      array(
        'label'       => __( 'Default Layout', 'blue-planet' ),
        'section'     => 'blue_planet_options_layout',
        'settings'    => 'blueplanet_options[default_layout]',
        'type'        => 'radio',
        'priority'    => 55,
        'choices'    => array(
            'right-sidebar' => __( 'Right Sidebar', 'blue-planet' ),
            'left-sidebar'  => __( 'Left Sidebar', 'blue-planet' ),
          ),
      )
    );

  // content_layout
  $wp_customize->add_setting( 'blueplanet_options[content_layout]',
     array(
        'default'              => $new_defaults['content_layout'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'blue_planet_sanitize_select',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[content_layout]',
      array(
        'label'       => __( 'Content Layout', 'blue-planet' ),
        'section'     => 'blue_planet_options_layout',
        'settings'    => 'blueplanet_options[content_layout]',
        'type'        => 'radio',
        'priority'    => 65,
        'choices'    => array(
            'full'          => __( 'Full', 'blue-planet' ),
            'excerpt'       => __( 'Excerpt', 'blue-planet' ),
            'excerpt-thumb' => __( 'Excerpt with thumbnail', 'blue-planet' ),
          ),
      )
    );

  // Blog Section
  $wp_customize->add_section( 'blue_planet_options_blog',
     array(
        'title'      => __( 'Blog', 'blue-planet' ),
        'priority'   => 30,
        'capability' => 'edit_theme_options',
        'panel'      => 'blue_planet_options_panel',
     )
  );

  // read_more_text
  $wp_customize->add_setting( 'blueplanet_options[read_more_text]',
     array(
        'default'              => $new_defaults['read_more_text'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'sanitize_text_field',
        'sanitize_js_callback' => 'esc_html',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[read_more_text]',
      array(
        'label'       => __( 'Read more text', 'blue-planet' ),
        'section'     => 'blue_planet_options_blog',
        'settings'    => 'blueplanet_options[read_more_text]',
        'type'        => 'text',
        'priority'    => 75,
      )
    );

  // excerpt_length
  $wp_customize->add_setting( 'blueplanet_options[excerpt_length]',
     array(
        'default'              => $new_defaults['excerpt_length'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'blue_planet_sanitize_number_absint',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[excerpt_length]',
      array(
        'label'       => __( 'Excerpt length', 'blue-planet' ),
        'description' => __( 'in words', 'blue-planet' ),
        'section'     => 'blue_planet_options_blog',
        'settings'    => 'blueplanet_options[excerpt_length]',
        'type'        => 'text',
        'priority'    => 80,
      )
    );

  // Social Section
  $wp_customize->add_section( 'blue_planet_options_social',
     array(
        'title'       => __( 'Social', 'blue-planet' ),
        'description' => __( 'Please enter Full URL', 'blue-planet' ),
        'priority'    => 40,
        'capability'  => 'edit_theme_options',
        'panel'       => 'blue_planet_options_panel',
     )
  );

  // social_facebook
  $wp_customize->add_setting( 'blueplanet_options[social_facebook]',
     array(
        'default'              => $new_defaults['social_facebook'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_facebook]',
      array(
        'label'       => __( 'Facebook', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_facebook]',
        'type'        => 'text',
        'priority'    => 100,
      )
    );

  // social_twitter
  $wp_customize->add_setting( 'blueplanet_options[social_twitter]',
     array(
        'default'              => $new_defaults['social_twitter'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_twitter]',
      array(
        'label'       => __( 'Twitter', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_twitter]',
        'type'        => 'text',
        'priority'    => 110,
      )
    );

  // social_googleplus
  $wp_customize->add_setting( 'blueplanet_options[social_googleplus]',
     array(
        'default'              => $new_defaults['social_googleplus'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_googleplus]',
      array(
        'label'       => __( 'Google Plus', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_googleplus]',
        'type'        => 'text',
        'priority'    => 115,
      )
    );

  // social_youtube
  $wp_customize->add_setting( 'blueplanet_options[social_youtube]',
     array(
        'default'              => $new_defaults['social_youtube'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_youtube]',
      array(
        'label'       => __( 'Youtube', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_youtube]',
        'type'        => 'text',
        'priority'    => 120,
      )
    );

  // social_pinterest
  $wp_customize->add_setting( 'blueplanet_options[social_pinterest]',
     array(
        'default'              => $new_defaults['social_pinterest'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_pinterest]',
      array(
        'label'       => __( 'Pinterest', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_pinterest]',
        'type'        => 'text',
        'priority'    => 125,
      )
    );

  // social_linkedin
  $wp_customize->add_setting( 'blueplanet_options[social_linkedin]',
     array(
        'default'              => $new_defaults['social_linkedin'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_linkedin]',
      array(
        'label'       => __( 'Linkedin', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_linkedin]',
        'type'        => 'text',
        'priority'    => 130,
      )
    );

  // social_vimeo
  $wp_customize->add_setting( 'blueplanet_options[social_vimeo]',
     array(
        'default'              => $new_defaults['social_vimeo'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_vimeo]',
      array(
        'label'       => __( 'Vimeo', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_vimeo]',
        'type'        => 'text',
        'priority'    => 135,
      )
    );

  // social_flickr
  $wp_customize->add_setting( 'blueplanet_options[social_flickr]',
     array(
        'default'              => $new_defaults['social_flickr'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_flickr]',
      array(
        'label'       => __( 'Flickr', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_flickr]',
        'type'        => 'text',
        'priority'    => 140,
      )
    );
  // social_tumblr
  $wp_customize->add_setting( 'blueplanet_options[social_tumblr]',
     array(
        'default'              => $new_defaults['social_tumblr'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_tumblr]',
      array(
        'label'       => __( 'Tumblr', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_tumblr]',
        'type'        => 'text',
        'priority'    => 145,
      )
    );
  // social_dribbble
  $wp_customize->add_setting( 'blueplanet_options[social_dribbble]',
     array(
        'default'              => $new_defaults['social_dribbble'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_dribbble]',
      array(
        'label'       => __( 'Dribbble', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_dribbble]',
        'type'        => 'text',
        'priority'    => 150,
      )
    );
  // social_deviantart
  $wp_customize->add_setting( 'blueplanet_options[social_deviantart]',
     array(
        'default'              => $new_defaults['social_deviantart'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_deviantart]',
      array(
        'label'       => __( 'deviantART', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_deviantart]',
        'type'        => 'text',
        'priority'    => 155,
      )
    );
  // social_rss
  $wp_customize->add_setting( 'blueplanet_options[social_rss]',
     array(
        'default'              => $new_defaults['social_rss'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_rss]',
      array(
        'label'       => __( 'RSS', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_rss]',
        'type'        => 'text',
        'priority'    => 160,
      )
    );

  // social_instagram
  $wp_customize->add_setting( 'blueplanet_options[social_instagram]',
     array(
        'default'              => $new_defaults['social_instagram'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_instagram]',
      array(
        'label'       => __( 'Instagram', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_instagram]',
        'type'        => 'text',
        'priority'    => 165,
      )
    );
  // social_skype
  $wp_customize->add_setting( 'blueplanet_options[social_skype]',
     array(
        'default'              => $new_defaults['social_skype'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'sanitize_text_field',
        'sanitize_js_callback' => 'sanitize_text_field',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_skype]',
      array(
        'label'       => __( 'Skype', 'blue-planet' ),
        'description' => __( 'Please enter Skype ID', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_skype]',
        'type'        => 'text',
        'priority'    => 170,
      )
    );
  // social_digg
  $wp_customize->add_setting( 'blueplanet_options[social_digg]',
     array(
        'default'              => $new_defaults['social_digg'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_digg]',
      array(
        'label'       => __( 'Digg', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_digg]',
        'type'        => 'text',
        'priority'    => 175,
      )
    );

  // social_stumbleupon
  $wp_customize->add_setting( 'blueplanet_options[social_stumbleupon]',
     array(
        'default'              => $new_defaults['social_stumbleupon'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_stumbleupon]',
      array(
        'label'       => __( 'Stumbleupon', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_stumbleupon]',
        'type'        => 'text',
        'priority'    => 180,
      )
    );
  // social_forrst
  $wp_customize->add_setting( 'blueplanet_options[social_forrst]',
     array(
        'default'              => $new_defaults['social_forrst'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_forrst]',
      array(
        'label'       => __( 'Forrst', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_forrst]',
        'type'        => 'text',
        'priority'    => 185,
      )
    );
  // social_500px
  $wp_customize->add_setting( 'blueplanet_options[social_500px]',
     array(
        'default'              => $new_defaults['social_500px'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'esc_url_raw',
        'sanitize_js_callback' => 'esc_url',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_500px]',
      array(
        'label'       => __( '500px', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_500px]',
        'type'        => 'text',
        'priority'    => 190,
      )
    );
  // social_email
  $wp_customize->add_setting( 'blueplanet_options[social_email]',
     array(
        'default'              => $new_defaults['social_email'],
        // 'type'                 => 'option',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'sanitize_email',
        'sanitize_js_callback' => 'sanitize_email',
     )
  );
  $wp_customize->add_control(
      'blueplanet_options[social_email]',
      array(
        'label'       => __( 'Email', 'blue-planet' ),
        'description' => __( 'Please enter email address', 'blue-planet' ),
        'section'     => 'blue_planet_options_social',
        'settings'    => 'blueplanet_options[social_email]',
        'type'        => 'text',
        'priority'    => 195,
      )
    );

  // Administration Section
  $wp_customize->add_section( 'blue_planet_options_administration',
     array(
        'title'       => __( 'Administration', 'blue-planet' ),
        'priority'    => 100,
        'capability'  => 'edit_theme_options',
        'panel'       => 'blue_planet_options_panel',
     )
  );

  $javascript_header = '';
  if ( isset( $temp_option['javascript_header'] ) && ! empty( $temp_option['javascript_header'] )  ) {
    $javascript_header = $temp_option['javascript_header'];
  }

  if ( '' != $javascript_header ) {
    // javascript_header
    $wp_customize->add_setting( 'blueplanet_options[javascript_header]',
       array(
          'default'              => $new_defaults['javascript_header'],
          // 'type'                 => 'option',
          'capability'           => 'edit_theme_options',
          'sanitize_callback'    => 'wp_filter_nohtml_kses',
          'sanitize_js_callback' => 'wp_filter_nohtml_kses',
       )
    );
    $wp_customize->add_control(
        'blueplanet_options[javascript_header]',
        array(
          'label'       => __( 'Javascript in Header', 'blue-planet' ),
          'description' => __( 'Enter your Javascript script code to put in HEADER', 'blue-planet' ),
          'section'     => 'blue_planet_options_administration',
          'settings'    => 'blueplanet_options[javascript_header]',
          'type'        => 'textarea',
          'priority'    => 50,
        )
      );
  } //end if

  $javascript_footer = '';
  if ( isset( $temp_option['javascript_footer'] ) && ! empty( $temp_option['javascript_footer'] )  ) {
    $javascript_footer = $temp_option['javascript_footer'];
  }

  if ( '' != $javascript_footer ) {
    // javascript_footer
    $wp_customize->add_setting( 'blueplanet_options[javascript_footer]',
       array(
          'default'              => $new_defaults['javascript_footer'],
          // 'type'                 => 'option',
          'capability'           => 'edit_theme_options',
          'sanitize_callback'    => 'wp_filter_nohtml_kses',
          'sanitize_js_callback' => 'wp_filter_nohtml_kses',
       )
    );
    $wp_customize->add_control(
        'blueplanet_options[javascript_footer]',
        array(
          'label'       => __( 'Javascript in Footer', 'blue-planet' ),
          'description' => __( 'Enter your Javascript script code to put in FOOTER', 'blue-planet' ),
          'section'     => 'blue_planet_options_administration',
          'settings'    => 'blueplanet_options[javascript_footer]',
          'type'        => 'textarea',
          'priority'    => 60,
        )
      );
  } // end if
