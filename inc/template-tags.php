<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Blue_Planet
 */

if ( ! function_exists( 'blue_planet_paging_nav' ) ) :
	/**
   * Display navigation to next/previous set of posts when applicable.
   *
	 * @deprecated 2.0.3 Use the_posts_navigation()
	 */
	function blue_planet_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'blue-planet' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> ' . __( 'Older posts', 'blue-planet' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'blue-planet' ) . '<span class="meta-nav">&rarr;</span>' ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
	}
endif;

if ( ! function_exists( 'blue_planet_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
   *
   * @deprecated 2.0.3 Use the_post_navigation()
   */
	function blue_planet_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'blue-planet' ); ?></h1>
		<div class="nav-links">
			<?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ); ?>
			<?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ); ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
	}
endif;

if ( ! function_exists( 'blue_planet_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function blue_planet_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( __( '<span class="posted-on">%1$s</span><span class="byline">%2$s</span>', 'blue-planet' ),
			sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
				esc_url( get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ) ), $time_string // WPCS: XSS OK.
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		); // WPCS: XSS OK.
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
			echo '<span class="comments">';
			echo '<a href="'.esc_url( get_comments_link() ).'">';
			echo comments_number( __( '0 comment','blue-planet' ), __( '1 comment','blue-planet' ), __( '% comments','blue-planet' ) );
			echo '</a>';
			echo '</span>';
		endif;

		edit_post_link( __( 'Edit', 'blue-planet' ), '<span class="edit-link">', '</span>' );
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function blue_planet_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so blue_planet_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so blue_planet_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in blue_planet_categorized_blog.
 */
function blue_planet_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'blue_planet_category_transient_flusher' );
add_action( 'save_post',     'blue_planet_category_transient_flusher' );
