<?php
/**
 * The template for displaying navigation on single post
 *
 * @package WordPress
 * @subpackage Theme_Name
 * @since Theme_Version 1.0
 */
if(get_next_post() || get_previous_post()):
?>
<nav class="post-navigation clearfix" role="navigation">
	<div class="nav-links">
		<?php
		previous_post_link('<div class="nav-previous">%link</div>', _x('<div class="post-navigation-content"><i class="pe-7s-angle-left"></i><span class="post-navigation-label">Previous</span></div> ', 'Previous post link', 'g5-startup'));
		next_post_link('<div class="nav-next">%link</div>', _x('<div class="post-navigation-content"><span class="post-navigation-label">Next</span><i class="pe-7s-angle-right"></i></div> ', 'Next post link', 'g5-startup'));
		?>
	</div>
	<!-- .nav-links -->
</nav><!-- .navigation -->
<?php endif;?>