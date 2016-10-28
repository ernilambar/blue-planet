<?php
/**
 * Customizer Reset section.
 *
 * @package Blue_Planet
 */

	// Reset Section.
	$wp_customize->add_section( 'blue_planet_reset_section',
		array(
			'title'       => esc_html__( 'Reset Theme Settings', 'blue-planet' ),
			'description' => esc_html__( 'Caution: This will delete your customization and reset to default as installed first time. Please refresh the page to see effect.', 'blue-planet' ),
			'priority'    => 900,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blue_planet_options_panel',
		)
	);

	// Setting - reset_theme_settings.
	$wp_customize->add_setting( 'blueplanet_options[reset_theme_settings]',
		array(
			'default'              => $new_defaults['reset_theme_settings'],
			'capability'           => 'edit_theme_options',
			'transport'            => 'postMessage',
			'sanitize_callback'    => 'blue_planet_sanitize_checkbox_input',
			'sanitize_js_callback' => 'blue_planet_sanitize_checkbox_output',
		)
	);
	$wp_customize->add_control(
		'reset_theme_settings',
		array(
			'label'       => esc_html__( 'Reset Theme Settings', 'blue-planet' ),
			'section'     => 'blue_planet_reset_section',
			'settings'    => 'blueplanet_options[reset_theme_settings]',
			'type'        => 'checkbox',
			'priority'    => 35,
		)
	);
