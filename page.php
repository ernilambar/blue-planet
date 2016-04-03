<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Blue_Planet
 */

get_header(); ?>
	<div id="primary" class="content-area col-md-8 col-sm-12 col-xs-12 <?php echo esc_attr( blue_planet_layout_setup_class() ); ?>">
		<?php do_action( 'blue_planet_after_primary_open' ); ?>
		<main id="main" class="site-main" role="main">
		<?php do_action( 'blue_planet_after_main_open' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>

			<?php endwhile; ?>

			<?php do_action( 'blue_planet_before_main_close' ); ?>
		</main><!-- #main -->
		<?php do_action( 'blue_planet_before_primary_close' ); ?>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
