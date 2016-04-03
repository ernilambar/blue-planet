<?php

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

if ( ! function_exists( 'blue_planet_primary_navigation_fallback' ) ) :

    /**
     * Fallback for primary navigation.
     *
     * @since 1.0.0
     */
    function blue_planet_primary_navigation_fallback() {
        echo '<div class="nav-menu">';
        echo '<ul>';
        echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home', 'blue-planet' ). '</a></li>';
        wp_list_pages( array(
            'title_li' => '',
            'depth'    => 1,
            'number'   => 7,
        ) );
        echo '</ul>';
        echo '</div>';
    }

endif;


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

if ( ! function_exists( 'blue_planet_generate_social_links' ) ) :

    /**
     * Generate social links.
     *
     * @since 1.0.0
     */
    function blue_planet_generate_social_links() {
        $bp_options = blueplanet_get_option_all();
        $social_array = array();
        if ( ! empty( $bp_options ) ) {
        	foreach ( $bp_options as $key => $val ) {
        		$pos = strpos( $key, 'social_' );
        		if ( false !== $pos && 0 === $pos && ! empty( $val ) ) {
        			$new_key = str_replace( 'social_', '', $key );
	        		$social_array[ $new_key ] = $val;
        		}
        	}
        }

        if ( ! empty( $social_array ) ) {
	        echo '<div class="social-wrapper-outer">';
	        echo '<div class="social-wrapper">';
	        $link_target = apply_filters( 'blue_planet_filter_social_sites_link_target', '_blank' );
	        foreach ( $social_array as $key => $site ) {
	        	switch ( $key ) {
	        		case 'email':
	        			echo '<a class="social-email" href="mailto:'.esc_attr( $site ).'"></a>';
	        			break;
	        		case 'skype':
	        			echo '<a class="social-skype" href="skype:'.esc_attr( $site ).'?call"></a>';
	        			break;

	        		default:
	        			echo '<a class="social-' . esc_attr( $key ) . '" href="' . esc_url( $site ) . '" target="' . esc_attr( $link_target ) . '"></a>';
	        			break;
	        	}
	        }
	        echo '</div><!-- .social-wrapper -->';
	        echo '</div><!-- .social-wrapper-outer -->';
        }

    }
endif;
