<?php
/**
 * The template for displaying comment item
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
        <div class="comment-avatar">
            <?php echo get_avatar($comment, $args['avatar_size']) ?>
        </div>
        <div class="comment-text entry-content">
            <div class="comment-author">
                <div class="author-name"><?php printf('%s', get_comment_author_link()) ?></div>
                <div class="comment-date"><i class="fa fa-clock-o"></i><span><?php echo get_comment_date() ?> <span>at</span> <?php echo get_comment_time()?></span> </div>
            </div>
            <div class="comment-meta">
                <?php edit_comment_link('<span>'.esc_html__('Edit', 'g5-startup') .'</span>'. '<i class="fa fa-pencil-square-o"></i>'); ?>
                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span>'.wp_kses_post(__('Reply', 'g5-startup')) .'</span>'. '<i class="fa fa-reply"></i>'))) ?>
            </div>
            <div class="text">
                <?php comment_text() ?>
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php esc_html_e('Your comment is awaiting moderation.', 'g5-startup'); ?></em>
                <?php endif; ?>
            </div>
        </div>
    </div>

