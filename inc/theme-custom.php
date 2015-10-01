<?php
/**
 * Custom theme functions.
 *
 * @package Blue_Planet
 */

if ( ! function_exists( 'blue_planet_layout_setup_class' ) ) :

	/**
	 * Return default layout class.
	 *
	 * @since 1.0.0
	 *
	 * @return string Class.
	 */
	function blue_planet_layout_setup_class() {
		$default_layout = blueplanet_get_option( 'default_layout' );
		if ( 'right-sidebar' === $default_layout ) {
			$class = ' pull-left ';
		} else {
			$class = ' pull-right ';
		}
		return $class;
	}
endif;

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
		$read_more_text = blueplanet_get_option( 'read_more_text' );

		$output = '... <a href="'. esc_url( get_permalink( $post->ID ) ) . '" class="readmore">' . esc_attr( $read_more_text )  . '</a>';
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
		$excerpt_length = blueplanet_get_option( 'excerpt_length' );
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
		$bp_options = blueplanet_get_option_all();
		$slider_status_2 = blueplanet_get_option( 'slider_status_2' );

		if ( 'none' !== $slider_status_2 &&  ( is_home() || is_front_page() ) ) {
			$slider_category_2 = esc_attr( $bp_options['slider_category_2'] );
			$number_of_slides_2 = esc_attr( $bp_options['number_of_slides_2'] );
			$args = array(
				'posts_per_page' => $number_of_slides_2,
				'meta_query'     => array(
					array( 'key' => '_thumbnail_id' ), // Show only posts with featured images
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
                            <?php }//endforeach ?>
                          </div>

							<?php endif ?>


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

if ( ! function_exists( 'blue_planet_custom_css' ) ) :

	/**
	 * Implement Custom CSS option.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_custom_css() {

		$banner_background_color = blueplanet_get_option( 'banner_background_color' );
		$custom_css = blueplanet_get_option( 'custom_css' );

		echo '<style type="text/css">' . "\n";
		echo 'header#masthead{background-color: ' . esc_attr( $banner_background_color ) . ';}';
		if ( ! empty( $custom_css ) ) {
			echo esc_textarea( $custom_css );
		}
		echo "\n". '</style>' . "\n";
	}

endif;

add_action( 'wp_head', 'blue_planet_custom_css' );

if ( ! function_exists( 'blue_planet_copyright_text_content' ) ) :
	/**
	 * Implement copyright text in footer.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_copyright_text_content() {
		$copyright_text = blueplanet_get_option( 'copyright_text' );
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
		$flg_hide_powered_by = blueplanet_get_option( 'flg_hide_powered_by' );
		if ( 1 !== $flg_hide_powered_by ) {  ?>
      <div class="footer-powered-by">
          <a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Powered by %s', 'blue-planet' ), 'WordPress' ); ?></a>
          <span class="sep"> | </span>
          <?php printf( __( '%1$s by %2$s.', 'blue-planet' ), 'Blue Planet', '<a href="http://www.nilambar.net" rel="designer">Nilambar Sharma</a>' ); ?>
      </div>
    <?php }
		return;
	}
endif;

add_action( 'blue_planet_credits', 'blue_planet_footer_powered_by' );

if ( ! function_exists( 'blue_planet_get_main_slider_details' ) ) :

	/**
	 * Fetch main slider details.
	 *
	 * @since 1.0.0
	 *
	 * @return array Main slider details.
	 */
	function blue_planet_get_main_slider_details() {

		$bp_options = blueplanet_get_option_all();
		$output = array();

		for ( $i = 1; $i <= 5 ; $i++ ) {

			if ( isset( $bp_options[ 'main_slider_image_' . $i ] ) && ! empty( $bp_options[ 'main_slider_image_' . $i ] ) ) {

				$item = array();
				$item['image'] = esc_url( $bp_options[ 'main_slider_image_'.$i ] );
				$item['url'] = ( isset( $bp_options[ 'main_slider_url_' . $i ] ) ) ? esc_url( $bp_options[ 'main_slider_url_' . $i ] ) : '' ;
				$item['caption'] = ( isset( $bp_options[ 'main_slider_caption_' . $i ] ) ) ? esc_html( $bp_options[ 'main_slider_caption_' . $i ] ) : '' ;
				$item['new_tab'] = ( isset( $bp_options[ 'main_slider_new_tab_' . $i ] ) && 1 === $bp_options[ 'main_slider_new_tab_' . $i ] ) ? 1 : 0 ;

				$output[] = $item;
			}
		}

		return $output;

	}

endif;


if ( ! function_exists( 'blue_planet_add_main_slider' ) ) :

	/**
	 * Implement main slider.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_add_main_slider() {

		$bp_options = blueplanet_get_option_all();

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

					<?php endforeach ?>

                </div>
              </div>
            </div>

            <?php
		} //end main if
	}
endif;
add_action( 'blue_planet_after_content_open','blue_planet_add_main_slider' );


if ( ! function_exists( 'blue_planet_footer_widgets' ) ) :

	/**
	 * Implement footer widgets.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_footer_widgets() {
		$bp_options = blueplanet_get_option_all();

		if ( 1 === $bp_options['flg_enable_footer_widgets'] && isset( $bp_options['number_of_footer_widgets'] ) && absint( $bp_options['number_of_footer_widgets'] ) > 0 ) {
			echo '<div class="footer-widgets-wrapper">';
			$num_footer = $bp_options['number_of_footer_widgets'];

			$grid = 12 / $num_footer;
			for ( $i = 1 ; $i <= $num_footer; $i++ ) {
				echo '<div class="footer-widget-area col-md-'.$grid.'">';
				?>
                    <?php
					if ( is_active_sidebar( "footer-area-$i" ) ) :
						dynamic_sidebar( "footer-area-$i" );
					endif;
					?>
                <?php
				echo '</div>';
			}
			echo '</div>';
		}

	}
endif; // blue_planet_footer_widgets
add_action( 'blue_planet_after_content_close','blue_planet_footer_widgets' );

if ( ! function_exists( 'blue_planet_header_social' ) ) :
	/**
	 * Implement social links in header.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_header_social() {
		$flg_hide_social_icons = blueplanet_get_option( 'flg_hide_social_icons' );

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
		$flg_hide_footer_social_icons = blueplanet_get_option( 'flg_hide_footer_social_icons' );

		if ( 1 !== $flg_hide_footer_social_icons ) {
			blue_planet_generate_social_links();
		}
	}
endif;

add_action( 'blue_planet_before_page_close','blue_planet_footer_social' );

if ( ! function_exists( 'blue_planet_generate_social_links' ) ) :

	/**
	 * Generate social links.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_generate_social_links() {
		$bp_options = blueplanet_get_option_all();

		echo '<div class="social-wrapper">';

		if ( '' !== $bp_options['social_email'] ) {
			echo '<a class="social-email" href="mailto:'.esc_attr( $bp_options['social_email'] ).'"></a>';
		}

		$social_sites = array(
				'facebook'    => 'facebook',
				'twitter'     => 'twitter',
				'googleplus'  => 'googleplus',
				'youtube'     => 'youtube',
				'pinterest'   => 'pinterest',
				'linkedin'    => 'linkedin',
				'flickr'      => 'flickr',
				'tumblr'      => 'tumblr',
				'dribbble'    => 'dribbble',
				'deviantart'  => 'deviantart',
				'rss'         => 'rss',
				'instagram'   => 'instagram',
				'skype'       => 'skype',
				'digg'        => 'digg',
				'stumbleupon' => 'stumbleupon',
				'forrst'      => 'forrst',
				'500px'       => '500px',
				'vimeo'       => 'vimeo',
			);
		$social_sites = apply_filters( 'blue_planet_filter_social_sites', $social_sites );
		$social_sites = array_reverse( $social_sites );

		$link_target = apply_filters( 'blue_planet_filter_social_sites_link_target', '_blank' );

		foreach ( $social_sites as $key => $site ) {
			if ( '' !== $bp_options[ "social_$site" ] ) {
				if ( 'skype' === $site ) {
					echo '<a class="social-'.$site.'" href="skype:'.esc_attr( $bp_options[ "social_$site" ] ).'?call"></a>';
				} else {
					echo '<a class="social-'.$site.'" href="'.esc_url( $bp_options[ "social_$site" ] ).'" target="' . esc_attr( $link_target ) . '"></a>';
				}
			}
		}
		echo '</div>';
	}
endif;

if ( ! function_exists( 'blue_planet_goto_top' ) ) :
	/**
	 * Implement go to top.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_goto_top() {

		$flg_enable_goto_top = blueplanet_get_option( 'flg_enable_goto_top' );
		if ( $flg_enable_goto_top ) {
			echo '<a href="#" class="scrollup">'. __( 'Scroll', 'blue-planet' ) . '</a>';
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
                                    <h1 class="site-title">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                    </h1>
                                    <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
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
                        <h1 class="site-title">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                        </h1>
                        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
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

if ( ! function_exists( 'blue_planet_header_add_favicon' ) ) :

	/**
	 * Implement favicon.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_header_add_favicon() {
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
			$custom_favicon = blueplanet_get_option( 'custom_favicon' );
			if ( ! empty( $custom_favicon ) ) {
				echo '<link rel="shortcut icon" href="' . esc_url( $custom_favicon ) . '" />';
			}
		}
	}

endif;

add_action( 'wp_head','blue_planet_header_add_favicon' );

if ( ! function_exists( 'blue_planet_add_editor_styles' ) ) :

	/**
	 * Load editor styles.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_add_editor_styles() {
		add_editor_style( 'editor-style.css' );
	}

endif;

add_action( 'init', 'blue_planet_add_editor_styles' );
