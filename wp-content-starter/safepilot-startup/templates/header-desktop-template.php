<?php
$header_border_bottom = g5plus_get_option('header_border_bottom', 'none');
$header_layout = g5plus_get_option('header_layout', 'header-1');
$header_float = g5plus_get_option('header_float', 0);
$header_class = array('main-header');
if ($header_border_bottom != 'none') {
	$header_class[] = $header_border_bottom;
}

if ($header_layout == 'header-6') {
	$header_class[] = 'header-left';
	$header_float = 0;
}

if ($header_float) {
	$header_class[] = 'float-header';
}

$header_class[] = $header_layout;
?>
<header class="<?php echo join(' ', $header_class); ?>">
	<?php if ($header_layout != 'header-6') {
		get_template_part('templates/header/top-bar');
	} ?>
	<?php get_template_part('templates/header/' . $header_layout); ?>
</header>