<?php
/**
 * Created by PhpStorm.
 * @var $thumbnail
 * @var $post_link
 * @var $title
 * @var $img_origin
 * @var $ico_gallery
 * @var $disable_link
 * @var $cat
 */
?>
<div class="grid-post-item thumbnail-title portfolio-skin-03" data-post-info-class="post-info">
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
                    <a href="javascript:;" data-src="<?php echo esc_url($img_origin); ?>" class="view-gallery" data-post-id="<?php echo get_the_ID(); ?>"
                       data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')) ?>"><i class="<?php echo esc_attr($ico_gallery); ?>"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="post-info">
        <?php if(!empty($cat)): ?>
            <div class="categories">
                <i class="fa fa-circle-o"></i> <span><?php echo esc_html($cat); ?></span>
            </div>
        <?php endif; ?>
        <?php if(!empty($title)): ?>
            <div class="title">
                <?php if($disable_link != 'true'): ?>
                    <a href="<?php echo esc_attr($post_link); ?>" title="<?php echo esc_html($title); ?>"><?php echo esc_html($title); ?></a>
                <?php else: ?>
                    <?php echo esc_html($title); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php
        $like_count = 99;
        $icon_class = 'fa fa-heart';
        $options = array();
        if(!isset($is_backend)) {
            $portfolio = new G5PlusFramework_Portfolio();
            $post_liked = $portfolio->get_post_liked();
            $like_count = $portfolio->get_like_count();
            $icon_class = $post_liked === true ? 'fa fa-heart' : 'fa fa-heart-o';
            $nonce = wp_create_nonce($portfolio->key);
            $options = array(
                'action' => 'portfolio_like',
                'id' => get_the_ID(),
                'status' => $post_liked,
                'nonce' => $nonce
            );
        }
        if(isset($is_backend) || 'portfolio' == get_post_type(get_the_ID())) :
        ?>
            <div class="post-metas">
                <a class="portfolio-like" data-options='<?php echo json_encode($options); ?>'
                   data-ajax-url="<?php echo admin_url( 'admin-ajax.php?activate-multi=true' ); ?>"
                   href="javascript:;">
                    <i class="<?php echo esc_attr($icon_class)?>"></i> <span class="like-count"><?php echo esc_html($like_count); ?></span>
                </a>
                <div class="post-meta-date">
                    <span>/</span>
                    <?php if(isset($is_backend)): ?>
                        <?php esc_html_e('January 01, 2017', 'g5-startup') ?>
                    <?php else:
                        $established_date = get_post_meta(get_the_ID(), 'portfolio-date', true);
                        if(isset($established_date) && !empty($established_date)) {
                            echo date_i18n( get_option( 'date_format' ), strtotime( $established_date ) );
                        } else {
                            date_i18n(the_time(get_option('date_format')));
                        }?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
