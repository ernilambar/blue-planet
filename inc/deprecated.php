<?php

// Deprecated functions.
function blue_planet_custom_css() {}

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
