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
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

global $post, $woocommerce, $product;
$index = 0;
$product_images = array();
$image_ids = array();

if (has_post_thumbnail()) {
	$product_images[$index] = array(
		'image_id' => get_post_thumbnail_id()
	);
	$image_ids[$index] = get_post_thumbnail_id();
	$index++;
}

// Additional Images
$attachment_ids = $product->get_gallery_image_ids();
if ($attachment_ids) {
	foreach ($attachment_ids as $attachment_id) {
		if (in_array($attachment_id, $image_ids)) continue;
		$product_images[$index] = array(
			'image_id' => $attachment_id
		);
		$image_ids[$index] = $attachment_id;
		$index++;
	}
}

// product variable type
if ($product->get_type() == 'variable') {
	$available_variations = $product->get_available_variations();

	if (isset($available_variations)) {
		foreach ($available_variations as $available_variation) {
			$variation_id = $available_variation['variation_id'];
			if (has_post_thumbnail($variation_id)) {
				$variation_image_id = get_post_thumbnail_id($variation_id);

				if (in_array($variation_image_id, $image_ids)) {
					$index_of = array_search($variation_image_id, $image_ids);
					if (isset($product_images[$index_of]['variation_id'])) {
						$product_images[$index_of]['variation_id'] .= $variation_id . '|';
					} else {
						$product_images[$index_of]['variation_id'] = '|' . $variation_id . '|';
					}
					continue;
				}

				$product_images[$index] = array(
					'image_id' => $variation_image_id,
					'variation_id' => '|' . $variation_id . '|'
				);
				$image_ids[$index] = $variation_image_id;
				$index++;
			}
		}
	}
}

$gallery_id = rand();
?>
<div id="single-product-image" class="single-product-image-inner">
	<div class="single-product-image-main-wrap entry-thumbnail">
        <?php
        /**
         * woocommerce_before_single_product_summary_flash hook.
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         */
        do_action( 'woocommerce_before_single_product_summary_flash' );?>
        <div class="single-product-image-main owl-carousel manual">
            <?php
            foreach($product_images as $key => $value) {
                $index = $key;
                $image_id = $value['image_id'];
                $variation_id = isset($value['variation_id']) ? $value['variation_id'] : '' ;
                $image_title 	= esc_attr( get_the_title( $image_id ) );
                $image_caption = '';
                $image_obj = get_post( $image_id );
                if (isset($image_obj) && isset($image_obj->post_excerpt)) {
                    $image_caption 	= $image_obj->post_excerpt;
                }
                $image_link  	= wp_get_attachment_url( $image_id );
                $image_thumb = wp_get_attachment_image_src($image_id);
                $image_thumb_link = '';
                if (sizeof($image_thumb) > 0 ) {
                    $image_thumb_link = $image_thumb['0'];
                }
                $image       	= wp_get_attachment_image( $image_id, apply_filters( 'single_product_large_thumbnail_size', 'woocommerce_single' ), array(
                    'title'	=> $image_title,
                    'alt'	=> $image_title
                ) );
                echo '<div class="entry-thumbnail-overlay">';
                if (!empty($variation_id)) {
                    echo apply_filters('woocommerce_single_product_image_html',
                        sprintf('<a data-thumb-src="%s" href="%s" itemprop="image"
                    class="zoomGallery" title="%s" data-rel="lightGallery"
                    data-gallery-id="%s" data-variation_id="%s" data-index="%s"><i class="fa fa-expand"></i></a>%s',
                            $image_thumb_link, $image_link, $image_caption, $gallery_id, $variation_id, $index, $image), $post->ID);
                } else {
                    echo apply_filters('woocommerce_single_product_image_html',
                        sprintf('<a data-thumb-src="%s" href="%s" itemprop="image"
                    class="zoomGallery" title="%s" data-rel="lightGallery"
                    data-gallery-id="%s" data-index="%s"><i class="fa fa-expand"></i></a>%s',
                            $image_thumb_link, $image_link, $image_caption, $gallery_id, $index, $image), $post->ID);
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <div class="single-product-image-thumb mg-top-10 owl-carousel manual">
        <?php
        foreach($product_images as $key => $value) {
            $index = $key;
            $image_id = $value['image_id'];
            $variation_id = isset($value['variation_id']) ? $value['variation_id'] : '' ;
            $image_title 	= esc_attr( get_the_title( $image_id ) );
            $image_caption = '';
            $image_obj = get_post( $image_id );
            if (isset($image_obj) && isset($image_obj->post_excerpt)) {
                $image_caption 	= $image_obj->post_excerpt;
            }


            $image_link  	=  wp_get_attachment_url( $image_id );
            $image       	= wp_get_attachment_image( $image_id,  apply_filters( 'single_product_small_thumbnail_size', 'woocommerce_gallery_thumbnail' ), array(
                'title'	=> $image_title,
                'alt'	=> $image_title
            ) );
            echo '<div class="product-image-thumb-item">';
            if (!empty($variation_id)) {
                echo  apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-thumbnail-image" title="%s" data-variation_id="%s" data-index="%s">%s</a>', $image_link, $image_caption,$variation_id,$index,  $image ), $post->ID );
            } else {
                echo  apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-thumbnail-image" title="%s" data-index="%s">%s</a>', $image_link, $image_caption,$index , $image), $post->ID );
            }
            echo '</div>';
        }
        ?>
    </div>
</div>

