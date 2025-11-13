<?php
/**
 * The template for displaying content masonry
 *
 * @package WordPress
 * @subpackage Speci
 * @since Speci 1.0
 */
$size = 'full';
$excerpt = get_the_excerpt();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-grid post-masonry gf-item-wrap clearfix'); ?>>
    <?php g5plus_get_post_thumbnail($size); ?>
    <div class="entry-content-wrap">
        <?php if (!empty(get_the_title())): ?>
            <h3 class="entry-post-title fs-20"><a title="<?php the_title(); ?>"
                                                                 href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
        <?php endif; ?>
        <div class="entry-post-meta">
            <div class="entry-meta-date"><i class="fa fa-clock-o"></i>
                <a title="<?php the_title(); ?>"
                   href="<?php echo get_permalink(); ?>"><?php date_i18n(the_time(get_option('date_format'))); ?></a></div>
        </div>
        <?php if ($excerpt !== ''): ?>
            <div class="entry-excerpt">
                <?php the_excerpt(); ?>
            </div>
        <?php endif; ?>
        <a href="<?php echo get_permalink() ?>" class="blog-read-more">
            <?php esc_html_e('VIEW WORKS', 'g5-startup'); ?>
        </a>
    </div>
</article>