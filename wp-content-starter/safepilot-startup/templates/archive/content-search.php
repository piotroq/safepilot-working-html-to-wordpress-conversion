<?php
/**
 * Created by PhpStorm.
 * User: WIN8.1X64
 * Date: 04/09/2016
 * Time: 09:43 AM
 */
global $post;
$class = array();
$class[] = "clearfix";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="search-icon">
		<span class="fa-menu"></span>
	</div>
	<div class="search-entry-content-wrap">
		<h4 class="search-entry-post-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php echo strtoupper( get_the_title() ); ?></a>
		</h4>
		<div class="search-entry-meta-date"><i class="fa fa-clock-o"></i>
			<a title="<?php the_title(); ?>"
			   href="<?php echo get_permalink(); ?>"><?php date_i18n(the_time(get_option('date_format'))); ?></a>
		</div>
		<p class="search-entry-post-type">
			<?php
				$post_type = '';
				switch ($post->post_type) {
					case 'post':
						$post_type = esc_html__('Post', 'g5-startup');
						break;
					case 'page':
						$post_type = esc_html__('Pages', 'g5-startup');
						break;
					case 'product':
						$post_type = esc_html__('Product', 'g5-startup');
						break;
					default:
						$post_type = $post->post_type;
						break;
				}
				echo esc_html($post_type);
			?>
		</p>
		<?php if (in_array($post->post_type, array('post', 'product'))) : ?>
			<div class="search-entry-excerpt">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>
	</div>
</article>
