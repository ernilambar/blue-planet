<?php
/**
 * Blue Planet functions and definitions
 *
 * @package Blue_Planet
 */

define( 'BS_THEME_NAME', 'Blue Planet' );
define( 'BS_THEME_SLUG', 'blue-planet' );
define( 'BS_THEME_VERSION', '2.0' );
define( 'BS_SHORT_NAME', 'bsk' );

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
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Blue Planet, use a find and replace
		 * to change 'blue-planet' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'blue-planet', get_template_directory() . '/languages' );

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
		add_image_size( 'homepage-thumb', 285, 215, true ); // (cropped)

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
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Menu Widget Area', 'blue-planet' ),
		'id'            => 'sidebar-top-menu',
		'description'   => esc_html__( 'Widget area in the header. Specially for menu widget', 'blue-planet' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	// Register footer widgets.
	$flg_enable_footer_widgets = blueplanet_get_option( 'flg_enable_footer_widgets' );
	if ( 1 === $flg_enable_footer_widgets ) {
		$number_of_footer_widgets = blueplanet_get_option( 'number_of_footer_widgets' );
		$num_footer = $number_of_footer_widgets;

		for ( $i = 1; $i <= $num_footer ;$i++ ) {
			register_sidebar(array(
				'name'          => esc_html__( 'Footer Column','blue-planet' ) .'-'.$i,
				'id'            => 'footer-area-'.$i,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h1 class="footer-sidebar-title">',
				'after_title'   => '</h1>',
			));

		}
	}

}
add_action( 'widgets_init', 'blue_planet_widgets_init' );

if ( ! function_exists( 'blue_planet_scripts' ) ) :

	/**
	 * Enqueue scripts and styles.
	 */
	function blue_planet_scripts() {

		wp_enqueue_style( 'blue-planet-style', get_stylesheet_uri() );
		wp_enqueue_style( 'blue-planet-style-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', false ,'3.0.0' );
		wp_enqueue_style( 'blue-planet-style-responsive', get_template_directory_uri().'/css/responsive.min.css', false ,'' );

		wp_enqueue_script( 'blue-planet-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20130115', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$slider_status = blueplanet_get_option( 'slider_status' );
		$slider_status_2 = blueplanet_get_option( 'slider_status_2' );
		if ( 'none' !== $slider_status || 'none' !== $slider_status_2 ) {
			wp_enqueue_style( 'nivo-slider-style', get_template_directory_uri().'/thirdparty/nivoslider/nivo-slider.css', false ,'3.2' );
			wp_enqueue_style( 'nivo-slider-style-theme', get_template_directory_uri().'/thirdparty/nivoslider/themes/default/default.css', false ,'3.2' );
			wp_enqueue_script( 'nivo-slider-script', get_template_directory_uri().'/thirdparty/nivoslider/jquery.nivo.slider.pack.js', array( 'jquery' ), '3.2', true );
			wp_register_script( 'blue-planet-theme-script-slider', get_template_directory_uri().'/js/slider.min.js', array( 'jquery', 'nivo-slider-script' ), '2.0.0', true );
			$options = blueplanet_get_option_all();
			wp_localize_script( 'blue-planet-theme-script-slider', 'BP_OPTIONS', $options );
			wp_enqueue_script( 'blue-planet-theme-script-slider' );
		}

		wp_enqueue_style( 'meanmenu-style', get_template_directory_uri().'/thirdparty/meanmenu/meanmenu.min.css', false ,'2.0.6' );
		wp_enqueue_script( 'meanmenu-script', get_template_directory_uri().'/thirdparty/meanmenu/jquery.meanmenu.min.js', array( 'jquery' ), '2.0.6', true );

		wp_enqueue_script( 'blue-planet-theme-script-custom', get_template_directory_uri().'/js/custom.min.js', array( 'jquery' ), '2.0.0', true );

		// Scripts for IE hack.
		global $wp_scripts;
		wp_enqueue_script( 'blue-planet-html5shiv', get_template_directory_uri() . '/js/html5shiv.js', array(), '3.6', false );
		$wp_scripts->add_data( 'blue-planet-html5shiv', 'conditional', 'lt IE 9' );
		wp_enqueue_script( 'blue-planet-respond', get_template_directory_uri() . '/js/respond.min.js', array(), '1.1.0', false );
		$wp_scripts->add_data( 'blue-planet-respond', 'conditional', 'lt IE 9' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'blue_planet_scripts' );

/**
 * Include customizer settings.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Include custom theme functions.
 */
require get_template_directory() . '/inc/theme-custom.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Theme Widgets.
 */
require get_template_directory() . '/inc/widgets.php';
