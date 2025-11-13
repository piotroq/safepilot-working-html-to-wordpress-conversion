<?php
/**
 * The template for displaying post meta
 *
 * @package WordPress
 * @subpackage g5-startup
 * @since g5-startup 1.0
 */
?>
<div class="entry-post-meta">
    <div class="entry-meta-author">
        <i class="fa fa-user"></i> <?php printf('<a href="%1$s">%2$s</a>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_html(get_the_author())); ?>
    </div>
    <div class="entry-meta-date"><i class="fa fa-clock-o"></i>
        <a title="<?php the_title(); ?>"
           href="<?php echo get_permalink(); ?>"><?php date_i18n(the_time(get_option('date_format'))); ?></a></div>
    <?php if (comments_open() || get_comments_number()) : ?>
        <div class="entry-meta-comment">
            <?php comments_popup_link(wp_kses_post(__('<i class="fa fa-comment-o"></i> 0 Comments', 'g5-startup')), wp_kses_post(__('<i class="fa fa-comment-o"></i> 1 Comment', 'g5-startup')), wp_kses_post(__('<i class="fa fa-comment-o"></i> % Comments', 'g5-startup')), '', ''); ?>
        </div>
    <?php endif; ?>
    <div class="entry-meta-count-view"><?php g5plus_post_view()->render(get_the_ID()); ?></div>
</div>
