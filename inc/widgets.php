<?php
/**
 * Implementation of widgets.
 *
 * @package Blue_Planet
 */

/**
 * Load and register widgets
 *
 * @since 1.0.0
 */
function blue_planet_load_widgets() {
	// Load Social widget.
	load_template( get_template_directory() . '/inc/widgets/social.php' );
	register_widget( 'BP_Social_Widget' );

	// Load Advertisement widget.
	load_template( get_template_directory() . '/inc/widgets/advertisement.php' );
	register_widget( 'BP_Advertisement_Widget' );
}

add_action( 'widgets_init', 'blue_planet_load_widgets' );
