<?php
/**
 * Blue Planet functions and definitions
 *
 * @package Blue_Planet
 */

if ( ! function_exists( 'blue_planet_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function blue_planet_setup() {

		/**
	   * Set the content width based on the theme's design and stylesheet.
	   */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 730;
		}

		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'blue-planet' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Add support for custom backgrounds.
		add_theme_support( 'custom-background' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'homepage-thumb', 285, 215, true ); // Cropped image.

		// Register nav menu.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'blue-planet' ),
			'footer'  => esc_html__( 'Footer Menu', 'blue-planet' ),
		) );

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		// Setup the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'blue_planet_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Load up theme options defaults.
		require( get_template_directory() . '/inc/blueplanet-themeoptions-defaults.php' );

        // Editor style.
        add_editor_style();

        /**
         * Enable support for footer widgets.
         */
        add_theme_support( 'footer-widgets', 4 );

        // Include supports.
        require get_template_directory() . '/inc/supports.php';

        // Custom header.
        add_theme_support( 'custom-header', apply_filters( 'blue_planet_custom_header_args', array(
			'default-image'      => '',
			'default-text-color' => '#ffffff',
			'width'              => 1140,
			'height'             => 152,
			'flex-height'        => true,
			'wp-head-callback'   => 'blue_planet_header_style',
        ) ) );

	}
endif;
add_action( 'after_setup_theme', 'blue_planet_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function blue_planet_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'blue-planet' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'blue-planet' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Menu Widget Area', 'blue-planet' ),
		'id'            => 'sidebar-top-menu',
		'description'   => esc_html__( 'Widget area in the header. Specially for menu widget.', 'blue-planet' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'blue_planet_widgets_init' );

if ( ! function_exists( 'blue_planet_scripts' ) ) :

	/**
	 * Enqueue scripts and styles.
	 */
	function blue_planet_scripts() {

		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_style( 'blue-planet-style-bootstrap', get_template_directory_uri().'/thirdparty/bootstrap/css/bootstrap' . $min . '.css', false ,'3.3.6' );
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/thirdparty/genericons/genericons' . $min . '.css', array(), '3.4.1' );
        wp_enqueue_style( 'meanmenu-style', get_template_directory_uri().'/thirdparty/meanmenu/meanmenu' . $min . '.css', false ,'2.0.6' );
        wp_enqueue_style( 'blue-planet-style', get_stylesheet_uri(), array(), '3.6' );

        $banner_background_color = blue_planet_get_option( 'banner_background_color' );
        $custom_css = blue_planet_get_option( 'custom_css' );
        $custom_style = "header#masthead{background-color:" . esc_attr( $banner_background_color ) . ";}";
        if ( ! empty( $custom_css ) ) {
            $custom_style .= $custom_css;
        }
        wp_add_inline_style( 'blue-planet-style', $custom_style );

        wp_enqueue_script( 'blue-planet-navigation', get_template_directory_uri() . '/js/navigation' . $min . '.js', array(), '20120206', true );
		wp_enqueue_script( 'blue-planet-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $min . '.js', array(), '20130115', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$slider_status = blue_planet_get_option( 'slider_status' );
		$slider_status_2 = blue_planet_get_option( 'slider_status_2' );
		if ( 'none' !== $slider_status || 'none' !== $slider_status_2 ) {
			wp_enqueue_style( 'nivo-slider-style', get_template_directory_uri().'/thirdparty/nivoslider/nivo-slider' . $min . '.css', false ,'3.2' );
			wp_enqueue_style( 'nivo-slider-style-theme', get_template_directory_uri().'/thirdparty/nivoslider/themes/default/default' . $min . '.css', false ,'3.2' );
			wp_enqueue_script( 'nivo-slider-script', get_template_directory_uri().'/thirdparty/nivoslider/jquery.nivo.slider' . $min . '.js', array( 'jquery' ), '3.2', true );
			wp_register_script( 'blue-planet-theme-script-slider', get_template_directory_uri().'/js/slider' . $min . '.js', array( 'jquery', 'nivo-slider-script' ), '2.0.0', true );
			$options = blue_planet_get_option_all();
			wp_localize_script( 'blue-planet-theme-script-slider', 'BP_OPTIONS', $options );
			wp_enqueue_script( 'blue-planet-theme-script-slider' );
		}

		wp_enqueue_script( 'meanmenu-script', get_template_directory_uri().'/thirdparty/meanmenu/jquery.meanmenu' . $min . '.js', array( 'jquery' ), '2.0.6', true );

		wp_enqueue_script( 'blue-planet-theme-script-custom', get_template_directory_uri().'/js/custom' . $min . '.js', array( 'jquery' ), '2.0.0', true );

		// Scripts for IE hack.
		wp_enqueue_script( 'blue-planet-html5shiv', get_template_directory_uri() . '/js/html5shiv' . $min . '.js', array(), '3.7.3', false );
        wp_script_add_data( 'blue-planet-html5shiv', 'conditional', 'lt IE 9' );
        wp_enqueue_script( 'blue-planet-respond', get_template_directory_uri() . '/js/respond' . $min . '.js', array(), '1.4.2', false );
        wp_script_add_data( 'blue-planet-respond', 'conditional', 'lt IE 9' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'blue_planet_scripts' );

/**
 * Include customizer settings.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Deprecated functions.
 */
require get_template_directory() . '/inc/deprecated.php';

/**
 * Include custom helper functions.
 */
require get_template_directory() . '/inc/theme-functions.php';
/**
 * Include custom theme hooks.
 */
require get_template_directory() . '/inc/theme-custom.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Theme Widgets.
 */
require get_template_directory() . '/inc/widgets.php';
