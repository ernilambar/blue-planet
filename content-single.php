<?php
/**
 * @package Blue_Planet
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php blue_planet_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="bp-thumbnail-wrapper">
					<?php the_post_thumbnail(); ?>
			</div>
		<?php } ?>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'blue-planet' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'blue-planet' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'blue-planet' ) );

			if (!empty($category_list)) {
				echo '<span class="bp-category">'.$category_list.'</span>';
			}
			if (!empty($tag_list)) {
				echo '<span class="bp-tags">'.$tag_list.'</span>';
			}

		?>

		<?php edit_post_link( __( 'Edit', 'blue-planet' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

	<?php do_action( 'blue_planet_author_box' ); ?>

</article><!-- #post-## -->
