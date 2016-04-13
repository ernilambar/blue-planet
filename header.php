<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Blue_Planet
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'blue_planet_after_body_open' ); ?>
	<a href="#content" class="screen-reader-text"><?php esc_html_e( 'Skip to content', 'blue-planet' ); ?></a>
  <div class="container">
    <div class="container-open-wrapper">
	    <?php do_action( 'blue_planet_after_container_open' ); ?>
    </div>

	  <div id="page" class="hfeed site">

	    <?php do_action( 'blue_planet_after_page_open' ); ?>

			<header id="masthead" class="site-header" role="banner">

		    <?php do_action( 'blue_planet_after_masthead_open' ); ?>

		    <?php do_action( 'blue_planet_before_masthead_close' ); ?>
			</header><!-- #masthead -->

	    <?php do_action( 'blue_planet_after_masthead_close' ); ?>
	    <nav role="navigation" class="blueplanet-nav" id="site-navigation" aria-label="<?php _e( 'Primary Menu', 'blue-planet' ); ?>">

        <?php if ( ! dynamic_sidebar( 'sidebar-top-menu' ) ) : ?>

	        	<button class="menu-toggle" aria-hidden="true"><?php esc_html_e( 'Primary Menu', 'blue-planet' ); ?></button>
					<?php
					wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'nav-menu',
                        'menu_id'        => 'menu-top',
                        'fallback_cb'    => 'blue_planet_primary_navigation_fallback',
						)
					);
					?>

        <?php endif; ?>

	    </nav>

		<div class="clear"></div>

    <?php do_action( 'blue_planet_before_content_open' ); ?>

    <div id="content" class="site-content">

    <?php do_action( 'blue_planet_after_content_open' ); ?>
