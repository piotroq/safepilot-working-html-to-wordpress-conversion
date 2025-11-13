<?php
/**
 * @var $customize_location
 */
if (!function_exists('g5plus_add_canvas_sidebar_region')) {
	function g5plus_add_canvas_sidebar_region()
	{
    ?>
		<nav class="canvas-sidebar-wrapper">
			<a href="#" class="canvas-sidebar-close"><img
					src="<?php echo esc_url(G5PLUS_THEME_URL . 'assets/images/close.png'); ?>"
					alt="<?php _e('Close sidebar', 'g5-startup'); ?>"/></a>

			<div class="canvas-sidebar-inner sidebar">
				<?php if (is_active_sidebar('canvas-sidebar')): ?>
					<?php dynamic_sidebar('canvas-sidebar'); ?>
				<?php endif; ?>
			</div>
		</nav>
	<?php
	}

	add_action('g5plus_after_page_wrapper', 'g5plus_add_canvas_sidebar_region');
}
?>
<div class="header-customize-item items-canvas-sidebar">
	<a class="canvas-sidebar-toggle" href="#"><i class="fa fa-align-justify"></i></a>
</div>

