<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
$g5plus_woocommerce_loop = &G5Plus_Woocommerce::get_woocommerce_loop();
$rows = !empty($g5plus_woocommerce_loop['rows']) ? $g5plus_woocommerce_loop['rows'] : 1;
$post_classes = array('gf-item-wrap product-item-wrap');
if (($g5plus_woocommerce_loop['layout'] !== 'slider') || ( ($g5plus_woocommerce_loop['layout'] == 'slider') && ($rows > 1))) {
	$post_classes[] = 'pd-bottom-30';
}
$shop_layout = isset($_GET['shop-layout']) ? $_GET['shop-layout'] : g5plus_get_option('archive_product_layout','grid');
?>
<div <?php post_class($post_classes); ?>>
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>
		<div class="product-item-inner">
			<?php if($shop_layout != 'list' || is_product() || is_cart()):?>
				<div class="product-thumb clearfix">
					<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook.
					 *
					 * @hooked g5plus_woocommerce_template_loop_sale_count_down - 10
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked g5plus_woocommerce_template_loop_product_thumbnail - 20
					 * @hooked g5plus_woocomerce_template_loop_link - 30
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
					?>
					<div class="product-actions">
						<?php
						/**
						 * g5plus_woocommerce_product_action hook
						 *
						 * @hooked g5plus_woocomerce_template_loop_compare - 5
						 * @hooked g5plus_woocomerce_template_loop_wishlist - 10
                         * @hooked g5plus_woocomerce_template_loop_quick_view - 15
						 */
						do_action( 'g5plus_woocommerce_product_actions' );
						?>
					</div>
				</div>
				<div class="product-info">
					<?php
					/**
					 * woocommerce_shop_loop_item_title hook.
					 * @hooked g5plus_woocommerce_template_loop_add_to_cart - 9
					 * @hooked g5plus_woocommerce_template_loop_product_title - 10
					 */
					do_action( 'woocommerce_shop_loop_item_title' );
                    $product_rating_enable = g5plus_get_option('product_rating_enable',1);
                    if (!$product_rating_enable) {
                        remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
                    }

                    /**
                     * woocommerce_after_shop_loop_item_title hook.
                     *
                     * @hooked woocommerce_template_loop_price - 5
                     * @hooked woocommerce_template_loop_rating - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                    if (!$product_rating_enable) {
                        remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',10);
                    }
                    echo '</div>';
                    ?>
				</div>
			<?php else:?>
				<div class="product-thumb clearfix">
					<?php
					do_action( 'g5plus_woocommerce_shop_loop_list_image' );
					?>
				</div>
				<div class="product-info">
					<?php do_action('g5plus_woocommerce_shop_loop_list_info')?>
				</div>
			<?php endif;?>
		</div>
	<?php
	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</div>
