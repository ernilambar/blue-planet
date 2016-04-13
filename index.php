<?php
/**
 * The main template file.
 *
 * @see http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blue_Planet
 */

get_header(); ?>

	<div id="primary" class="content-area col-md-8 col-sm-12 col-xs-12 <?php echo esc_attr( blue_planet_layout_setup_class() ); ?>">
	    <?php do_action( 'blue_planet_after_primary_open' ); ?>
		<main id="main" class="site-main" role="main">
			<?php do_action( 'blue_planet_after_main_open' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
				   * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

		<?php
		the_posts_pagination( array(
			'prev_text' => _x( '&larr; Previous', 'posts navigation', 'blue-planet' ),
			'next_text' => _x( 'Next &rarr;',     'posts navigation', 'blue-planet' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'blue-planet' ) . ' </span>',
		) );
		?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		<?php do_action( 'blue_planet_before_main_close' ); ?>

		</main><!-- #main -->

		<?php do_action( 'blue_planet_before_primary_close' ); ?>

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
