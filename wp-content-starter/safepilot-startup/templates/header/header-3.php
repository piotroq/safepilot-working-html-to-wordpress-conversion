<?php
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
$page_menu_left = g5plus_get_option('page_menu_left', '');
$page_menu_right = g5plus_get_option('page_menu_right', '');
?>
<div class="<?php echo join(' ', $sticky_wrapper); ?>">
	<div class="<?php echo join(' ', $header_class); ?>">
		<div class="<?php echo esc_attr($header_container_layout); ?>">
			<div class="header-above-inner container-inner clearfix">
				<?php g5plus_get_template('header/header-customize.php', array('customize_location' => 'left')); ?>
				<div class="header-nav-left">
					<?php if (has_nav_menu('left-menu') || $page_menu_left): ?>
						<nav class="left-menu">
							<?php
							$arg_menu = array(
								'menu_id'        => 'left-menu',
								'container'      => '',
								'theme_location' => 'left-menu',
								'menu_class'     => 'left-menu'
							);
							wp_nav_menu($arg_menu);
							?>
						</nav>
					<?php endif;?>
				</div>
				<?php get_template_part('templates/header/logo'); ?>
				<div class="header-nav-right">
					<?php if (has_nav_menu('right-menu') || $page_menu_right): ?>
						<nav class="right-menu">
							<?php
							$arg_menu = array(
								'menu_id'        => 'right-menu',
								'container'      => '',
								'theme_location' => 'right-menu',
								'menu_class'     => 'right-menu'
							);
							wp_nav_menu($arg_menu);
							?>
						</nav>
					<?php endif;?>
				</div>
				<?php g5plus_get_template('header/header-customize.php', array('customize_location' => 'right')); ?>
			</div>
		</div>
	</div>
</div>