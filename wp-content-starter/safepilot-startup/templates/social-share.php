<?php
/**
 * The template for displaying social share
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */

$social_sharing = g5plus_get_option('social_sharing', array());
$sharing_facebook = isset($social_sharing['facebook']) ? $social_sharing['facebook'] : 0;
$sharing_twitter = isset($social_sharing['twitter']) ? $social_sharing['twitter'] : 0;
$sharing_linkedin = isset($social_sharing['linkedin']) ? $social_sharing['linkedin'] : 0;
$sharing_tumblr = isset($social_sharing['tumblr']) ? $social_sharing['tumblr'] : 0;
$sharing_pinterest = isset($social_sharing['pinterest']) ? $social_sharing['pinterest'] : 0;
if (!$sharing_facebook && !$sharing_twitter && !$sharing_linkedin && !$sharing_tumblr && !$sharing_pinterest) return;
?>

<div class="social-share">
    <span><?php echo esc_html__('SHARE', 'g5-startup') ?></span>
    <div class="social-share-list">
        <div class="list-social-icon clearfix">
            <?php if ($sharing_facebook == 1) : ?>
                <a target="_blank" href="<?php echo esc_url('https://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()))?>">
                    <i class="fa fa-facebook"></i>
                </a>
            <?php endif; ?>

            <?php if ($sharing_twitter == 1) : ?>
                <a target="_blank" href="<?php echo esc_url('https://twitter.com/share?text=' . urlencode(get_the_title()) . '&url=' . urlencode(get_permalink()))?>">
                    <i class="fa fa-twitter"></i>
                </a>
            <?php endif; ?>

            <?php if ($sharing_linkedin == 1): ?>
                <a target="_blank" href="<?php echo esc_url('http://www.linkedin.com/shareArticle?mini=true&url=' . urlencode(get_permalink()) . '&title=' .  urlencode(get_the_title()))?>">
                    <i class="fa fa-linkedin"></i>
                </a>
            <?php endif; ?>

            <?php if ($sharing_tumblr == 1) : ?>
                <a target="_blank" href="<?php echo esc_url('http://www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&name=' . urlencode(get_the_title()))?>">
                    <i class="fa fa-tumblr"></i>
                </a>

            <?php endif; ?>

            <?php if ($sharing_pinterest == 1) : ?>
                <?php $_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
                <a target="_blank" href="<?php echo esc_url('http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&description=' . urlencode(get_the_title()) . '&media=' . (($_img_src === false) ? '' :  $_img_src[0]))?>">
                    <i class="fa fa-pinterest"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
