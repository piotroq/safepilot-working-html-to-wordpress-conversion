<?php
/**
 * The template for displaying tags on single post
 *
 * @package WordPress
 * @subpackage Speci
 * @since Speci 1.0
 */
$single_tag_enable = g5plus_get_option('single_tag_enable',1);
$single_share_enable = g5plus_get_option('single_share_enable',1);
if ($single_tag_enable || $single_share_enable){
	echo '<div class="entry-meta-tag-and-share-wrap">';
	if ($single_tag_enable) {
		the_tags('<div class="entry-meta-tag"><span>'. esc_html('TAGS','g5-startup') .'</span>', '', '</div>');
	}
	if ($single_share_enable) {
		g5plus_the_social_share();
	}
	echo '</div>';
}

