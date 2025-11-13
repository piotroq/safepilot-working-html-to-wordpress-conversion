<?php
/**
 * The template for displaying content related
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
global $post;
$size = 'medium-image';
$excerpt = get_the_excerpt();

?>


<article id="post-<?php the_ID(); ?>" <?php post_class('post-grid clearfix'); ?>>
    <div class="post-item-wrap clearfix">
        <?php if (function_exists('g5plus_get_post_thumbnail')) {
            g5plus_get_post_thumbnail($size);
        } ?>
        <div class="entry-content-wrap">
            <?php if (!empty(get_the_title())): ?>
                <h3 class="entry-post-title fs-20 s-font fw-bold"><a title="<?php the_title(); ?>"
                                                                     href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
            <?php endif; ?>
            <?php if ($excerpt !== ''): ?>
                <div class="entry-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>
            <div class="entry-post-meta">
                <?php if (empty(get_the_title())): ?>
                <a href="<?php echo get_permalink(); ?>">
                    <?php endif; ?>
                    <div class="entry-meta-date"><i
                            class="fa fa-clock-o"></i><a title="<?php the_title(); ?>"
                                                         href="<?php echo get_permalink(); ?>"><?php date_i18n(the_time(get_option('date_format'))); ?></a>
                    </div>
                    <?php if (empty(get_the_title())): ?>
                </a>
            <?php endif; ?>
            </div>
        </div>
    </div>
</article>
