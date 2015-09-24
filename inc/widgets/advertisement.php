<?php
#
# BP_Advertisement_Widget
#

class BP_Advertisement_Widget  extends WP_Widget {

    function __construct() {
        $opts =array(
                    'classname'     => 'bp_advertisement_widget',
                    'description'   => __( 'Widget for displaying ads', 'blue-planet' )
                );

        $this-> WP_Widget('bp-advertisement', '[Blue Planet]   '.__('Advertisement Widget', 'blue-planet'), $opts);
    }


    function widget( $args, $instance ) {
        extract( $args );

        $title  =   apply_filters('widget_title', $instance['title']) ;
        $adcode = !empty( $instance['adcode'] ) ? $instance[ 'adcode' ] : '';
        $image  = !empty( $instance['image'] ) ? $instance[ 'image' ] : '';
        $href   = !empty( $instance['href'] ) ? $instance[ 'href' ] : '';
        $target = !empty( $instance['target'] ) ? 'true' : 'false';
        $alt    = !empty( $instance['alt'] ) ? $instance[ 'alt' ] : '';

        echo $before_widget;
        if ($title) echo $before_title . $title . $after_title;

        if ( $adcode != '' ) {
            echo $adcode;
        }
        else {
            echo '<a href="' . esc_url($href) . '" ';
            echo ($target)?' target="_blank"':'';
            echo ' ><img src="'. esc_url($image) . '" alt="' . esc_attr( $alt ) . '" /></a>';
        }

        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title']  =   esc_attr( strip_tags($new_instance['title']) );
        $instance['adcode'] = wp_kses_stripslashes($new_instance['adcode']);
        $instance['image']  = esc_url_raw($new_instance['image']);
        $instance['href']   = esc_url_raw($new_instance['href']);
        $instance['target'] = !empty($new_instance['target']) ? 1 : 0;
        $instance['alt']    = sanitize_text_field($new_instance['alt']);

        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array(
            'title'  => '',
            'adcode' => '',
            'image'  => '',
            'href'   => '',
            'target' => 0,
            'alt'    => ''
            )
        );
        $title  =   isset($instance['title']) ? esc_attr($instance['title']) : '';
        $adcode =   isset($instance['adcode']) ? esc_textarea($instance['adcode']) : '';
        $image  =   isset($instance['image']) ? esc_url($instance['image']) : '';
        $href   =   isset($instance['href']) ? esc_url($instance['href']) : '';
        $target =   isset($instance['target']) ? esc_attr($instance['target']) : '';
        $alt    =   isset($instance['alt']) ? esc_attr($instance['alt']) : '';
?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'blue-planet'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title ; ?>" />
    </p>
    <hr/>
    <?php if ( current_user_can( 'unfiltered_html' ) ) : ?>
        <p>
            <label for="<?php echo $this->get_field_id('adcode'); ?>"><?php _e('Adv Code:','blue-planet'); ?></label>
            <textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo $adcode; ?></textarea><small><?php _e('eg, Google Adsense code','blue-planet'); ?></small>
        </p>
    <?php endif; ?>
    <hr >
    <p style="text-align:center;"><strong>OR</strong></p>
    <hr >
    <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image URL:','blue-planet'); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('href'); ?>"><?php _e('Link URL:','blue-planet'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo esc_url( $href ); ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('target'); ?>"><?php _e( 'Open Link in New Window', 'blue-planet' ); ?></label>
            <input id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" type="checkbox" <?php checked(isset($instance['target']) ? $instance['target'] : 0); ?> />


        </p>
        <p>
            <label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Alt text:','blue-planet'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo $alt; ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
        </p>
        <hr>



<?php }

} ?>
