<?php
/**
 * The template for displaying sale count down
 *
 * @package WordPress
 * @subpackage Organiz
 * @since organiz 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$product_sale_count_down_enable = g5plus_get_option('product_sale_count_down_enable',true);
$product_sale_count_down_enable = 1;
if (!$product_sale_count_down_enable) {
	return;
}
global $post, $product;
$sales_price_to = '';
if ($product->is_on_sale() && $product->get_type() != 'grouped') {
	if ($product->get_type() == 'variable') {
		$available_variations = $product->get_available_variations();
		for ($i = 0; $i < count($available_variations); ++$i) {
			$sales_price_to_temp = '';
			$variation_id = $available_variations[$i]['variation_id'];
			$variable_product = new WC_Product_Variation( $variation_id );
			$regular_price = $variable_product->get_regular_price();
			$sales_price = $variable_product->get_sale_price();
			$price = $variable_product->get_price();
			if ( $sales_price != $regular_price && $sales_price == $price ) {
				$sales_price_to_temp = get_post_meta($variation_id, '_sale_price_dates_to', true);
				if (isset($sales_price_to_temp) && !empty($sales_price_to_temp) && ($sales_price_to_temp > $sales_price_to)) {
					$sales_price_to = $sales_price_to_temp;
				}
			}
		}
	} else {
		$sales_price_to = get_post_meta($post->ID, '_sale_price_dates_to', true);
	}
}
if ( !empty($sales_price_to)) {
	$sales_price_to = date("Y/m/d", $sales_price_to);
	?>
	<div class="g5plus-countdown product-deal-countdown clearfix" data-date-end="<?php echo esc_attr($sales_price_to); ?>">
		<div class="product-deal-countdown-inner">
			<div class="countdown-section">
				<div class="countdown">
					<span class="countdown-amount countdown-day"></span>
					<span class="countdown-period"><?php esc_html_e('Days','g5-startup'); ?></span>
				</div>
			</div>
			<div class="countdown-section">
				<div class="countdown">
					<span class="countdown-amount countdown-hours"></span>
					<span class="countdown-period"><?php esc_html_e('Hours','g5-startup'); ?></span>
				</div>
			</div>
			<div class="countdown-section">
				<div class="countdown">
					<span class="countdown-amount countdown-minutes"></span>
					<span class="countdown-period"><?php esc_html_e('Mins','g5-startup'); ?></span>
				</div>
			</div>
			<div class="countdown-section">
				<div class="countdown">
					<span class="countdown-amount countdown-seconds"></span>
					<span class="countdown-period"><?php esc_html_e('Secs','g5-startup'); ?></span>
				</div>
			</div>
		</div>
	</div>
<?php
}