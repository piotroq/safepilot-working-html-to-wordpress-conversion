<?php
/**
 * The template for displaying post-view.php
 *
 * @package WordPress
 * @subpackage emo
 * @since emo 1.0
 * @var $post_id
 */
$view_count = g5plus_post_view()->get_view_count($post_id);
?>
<i class="fa fa-eye accent-color"></i><span><?php echo esc_html($view_count);?></span>

