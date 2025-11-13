<?php
add_action('g5plus_after_page_wrapper', 'g5plus_canvas_menu', 5);
$header_class = array('header-wrapper', 'clearfix');
$header_container_layout = g5plus_get_option('header_container_layout', 'container-fluid');
$header_border_bottom = g5plus_get_option('header_border_bottom', 'none');
$header_sticky = g5plus_get_option('header_sticky', 0);

if ($header_border_bottom != 'none') {
	$header_class[] = $header_border_bottom;
}

$sticky_wrapper = array();
if ($header_sticky) {
	$sticky_wrapper[] = 'sticky-wrapper';
	$header_class[] = 'sticky-region';
}

/**
 * Get page custom menu
 */
$page_menu = g5plus_get_option('page_menu', '');
?>
<div class="<?php echo join(' ', $sticky_wrapper); ?>">
	<div class="<?php echo join(' ', $header_class); ?>">
		<div class="<?php echo esc_attr($header_container_layout); ?>">
			<div class="header-above-inner container-inner clearfix">
				<?php g5plus_get_template('header/header-customize.php', array('customize_location' => 'left'));
					  get_template_part('templates/header/logo');?>
				<div class="header-customize-item items-menu-canvas">
					<a class="menu-switch" href="#"><i class="fa fa-align-right"></i></a>
				</div>
				<?php g5plus_get_template('header/header-customize.php', array('customize_location' => 'right')); ?>
			</div>
		</div>
	</div>
</div>