<?php
/**
 * Social Widget.
 *
 * @package Blue_Planet
 */

/**
 * Social widget Class.
 *
 * @since 1.0.0
 */
class BP_Social_Widget  extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 *
	 * @since 1.0.0
	 */
	function __construct() {
		$opts = array(
					'classname'     => 'bp_social_widget',
					'description'   => __( 'Display Social links in your sidebar', 'blue-planet' ),
				);

		parent::__construct( 'bp-social', __( 'Blue Planet Social', 'blue-planet' ), $opts );
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

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		global $blueplanet_options_settings;

		$bp_options = $blueplanet_options_settings;

		echo '<div class="social-widget-wrapper">';

		$social_sites = array( 'facebook','twitter','googleplus','youtube','pinterest','linkedin','flickr','tumblr','dribbble','deviantart','rss','instagram','skype','digg','stumbleupon','forrst','500px','vimeo' );

		foreach ( $social_sites as $key => $site ) {
			if ( '' !== $bp_options[ "social_$site" ] ) {
				echo '<a class="social-' . esc_attr( $site ) . '" href="'.esc_url( $bp_options[ "social_$site" ] ).'"></a>';
			}
		}
		if ( '' !== $bp_options['social_email'] ) {
			echo '<a class="social-email" href="mailto:'.esc_attr( $bp_options['social_email'] ).'"></a>';
		}
		echo '</div>';

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
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '' ) );
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
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

		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];

		?>
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'blue-planet' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p><?php echo esc_html_e( 'This widget will display social links from Theme Options.','blue-planet' );  ?></p>
		<?php
	}
}
