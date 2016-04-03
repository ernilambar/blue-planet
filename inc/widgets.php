<?php
/**
 * Implementation of widgets.
 *
 * @package Blue_Planet
 */

require_once get_template_directory() . '/lib/widget-base/class-widget-base.php';

/**
 * Register widgets
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
		function __construct() {
			$opts = array(
				'classname'   => 'bp_social_widget',
				'description' => __( 'Display Social links in your sidebar', 'blue-planet' ),
				);
			$fields = array(
				'title' => array(
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
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			// Render social links.
			blue_planet_generate_social_links();

			echo $args['after_widget'];

		}
	}
endif;


if ( ! class_exists( 'BP_Advertisement_Widget' ) ) :

	/**
	 * Advertisement widget Class.
	 *
	 * @since 1.0.0
	 */
	class BP_Advertisement_Widget  extends WP_Widget {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
						'classname'     => 'bp_advertisement_widget',
						'description'   => esc_html__( 'Widget for displaying ads', 'blue-planet' ),
					);
			parent::__construct( 'bp-advertisement', esc_html__( 'Blue Planet Advertisement', 'blue-planet' ), $opts );
		}


		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$adcode = ! empty( $instance['adcode'] ) ? $instance['adcode'] : '';
			$image  = ! empty( $instance['image'] ) ? $instance['image'] : '';
			$href   = ! empty( $instance['href'] ) ? $instance['href'] : '';
			$target = ! empty( $instance['target'] ) ? 'true' : 'false';
			$alt    = ! empty( $instance['alt'] ) ? $instance['alt'] : '';

			echo $args['before_widget'];
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			if ( ! empty( $adcode ) ) {
				echo $adcode;
			} else {
				echo '<a href="' . esc_url( $href ) . '" ';
				echo ($target)?' target="_blank"':'';
				echo ' ><img src="'. esc_url( $image ) . '" alt="' . esc_attr( $alt ) . '" /></a>';
			}

			echo $args['after_widget'];

		}

		/**
		 * Update widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            {@see WP_Widget::form()}.
		 * @param array $old_instance Old settings for this instance.
		 * @return array Settings to save or bool false to cancel saving.
		 */
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title']  = sanitize_text_field( $new_instance['title'] );
			$instance['adcode'] = wp_kses_stripslashes( $new_instance['adcode'] );
			$instance['image']  = esc_url( $new_instance['image'] );
			$instance['href']   = esc_url( $new_instance['href'] );
			$instance['target'] = ! empty( $new_instance['target'] ) ? 1 : 0;
			$instance['alt']    = sanitize_text_field( $new_instance['alt'] );

			return $instance;
		}

		/**
		 * Output the settings update form.
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance Current settings.
		 */
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array(
				'title'  => '',
				'adcode' => '',
				'image'  => '',
				'href'   => '',
				'target' => 0,
				'alt'    => '',
				)
			);
			$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$adcode = isset( $instance['adcode'] ) ? esc_textarea( $instance['adcode'] ) : '';
			$image  = isset( $instance['image'] ) ? esc_url( $instance['image'] ) : '';
			$href   = isset( $instance['href'] ) ? esc_url( $instance['href'] ) : '';
			$target = isset( $instance['target'] ) ? esc_attr( $instance['target'] ) : '';
			$alt    = isset( $instance['alt'] ) ? esc_attr( $instance['alt'] ) : '';
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'blue-planet' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<hr/>
			<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'adcode' ) ); ?>"><?php esc_html_e( 'Ad Code:','blue-planet' ); ?></label>
					<textarea name="<?php echo esc_attr( $this->get_field_name( 'adcode' ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'adcode' ) ); ?>"><?php echo $adcode; ?></textarea>
				</p>
			<?php endif; ?>
			<hr >
			<p style="text-align:center;"><strong><?php echo esc_html_x( 'OR', 'Ad Widget', 'blue-planet' ) ?></strong></p>
			<hr >
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Image URL:','blue-planet' ); ?></label>
				<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" value="<?php echo esc_url( $image ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'href' ) ); ?>"><?php esc_html_e( 'Link URL:','blue-planet' ); ?></label>
				<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'href' ) ); ?>" value="<?php echo esc_url( $href ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'href' ) ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open Link in New Window', 'blue-planet' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" <?php checked( isset( $instance['target'] ) ? $instance['target'] : 0 ); ?> />


			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'alt' ) ); ?>"><?php esc_html_e( 'Alt text:','blue-planet' ); ?></label>
				<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'alt' ) ); ?>" value="<?php echo esc_attr( $alt ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'alt' ) ); ?>" />
			</p>
			<hr>



			<?php }
	}


endif;
