<?php
/**
 * Custom hooks
 *
 * @package Blue_Planet
 */

use Nilambar\AdminNotice\Notice;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array Body classes
 */
function blue_planet_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'custom-header-enabled';
	} else {
		$classes[] = 'custom-header-disabled';
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

			/* translators: 1: Slider width, 2: Slider height. */
			$content .= '<br/>' . sprintf( __( 'Secondary Slider : %1$dpx X %2$dpx', 'blue-planet' ), 720, 350 );
		}

		return $content;
	}
endif;

add_filter( 'admin_post_thumbnail_html', 'blue_planet_featured_image_instruction', 10, 2 );

if ( ! function_exists( 'blue_planet_excerpt_readmore' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function blue_planet_excerpt_readmore( $more ) {
		global $post;

		if ( is_admin() ) {
			return $more;
		}

		$read_more_text = blue_planet_get_option( 'read_more_text' );

		if ( ! empty( $read_more_text ) ) {
			$more = '&hellip;';
		}

		$output = $more . ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="readmore">' . esc_attr( $read_more_text ) . '<span class="screen-reader-text">"' . esc_html( get_the_title() ) . '"</span></a>';

		$output = apply_filters( 'blue_planet_filter_read_more_content', $output );

		return $output;
	}
endif;

add_filter( 'excerpt_more', 'blue_planet_excerpt_readmore' );

if ( ! function_exists( 'blue_planet_custom_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function blue_planet_custom_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		$excerpt_length = blue_planet_get_option( 'excerpt_length' );

		return apply_filters( 'blue_planet_filter_excerpt_length', absint( $excerpt_length ) );
	}
endif;

add_filter( 'excerpt_length', 'blue_planet_custom_excerpt_length', 999 );

if ( ! function_exists( 'blue_planet_copyright_text_content' ) ) :

	/**
	 * Implement copyright text in footer.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_copyright_text_content() {
		$copyright_text = blue_planet_get_option( 'copyright_text' );

		if ( empty( $copyright_text ) ) {
			return;
		}

		$copyright_content = apply_filters( 'blue_planet_filter_copyright_text_content', $copyright_text );

		echo '<div class="copyright">' . wp_kses_post( $copyright_content ) . '</div>';
	}
endif;

add_action( 'blue_planet_credits', 'blue_planet_copyright_text_content' );



/**
 * Add admin notice.
 *
 * @since 3.9.1
 */
function blue_planet_add_admin_notice() {
	// Setup notice.
	Notice::init(
		array(
			'slug' => 'blue-planet',
			'type' => 'theme',
			'name' => esc_html__( 'Blue Planet', 'blue-planet' ),
		)
	);
}

add_action( 'admin_init', 'blue_planet_add_admin_notice' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function blue_planet_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}

add_action( 'wp_print_footer_scripts', 'blue_planet_skip_link_focus_fix' );


if ( ! function_exists( 'blue_planet_header_social' ) ) :

	/**
	 * Implement social links in header.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_header_social() {
		$flg_hide_social_icons = blue_planet_get_option( 'flg_hide_social_icons' );

		if ( 1 !== $flg_hide_social_icons ) {
			blue_planet_generate_social_links();
		}
	}
endif;

add_action( 'blue_planet_after_container_open', 'blue_planet_header_social' );

if ( ! function_exists( 'blue_planet_footer_social' ) ) :

	/**
	 * Implement social links in footer.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_footer_social() {
		$flg_hide_footer_social_icons = blue_planet_get_option( 'flg_hide_footer_social_icons' );

		if ( 1 !== $flg_hide_footer_social_icons ) {
			blue_planet_generate_social_links();
		}
	}
endif;

add_action( 'blue_planet_before_page_close', 'blue_planet_footer_social' );

if ( ! function_exists( 'blue_planet_goto_top' ) ) :

	/**
	 * Implement go to top.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_goto_top() {
		$flg_enable_goto_top = blue_planet_get_option( 'flg_enable_goto_top' );

		if ( 1 === $flg_enable_goto_top ) {
			echo '<a href="#" class="scrollup"><span class="genericon genericon-collapse" aria-hidden="true"></span><span class="screen-reader-text">' . esc_html__( 'Go to top', 'blue-planet' ) . '</span></a>';
		}
	}
endif;

add_action( 'blue_planet_before_container_close', 'blue_planet_goto_top' );

if ( ! function_exists( 'blue_planet_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 2.3
	 */
	function blue_planet_custom_content_width() {

		global $post, $content_width;
		if ( is_page() ) {
			if ( is_page_template( 'templates/page-full-width.php' ) ) {
				$content_width = 1110;
			} elseif ( is_page_template( array( 'templates/page-content-sidebar.php', 'templates/page-sidebar-content.php', 'templates/page-one-column-disabled-sidebar.php' ) ) ) {
				$content_width = 730;
			}
		}
	}
endif;

add_filter( 'template_redirect', 'blue_planet_custom_content_width' );

if ( ! function_exists( 'blue_planet_add_image_in_single_display' ) ) :

	/**
	 * Add image in single post.
	 *
	 * @since 3.0
	 */
	function blue_planet_add_image_in_single_display() {

		global $post;
		if ( has_post_thumbnail() ) {
			$single_image           = blue_planet_get_option( 'single_image' );
			$single_image_alignment = blue_planet_get_option( 'single_image_alignment' );
			if ( 'disable' !== $single_image ) {
				$args = array(
					'class' => 'align' . $single_image_alignment,
				);
				the_post_thumbnail( $single_image, $args );
			}
		}
	}

endif;

add_action( 'blue_planet_single_image', 'blue_planet_add_image_in_single_display' );

if ( ! function_exists( 'blue_planet_import_custom_css' ) ) :

	/**
	 * Import Custom CSS.
	 *
	 * @since 3.5.0
	 */
	function blue_planet_import_custom_css() {

		// Bail if not WP 4.7.
		if ( ! function_exists( 'wp_get_custom_css_post' ) ) {
			return;
		}

		$custom_css = blue_planet_get_option( 'custom_css' );

		// Bail if there is no Custom CSS.
		if ( empty( $custom_css ) ) {
			return;
		}

		$core_css = wp_get_custom_css();
		$return   = wp_update_custom_css_post( $core_css . $custom_css );

		if ( ! is_wp_error( $return ) ) {

			// Remove from theme.
			$options               = blue_planet_get_option_all();
			$options['custom_css'] = '';
			set_theme_mod( 'blueplanet_options', $options );
		}
	}
endif;

add_action( 'after_setup_theme', 'blue_planet_import_custom_css', 99 );
