<?php
/**
 * Footer Widgets support.
 *
 * @package Blue_Planet
 */

/**
 * Footer Widgets class.
 *
 * @since 1.0.0
 */
class Blue_Planet_Footer_Widgets {

	/**
	 * Maximum widgets.
	 *
	 * @var int
	 */
	protected $max_widgets = 0;

	/**
	 * Active widgets.
	 *
	 * @var int
	 */
	protected $active_widgets = 0;

	/**
	 * Theme prefix.
	 *
	 * @var string
	 */
	protected $theme_prefix = 'blue_planet';

	/**
	 * Construcor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->setup();
		$this->init();
	}

	/**
	 * Initial setup.
	 *
	 * @since 1.0.0
	 */
	public function setup() {

		$support = get_theme_support( 'footer-widgets' );
		if ( empty( $support ) ) {
			return;
		}
		if ( absint( $support[0] ) < 1 ) {
			return;
		}
		$this->max_widgets    = absint( $support[0] );
		$this->active_widgets = $this->get_number_of_active_widgets();
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		if ( $this->max_widgets < 1 ) {
			return;
		}

		// Register footer widgets.
		add_action( 'widgets_init', array( $this, 'footer_widgets_init' ), 20 );

		if ( $this->active_widgets > 0 ) {

			// Add footer widgets in front end.
			add_action( $this->theme_prefix . '_after_content_close', array( $this, 'add_footer_widgets' ) );
			// Add custom class in widgets.
			add_filter( $this->theme_prefix . '_filter_footer_widget_class', array( $this, 'custom_footer_widget_class' ) );
		}
	}

	/**
	 * Register footer widgets.
	 *
	 * @since 1.0.0
	 */
	public function footer_widgets_init() {

		for ( $i = 1; $i <= $this->max_widgets; $i++ ) {
			register_sidebar(
				array(
					/* translators: %d: Column number. */
					'name'          => sprintf( __( 'Footer Column %d', 'blue-planet' ), $i ),
					'id'            => sprintf( 'footer-area-%d', $i ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
		}
	}

	/**
	 * Returns number of active footer widgets.
	 *
	 * @since 1.0.0
	 */
	private function get_number_of_active_widgets() {

		$count = 0;

		for ( $i = 1; $i <= $this->max_widgets; $i++ ) {
			if ( is_active_sidebar( 'footer-area-' . $i ) ) {
				++$count;
			}
		}

		return $count;
	}

	/**
	 * Add custom class in widgets.
	 *
	 * @since 1.0.0
	 *
	 * @param string $input CSS class.
	 */
	public function custom_footer_widget_class( $input ) {

		$footer_widgets_number = $this->active_widgets;

		if ( $footer_widgets_number > 0 ) {
			switch ( $footer_widgets_number ) {
				case 1:
					$input .= 'col-sm-12';
					break;

				case 2:
					$input .= 'col-sm-6';
					break;

				case 3:
					$input .= 'col-sm-4';
					break;

				case 4:
					$input .= 'col-sm-3';
					break;

				default:
					break;
			}
		}

		return $input;
	}

	/**
	 * Add footer widgets content in front end.
	 *
	 * @since 1.0.0
	 */
	public function add_footer_widgets() {
		$flag_apply_footer_widgets_content = apply_filters( $this->theme_prefix . '_filter_footer_widgets', true );

		if ( true !== $flag_apply_footer_widgets_content ) {
			return false;
		}

		$args = array(
			'container' => 'div',
			'before'    => '<div class="row">',
			'after'     => '</div><!-- .row -->',
		);

		echo $this->get_footer_widgets_content( $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Returns all active footer widgets number in array.
	 *
	 * @since 1.0.0
	 */
	public function all_active_widgets() {

		$arr = array();

		for ( $i = 1; $i <= $this->max_widgets; $i++ ) {
			if ( is_active_sidebar( 'footer-area-' . $i ) ) {
				$arr[] = $i;
			}
		}
		return $arr;
	}

	/**
	 * Returns footer widget contents.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Arguments.
	 */
	public function get_footer_widgets_content( $args ) {
		$number = $this->active_widgets;

		$all_active_widgets = $this->all_active_widgets();

		// Defaults.
		$args = wp_parse_args(
			(array) $args,
			array(
				'container'       => 'div',
				'container_class' => 'footer-widgets-wrapper',
				'container_style' => '',
				'container_id'    => 'footer-widgets',
				'wrap_class'      => 'footer-widget-area',
				'before'          => '',
				'after'           => '',
			)
		);
		$args = apply_filters( $this->theme_prefix . '_filter_footer_widgets_args', $args );

		ob_start();
		$container_open  = '';
		$container_close = '';

		if ( ! empty( $args['container_class'] ) || ! empty( $args['container_id'] ) ) {
			$container_open = sprintf(
				'<%s %s %s %s>',
				$args['container'],
				( $args['container_class'] ) ? 'class="' . $args['container_class'] . '"' : '',
				( $args['container_id'] ) ? 'id="' . $args['container_id'] . '"' : '',
				( $args['container_style'] ) ? 'style="' . esc_attr( $args['container_style'] ) . '"' : ''
			);
		}
		if ( ! empty( $args['container_class'] ) || ! empty( $args['container_id'] ) ) {
			$container_close = sprintf(
				'</%s>',
				$args['container']
			);
		}

		echo $container_open; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		echo $args['before']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		for ( $i = 1; $i <= $number; $i++ ) {
			$item_class  = apply_filters( $this->theme_prefix . '_filter_footer_widget_class', '', $i );
			$div_classes = implode( ' ', array( $item_class, $args['wrap_class'] ) );

			echo '<div class="' . esc_attr( $div_classes ) . '">';
			$sidebar_name = 'footer-area-' . $all_active_widgets[ $i - 1 ];
			dynamic_sidebar( $sidebar_name );
			echo '</div><!-- .' . esc_attr( $args['wrap_class'] ) . ' -->';
		}

		echo $args['after']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		echo $container_close; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}

$blue_planet_footer_widgets = new Blue_Planet_Footer_Widgets();
