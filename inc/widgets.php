<?php

function blue_planet_load_widgets()
{
    //social widget
    load_template(get_template_directory() . "/inc/widgets/social.php");
    register_widget('BP_Social_Widget');

    //advertisement widget
    load_template(get_template_directory() . "/inc/widgets/advertisement.php");
    register_widget('BP_Advertisement_Widget');
}


add_action('widgets_init', 'blue_planet_load_widgets');
