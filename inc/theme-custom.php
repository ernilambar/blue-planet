<?php
/**
 * Custom theme functions.
 *
 * @package Blue_Planet
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array Body classes
 */
function blue_planet_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    if ( get_header_image() ) {
    	$classes[] = 'custom-header-enabled';
    }
    else {
    	$classes[] = 'custom-header-disabled';
    }

    return $classes;
}

add_filter( 'body_class', 'blue_planet_body_classes' );

if ( ! function_exists( 'blue_planet_featured_image_instruction' ) ) :
    /**
     * Message to show in the Featured Image Meta box.
     *
     * @since 1.0.0
     *
     * @param string $content Admin post thumbnail HTML markup.
     * @param int    $post_id Post ID.
     * @return string HTML.
     */
    function blue_planet_featured_image_instruction( $content, $post_id ) {

        if ( 'post' === get_post_type( $post_id ) ) {
            $content .= '<strong>' . __( 'Recommended image sizes', 'blue-planet' ) . '</strong><br/>';
            $content .= '<br/>' . sprintf( __( 'Secondary Slider : %dpx X %dpx', 'blue-planet' ), 720, 350 );
        }

        return $content;
    }
endif;

add_filter( 'admin_post_thumbnail_html', 'blue_planet_featured_image_instruction', 10, 2 );


