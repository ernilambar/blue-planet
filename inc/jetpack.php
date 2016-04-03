<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Blue_Planet
 */

/**
 * Add theme support for Infinite Scroll.
 */
function blue_planet_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'blue_planet_jetpack_setup' );
