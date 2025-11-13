<?php
get_header();
$title_404 = g5plus_get_option('404_title', esc_html__('404', 'g5-startup'));
$sub_title_404 = g5plus_get_option('404_sub_title', esc_html__('page not found', 'g5-startup'));
$description = g5plus_get_option('404_description', esc_html__('It seems we couldn\'t find the page you are looking for. Please check to make sure you’ve typed the URL correctly.', 'g5-startup'));
$return_text_link = g5plus_get_option('404_return_text_link', esc_html__('BACK TO HOME', 'g5-startup'));
$return_link = g5plus_get_option('404_return_link', esc_url(home_url('/')));

/* 404 Background*/
$background_404 = g5plus_get_option('404_background', array());
$background_404_image_url = isset($background_404['background-image']) ? $background_404['background-image'] : '';
$background_404_color = isset($background_404['background-color']) ? $background_404['background-color'] : '';
$background_404_repeat = $background_404_position = $background_404_size = $background_404_attachment = '';
$custom_style = '';
if (!empty($background_404_image_url)) {
	$background_404_repeat = isset($background_404['background-repeat']) ? $background_404['background-repeat'] : '';
	$background_404_position = isset($background_404['background-position']) ? $background_404['background-position'] : '';
	$background_404_size = isset($background_404['background-size']) ? $background_404['background-size'] : '';
	$background_404_attachment = isset($background_404['background-attachment']) ? $background_404['background-attachment'] : '';
	$custom_style = 'style="background-image: url(' . esc_url($background_404_image_url) . '); background-repeat: '.esc_attr($background_404_repeat).'; background-position: '.esc_attr($background_404_position).'; background-size: '.esc_attr($background_404_size).'; background-attachment: '.esc_attr($background_404_attachment).'; background-color: '.esc_attr($background_404_color).';"';
}


?>
	<div class="page404" <?php echo wp_kses_post($custom_style); ?>>
		<div class="page404-inner">
			<h2 class="title"><?php echo wp_kses_post($title_404); ?></h2>
			<h3 class="subtitle"><?php echo wp_kses_post($sub_title_404); ?></h3>
			<p class="description"><?php echo wp_kses_post($description); ?></p>
			<a class="btn btn-color-accent btn-style-shadow btn-size-md btn-shape-square"
			   href="<?php echo esc_url($return_link) ?>">
				<?php echo wp_kses_post($return_text_link); ?>
			</a>
		</div>
	</div>
<?php
get_footer();