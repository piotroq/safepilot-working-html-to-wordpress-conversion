<?php
/**
 * Template display quickview
 *
 * @package WordPress
 * @subpackage Organiz
 * @since organiz 1.0
 */
$product_quick_view = g5plus_get_option('product_quick_view_enable');
if (!$product_quick_view) return;
?>
<a title="<?php esc_html_e('Quick view', 'g5-startup') ?>" class="button product-quick-view no-animation alt" data-product_id="<?php the_ID(); ?>" href="<?php the_permalink(); ?>"><i class="fa fa-eye"></i></a>

