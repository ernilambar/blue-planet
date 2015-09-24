<?php
/**
 * Template Name: Full Width
 *
 * @package Blue Planet
 */

get_header(); ?>
	<div id="primary" class="content-area col-md-12 col-sm-12 col-xs-12 pull-left">
	<?php
	//
	do_action( 'blue_planet_after_primary_open' );
	//
	?>
		<main id="main" class="site-main" role="main">
		<?php
		//
		do_action( 'blue_planet_after_main_open' );
		//
		?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

			<?php
			//
			do_action( 'blue_planet_before_main_close' );
			//
			?>
		</main><!-- #main -->
		<?php
		//
		do_action( 'blue_planet_before_primary_close' );
		//
		?>
	</div><!-- #primary -->

<?php get_footer(); ?>
