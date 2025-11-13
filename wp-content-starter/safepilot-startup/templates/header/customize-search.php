<?php

$classes = array(
	'header-customize-item',
	'item-search'
);
if (!function_exists('g5plus_add_search_popup')) {
	function g5plus_add_search_popup() {
		$search_popup_type = g5plus_get_option('search_popup_type','standard');
		g5plus_get_template('header/search-popup-' . $search_popup_type.'.php');
	}
	add_action('wp_footer','g5plus_add_search_popup');
}
$search_popup_type = g5plus_get_option('search_popup_type','standard');
?>
<div class="<?php echo join(' ', $classes); ?>">
	<a href="#" class="prevent-default search-<?php echo esc_attr($search_popup_type); ?>"><i class="fa fa-search"></i></a>
</div>
