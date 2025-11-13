<?php
/**
 * The template for displaying main footer
 *
 * @package WordPress
 * @subpackage Pasco
 * @since Pasco 1.0
 */
if (!g5plus_get_option('footer_show_hide', 1)) {
	return;
}

global $wp_registered_sidebars;
$footer_layout = g5plus_get_option('footer_layout', 'footer-1');

$footer_matrix = array(
	'footer-1' => array('col-md-3 col-sm-6', 'col-md-3 col-sm-6', 'col-md-3 col-sm-6', 'col-md-3 col-sm-6'),
	'footer-2' => array('col-md-6 col-sm-12', 'col-md-3 col-sm-6', 'col-md-3 col-sm-6'),
	'footer-3' => array('col-md-3 col-sm-6', 'col-md-3 col-sm-6', 'col-md-6 col-sm-12'),
	'footer-4' => array('col-md-6 col-sm-12', 'col-md-6 col-sm-12'),
	'footer-5' => array('col-md-4 col-sm-12', 'col-md-4 col-sm-12', 'col-md-4 col-sm-12'),
	'footer-6' => array('col-md-8 col-sm-12', 'col-md-4 col-sm-12'),
	'footer-7' => array('col-md-4 col-sm-12', 'col-md-8 col-sm-12'),
	'footer-8' => array('col-md-3 col-sm-12', 'col-md-6 col-sm-12', 'col-md-3 col-sm-12'),
	'footer-9' => array('col-sm-12'),
	'footer-10' => array('col-md-5 col-sm-6 col-xs-12', 'col-md-2 col-sm-6 col-xs-12', 'col-md-3 col-sm-6 col-xs-12', 'col-md-2 col-sm-6 col-xs-12'),
);

$footer_sidebar = array();
$sidebar_count = 0;
for ($i = 0; $i < count($footer_matrix[$footer_layout]); $i++) {
	$footer_sidebar[$i] = g5plus_get_option('footer_sidebar_' . ($i + 1), 'footer-' . ($i + 1));
	if (is_active_sidebar($footer_sidebar[$i])) {
		$sidebar_count++;
	}
}
if ($sidebar_count === 0) return;
$footer_class = array('main-footer');
$footer_container_layout = g5plus_get_option('footer_container_layout', 'container');
?>
<div class="<?php echo esc_attr(implode(' ', array_filter($footer_class))); ?>">
	<div class="<?php echo esc_attr($footer_container_layout); ?>">
		<div class="footer-inner">
			<div class="row">
				<?php for ($i = 0; $i < count($footer_sidebar); $i++): ?>
					<div class="sidebar <?php echo esc_attr($footer_matrix[$footer_layout][$i]); ?>">
						<?php if (is_active_sidebar($footer_sidebar[$i])): ?>
							<?php dynamic_sidebar($footer_sidebar[$i]); ?>
						<?php endif; ?>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</div>
</div>
