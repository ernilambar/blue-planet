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
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'blue-planet' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'blue-planet' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'blue-planet' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'blue-planet' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
			?>

			<?php
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

		<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
