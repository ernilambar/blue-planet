<?php
/**
 * Social widget
 *
 * @package Blue_Planet
 */

if ( ! class_exists( 'BP_Social_Widget' ) ) :

	/**
	 * Social widget Class.
	 *
	 * @since 1.0.0
	 */
	class BP_Social_Widget extends Blue_Planet_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$opts = array(
				'classname'   => 'bp_social_widget',
				'description' => __( 'Display Social links in your sidebar', 'blue-planet' ),
			);

			$fields = array(
				'title'          => array(
					'label' => __( 'Title:', 'blue-planet' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'social_message' => array(
					'label' => __( 'This widget will display social links from Theme Options.', 'blue-planet' ),
					'type'  => 'message',
				),
			);

			parent::__construct( 'bp-social', __( 'Blue Planet Social', 'blue-planet' ), $opts, array(), $fields );
		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		public function widget( $args, $instance ) {
			$params = $this->get_params( $instance );

			echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			// Render social links.
			blue_planet_generate_social_links();

			echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;
