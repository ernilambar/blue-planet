<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Blue_Planet
 */

get_header(); ?>

	<div id="primary" class="content-area col-md-8 col-sm-12 col-xs-12 <?php echo esc_attr( blue_planet_layout_setup_class() ); ?>">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php
			the_post_navigation( array(
				'next_text' => '%title <span class="meta-nav">&rarr;</span>',
				'prev_text' => '<span class="meta-nav">&larr;</span> %title',
			) );
			?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
				endif;
			?>

		<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
