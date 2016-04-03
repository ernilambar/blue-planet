<?php
/**
 * Template part for displaying single posts.
 *
 * @package Blue_Planet
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php blue_planet_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php do_action( 'blue_planet_single_image' ); ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'blue-planet' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php blue_planet_entry_footer(); ?>
	</footer><!-- .entry-meta -->

	<?php do_action( 'blue_planet_author_box' ); ?>

</article><!-- #post-## -->
