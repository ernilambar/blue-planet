<?php
#
# BP_Social_Widget Widget
#

class BP_Social_Widget  extends WP_Widget {

    function __construct() {
        $opts =array(
                    'classname'     => 'bp_social_widget',
                    'description'   => __( 'Display Social links in your sidebar', 'blue-planet' )
                );

        parent::__construct( 'bp-social', __( 'Blue Planet Social', 'blue-planet' ), $opts);
    }


    function widget( $args, $instance ) {
        extract( $args );

        $title          =   apply_filters('widget_title', $instance['title']) ;

        echo $before_widget;
        if ($title) echo $before_title . $title . $after_title;
        //
        global $blueplanet_options_settings;

        $bp_options = $blueplanet_options_settings;

        echo '<div class="social-widget-wrapper">';

        $social_sites = array('facebook','twitter','googleplus','youtube','pinterest','linkedin','flickr','tumblr','dribbble','deviantart','rss','instagram','skype','digg','stumbleupon','forrst','500px','vimeo');

        foreach ($social_sites as $key => $site) {
            if('' != $bp_options["social_$site"]){
                echo '<a class="social-'.$site.'" href="'.esc_url($bp_options["social_$site"]).'"></a>';
            }
        }
        if('' != $bp_options['social_email']){
            echo '<a class="social-email" href="mailto:'.esc_attr($bp_options['social_email']).'"></a>';
        }
        echo '</div>';
        //
        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title']  =   esc_attr( strip_tags($new_instance['title']) );

        return $instance;
    }

    function form( $instance ) {
        $title          =   isset($instance['title']) ? esc_attr($instance['title']) : '';
?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'blue-planet'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title ; ?>" />
    </p>

    <p><?php echo _e('This widget will display social links from Theme Options.','blue-planet');  ?></p>

<?php }

} ?>
