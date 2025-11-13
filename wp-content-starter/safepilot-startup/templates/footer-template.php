<?php
/**
 * The template for displaying footer
 *
 * @package WordPress
 * @subpackage Pasco
 * @since Pasco 1.0
 */
$set_footer_custom = g5plus_get_option('set_footer_custom', 0);
$set_footer_above_custom = g5plus_get_option('set_footer_above_custom', 0);
$footer_show_hide = g5plus_get_option('footer_show_hide', 1);
$bottom_bar_visible = g5plus_get_option('bottom_bar_visible', 1);
if (empty($set_footer_custom) && empty($set_footer_above_custom) && !$footer_show_hide && !$bottom_bar_visible){
	return;
}

$footer_parallax = g5plus_get_option('footer_parallax', 0);
$collapse_footer = g5plus_get_option('collapse_footer', 0);

$main_footer_class = array('main-footer-wrapper');
if ($footer_parallax) {
	$main_footer_class[] = 'enable-parallax';
}
if ($collapse_footer && !$set_footer_custom) {
	$main_footer_class[] = 'footer-collapse-able';
}

?>
<footer class="<?php echo join(' ', $main_footer_class) ?>">
	<div id="wrapper-footer">
		<!-- Footer Custom -->
		<?php if ($set_footer_custom):
			$footer_container_layout = g5plus_get_option('footer_container_layout','container');
			global $post;
			$post = get_post($set_footer_custom);
			setup_postdata( $post );
			?>
			<div class="<?php echo esc_attr($footer_container_layout); ?>">
				<?php
				the_content();
				wp_reset_postdata();
				?>
			</div>
		<?php else: ?>
			<!-- Above Footer -->
			<?php get_template_part('templates/footer/above-footer'); ?>
			<!-- Main Footer -->
			<?php get_template_part('templates/footer/main-footer'); ?>
			<!-- Bottom Bar -->
			<?php get_template_part('templates/footer/bottom-bar'); ?>
		<?php endif; ?>
	</div>
</footer>