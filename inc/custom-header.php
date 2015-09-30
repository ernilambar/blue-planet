<?php
/**
 * Implementation of the Custom Header feature.
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package Blue_Planet
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses blue_planet_header_style()
 *
 * @package Blue_Planet
 */
function blue_planet_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'blue_planet_custom_header_args', array(
		'default-image'      => '',
		'default-text-color' => '000000',
		'width'              => 1140,
		'height'             => 152,
		'flex-height'        => true,
		'wp-head-callback'   => 'blue_planet_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'blue_planet_custom_header_setup' );

if ( ! function_exists( 'blue_planet_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog
	 *
	 * @see blue_planet_custom_header_setup().
	 */
	function blue_planet_header_style() {
		$header_text_color = get_header_textcolor();

		// If no custom options for text are set, let's bail.
		if ( HEADER_TEXTCOLOR === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( 'blank' === $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
	}
endif;
