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
 */
?>
<div class="grid-post-item thumbnail thumbnail-icon portfolio-skin-01" data-thumbnail-only="1">
    <div class="thumbnail-image" data-img="<?php echo esc_url($thumbnail); ?>">
        <?php if(!empty($thumbnail)): ?>
            <img src="<?php echo esc_attr($thumbnail); ?>" alt="<?php echo esc_html($title); ?>" >
        <?php endif; ?>
        <div class="hover-outer transition-30">
            <?php if($disable_link != 'true'): ?>
                <a href="<?php echo esc_attr($post_link); ?>" title="<?php echo esc_html($title); ?>"></a>
            <?php endif; ?>
            <div class="hover-inner transition-50">
                <div class="icon-groups">
                    <a href="javascript:;" class="portfolio-share" title="<?php esc_html_e('Share', 'g5-startup') ?>"><i class="fa fa-share-alt"></i></a>
                    <?php if (!isset($is_backend)): ?>
                        <?php get_template_part('templates/social-share-product'); ?>
                    <?php endif; ?>
                    <a href="javascript:;" class="view-gallery" data-src="<?php echo esc_url($img_origin); ?>" data-post-id="<?php echo get_the_ID(); ?>" title="<?php echo esc_attr($title);?>"
                       data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')) ?>"><i class="<?php echo esc_attr($ico_gallery); ?>"></i></a>
                </div>
                <?php if(!empty($title)): ?>
                    <div class="title">
                        <?php if($disable_link != 'true'): ?>
                            <a href="<?php echo esc_attr($post_link); ?>" title="<?php echo esc_html($title); ?>"><?php echo esc_html($title); ?></a>
                        <?php else: ?>
                            <?php echo esc_html($title); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if(!empty($cat)): ?>
                    <div class="categories">
                        <span><?php echo esc_html($cat); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>