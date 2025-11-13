<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.6.0
 * @var $columns
 * @var $related_products
 */

if (!defined('ABSPATH')) {
	exit;
}

$g5plus_woocommerce_loop = &G5Plus_Woocommerce::get_woocommerce_loop();
$g5plus_woocommerce_loop['columns'] = $columns;
$g5plus_woocommerce_loop['layout'] = 'slider';
$g5plus_woocommerce_loop['nav_pos'] = 'nav-top';


if ($related_products) : ?>

	<div class="related products">

		<h2><?php esc_html_e('Related Products', 'g5-startup'); ?></h2>

		<?php woocommerce_product_loop_start(); ?>

		<?php foreach ($related_products as $related_product) : ?>

			<?php
			$post_object = get_post($related_product->get_id());

            setup_postdata( $GLOBALS['post'] = $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

			wc_get_template_part('content', 'product'); ?>

		<?php endforeach; ?>
		<?php woocommerce_product_loop_end(); ?>

	</div>
<?php endif;

wp_reset_postdata();
