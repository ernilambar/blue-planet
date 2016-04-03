<?php
/**
 * The template for displaying search forms in Blue Planet
 *
 * @package Blue_Planet
 */

?>
<?php $search_placeholder = blue_planet_get_option( 'search_placeholder' ); ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<fieldset>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'blue-planet' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( $search_placeholder ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'blue-planet' ); ?>">
		<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'blue-planet' ); ?>">
	</fieldset>
</form>
