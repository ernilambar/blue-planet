<?php
/**
 * Theme supports.
 *
 * @package Blue_Planet
 */

// Load Footer Widget Support.
require_if_theme_supports( 'footer-widgets', get_template_directory() . '/inc/supports/footer-widgets.php' );
