<?php
/**
 * The template for displaying content large image
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
$size = 'large-image';
$excerpt = get_the_excerpt();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-large-image clearfix'); ?>>
    <?php g5plus_get_post_thumbnail($size); ?>
    <div class="entry-content-wrap clearfix">
        <div class="entry-info-post clearfix">
            <div class="entry-date-wrap">
                <div class="entry-date h-font">
                    <span><?php the_time('d'); ?></span>
                    <span class="mg-bottom-0"><?php the_time('M'); ?></span>
                </div>
            </div>
            <div class="entry-title-and-meta">
                <?php if (!empty(get_the_title())): ?>
                    <h3 class="entry-post-title"><a title="<?php the_title(); ?>"
                                                                         href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                <?php endif; ?>
                <?php get_template_part('templates/archive/post-meta'); ?>
            </div>
        </div>
        <?php if ($excerpt !== ''): ?>
            <div class="entry-excerpt">
                <?php the_excerpt(); ?>
            </div>
        <?php endif; ?>
        <a href="<?php echo get_permalink() ?>" class=" btn blog-read-more h-font">
            <?php esc_html_e('READ MORE', 'g5-startup'); ?>
        </a>
    </div>
</article>
