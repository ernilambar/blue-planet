<?php
/**
 * Implementation of widgets
 *
 * @package Blue_Planet
 */

/**
 * Register widgets.
 *
 * @since 1.0.0
 */
function blue_planet_load_widgets() {
	// Load base class.
	require_once get_template_directory() . '/lib/widget-base/class-widget-base.php';

	// Load custom widgets.
	require_once get_template_directory() . '/inc/widgets/class-bp-social-widget.php';
	require_once get_template_directory() . '/inc/widgets/class-bp-advertisement-widget.php';

	// Register widgets.
	register_widget( 'BP_Social_Widget' );
	register_widget( 'BP_Advertisement_Widget' );
}

add_action( 'widgets_init', 'blue_planet_load_widgets' );
