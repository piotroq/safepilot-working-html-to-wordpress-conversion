<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Speci
 * @since Speci 1.0
 */
$size = 'large-image';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-single clearfix'); ?>>
    <?php g5plus_get_post_thumbnail($size, 0, true); ?>
    <div class="entry-content-wrap">
        <div class="entry-info-post clearfix">
            <div class="entry-date-wrap">
                <div class="entry-date h-font">
                    <span><?php the_time('d'); ?></span>
                    <span class="mg-bottom-0"><?php the_time('M'); ?></span>
                </div>
            </div>
            <div class="entry-title-and-meta">
                <h3 class="entry-post-title"><?php the_title(); ?></h3>
                <div class="entry-post-meta">
                    <div class="entry-meta-author">
                        <i class="fa fa-user"></i> <?php printf('<a href="%1$s">%2$s</a>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_html(get_the_author())); ?>
                    </div>
                    <div class="entry-meta-date"><i class="fa fa-clock-o"></i>
                       <?php date_i18n(the_time(get_option('date_format'))); ?></div>
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <div class="entry-meta-comment">
                            <?php comments_popup_link(wp_kses_post(__('<i class="fa fa-comment-o"></i> 0 Comments', 'g5-startup')), wp_kses_post(__('<i class="fa fa-comment-o"></i> 1 Comment', 'g5-startup')), wp_kses_post(__('<i class="fa fa-comment-o"></i> % Comments', 'g5-startup')), '', ''); ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry-meta-count-view"><?php g5plus_post_view()->render();?></div>
                </div>

            </div>
        </div>
        <div class="entry-content clearfix">
            <?php
            the_content();
            wp_link_pages(array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'g5-startup') . '</span>',
                'after'       => '</div>',
                'link_before' => '<span class="page-link">',
                'link_after'  => '</span>',
            )); ?>
        </div>
    </div>
</article>
<?php
/**
 * @hooked - g5plus_post_tag - 5
 * @hooked - g5plus_post_nav - 10
 * @hooked - g5plus_post_author_info - 15
 * @hooked - g5plus_post_comment - 20
 * @hooked - g5plus_post_related - 30
 *
 **/
do_action('g5plus_after_single_post');
?>

