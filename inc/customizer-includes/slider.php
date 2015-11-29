<?php
/**
 * Customizer Slider panel.
 *
 * @package Blue_Planet
 */

// Add Panel.
$wp_customize->add_panel( 'blue_planet_slider_panel',
	array(
	  'title'       => __( 'Blue Planet Slider', 'blue-planet' ),
	  'priority'    => 100,
	  'capability'  => 'edit_theme_options',
	)
);
// Main Slider Section.
$wp_customize->add_section( 'blue_planet_slider_main',
	array(
	  'title'       => __( 'Main Slider', 'blue-planet' ),
	  'description' => sprintf( __( 'Recommended image size for banner slider : %dpx X %dpx', 'blue-planet' ), 1140, 250 ),
	  'priority'    => 10,
	  'capability'  => 'edit_theme_options',
	  'panel'       => 'blue_planet_slider_panel',
	)
);
// Setting - slider_status.
$wp_customize->add_setting( 'blueplanet_options[slider_status]',
	array(
	  'default'              => $new_defaults['slider_status'],
	  'capability'           => 'edit_theme_options',
	  'sanitize_callback'    => 'blue_planet_sanitize_select',
	)
);
$wp_customize->add_control(
	'blueplanet_options[slider_status]',
	array(
	  'label'       => __( 'Show slider in', 'blue-planet' ),
	  'section'     => 'blue_planet_slider_main',
	  'settings'    => 'blueplanet_options[slider_status]',
	  'type'        => 'radio',
	  'priority'    => 20,
	  'choices'    => array(
		  'home' => __( 'Home page Only', 'blue-planet' ),
		  'all'  => __( 'All pages', 'blue-planet' ),
		  'none' => __( 'Disable', 'blue-planet' ),
		),
	)
);

