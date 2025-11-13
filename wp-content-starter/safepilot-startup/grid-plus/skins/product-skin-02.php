<?php
/**
 * Created by PhpStorm.
 * @var $thumbnail
 * @var $post_link
 * @var $title
 * @var $img_origin
 * @var $ico_gallery
 * @var $cat
 * @var $disable_link
 * @var $terms
 * @var $is_backend
 */
?>
<div class="grid-post-item thumbnail product-skin-02" data-thumbnail-only="1">
    <div class="thumbnail-image" data-img="<?php echo esc_url($thumbnail); ?>">
        <?php if(!empty($thumbnail)): ?>
            <img src="<?php echo esc_attr($thumbnail); ?>" alt="<?php echo esc_html($title); ?>" >
        <?php endif; ?>
        <div class="post-info product-info">
            <div class="product-heading">
                <?php if(isset($is_backend)): ?>
                    <?php if(!empty($cat)): ?>
                        <div class="categories">
                            <span><?php echo esc_html($cat); ?></span>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <?php
                    $terms = get_the_terms(get_the_ID(), 'product_cat');
                    if($terms):
                        echo '<h4 class="product-categories">';
                        $output = '';
                        foreach ($terms as $term) {
	                        $link = get_term_link($term->term_id, 'product_cat');
                            $output .= '<a href="' . $link . '" title="' . $term->name . '">' . $term->name . '</a>, ';
                        }
                        $output = substr($output, 0, strlen($output) - 2);
                        echo wp_kses_post($output);
                        echo '</h4>';
                    endif; ?>
                <?php endif; ?>
                <?php if(!empty($title)): ?>
                    <div class="s-font product-name">
                        <?php if($disable_link != 'true'): ?>
                            <a href="<?php echo esc_attr($post_link); ?>" title="<?php echo esc_html($title); ?>"><?php echo esc_html($title); ?></a>
                        <?php else: ?>
                            <?php echo esc_html($title); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="price-wrap">
                <?php if(isset($is_backend)): ?>
                    <span class="price">$100.00</span>
                <?php else: ?>
                    <div class="price-inner">
                        <?php
                        /**
                         * woocommerce_after_shop_loop_item_title hook.
                         *
                         * @hooked woocommerce_template_loop_price - 5
                         * @hooked woocommerce_template_loop_rating - 10
                         */
                        remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',10);
                        do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>