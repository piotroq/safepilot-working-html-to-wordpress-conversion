<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
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

do_action( 'woocommerce_before_mini_cart' ); ?>
<?php
$total_item = WC()->cart->get_cart_contents_count();
if (!isset($args) || !isset($args['list_class'])) {
	$args['list_class'] = '';
}
?>
<div class="shopping-cart-icon">
	<div class="icon">
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
            <span><?php echo esc_html($total_item); ?></span>
            <i class="fa fa-shopping-cart"></i>
        </a>
	</div>
	<div class="subtotal-info-wrapper">
		<span class="my-cart"><?php esc_html_e('My Cart', 'g5-startup'); ?></span> - <span
			class="total-item"><?php echo esc_html($total_item); ?> <?php esc_html_e('items', 'g5-startup'); ?></span>
	</div>
</div>
<div class="shopping-cart-list drop-shadow">
	<ul class="cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">

		<?php if (!WC()->cart->is_empty()) : ?>

			<?php
			do_action( 'woocommerce_before_mini_cart_contents' );
			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
				$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
				$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
						<?php
						echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
							'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s" data-success_message="%s">&times;</a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                            /* translators: %s is the product name */
                            esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
							esc_attr( $product_id ),
							esc_attr( $cart_item_key ),
							esc_attr( $_product->get_sku() ),
                            /* translators: %s is the product name */
                            esc_attr( sprintf( __( '&ldquo;%s&rdquo; has been removed from your cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) )
						), $cart_item_key );
						?>
						<?php if ( empty( $product_permalink ) ) : ?>
							<?php echo sprintf('%s',$thumbnail . $product_name) ; ?>
						<?php else : ?>
                            <a href="<?php echo esc_url( $product_permalink ); ?>">
								<?php echo sprintf('%s',$thumbnail . $product_name); ?>
                            </a>
						<?php endif; ?>
						<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>

						<?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s &times; %s', $product_price, $cart_item['quantity']) . '</span>', $cart_item, $cart_item_key); ?>
					</li>
				<?php
				}
			}
			do_action( 'woocommerce_mini_cart_contents' );
			?>

		<?php else : ?>

			<li class="empty"><?php esc_html_e('No product in the cart.', 'g5-startup'); ?></li>

		<?php endif; ?>

	</ul>
	<!-- end product list -->

	<?php if (!WC()->cart->is_empty()) : ?>

		<p class="total"><strong><?php esc_html_e('Subtotal', 'g5-startup'); ?>
				:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

		<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

		<p class="buttons">
			<a href="<?php echo esc_url(wc_get_cart_url()); ?>"
			   class="wc-forward"><?php esc_html_e('View Cart', 'g5-startup'); ?></a>
			<a href="<?php echo esc_url(wc_get_checkout_url()); ?>"
			   class="checkout wc-forward"><?php esc_html_e('Checkout', 'g5-startup'); ?></a>
		</p>

	<?php endif; ?>

	<?php do_action('woocommerce_after_mini_cart'); ?>
</div>