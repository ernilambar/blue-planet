<?php
/**
 * Custom theme functions
 *
 * @package Blue_Planet
 */

if ( ! function_exists( 'blue_planet_add_secondary_slider_function' ) ) :

	/**
	 * Implement secondary slider.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_add_secondary_slider_function() {
		$bp_options      = blue_planet_get_option_all();
		$slider_status_2 = blue_planet_get_option( 'slider_status_2' );

		if ( 'none' !== $slider_status_2 && ( is_home() || is_front_page() ) ) {
			$slider_category_2  = absint( $bp_options['slider_category_2'] );
			$number_of_slides_2 = absint( $bp_options['number_of_slides_2'] );

			$args               = array(
				'posts_per_page' => $number_of_slides_2,
				'meta_query'     => array(
					array( 'key' => '_thumbnail_id' ),
				),
			);

			if ( absint( $slider_category_2 ) > 0 ) {
				$args['cat'] = absint( $slider_category_2 );
			}

			$secondary_slider_query = new WP_Query( $args );

			if ( $secondary_slider_query->have_posts() ) {
				?>
				<div class="secondary-slider-wrapper theme-default">
					<div class="ribbon"></div>

						<?php
							$slide_count = 0;
							$slide_data  = array();
						?>
						<?php
						while ( $secondary_slider_query->have_posts() ) :
							$secondary_slider_query->the_post();
							?>
							<?php
							$image_url = '';
							if ( has_post_thumbnail() ) {
								$thumb     = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
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
							<?php ++$slide_count; ?>
						<?php endwhile; ?>

							<?php if ( ! empty( $slide_data ) ) : ?>

							<div id="bp-secondary-slider" class="nivoSlider">

								<?php foreach ( $slide_data as $slide ) { ?>
								<a href="<?php echo esc_url( $slide['permalink'] ); ?>">
									<?php
									echo '<img src="' . esc_url( $slide['url'] ) . '" alt="' . esc_attr( $slide['title'] ) . '" ';
									if ( 1 === $bp_options['slider_caption_2'] ) {
										echo ' title="#htmlcaption-' . $slide['ID'] . '" ';
									}
									echo '/>';
									?>
								</a>
							<?php } // Endforeach. ?>
							</div>

							<?php endif; ?>


					<?php unset( $slide ); ?>


					<?php if ( ! empty( $slide_data ) ) : ?>

						<?php foreach ( $slide_data as $slide ) { ?>
							<div id="<?php echo 'htmlcaption-' . $slide['ID']; ?>" class="nivo-html-caption">
								<h4><?php echo $slide['title']; ?></h4>
									<?php echo $slide['excerpt']; ?>

							</div>
						<?php } ?>

					<?php endif ?>

					</div>

				<?php

			}
			wp_reset_postdata();
		}
	}
endif;

add_action( 'blue_planet_after_main_open', 'blue_planet_add_secondary_slider_function' );

if ( ! function_exists( 'blue_planet_footer_powered_by' ) ) :

	/**
	 * Implement powered by content in footer.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_footer_powered_by() {
		$extra_style         = '';

		$flg_hide_powered_by = blue_planet_get_option( 'flg_hide_powered_by' );

		if ( 1 === $flg_hide_powered_by ) {
			$extra_style = 'display:none;';
		}

		?>
		<div class="footer-powered-by" style="<?php echo esc_attr( $extra_style ); ?>">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'blue-planet' ) ); ?>">
				<?php
				/* translators: %s: WordPress. */
				printf( __( 'Powered by %s', 'blue-planet' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( __( '%1$s by %2$s', 'blue-planet' ), 'Blue Planet', '<a href="' . esc_url( 'https://www.nilambar.net' ) . '" rel="designer">Nilambar</a>' );
			?>
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

		if ( ( 'all' === $bp_options['slider_status'] ) || ( 'home' === $bp_options['slider_status'] && is_front_page() ) ) {
			?>
			<div class="main-slider-wrapper">
				<div class="slider-wrapper theme-default">
				<div class="ribbon"></div>
				<div id="bp-main-slider" class="nivoSlider">
					<?php foreach ( $slides as $slide ) : ?>

						<?php
						$link_open  = '';
						$link_close = '';

						if ( ! empty( $slide['url'] ) ) {
							$open_target = '_self';

							if ( 1 === $slide['new_tab'] ) {
								$open_target = '_blank';
							}

							$link_open  = '<a ' . ' target="' . $open_target . '" ' . 'href=" ' . esc_url( $slide['url'] ) . '" >';
							$link_close = '</a>';
						}
						?>
						<?php echo $link_open; ?>
						<?php
						echo '<img src=" ' . esc_url( $slide['image'] ) . '" title="' . esc_attr( $slide['caption'] ) . '" />';
						?>
						<?php echo $link_close; ?>

					<?php endforeach; ?>

				</div>
				</div>
			</div>

			<?php
		}
	}
endif;

add_action( 'blue_planet_before_content_open', 'blue_planet_add_main_slider' );

if ( ! function_exists( 'blue_planet_header_content_stuff' ) ) :

	/**
	 * Implement header content stuff.
	 *
	 * @since 1.0.0
	 */
	function blue_planet_header_content_stuff() {
		?>
		<?php
		$header_image = get_header_image();
		if ( ! empty( $header_image ) ) {
			?>
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
			<?php
		}
		else {
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
			</div><!-- .only-site-branding -->
			<?php
		}
		?>

		<?php
	}
endif;

add_action( 'blue_planet_after_masthead_open', 'blue_planet_header_content_stuff' );
