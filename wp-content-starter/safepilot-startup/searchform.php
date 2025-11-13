<?php
/**
 * Template for displaying search forms in Orson
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'g5-startup' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'g5-startup' ); ?>" />
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>
