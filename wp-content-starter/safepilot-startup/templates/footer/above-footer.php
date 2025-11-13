<?php
$set_footer_above_custom = g5plus_get_option('set_footer_above_custom', 0);
if ($set_footer_above_custom):
	global $post;
	$post = get_post($set_footer_above_custom);
	setup_postdata( $post );
	?>
	<div class="footer-above-wrapper">
		<div class="container">
			<?php the_content(); ?>
		</div>
	</div>
	<?php
	wp_reset_postdata();
endif;