<?php
/**
 * Template part for displaying posts.
 *
 * @package Blue_Planet
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php blue_planet_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php
	$content_layout          =  blue_planet_get_option( 'content_layout' );
	$archive_image           =  blue_planet_get_option( 'archive_image' );
	$archive_image_alignment =  blue_planet_get_option( 'archive_image_alignment' );
	?>

	<div class="entry-content">
		<?php if ( has_post_thumbnail() && 'disable' !== $archive_image ) : ?>
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( esc_attr( $archive_image ), array( 'class' => esc_attr( 'align' . $archive_image_alignment ) ) ); ?>
			</a>
		<?php endif; ?>

		<?php if ( 'excerpt' === $content_layout || 'excerpt-thumb' === $content_layout ) : ?>

			<?php the_excerpt(); ?>

		<?php else : ?>
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s', 'blue-planet' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'blue-planet' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'blue-planet' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );

			?>
		<?php endif; ?>

	</div><!-- .entry-content -->


	<footer class="entry-meta">
		<?php blue_planet_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
