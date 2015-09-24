<?php
//Add theme option menu in sidebar
function blue_planet_theme_options_start() {
    if ( get_option('blueplanet_options') ) {
      add_theme_page( __('Blue Planet Theme Options','blue-planet'), __('Blue Planet Theme Options','blue-planet'), 'edit_theme_options', 'theme_options', 'blue_planet_theme_options_page' );
    }
}

add_action( 'admin_menu', 'blue_planet_theme_options_start' );
////
function blue_planet_theme_options_page(){
    if (!isset($_REQUEST['settings-updated']))
		$_REQUEST['settings-updated'] = false;

    require get_template_directory() . '/admin/view.php';

    global $blueplanet_options_settings;
    $bp_options = $blueplanet_options_settings;

}
