<?php
/**
 * @var $customize_location
 */
if (!class_exists('WooCommerce')) {
	return;
}
$mini_cart_style = g5plus_get_option('header_customize_' . $customize_location . '_cart', 'icon');
$mini_cart_style = 'mini-cart-' . $mini_cart_style;

?>
<div
	class="header-customize-item item-shopping-cart fold-out hover woocommerce <?php echo esc_attr($mini_cart_style); ?>">
	<div class="widget_shopping_cart_content">
		<?php get_template_part('woocommerce/cart/mini-cart'); ?>
	</div>
</div>