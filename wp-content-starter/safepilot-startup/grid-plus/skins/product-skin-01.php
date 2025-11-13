<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 12/17/2016
 * Time: 2:51 PM
 * @var $thumbnail
 * @var $post_link
 * @var $title
 * @var $ico_gallery
 * @var $disable_link
 * @var $price
 * @var $img_origin
 */

global $post;
?>
<?php if(isset($is_backend)): ?>
    <div class="grid-post-item thumbnail-title woocommerce product-skin-01" data-post-info-class="post-info">
        <div class="thumbnail-image" data-img="<?php echo esc_url($thumbnail); ?>">
            <?php if(!empty($thumbnail)): ?>
                <img src="<?php echo esc_attr($thumbnail); ?>" alt="<?php echo esc_html($title); ?>" >
            <?php endif; ?>
            <div class="hover-outer transition-30">
                <a href="<?php echo esc_attr($post_link); ?>" class="product-link" title="<?php echo esc_html($title); ?>"></a>
                <div class="hover-inner transition-50">
                    <div class="icon-groups product-actions">
                        <a href="javascript:;" class="grid-product-compare" title="<?php echo esc_attr($title); ?>">
                            <i class="fa fa-sliders"></i>
                        </a>
                        <a href="javascript:;" class="grid-product-wishlist" title="<?php echo esc_attr($title); ?>">
                            <i class="fa fa-heart"></i>
                        </a>
                        <a href="javascript:;" class="grid-product-quick-view" title="<?php echo esc_attr($title); ?>">
                            <i class="fa fa-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="post-info">
            <?php echo '<div class="grid-add-to-cart"><a class=""><i class="pe-7s-shopbag"></i></a></div>';?>
            <div class="product-info-right">
                <?php if(!empty($title)): ?>
                    <div class="title">
                        <?php if($disable_link != 'true'): ?>
                            <a href="<?php echo esc_attr($post_link); ?>" title="<?php echo esc_html($title); ?>"><?php echo esc_html($title); ?></a>
                        <?php else: ?>
                            <?php echo esc_html($title); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if(!empty($price)): ?>
                    <div class="price"><?php echo sprintf('%s', $price); ?></div>
                <?php endif; ?>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-full"></i>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="grid-post-item thumbnail woocommerce product-skin-01">
        <div class="product product-item-wrap">
            <div class="product-item-inner">
                <div class="thumbnail-image" data-img="<?php echo esc_url($thumbnail); ?>">
                    <?php if(!empty($thumbnail)): ?>
                        <img src="<?php echo esc_attr($thumbnail); ?>" alt="<?php echo esc_html($title); ?>" >
                    <?php endif; ?>
                    <?php do_action('g5plus_grid_woocommerce_shop_loop_flash'); ?>
                    <div class="product-thumb">
                        <a href="<?php echo esc_attr($post_link); ?>" class="product-link" title="<?php echo esc_html($title); ?>"></a>
                        <div class="product-actions">
                            <?php if('product' == get_post_type($post->ID)): ?>
                                <?php do_action( 'g5plus_woocommerce_product_actions' ); ?>
                            <?php else: ?>
                                <a href="javascript:;" class="view-gallery" data-src="<?php echo esc_url($img_origin); ?>" data-post-id="<?php echo get_the_ID(); ?>" title="<?php echo esc_attr($title);?>"
                                   data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')) ?>"><i class="<?php echo esc_attr($ico_gallery); ?>"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="post-info product-info">
                    <?php if ('product' == get_post_type($post->ID)) {
                        do_action('g5plus_grid_woocommerce_shop_loop_add_to_cart');
                    }?>
                    <div class="product-info-right">
                        <?php if(!empty($title)): ?>
                            <h3 class="product-name">
                                <?php if($disable_link != 'true'): ?>
                                    <a href="<?php echo esc_attr($post_link); ?>" title="<?php echo esc_html($title); ?>"><?php echo esc_html($title); ?></a>
                                <?php else: ?>
                                    <?php echo esc_html($title); ?>
                                <?php endif; ?>
                            </h3>
                        <?php endif; ?>
                        <?php
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
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>