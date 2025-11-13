<?php
/**
 * Created by PhpStorm.
 * @var $thumbnail
 * @var $post_link
 * @var $title
 * @var $img_origin
 * @var $ico_gallery
 * @var $disable_link
 */

$excerpt = get_the_excerpt();
?>
<div <?php post_class('post-grid grid-post-item thumbnail-title blog-skin-02'); ?> data-post-info-class="post-info">
<?php if (isset($is_backend) || (!has_post_format('quote') && !has_post_format('link') && !has_post_format('video') && !has_post_format('audio') && !has_post_format('gallery'))): ?>
    <div class="thumbnail-image entry-thumb-wrap" data-img="<?php echo esc_url($thumbnail); ?>">
        <?php if (!empty($thumbnail)): ?>
            <img src="<?php echo esc_attr($thumbnail); ?>" alt="<?php echo esc_html($title); ?>">
        <?php endif; ?>
        <div class="hover-outer transition-30">
            <?php if ($disable_link != 'true'): ?>
                <a href="<?php echo esc_attr($post_link); ?>" title="<?php echo esc_html($title); ?>"></a>
            <?php endif; ?>
            <div class="hover-inner transition-50">
                <div class="icon-groups">
                    <a href="javascript:;" data-src="<?php echo esc_url($img_origin); ?>" class="view-gallery"
                       data-post-id="<?php echo get_the_ID(); ?>"
                       data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')) ?>"><i
                            class="<?php echo esc_attr($ico_gallery); ?>"></i></a>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php g5plus_get_post_thumbnail('medium-image'); ?>
<?php endif; ?>
<div class="post-info entry-content-wrap">
    <?php if (!empty($title)): ?>
        <div class="title entry-post-title fs-20 s-font fw-bold">
            <?php if ($disable_link != 'true'): ?>
                <a href="<?php echo esc_attr($post_link); ?>"
                   title="<?php echo esc_html($title); ?>"><?php echo esc_html($title); ?></a>
            <?php else: ?>
                <?php echo esc_html($title); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if (isset($is_backend)): ?>
        <p><?php esc_html_e('The post excerpt', 'g5-startup') ?></p>
    <?php else:
        if ($excerpt !== ''): ?>
            <div class="entry-excerpt">
                <?php the_excerpt(); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="entry-post-meta">
        <div class="entry-meta-date"><i class="fa fa-clock-o"></i>
            <?php if (isset($is_backend)): ?>
                <?php esc_html_e('January 01, 2017', 'g5-startup') ?>
            <?php else: ?>
                <a title="<?php the_title(); ?>"
                   href="<?php echo get_permalink(); ?>"><?php date_i18n(the_time(get_option('date_format'))); ?></a>
            <?php endif; ?>
        </div>
        <?php if (isset($is_backend)): ?>
            <div class="entry-meta-count-view">
                <i class="fa fa-eye accent-color"></i><span><?php esc_html_e('5', 'g5-startup') ?></span>
            </div>
        <?php else: ?>
            <div class="entry-meta-count-view"><?php g5plus_post_view()->render(get_the_ID()); ?></div>
        <?php endif; ?>

    </div>
</div>
</div>

