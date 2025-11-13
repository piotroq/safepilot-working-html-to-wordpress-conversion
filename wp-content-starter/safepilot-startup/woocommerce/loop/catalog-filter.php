<?php
/**
 * The template for displaying Catalog Filter
 *
 * @package WordPress
 * @subpackage Pasco
 * @since Pasco 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$ajax = isset($_POST['ajax']) ? $_POST['ajax'] : '';
if (!empty( $ajax ) && ($ajax != 'full')) {
    return;
}
if (!woocommerce_products_will_display()) return;
$filter_enable = g5plus_get_option( 'product_filter_enable', '1' );
if(isset( $_GET['product-filter-enable'] ) && in_array( $_GET['product-filter-enable'], array(0,1) )) {
    $filter_enable = $_GET['product-filter-enable'];
}
?>
<div class="woocommerce-catalog-filter clearfix">
    <div class="filter-wrap content-bg-color">
        <?php if($filter_enable):?>
            <div class="filter" data-toggle="collapse" data-target="#filter-content">
                <i class="fa fa-sliders"></i> <span class="p-font fw-bold"><?php esc_html_e('Filter', 'g5-startup') ?></span>
            </div>
        <?php endif;?>
        <?php
        woocommerce_catalog_ordering();
        woocommerce_result_count();
        ?>
    </div>
    <?php if($filter_enable):?>
        <div id="filter-content" class="collapse row clearfix">
            <?php if (is_active_sidebar('woocommerce-filter')): ?>
                <?php dynamic_sidebar('woocommerce-filter') ?>
            <?php endif; ?>
        </div>
    <?php endif;?>
</div>