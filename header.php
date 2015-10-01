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
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
		do_action( 'blue_planet_after_body_open' );
	?>
  <div class="container">
    <div class="container-open-wrapper">
	    <?php
				do_action( 'blue_planet_after_container_open' );
			?>
    </div>

	  <div id="page" class="hfeed site">

    <?php
		do_action( 'blue_planet_after_page_open' );
		?>

			<header id="masthead" class="site-header" role="banner">

		    <?php
					do_action( 'blue_planet_after_masthead_open' );
				?>

		    <?php
					do_action( 'blue_planet_before_masthead_close' );
				?>
			</header><!-- #masthead -->

	    <?php
				do_action( 'blue_planet_after_masthead_close' );
			?>
	    <nav role="navigation" class="blueplanet-nav" id="site-navigation">
        <a href="#content" class="screen-reader-text"><?php esc_html_e( 'Skip to content', 'blue-planet' ); ?></a>

        <?php if ( ! dynamic_sidebar( 'sidebar-top-menu' ) ) :?>

					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class'     => 'nav-menu',
						'menu_id'        => 'menu-top',
						)
					);
					?>

        <?php endif; ?>

	    </nav>

		<div class="clear"></div>

    <div id="content" class="site-content"  style="margin-top:10px;">
    <?php
			do_action( 'blue_planet_after_content_open' );
		?>
