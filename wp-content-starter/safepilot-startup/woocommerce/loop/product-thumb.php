<?php
/**
 * Template display product thumb
 *
 * @package WordPress
 * @subpackage Organiz
 * @since organiz 1.0
 */
global $product;
$product_image_hover_effect = g5plus_get_option('product_image_hover_effect');
$attachment_ids = $product->get_gallery_image_ids();
$secondary_image = '';

if ($attachment_ids) {
	$secondary_image_id = $attachment_ids['0'];
	$secondary_image = wp_get_attachment_image($secondary_image_id, apply_filters('shop_catalog', 'woocommerce_thumbnail'));
}
?>
<?php if ($product_image_hover_effect == 'none' || $product_image_hover_effect == '' || $secondary_image == '' || !has_post_thumbnail()): ?>
	<div class="product-thumb-one">
		<?php echo woocommerce_get_product_thumbnail();?>
	</div>
<?php else : ?>
	<div class="product-images-hover <?php echo esc_attr($product_image_hover_effect); ?>">
		<div class="product-thumb-primary">
			<?php echo woocommerce_get_product_thumbnail(); ?>
		</div>
		<div class="product-thumb-secondary">
			<?php echo wp_kses_post($secondary_image); ?>
		</div>
	</div>
<?php endif; ?>

