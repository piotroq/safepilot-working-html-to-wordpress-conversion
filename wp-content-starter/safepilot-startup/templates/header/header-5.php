<?php
$header_class = array('header-wrapper', 'clearfix');
$header_above_class = array('header-row', 'header-above-wrapper');
$header_container_layout = g5plus_get_option('header_container_layout', 'container-fluid');
$header_above_border_bottom = g5plus_get_option('header_above_border_bottom', 'none');
$header_border_bottom = g5plus_get_option('header_border_bottom', 'none');
$header_sticky = g5plus_get_option('header_sticky', 0);

if ($header_above_border_bottom != 'none') {
	$header_above_class[] = $header_above_border_bottom;
}
if ($header_border_bottom != 'none') {
	$header_class[] = $header_border_bottom;
}

$sticky_wrapper = array();
$sticky_region_class = array('header-row', 'header-nav-wrapper');
if ($header_sticky) {
	$sticky_wrapper[] = 'sticky-wrapper';
	$sticky_region_class[] = 'sticky-region';
}
/**
 * Get page custom menu
 */
$page_menu = g5plus_get_option('page_menu', '');
?>
<div class="<?php echo join(' ', $header_class); ?>">
	<div class="<?php echo esc_attr($header_container_layout); ?>">
		<div class="<?php echo join(' ', $header_above_class); ?>">
			<div class="header-above-inner clearfix">
				<?php g5plus_get_template('header/header-customize.php', array('customize_location' => 'left')); ?>
				<?php g5plus_get_template('header/logo.php'); ?>
				<?php g5plus_get_template('header/header-customize.php', array('customize_location' => 'right')); ?>
			</div>
		</div>
	</div>
	<div class="<?php echo join(' ', $sticky_wrapper); ?>">
		<div class="<?php echo join(' ', $sticky_region_class); ?>">
			<div class="<?php echo esc_attr($header_container_layout); ?>">
				<div class="container-inner">
					<?php if (has_nav_menu('primary') || $page_menu): ?>
						<?php g5plus_get_template('header/logo.php'); ?>
						<nav class="primary-menu header-row">
							<?php
							$arg_menu = array(
								'menu_id'        => 'main-menu',
								'container'      => '',
								'theme_location' => 'primary',
								'menu_class'     => 'main-menu'
							);
							wp_nav_menu($arg_menu);
							g5plus_get_template('header/header-customize.php', array('customize_location' => 'nav'));
							?>
						</nav>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>