<?php
/**
 * @var $customize_location
 */
$header_customize_location = g5plus_get_option('header_customize_' . $customize_location, array());
$wrapper_class = array('header-customize-wrapper');
$wrapper_class[] = 'header-customize-' . $customize_location;
$css_class = g5plus_get_option('header_customize_' . $customize_location . '_css_class', '');
if ($css_class) {
	$wrapper_class[] = $css_class;
}
$header_customize = array();
if (isset($header_customize_location) && isset($header_customize_location['enabled'])) {
	foreach ($header_customize_location['enabled'] as $key => $value) {
		$header_customize[] = $key;
	}
}
$header_layout = g5plus_get_option('header_layout', 'header-1');
$page_menu = g5plus_get_option('page_menu', '');
?>
<?php if ((count($header_customize) > 0) || (($header_layout == 'header-4' || $header_layout == 'header-7') && (has_nav_menu('primary') || $page_menu))): ?>
	<div class="<?php echo join(' ', $wrapper_class); ?>">
		<?php foreach ($header_customize as $key): ?>
			<?php if (!in_array($key, array('sidebar', 'shopping-cart', 'search', 'custom-text', 'canvas-sidebar'))) {
				continue;
			} ?>
			<?php g5plus_get_template('header/customize-' . $key . '.php', array('customize_location' => $customize_location)); ?>
		<?php endforeach; ?>
		<?php if (($header_layout == 'header-4')  && (has_nav_menu('primary') || $page_menu)): ?>
			<div class="header-customize-item items-menu-canvas">
				<a class="menu-switch" href="#"><i class="fa fa-align-right"></i></a>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>