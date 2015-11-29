<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Blue_Planet
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
 * @return array Body classes
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
	/**
	 * Message to show in the Featured Image Meta box.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content Admin post thumbnail HTML markup.
	 * @param int    $post_id Post ID.
	 * @return string HTML.
	 */
	function blue_planet_featured_image_instruction( $content, $post_id ) {

		if ( 'post' === get_post_type( $post_id ) ) {
			$content .= '<strong>' . __( 'Recommended image sizes', 'blue-planet' ) . '</strong><br/>';
			$content .= '<br/>' . sprintf( __( 'Secondary Slider : %dpx X %dpx', 'blue-planet' ), 720, 350 );
		}

		return $content;
	}
endif;

add_filter( 'admin_post_thumbnail_html', 'blue_planet_featured_image_instruction', 10, 2 );
