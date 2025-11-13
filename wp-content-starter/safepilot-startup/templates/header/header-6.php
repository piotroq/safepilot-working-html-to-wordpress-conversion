<?php
$header_class = array('header-wrapper', 'clearfix');
/**
 * Get page custom menu
 */
$page_menu = g5plus_get_option('page_menu', '');
?>
<div class="<?php echo join(' ', $header_class); ?>">
	<div class="header-above-wrapper">
		<?php get_template_part('templates/header/logo'); ?>
	</div>
	<div class="header-nav-wrapper clearfix">
		<?php if (has_nav_menu('primary') || $page_menu): ?>
			<nav class="primary-menu">
				<?php
				$arg_menu = array(
					'menu_id' => 'main-menu',
					'container' => '',
					'theme_location' => 'primary',
					'menu_class' => 'main-menu x-nav-vmenu'
				);
				wp_nav_menu($arg_menu);
				?>
			</nav>
		<?php endif; ?>
		<?php g5plus_get_template('header/header-customize.php', array('customize_location' => 'nav')); ?>
	</div>
</div>

