<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post, $product;
$index = 0;
$product_images = array();

$gallery_id = rand();
?>
<div class="single-product-image-inner">
    <div class="single-product-image-main-wrap entry-thumbnail">
        <?php
        $image_id = '';
        if (has_post_thumbnail()) {
            $image_id = get_post_thumbnail_id();
        }
        $image_caption = '';
        $image_obj = get_post( $image_id );
        if (isset($image_obj) && isset($image_obj->post_excerpt)) {
            $image_caption 	= $image_obj->post_excerpt;
        }
        $image_link  	= wp_get_attachment_url( $image_id );
        $image_title 	= esc_attr( get_the_title( $image_id ) );
        $image_thumb = wp_get_attachment_image_src($image_id);
        $image_thumb_link = '';
        $image       	= wp_get_attachment_image( $image_id, apply_filters( 'single_product_large_thumbnail_size', 'woocommerce_single' ), array(
            'title'	=> $image_title,
            'alt'	=> $image_title
        ) );
        echo '<div class="entry-thumbnail-overlay">';
        echo apply_filters('woocommerce_single_product_image_html',
            sprintf('<a data-thumb-src="%s" href="%s" class="zoomGallery" title="%s" data-rel="lightGallery"
                data-gallery-id="%s" data-index="%s"><i class="fa fa-expand"></i></a>%s',
                $image_thumb_link, $image_link, $image_caption, $gallery_id, $index, $image), $post->ID);
        echo '</div>';
        ?>
    </div>
</div>

