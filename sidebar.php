<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Blue_Planet
 */

?>
<?php do_action( 'blue_planet_before_secondary_open' ); ?>
<div id="secondary" class="widget-area col-md-4" role="complementary">
	<?php do_action( 'blue_planet_after_secondary_open' ); ?>

	<?php do_action( 'blue_planet_before_widget' ); ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) :  ?>

		<?php dynamic_sidebar( 'sidebar-1' ); ?>

	<?php else : ?>
		<?php
		$widget = 'WP_Widget_Text';
		$instance = array(
			'title' => esc_html__( 'Sidebar', 'blue-planet' ),
			'text'  => esc_html__( 'Widgets of Sidebar will be displayed here.', 'blue-planet' ),
			);
		$args = array(
			'before_title' => '<h2 class="widget-title">',
			'after_title'  => '</h2>',
			);
		the_widget( $widget, $instance, $args );
		?>
	<?php endif; ?>


	<?php do_action( 'blue_planet_after_widget' ); ?>

	<?php do_action( 'blue_planet_before_secondary_close' ); ?>
</div><!-- #secondary -->
