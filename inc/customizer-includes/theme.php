<?php
/**
 * Customizer Theme Options section.
 *
 * @package Blue_Planet
 */

	// Add Panel.
	$wp_customize->add_panel( 'blue_planet_options_panel',
		array(
		'title'       => __( 'Blue Planet Options', 'blue-planet' ),
		'priority'    => 99,
		'capability'  => 'edit_theme_options',
		)
	);
	// General Section.
	$wp_customize->add_section( 'blue_planet_options_general',
		array(
		'title'      => __( 'General Options', 'blue-planet' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'panel'      => 'blue_planet_options_panel',
		)
	);

	// Setting - custom_css.
	$wp_customize->add_setting( 'blueplanet_options[custom_css]',
		array(
		'default'              => $new_defaults['custom_css'],
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses',
		)
	);
	$wp_customize->add_control(
		'blueplanet_options[custom_css]',
		array(
		'label'       => __( 'Custom CSS', 'blue-planet' ),
		'section'     => 'blue_planet_options_general',
		'settings'    => 'blueplanet_options[custom_css]',
		'type'        => 'textarea',
		'priority'    => 20,
		)
	);

	// Setting - search_placeholder.
	$wp_customize->add_setting( 'blueplanet_options[search_placeholder]',
		array(
		'default'              => $new_defaults['search_placeholder'],
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'sanitize_text_field',
		'sanitize_js_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'blueplanet_options[search_placeholder]',
		array(
		'label'       => __( 'Search Placeholder', 'blue-planet' ),
		'section'     => 'blue_planet_options_general',
		'settings'    => 'blueplanet_options[search_placeholder]',
		'type'        => 'text',
		'priority'    => 30,
		)
	);

	// Setting - flg_enable_goto_top.
	$wp_customize->add_setting( 'blueplanet_options[flg_enable_goto_top]',
		array(
		'default'              => $new_defaults['flg_enable_goto_top'],
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

	// Header Section.
	$wp_customize->add_section( 'blue_planet_options_header',
		array(
		'title'      => __( 'Header Options', 'blue-planet' ),
		'priority'   => 15,
		'capability' => 'edit_theme_options',
		'panel'      => 'blue_planet_options_panel',
		)
	);
	// Setting - banner_background_color.
	$wp_customize->add_setting( 'blueplanet_options[banner_background_color]',
		array(
		'default'              => $new_defaults['banner_background_color'],
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

	// Setting - flg_hide_social_icons.
	$wp_customize->add_setting( 'blueplanet_options[flg_hide_social_icons]',
		array(
		'default'              => $new_defaults['flg_hide_social_icons'],
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

	// Footer Section.
	$wp_customize->add_section( 'blue_planet_options_footer',
		array(
		'title'      => __( 'Footer Options', 'blue-planet' ),
		'priority'   => 20,
		'capability' => 'edit_theme_options',
		'panel'      => 'blue_planet_options_panel',
		)
	);

	// Setting - copyright_text.
	$wp_customize->add_setting( 'blueplanet_options[copyright_text]',
		array(
		'default'              => $new_defaults['copyright_text'],
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


	// Setting - flg_hide_powered_by.
	$wp_customize->add_setting( 'blueplanet_options[flg_hide_powered_by]',
		array(
		'default'              => $new_defaults['flg_hide_powered_by'],
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

	// Setting - flg_hide_footer_social_icons.
	$wp_customize->add_setting( 'blueplanet_options[flg_hide_footer_social_icons]',
		array(
		'default'              => $new_defaults['flg_hide_footer_social_icons'],
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


	// Layout Section.
	$wp_customize->add_section( 'blue_planet_options_layout',
		array(
		'title'      => __( 'Layout Options', 'blue-planet' ),
		'priority'   => 25,
		'capability' => 'edit_theme_options',
		'panel'      => 'blue_planet_options_panel',
		)
	);

	// Setting - default_layout.
	$wp_customize->add_setting( 'blueplanet_options[default_layout]',
		array(
		'default'              => $new_defaults['default_layout'],
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
		'type'        => 'select',
		'priority'    => 55,
		'choices'    => array(
			'right-sidebar' => __( 'Right Sidebar', 'blue-planet' ),
			'left-sidebar'  => __( 'Left Sidebar', 'blue-planet' ),
		  ),
		)
	);

	// Setting - content_layout ~ Archive Layout.
	$wp_customize->add_setting( 'blueplanet_options[content_layout]',
		array(
		'default'              => $new_defaults['content_layout'],
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'blue_planet_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'blueplanet_options[content_layout]',
		array(
		'label'       => __( 'Archive Layout', 'blue-planet' ),
		'section'     => 'blue_planet_options_layout',
		'settings'    => 'blueplanet_options[content_layout]',
		'type'        => 'select',
		'priority'    => 65,
		'choices'    => array(
			'full'          => __( 'Full', 'blue-planet' ),
			'excerpt'       => __( 'Excerpt', 'blue-planet' ),
			'excerpt-thumb' => __( 'Excerpt with thumbnail', 'blue-planet' ),
		  ),
		)
	);

	// Setting - archive_image.
	$wp_customize->add_setting( 'blueplanet_options[archive_image]',
		array(
		'default'              => $new_defaults['archive_image'],
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'blue_planet_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'blueplanet_options[archive_image]',
		array(
		'label'    => __( 'Image in Archive', 'blue-planet' ),
		'section'  => 'blue_planet_options_layout',
		'settings' => 'blueplanet_options[archive_image]',
		'type'     => 'select',
		'priority' => 65,
		'choices'  => blue_planet_get_image_sizes_options(),
		)
	);

	// Setting - archive_image_alignment.
	$wp_customize->add_setting( 'blueplanet_options[archive_image_alignment]',
		array(
		'default'              => $new_defaults['archive_image_alignment'],
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'blue_planet_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'blueplanet_options[archive_image_alignment]',
		array(
		'label'    => __( 'Image Alignment in Archive', 'blue-planet' ),
		'section'  => 'blue_planet_options_layout',
		'settings' => 'blueplanet_options[archive_image_alignment]',
		'type'     => 'select',
		'priority' => 65,
		'choices'  => blue_planet_get_image_alignment_options(),
		)
	);

	// Setting - single_image.
	$wp_customize->add_setting( 'blueplanet_options[single_image]',
		array(
		'default'              => $new_defaults['single_image'],
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'blue_planet_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'blueplanet_options[single_image]',
		array(
		'label'    => __( 'Image in Single Post/Page', 'blue-planet' ),
		'section'  => 'blue_planet_options_layout',
		'settings' => 'blueplanet_options[single_image]',
		'type'     => 'select',
		'priority' => 65,
		'choices'  => blue_planet_get_image_sizes_options(),
		)
	);

	// Setting - single_image_alignment.
	$wp_customize->add_setting( 'blueplanet_options[single_image_alignment]',
		array(
		'default'              => $new_defaults['single_image_alignment'],
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'blue_planet_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'blueplanet_options[single_image_alignment]',
		array(
		'label'    => __( 'Image Alignment in Single Post/Page', 'blue-planet' ),
		'section'  => 'blue_planet_options_layout',
		'settings' => 'blueplanet_options[single_image_alignment]',
		'type'     => 'select',
		'priority' => 65,
		'choices'  => blue_planet_get_image_alignment_options(),
		)
	);

	// Blog Section.
	$wp_customize->add_section( 'blue_planet_options_blog',
		array(
		'title'      => __( 'Blog Options', 'blue-planet' ),
		'priority'   => 30,
		'capability' => 'edit_theme_options',
		'panel'      => 'blue_planet_options_panel',
		)
	);

	// Setting - read_more_text.
	$wp_customize->add_setting( 'blueplanet_options[read_more_text]',
		array(
		'default'              => $new_defaults['read_more_text'],
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

	// Setting - excerpt_length.
	$wp_customize->add_setting( 'blueplanet_options[excerpt_length]',
		array(
		'default'              => $new_defaults['excerpt_length'],
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
		'type'        => 'number',
		'priority'    => 80,
		'input_attrs' => array( 'min' => 1, 'max' => 500, 'style' => 'width: 60px;' ),
		)
	);

	// Social Section.
	$wp_customize->add_section( 'blue_planet_options_social',
		array(
		'title'       => __( 'Social Options', 'blue-planet' ),
		'description' => __( 'Please enter Full URL', 'blue-planet' ),
		'priority'    => 40,
		'capability'  => 'edit_theme_options',
		'panel'       => 'blue_planet_options_panel',
		)
	);

	// Setting - social_facebook.
	$wp_customize->add_setting( 'blueplanet_options[social_facebook]',
		array(
		'default'              => $new_defaults['social_facebook'],
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

	// Setting - social_twitter.
	$wp_customize->add_setting( 'blueplanet_options[social_twitter]',
		array(
		'default'              => $new_defaults['social_twitter'],
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

	// Setting - social_googleplus.
	$wp_customize->add_setting( 'blueplanet_options[social_googleplus]',
		array(
		'default'              => $new_defaults['social_googleplus'],
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

	// Setting - social_youtube.
	$wp_customize->add_setting( 'blueplanet_options[social_youtube]',
		array(
		'default'              => $new_defaults['social_youtube'],
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

	// Setting - social_pinterest.
	$wp_customize->add_setting( 'blueplanet_options[social_pinterest]',
		array(
		'default'              => $new_defaults['social_pinterest'],
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

	// Setting - social_linkedin.
	$wp_customize->add_setting( 'blueplanet_options[social_linkedin]',
		array(
		'default'              => $new_defaults['social_linkedin'],
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

	// Setting - social_vimeo.
	$wp_customize->add_setting( 'blueplanet_options[social_vimeo]',
		array(
		'default'              => $new_defaults['social_vimeo'],
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

	// Setting - social_flickr.
	$wp_customize->add_setting( 'blueplanet_options[social_flickr]',
		array(
		'default'              => $new_defaults['social_flickr'],
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
	// Setting - social_tumblr.
	$wp_customize->add_setting( 'blueplanet_options[social_tumblr]',
		array(
		'default'              => $new_defaults['social_tumblr'],
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
	// Setting - social_dribbble.
	$wp_customize->add_setting( 'blueplanet_options[social_dribbble]',
		array(
		'default'              => $new_defaults['social_dribbble'],
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
	// Setting - social_deviantart.
	$wp_customize->add_setting( 'blueplanet_options[social_deviantart]',
		array(
		'default'              => $new_defaults['social_deviantart'],
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
	// Setting - social_rss.
	$wp_customize->add_setting( 'blueplanet_options[social_rss]',
		array(
		'default'              => $new_defaults['social_rss'],
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

	// Setting - social_instagram.
	$wp_customize->add_setting( 'blueplanet_options[social_instagram]',
		array(
		'default'              => $new_defaults['social_instagram'],
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
	// Setting - social_skype.
	$wp_customize->add_setting( 'blueplanet_options[social_skype]',
		array(
		'default'              => $new_defaults['social_skype'],
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
	// Setting - social_digg.
	$wp_customize->add_setting( 'blueplanet_options[social_digg]',
		array(
		'default'              => $new_defaults['social_digg'],
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

	// Setting - social_stumbleupon.
	$wp_customize->add_setting( 'blueplanet_options[social_stumbleupon]',
		array(
		'default'              => $new_defaults['social_stumbleupon'],
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
	// Setting - social_forrst.
	$wp_customize->add_setting( 'blueplanet_options[social_forrst]',
		array(
		'default'              => $new_defaults['social_forrst'],
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
	// Setting - social_500px.
	$wp_customize->add_setting( 'blueplanet_options[social_500px]',
		array(
		'default'              => $new_defaults['social_500px'],
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
	// Setting - social_email.
	$wp_customize->add_setting( 'blueplanet_options[social_email]',
		array(
		'default'              => $new_defaults['social_email'],
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
