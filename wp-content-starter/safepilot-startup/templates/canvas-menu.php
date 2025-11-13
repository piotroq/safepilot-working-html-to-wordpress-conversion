<?php
$page_menu = g5plus_get_option('page_menu', '');
?>
<nav class="canvas-menu-wrapper">
	<div class="canvas-menu-inner">
		<div class="header-above-wrapper clearfix">
			<?php get_template_part('templates/header/canvas-logo'); ?>
			<a href="#" class="canvas-menu-close"><img
					src="<?php echo esc_url(G5PLUS_THEME_URL . 'assets/images/close.png'); ?>"
					alt="<?php _e('Close menu', 'g5-startup'); ?>"/></a>
		</div>
		<div class="header-nav-wrapper clearfix">
			<?php if (has_nav_menu('primary') || $page_menu): ?>
				<nav class="primary-menu">
					<?php
					$arg_menu = array(
						'menu_id'        => 'main-menu',
						'container'      => '',
						'theme_location' => 'primary',
						'menu_class'     => 'main-menu x-nav-vmenu'
					);
					wp_nav_menu($arg_menu);
					?>
				</nav>
			<?php endif; ?>
			<?php g5plus_get_template('header/header-customize.php', array('customize_location' => 'nav')); ?>
		</div>
	</div>
</nav>
