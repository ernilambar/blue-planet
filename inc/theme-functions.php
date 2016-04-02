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

// Deprecated functions.
function blue_planet_custom_css() {}
