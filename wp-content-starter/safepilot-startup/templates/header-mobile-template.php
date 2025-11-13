<?php
/**
 * Header Mobile
 */
$border_mobile_class = '';
$header_mobile_border_bottom = g5plus_get_option('mobile_header_border_bottom','none');
if($header_mobile_border_bottom == 'bordered'){
	$border_mobile_class = 'mobile-border-bottom';
}
$header_class = 'header-mobile ' . g5plus_get_option('mobile_header_layout', '').' '.$border_mobile_class;
$mobile_header_layout = g5plus_get_option('mobile_header_layout', '');
?>
<header class="<?php echo esc_attr($header_class); ?>">
	<?php get_template_part('templates/header/mobile-top-bar'); ?>
	<?php get_template_part('templates/header/mobile-header'); ?>
</header>