// Setting - transition_effect.
$wp_customize->add_setting( 'blueplanet_options[transition_effect]',
	array(
	'default'              => $new_defaults['transition_effect'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_select',
	)
);
$wp_customize->add_control(
	'blueplanet_options[transition_effect]',
	array(
	'label'           => __( 'Transition Effect', 'blue-planet' ),
	'section'         => 'blue_planet_slider_main',
	'settings'        => 'blueplanet_options[transition_effect]',
	'type'            => 'select',
	'choices'         => blue_planet_get_slider_transition_effects(),
	'priority'        => 30,
	'active_callback' => 'blue_planet_check_main_slider_status_cb',
	)
);

// Setting - direction_nav.
$wp_customize->add_setting( 'blueplanet_options[direction_nav]',
	array(
	'default'              => $new_defaults['direction_nav'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_select',
	)
);
$wp_customize->add_control(
	'blueplanet_options[direction_nav]',
	array(
	'label'           => __( 'Show Direction Nav', 'blue-planet' ),
	'section'         => 'blue_planet_slider_main',
	'settings'        => 'blueplanet_options[direction_nav]',
	'type'            => 'radio',
	'priority'        => 40,
	'choices'         => blue_planet_get_show_hide_options(),
	'active_callback' => 'blue_planet_check_main_slider_status_cb',
	)
);

// Setting - slider_autoplay.
$wp_customize->add_setting( 'blueplanet_options[slider_autoplay]',
	array(
	'default'              => $new_defaults['slider_autoplay'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_select',
	)
);
$wp_customize->add_control(
	'blueplanet_options[slider_autoplay]',
	array(
	'label'           => __( 'Enable Auto Play', 'blue-planet' ),
	'section'         => 'blue_planet_slider_main',
	'settings'        => 'blueplanet_options[slider_autoplay]',
	'type'            => 'radio',
	'priority'        => 50,
	'choices'         => blue_planet_get_on_off_options(),
	'active_callback' => 'blue_planet_check_main_slider_status_cb',
	)
);

// Setting - transition_delay.
$wp_customize->add_setting( 'blueplanet_options[transition_delay]',
	array(
	'default'              => $new_defaults['transition_delay'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_number_absint',
	)
);
$wp_customize->add_control(
	'blueplanet_options[transition_delay]',
	array(
	'label'           => __( 'Transition Delay', 'blue-planet' ),
	'description'     => __( 'in seconds', 'blue-planet' ),
	'section'         => 'blue_planet_slider_main',
	'settings'        => 'blueplanet_options[transition_delay]',
	'type'            => 'number',
	'priority'        => 60,
	'active_callback' => 'blue_planet_check_main_slider_status_cb',
	'input_attrs'     => array( 'min' => 1, 'max' => 20, 'style' => 'width: 55px;' ),
	)
);

// Setting - transition_length.
$wp_customize->add_setting( 'blueplanet_options[transition_length]',
	array(
	'default'              => $new_defaults['transition_length'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_number_absint',
	)
);
$wp_customize->add_control(
	'blueplanet_options[transition_length]',
	array(
	'label'           => __( 'Transition Length', 'blue-planet' ),
	'description'     => __( 'in seconds', 'blue-planet' ),
	'section'         => 'blue_planet_slider_main',
	'settings'        => 'blueplanet_options[transition_length]',
	'type'            => 'number',
	'priority'        => 70,
	'active_callback' => 'blue_planet_check_main_slider_status_cb',
	'input_attrs'     => array( 'min' => 1, 'max' => 20, 'style' => 'width: 55px;' ),
	)
);
// Sliders block.
$pr = 100;
for ( $i = 1; $i <= 5 ; $i++ ) {

	// Setting - main_slider_block_message.
	$wp_customize->add_setting( 'blueplanet_options[main_slider_block_message_' . $i . ']',
		array(
		'default'              => '',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'esc_html',
		'sanitize_js_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control( new Blue_Planet_Customize_Heading_Control( $wp_customize, 'blueplanet_options[main_slider_block_message_' . $i . ']', array(
		'label'    => sprintf( __( 'Slide - %d', 'blue-planet' ), $i ),
		'name'     => 'blueplanet_options[main_slider_block_message_' . $i . ']',
		'section'  => 'blue_planet_slider_main',
		'settings' => 'blueplanet_options[main_slider_block_message_' . $i . ']',
		'priority' => $pr++,
		'active_callback' => 'blue_planet_check_main_slider_status_cb',
	) ) );
	// Setting - main_slider_image.
	$wp_customize->add_setting( 'blueplanet_options[main_slider_image_' . $i . ']',
		array(
		'default'              => '',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'esc_url_raw',
		'sanitize_js_callback' => 'esc_url',
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'blueplanet_options[main_slider_image_' . $i . ']', array(
		'label'    => __( 'Slider Image', 'blue-planet' ),
		'name'     => 'blueplanet_options[main_slider_image_' . $i . ']',
		'section'  => 'blue_planet_slider_main',
		'settings' => 'blueplanet_options[main_slider_image_' . $i . ']',
		'priority' => $pr++,
		'active_callback' => 'blue_planet_check_main_slider_status_cb',
	) ) );
	// Setting - main_slider_caption.
	$wp_customize->add_setting( 'blueplanet_options[main_slider_caption_' . $i . ']',
		array(
		'default'              => $new_defaults[ 'main_slider_caption_' . $i ],
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'sanitize_text_field',
		'sanitize_js_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'blueplanet_options[main_slider_caption_' . $i. ']',
		array(
		'label'           => __( 'Slider Caption', 'blue-planet' ),
		'section'         => 'blue_planet_slider_main',
		'settings'        => 'blueplanet_options[main_slider_caption_' . $i . ']',
		'type'            => 'textarea',
		'priority'        => $pr++,
		'active_callback' => 'blue_planet_check_main_slider_status_cb',
		)
	);
	// Setting - main_slider_url.
	$wp_customize->add_setting( 'blueplanet_options[main_slider_url_' . $i . ']',
		array(
		'default'              => $new_defaults[ 'main_slider_url_' . $i ],
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'esc_url_raw',
		'sanitize_js_callback' => 'esc_url',
		)
	);
	$wp_customize->add_control(
		'blueplanet_options[main_slider_url_' . $i . ']',
		array(
		'label'           => __( 'Slider URL', 'blue-planet' ),
		'section'         => 'blue_planet_slider_main',
		'settings'        => 'blueplanet_options[main_slider_url_' . $i . ']',
		'type'            => 'text',
		'priority'        => $pr++,
		'active_callback' => 'blue_planet_check_main_slider_status_cb',
		)
	);
	// Setting - main_slider_new_tab.
	$wp_customize->add_setting( 'blueplanet_options[main_slider_new_tab_' . $i . ']',
		array(
		'default'              => $new_defaults[ 'main_slider_new_tab_' . $i ],
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'blue_planet_sanitize_checkbox_input',
		'sanitize_js_callback' => 'blue_planet_sanitize_checkbox_output',
		)
	);
	$wp_customize->add_control(
		'blueplanet_options[main_slider_new_tab_' . $i . ']',
		array(
		'label'           => __( 'Open Link in New Window', 'blue-planet' ),
		'section'         => 'blue_planet_slider_main',
		'settings'        => 'blueplanet_options[main_slider_new_tab_' . $i . ']',
		'type'            => 'checkbox',
		'priority'        => $pr++,
		'active_callback' => 'blue_planet_check_main_slider_status_cb',
		)
	);

}

// Secondary Slider Section.
$wp_customize->add_section( 'blue_planet_slider_secondary',
	array(
	  'title'      => __( 'Secondary Slider', 'blue-planet' ),
	  'priority'   => 20,
	  'capability' => 'edit_theme_options',
	  'panel'      => 'blue_planet_slider_panel',
	)
);
// Setting - slider_status_2.
$wp_customize->add_setting( 'blueplanet_options[slider_status_2]',
	array(
	  'default'              => $new_defaults['slider_status_2'],
	  'capability'           => 'edit_theme_options',
	  'sanitize_callback'    => 'blue_planet_sanitize_select',
	)
);
$wp_customize->add_control(
	'blueplanet_options[slider_status_2]',
	array(
	  'label'       => __( 'Show slider in', 'blue-planet' ),
	  'section'     => 'blue_planet_slider_secondary',
	  'settings'    => 'blueplanet_options[slider_status_2]',
	  'type'        => 'radio',
	  'priority'    => 10,
	  'choices'    => array(
		  'home' => __( 'Home page Only', 'blue-planet' ),
		  'none' => __( 'Disable', 'blue-planet' ),
		),
	)
);

// Setting - number_of_slides_2.
$wp_customize->add_setting( 'blueplanet_options[number_of_slides_2]',
	array(
	'default'              => $new_defaults['number_of_slides_2'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_number_absint',
	)
);
$wp_customize->add_control(
	'blueplanet_options[number_of_slides_2]',
	array(
	'label'           => __( 'Number of slides', 'blue-planet' ),
	'section'         => 'blue_planet_slider_secondary',
	'settings'        => 'blueplanet_options[number_of_slides_2]',
	'type'            => 'number',
	'priority'        => 20,
	'active_callback' => 'blue_planet_check_secondary_slider_status_cb',
	'input_attrs'     => array( 'min' => 1, 'max' => 20, 'style' => 'width: 55px;' ),
	)
);
// Setting - slider_category_2.
$wp_customize->add_setting( 'blueplanet_options[slider_category_2]',
	array(
	  'default'              => $new_defaults['slider_category_2'],
	  'capability'           => 'edit_theme_options',
	  'sanitize_callback'    => 'absint',
	  'sanitize_js_callback' => 'absint',
	)
);
$wp_customize->add_control( new Blue_Planet_Customize_Dropdown_Taxonomies_Control( $wp_customize, 'blueplanet_options[slider_category_2]', array(
	  'label'    => __( 'Select Category', 'blue-planet' ),
	  'name'     => 'blueplanet_options[slider_category_2]',
	  'section'  => 'blue_planet_slider_secondary',
	  'settings' => 'blueplanet_options[slider_category_2]',
	  'type'     => 'dropdown-taxonomies',
	  'priority' => 30,
	  'active_callback' => 'blue_planet_check_secondary_slider_status_cb',
	) ) );


// Setting - transition_effect_2.
$wp_customize->add_setting( 'blueplanet_options[transition_effect_2]',
	array(
	'default'              => $new_defaults['transition_effect_2'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_select',
	)
);
$wp_customize->add_control(
	'blueplanet_options[transition_effect_2]',
	array(
	'label'           => __( 'Transition Effect', 'blue-planet' ),
	'section'         => 'blue_planet_slider_secondary',
	'settings'        => 'blueplanet_options[transition_effect_2]',
	'type'            => 'select',
	'choices'         => blue_planet_get_slider_transition_effects(),
	'priority'        => 30,
	'active_callback' => 'blue_planet_check_secondary_slider_status_cb',
	)
);
// Setting - control_nav_2.
$wp_customize->add_setting( 'blueplanet_options[control_nav_2]',
	array(
	'default'              => $new_defaults['control_nav_2'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_select',
	)
);
$wp_customize->add_control(
	'blueplanet_options[control_nav_2]',
	array(
	'label'           => __( 'Show Control Nav', 'blue-planet' ),
	'section'         => 'blue_planet_slider_secondary',
	'settings'        => 'blueplanet_options[control_nav_2]',
	'type'            => 'radio',
	'choices'         => blue_planet_get_show_hide_options(),
	'priority'        => 40,
	'active_callback' => 'blue_planet_check_secondary_slider_status_cb',
	)
);
// Setting - direction_nav_2.
$wp_customize->add_setting( 'blueplanet_options[direction_nav_2]',
	array(
	'default'              => $new_defaults['direction_nav_2'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_select',
	)
);
$wp_customize->add_control(
	'blueplanet_options[direction_nav_2]',
	array(
	'label'           => __( 'Show Direction Nav', 'blue-planet' ),
	'section'         => 'blue_planet_slider_secondary',
	'settings'        => 'blueplanet_options[direction_nav_2]',
	'type'            => 'radio',
	'priority'        => 50,
	'choices'         => blue_planet_get_show_hide_options(),
	'active_callback' => 'blue_planet_check_secondary_slider_status_cb',
	)
);
// Setting - slider_caption_2.
$wp_customize->add_setting( 'blueplanet_options[slider_caption_2]',
	array(
	'default'              => $new_defaults['slider_caption_2'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_select',
	)
);
$wp_customize->add_control(
	'blueplanet_options[slider_caption_2]',
	array(
	'label'           => __( 'Show Caption', 'blue-planet' ),
	'section'         => 'blue_planet_slider_secondary',
	'settings'        => 'blueplanet_options[slider_caption_2]',
	'type'            => 'radio',
	'priority'        => 60,
	'choices'         => blue_planet_get_on_off_options(),
	'active_callback' => 'blue_planet_check_secondary_slider_status_cb',
	)
);
// Setting - slider_autoplay_2.
$wp_customize->add_setting( 'blueplanet_options[slider_autoplay_2]',
	array(
	'default'              => $new_defaults['slider_autoplay_2'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_select',
	)
);
$wp_customize->add_control(
	'blueplanet_options[slider_autoplay_2]',
	array(
	'label'           => __( 'Enable Auto Play', 'blue-planet' ),
	'section'         => 'blue_planet_slider_secondary',
	'settings'        => 'blueplanet_options[slider_autoplay_2]',
	'type'            => 'radio',
	'priority'        => 70,
	'choices'         => blue_planet_get_on_off_options(),
	'active_callback' => 'blue_planet_check_secondary_slider_status_cb',
	)
);
// Setting - transition_delay_2.
$wp_customize->add_setting( 'blueplanet_options[transition_delay_2]',
	array(
	'default'              => $new_defaults['transition_delay_2'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_number_absint',
	)
);
$wp_customize->add_control(
	'blueplanet_options[transition_delay_2]',
	array(
	'label'           => __( 'Transition Delay', 'blue-planet' ),
	'description'     => __( 'in seconds', 'blue-planet' ),
	'section'         => 'blue_planet_slider_secondary',
	'settings'        => 'blueplanet_options[transition_delay_2]',
	'type'            => 'number',
	'priority'        => 80,
	'active_callback' => 'blue_planet_check_secondary_slider_status_cb',
	'input_attrs'     => array( 'min' => 1, 'max' => 20, 'style' => 'width: 55px;' ),
	)
);
// Setting - transition_length_2.
$wp_customize->add_setting( 'blueplanet_options[transition_length_2]',
	array(
	'default'              => $new_defaults['transition_length_2'],
	'capability'           => 'edit_theme_options',
	'sanitize_callback'    => 'blue_planet_sanitize_number_absint',
	)
);
$wp_customize->add_control(
	'blueplanet_options[transition_length_2]',
	array(
	'label'           => __( 'Transition Length', 'blue-planet' ),
	'description'     => __( 'in seconds', 'blue-planet' ),
	'section'         => 'blue_planet_slider_secondary',
	'settings'        => 'blueplanet_options[transition_length_2]',
	'type'            => 'number',
	'priority'        => 90,
	'active_callback' => 'blue_planet_check_secondary_slider_status_cb',
	'input_attrs'     => array( 'min' => 1, 'max' => 20, 'style' => 'width: 55px;' ),
	)
);
