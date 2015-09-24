<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Blue Planet
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function blue_planet_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'blue_planet_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blue_planet_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'blue_planet_body_classes' );

if ( ! function_exists( 'blue_planet_featured_image_instruction' ) ) :
//Messgae to show in the Featured Image Meta box
function blue_planet_featured_image_instruction( $content ) {
    $content .= '<strong>'.__( 'Recommended image sizes', 'blue-planet' ).'</strong><br/>';
    $content .= '<br/>'.__( 'Secondary Slider : 720px X 350px', 'blue-planet' );
    return $content;
}
endif; // blue_planet_featured_image_instruction
add_filter( 'admin_post_thumbnail_html', 'blue_planet_featured_image_instruction');
//////////////

if ( ! function_exists( 'blue_planet_sanitize_hex_color' ) ) :
	function blue_planet_sanitize_hex_color( $color ) {
		if ( '' === $color )
			return '';

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
			return $color;

		return null;
	}
endif; // blue_planet_sanitize_hex_color


if ( ! function_exists( 'blue_planet_dumb_css_sanitize' ) ) :
	function blue_planet_dumb_css_sanitize( $css ) {
		$css = str_replace( '<=', '<=', $css );
		$css = wp_kses_split( $css, array(), array() );
		$css = str_replace( '>', '>', $css );
		$css = strip_tags( $css );
		return $css;
	}
endif; // blue_planet_dumb_css_sanitize
