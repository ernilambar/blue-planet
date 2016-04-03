<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Blue_Planet
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		}
		?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'blue-planet' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php
	edit_post_link(
		sprintf (
			/* translators: %s: Name of current post */
			__( 'Edit %s', 'blue-planet' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
		'<footer class="entry-meta"><span class="edit-link">',
		'</span></footer>'
		);
	?>
</article><!-- #post-## -->
