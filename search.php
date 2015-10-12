<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Blue_Planet
 */

get_header(); ?>

	<section id="primary" class="content-area col-md-8 col-sm-12 col-xs-12 <?php echo esc_attr( blue_planet_layout_setup_class() ); ?>">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'blue-planet' ), '<span>' . get_search_query() . '</span>' ); // WPCS: XSS OK. ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

      <?php
      the_posts_navigation( array(
        'prev_text'          => '<span class="meta-nav">&larr;</span> ' . __( 'Older posts', 'blue-planet' ),
        'next_text'          => __( 'Newer posts', 'blue-planet' ) . ' <span class="meta-nav">&rarr;</span>',
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Posts navigation', 'blue-planet' ) . ' </span>',
      ) );
      ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
