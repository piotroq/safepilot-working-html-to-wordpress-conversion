<?php
$data_retina = '';
$logo = g5plus_get_option('logo');
$logo = isset($logo['url']) ? $logo['url'] : '';;

$logo_retina = g5plus_get_option('logo_retina');
$logo_retina = isset($logo_retina['url']) ? $logo_retina['url'] : '';


$data_retina = '';
if ($logo_retina && ($logo_retina != $logo)) {
	$data_retina = sprintf(' data-no-retina="%s" data-retina="%s"', esc_url($logo), esc_url($logo_retina));
}
$logo_title = esc_attr(get_bloginfo('name', 'display')) . '-' . get_bloginfo('description', 'display');
$logo_text = get_bloginfo('name', 'display');

?>
<div class="logo-canvas">
	<a class="no-sticky" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($logo_title); ?>">
		<?php if (!empty($logo)): ?>
			<img src="<?php echo esc_url($logo); ?>"<?php echo sprintf('%s', $data_retina); ?>
				 alt="<?php echo esc_attr($logo_title); ?>"/>
		<?php else: ?>
			<h2 class="logo-text"><?php echo esc_html($logo_text); ?></h2>
		<?php endif; ?>
	</a>
</div>