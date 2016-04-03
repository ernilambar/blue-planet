<?php

// Deprecated functions.
function blue_planet_custom_css() {}

function blue_planet_paging_nav() {}

function blue_planet_post_nav() {}


/**
 * Get default theme options.
 *
 * @since 1.0.0
 * @deprecated 3.0
 *
 * @return array Default theme options.
 */
function blueplanet_get_default_options() {

	_deprecated_function( 'blueplanet_get_default_options', '3.0', 'blue_planet_get_default_options' );

	return blue_planet_get_default_options();

}

/**
 * Get all theme options.
 *
 * @since 1.0.0
 * @deprecated 3.0
 *
 * @return array Theme options.
 */
function blueplanet_get_option_all() {

	_deprecated_function( 'blueplanet_get_option_all', '3.0', 'blue_planet_get_option_all' );

	return blue_planet_get_option_all();

}

/**
 * Get theme option.
 *
 * @since 1.0.0
 * @deprecated 3.0
 *
 * @param string $key Option key.
 * @return mixed Option value.
 */
function blueplanet_get_option( $key ) {

	_deprecated_function( 'blueplanet_get_option', '3.0', 'blue_planet_get_option' );

	return blue_planet_get_option( $key );

}
