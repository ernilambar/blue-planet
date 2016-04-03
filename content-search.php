<?php
/**
 * Template part for displaying results in search pages.
 *
 * @package Blue_Planet
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php blue_planet_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) ); ?>
			</a>
		<?php endif; ?>
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		<?php blue_planet_entry_footer(); ?>
	</footer><!-- .entry-meta -->

</article><!-- #post-## -->