if ( ! function_exists( 'blue_planet_excerpt_readmore' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function blue_planet_excerpt_readmore( $more ) {

		global $post;
		$read_more_text = blue_planet_get_option( 'read_more_text' );
		if ( ! empty( $read_more_text ) ) {
			$more = '...';
		}

		$output = $more . ' <a href="'. esc_url( get_permalink( $post->ID ) ) . '" class="readmore">' . esc_attr( $read_more_text )  . '<span class="screen-reader-text">"' . esc_html( get_the_title() ) . '"</span></a>';
		$output = apply_filters( 'blue_planet_filter_read_more_content' , $output );

		return $output;
	}
endif;

add_filter( 'excerpt_more', 'blue_planet_excerpt_readmore' );


if ( ! function_exists( 'blue_planet_custom_excerpt_length' ) ) :
	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function blue_planet_custom_excerpt_length( $length ) {
		$excerpt_length = blue_planet_get_option( 'excerpt_length' );
		return apply_filters( 'blue_planet_filter_excerpt_length', esc_attr( $excerpt_length ) );
	}
endif;

add_filter( 'excerpt_length', 'blue_planet_custom_excerpt_length', 999 );

if ( ! function_exists( 'blue_planet_add_secondary_slider_function' ) ) :
	/**
	 * Implement secondary slider.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_add_secondary_slider_function() {
		$bp_options = blue_planet_get_option_all();
		$slider_status_2 = blue_planet_get_option( 'slider_status_2' );

		if ( 'none' !== $slider_status_2 &&  ( is_home() || is_front_page() ) ) {
			$slider_category_2  = absint( $bp_options['slider_category_2'] );
			$number_of_slides_2 = absint( $bp_options['number_of_slides_2'] );
			$args = array(
				'posts_per_page' => $number_of_slides_2,
				'meta_query'     => array(
					array( 'key' => '_thumbnail_id' ),
				  ),
				);
			if ( absint( $slider_category_2 ) > 0  ) {
				$args['cat'] = absint( $slider_category_2 );
			}

			$secondary_slider_query = new WP_Query( $args );

			if ( $secondary_slider_query->have_posts() ) {
				?>
                 <div class="secondary-slider-wrapper theme-default">
                    <div class="ribbon"></div>

                        <?php
							$slide_count = 0;
							$slide_data = array();
						?>
                        <?php while ( $secondary_slider_query->have_posts() ) : $secondary_slider_query -> the_post();?>
                            <?php
							$image_url = '';
							if ( has_post_thumbnail() ) {
								$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
								$image_url = $thumb['0'];
							}
							if ( empty( $image_url ) ) {
								continue;
							}
							$slide_data[ $slide_count ]['url']       = esc_url( $image_url );
							$slide_data[ $slide_count ]['ID']        = get_the_ID();
							$slide_data[ $slide_count ]['permalink'] = get_permalink( get_the_ID() );
							$slide_data[ $slide_count ]['title']     = get_the_title();
							$slide_data[ $slide_count ]['excerpt']   = get_the_excerpt();
							?>
							<?php $slide_count++; ?>
                        <?php endwhile; ?>

							<?php if ( ! empty( $slide_data ) ) :  ?>

                          <div id="bp-secondary-slider" class="nivoSlider">

                            <?php foreach ( $slide_data as $slide ) { ?>
                                <a href="<?php echo esc_url( $slide['permalink'] ); ?>">
									<?php
									echo '<img src="'.esc_url( $slide['url'] ).'" alt="'.esc_attr( $slide['title'] ).'" ';
									if ( 1 === $bp_options['slider_caption_2'] ) {
										echo ' title="#htmlcaption-'.$slide['ID'].'" ';
									}
									echo '/>';
									?>
                                </a>
                            <?php } // Endforeach. ?>
                          </div>

							<?php endif; ?>


					<?php unset( $slide ); ?>


					<?php if ( ! empty( $slide_data ) ) :  ?>

						<?php foreach ( $slide_data as $slide ) { ?>
                     <div id="<?php echo 'htmlcaption-'.$slide['ID']; ?>" class="nivo-html-caption">
                        <h4><?php echo $slide['title']; ?></h4>
                        <?php echo $slide['excerpt']; ?>

                    </div>
						<?php }//endforeach ?>

					<?php endif ?>

                     </div>

                <?php

			}//end if post is there
			wp_reset_postdata();
		}//end if is_home()
	}
endif;
add_action( 'blue_planet_after_main_open','blue_planet_add_secondary_slider_function' );

if ( ! function_exists( 'blue_planet_copyright_text_content' ) ) :
	/**
	 * Implement copyright text in footer.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_copyright_text_content() {
		$copyright_text = blue_planet_get_option( 'copyright_text' );
		if ( empty( $copyright_text )  ) {
			return;
		}
		echo '<div class="copyright">' . apply_filters( 'blue_planet_filter_copyright_text_content', esc_html( $copyright_text ) ) . '</div>';
	}
endif;

add_action( 'blue_planet_credits', 'blue_planet_copyright_text_content' );


if ( ! function_exists( 'blue_planet_footer_powered_by' ) ) :

	/**
	 * Implement powered by content in footer.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_footer_powered_by() {
		$extra_style = '';
		$flg_hide_powered_by = blue_planet_get_option( 'flg_hide_powered_by' );
		if ( 1 === $flg_hide_powered_by ) {
			$extra_style = 'display:none;';
		}
		?>
		<div class="footer-powered-by" style="<?php echo esc_attr( $extra_style ); ?>">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'blue-planet' ) ); ?>"><?php printf( __( 'Powered by %s', 'blue-planet' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( '%1$s by %2$s', 'blue-planet' ), 'Blue Planet', '<a href="' . esc_url( 'http://nilambar.net' ) . '" rel="designer">Nilambar</a>' ); ?>
		</div>
		<?php
	}
endif;

add_action( 'blue_planet_credits', 'blue_planet_footer_powered_by' );


if ( ! function_exists( 'blue_planet_add_main_slider' ) ) :

	/**
	 * Implement main slider.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_add_main_slider() {

		$bp_options = blue_planet_get_option_all();

		$slides = blue_planet_get_main_slider_details();

		if ( empty( $slides ) ) {
			return;
		}

		if ( ('all' === $bp_options['slider_status']) ||  ( 'home' === $bp_options['slider_status']  && is_front_page() ) ) {

			?>
            <div class="main-slider-wrapper">
              <div class="slider-wrapper theme-default">
                <div class="ribbon"></div>
                <div id="bp-main-slider" class="nivoSlider">
					<?php foreach ( $slides as $slide ) : ?>

                    <?php
					  $link_open = '';
					  $link_close = '';
					if ( ! empty( $slide['url'] ) ) {
						$open_target = '_self';
						if ( 1 === $slide['new_tab'] ) {
							$open_target = '_blank';
						}
						$link_open = '<a ' . ' target="' . $open_target . '" ' . 'href=" ' . esc_url( $slide['url'] ) . '" >';
						$link_close = '</a>';
					}
						?>
						<?php echo $link_open; ?>
                    <?php
					  echo '<img src=" '. esc_url( $slide['image'] ) .'" title="' . esc_attr( $slide['caption'] ) . '" />';
						?>
						<?php echo $link_close; ?>

					<?php endforeach; ?>

                </div>
              </div>
            </div>

            <?php
		} // End main if.
	}
endif;

add_action( 'blue_planet_before_content_open','blue_planet_add_main_slider' );

if ( ! function_exists( 'blue_planet_header_social' ) ) :
	/**
	 * Implement social links in header.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_header_social() {
		$flg_hide_social_icons = blue_planet_get_option( 'flg_hide_social_icons' );

		if ( 1 !== $flg_hide_social_icons ) {
			blue_planet_generate_social_links();
		}
	}
endif;
add_action( 'blue_planet_after_container_open','blue_planet_header_social' );

if ( ! function_exists( 'blue_planet_footer_social' ) ) :

	/**
	 * Implement social links in footer.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_footer_social() {
		$flg_hide_footer_social_icons = blue_planet_get_option( 'flg_hide_footer_social_icons' );

		if ( 1 !== $flg_hide_footer_social_icons ) {
			blue_planet_generate_social_links();
		}
	}
endif;

add_action( 'blue_planet_before_page_close','blue_planet_footer_social' );



if ( ! function_exists( 'blue_planet_goto_top' ) ) :
	/**
	 * Implement go to top.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_goto_top() {

		$flg_enable_goto_top = blue_planet_get_option( 'flg_enable_goto_top' );

		if ( 1 == $flg_enable_goto_top ) {
			echo '<a href="#" class="scrollup"><span class="genericon genericon-collapse" aria-hidden="true"></span><span class="screen-reader-text">'. __( 'Go to top', 'blue-planet' ) . '</span></a>';
		}
	}
endif;

add_action( 'blue_planet_before_container_close','blue_planet_goto_top' );

if ( ! function_exists( 'blue_planet_header_content_stuff' ) ) :

	/**
	 * Implement header content stuff.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_header_content_stuff() {
	?>
        <?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) { ?>
                    <div class="header-image-wrapper">

                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img id="bs-header-image" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
                            <div class="site-branding">
                                <div class="site-info">
                                    <?php if ( is_front_page() && is_home() ) : ?>
                                    		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                    	<?php else : ?>
                                    		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                    	<?php endif; ?>
                                    <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                                </div>
                            </div>
                    </div>
        <?php } // if ( ! empty( $header_image ) )
		else {
			// if no header image
			?>
            <div class="only-site-branding">
                <div class="site-branding">
                    <div class="site-info">
	                    <?php if ( is_front_page() && is_home() ) : ?>
	                    		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	                    	<?php else : ?>
	                    		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
	                    	<?php endif; ?>
	                    <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                    </div>
                </div>
            </div>  <!-- .only-site-branding -->
            <?php
		}
		?>

    <?php
	}
endif;

add_action( 'blue_planet_after_masthead_open','blue_planet_header_content_stuff' );

if ( ! function_exists( 'blue_planet_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 2.3
	 */
	function blue_planet_custom_content_width() {

		global $post, $content_width;
		if ( is_page() ) {
			if ( is_page_template( 'templates/page-full-width.php' ) ) {
				$content_width = 1110;
			} elseif ( is_page_template( array( 'templates/page-content-sidebar.php', 'templates/page-sidebar-content.php', 'templates/page-one-column-disabled-sidebar.php' ) ) ) {
				$content_width = 730;
			}
		}
	}
endif;

add_filter( 'template_redirect', 'blue_planet_custom_content_width' );

if ( ! function_exists( 'blue_planet_add_image_in_single_display' ) ) :

	/**
	 * Add image in single post.
	 *
	 * @since 3.0
	 */
	function blue_planet_add_image_in_single_display() {

		global $post;
		if ( has_post_thumbnail() ) {
			$single_image           = blue_planet_get_option( 'single_image' );
			$single_image_alignment = blue_planet_get_option( 'single_image_alignment' );
			if ( 'disable' !== $single_image ) {
				$args = array(
					'class' => 'align' . $single_image_alignment,
				);
				the_post_thumbnail( $single_image, $args );
			}
		}
	}

endif;
add_action( 'blue_planet_single_image', 'blue_planet_add_image_in_single_display' );

if ( ! function_exists( 'blue_planet_import_custom_css' ) ) :

	/**
	 * Import Custom CSS.
	 *
	 * @since 3.5.0
	 */
	function blue_planet_import_custom_css() {

		// Bail if not WP 4.7.
		if ( ! function_exists( 'wp_get_custom_css_post' ) ) {
			return;
		}

		$custom_css = blue_planet_get_option( 'custom_css' );

		// Bail if there is no Custom CSS.
		if ( empty( $custom_css ) ) {
			return;
		}

		$core_css = wp_get_custom_css();
		$return = wp_update_custom_css_post( $core_css . $custom_css );

		if ( ! is_wp_error( $return ) ) {

			// Remove from theme.
			$options = blue_planet_get_option_all();
			$options['custom_css'] = '';
			set_theme_mod( 'blueplanet_options', $options );
		}

	}
endif;

add_action( 'after_setup_theme', 'blue_planet_import_custom_css', 99 );
