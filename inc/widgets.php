<?php
/**
 * Implementation of widgets
 *
 * @package Blue_Planet
 */

// Load base class.
require_once get_template_directory() . '/lib/widget-base/class-widget-base.php';

/**
 * Register widgets.
 *
 * @since 1.0.0
 */
function blue_planet_load_widgets() {
	// Load Social widget.
	register_widget( 'BP_Social_Widget' );

	// Load Advertisement widget.
	register_widget( 'BP_Advertisement_Widget' );
}

add_action( 'widgets_init', 'blue_planet_load_widgets' );

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

if ( ! class_exists( 'BP_Advertisement_Widget' ) ) :
	/**
	 * Advertisement widget Class.
	 *
	 * @since 1.0.0
	 */
	class BP_Advertisement_Widget extends Blue_Planet_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			$opts = array(
				'classname'   => 'bp_advertisement_widget',
				'description' => __( 'Widget for displaying ads', 'blue-planet' ),
			);

			$fields = array(
				'title'        => array(
					'label' => __( 'Title:', 'blue-planet' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'adcode'       => array(
					'label' => __( 'Ad Code:', 'blue-planet' ),
					'type'  => 'textarea',
					'class' => 'widefat',
				),
				'just_message' => array(
					'label' => _x( 'OR', 'Ad Widget', 'blue-planet' ),
					'type'  => 'message',
				),
				'image'        => array(
					'label'       => __( 'Image:', 'blue-planet' ),
					'type'        => 'url',
					'class'       => 'widefat',
					'placeholder' => __( 'Enter full image URL.', 'blue-planet' ),
				),
				'href'         => array(
					'label' => __( 'Link URL:', 'blue-planet' ),
					'type'  => 'url',
					'class' => 'widefat',
				),
				'target'       => array(
					'label'   => __( 'Open Link in New Window', 'blue-planet' ),
					'type'    => 'checkbox',
					'default' => false,
					'class'   => 'widefat',
				),
				'alt'          => array(
					'label' => __( 'Alt Text:', 'blue-planet' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
			);

			parent::__construct( 'bp-advertisement', __( 'Blue Planet Advertisement', 'blue-planet' ), $opts, array(), $fields );
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

			if ( ! empty( $params['adcode'] ) ) {
				echo $params['adcode']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				$link_open  = '';
				$link_close = '';

				if ( ! empty( $params['href'] ) ) {
					$link_open  = '<a href="' . esc_url( (string) $params['href'] )
					. '" ' . ( ( true === $params['target'] ) ? ' target="_blank" ' : '' ) . '>';
					$link_close = '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}

				if ( ! empty( $params['image'] ) ) {
					echo $link_open . '<img src="' . esc_url( (string) $params['image'] ) . '" alt="' . esc_attr( $params['alt'] ) . '" />' . $link_close; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}

			echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;
