<?php
/**
 * The template for displaying product quick-views
 *
 * @package WordPress
 * @subpackage Organiz
 * @since organiz 1.0
 */
global $product;
?>
<div id="popup-product-quick-view-wrapper" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
     aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<a class="popup-close fa fa-close" data-dismiss="modal" href="javascript:;"></a>
			<div class="modal-body">
				<div class="woocommerce">
					<div id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>>
						<div class="row single-product-info clearfix">
							<div class="col-md-5 sm-mg-bottom-50">
								<div class="single-product-image">
									<?php
									/**
									 * woocommerce_before_single_product_summary hook.
									 *
									 * @hooked woocommerce_show_product_sale_flash - 10
									 * @hooked g5plus_show_product_quick_view_images - 20
									 */
									do_action( 'woocommerce_before_quick_view_product_summary' );
									?>
								</div>
							</div>
							<div class="col-md-7">
								<div class="summary-product entry-summary">
									<?php
									$product_add_to_cart_enable = g5plus_get_option('product_add_to_cart_enable',1);
									if (!$product_add_to_cart_enable) {
										remove_action('woocommerce_quick_view_product_summary','woocommerce_template_single_add_to_cart',30);
									}
									?>
									<?php
									/**
									 * woocommerce_single_product_summary hook.
									 *
									 * @hooked g5plus_template_quick_view_product_title - 5
									 * @hooked g5plus_template_quick_view_rating - 10
									 * @hooked woocommerce_template_single_price - 10
									 * @hooked woocommerce_template_single_excerpt - 20
									 * @hooked woocommerce_template_single_add_to_cart - 30
									 * @hooked g5plus_woocommerce_template_single_function - 35
									 * @hooked woocommerce_template_single_meta - 40
									 * @hooked woocommerce_template_single_sharing - 50
									 */
									do_action( 'woocommerce_quick_view_product_summary' );
									?>
								</div><!-- .summary -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>