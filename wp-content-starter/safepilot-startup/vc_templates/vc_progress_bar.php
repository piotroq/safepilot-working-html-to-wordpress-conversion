<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout_style
 * @var $title
 * @var $values
 * @var $units
 * @var $bgcolor
 * @var $custombgcolor
 * @var $custombgcolor2
 * @var $customtxtcolor
 * @var $options
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Progress_Bar
 */
$layout_style = $title = $values = $units = $css = $barbgcolor = $bargrdcolor = $custombgcolor = $custombgcolor2 = $customtxtcolor = $options = $el_class = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts = $this->convertAttributesToNewProgressBar( $atts );

extract( $atts );
wp_enqueue_script( 'vc_waypoints' );

$el_class = $this->getExtraClass( $el_class );

$bar_options = array();
$options = explode( ',', $options );
if ( in_array( 'animated', $options ) ) {
	$bar_options[] = 'animated';
}
if ( in_array( 'striped', $options ) ) {
	$bar_options[] = 'striped';
}

$class_to_filter = 'vc_progress_bar wpb_content_element '.$layout_style.' '.$barbgcolor.'';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class="' . esc_attr( $css_class ) . '">';
$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_progress_bar_heading' ) );

$values = (array) vc_param_group_parse_atts( $values );
$max_value = 0.0;
$graph_lines_data = array();
foreach ( $values as $data ) {
	$new_line = $data;
	$new_line['value'] = isset( $data['value'] ) ? $data['value'] : 0;
	$new_line['label'] = isset( $data['label'] ) ? $data['label'] : '';
	$new_line['bgcolor'] = ' style="background-color: ' . esc_attr($custombgcolor) . ';"';
	$new_line['txtcolor'] = ' style="color: ' . esc_attr($customtxtcolor) . ';"';
	if(( 'true' === $bargrdcolor) && ( !empty($custombgcolor2 ))){
		$new_line['bgcolor'] = ' style="background: ' . esc_attr($custombgcolor) . ';
		background: -webkit-linear-gradient(left,' . esc_attr($custombgcolor) . ',' . esc_attr($custombgcolor2) . ');
		background: -o-linear-gradient(right,' . esc_attr($custombgcolor) . ',' . esc_attr($custombgcolor2) . ');
		background: -moz-linear-gradient(right' . esc_attr($custombgcolor) . ',' . esc_attr($custombgcolor2) . ');
        background: linear-gradient(right,' . esc_attr($custombgcolor) . ',' . esc_attr($custombgcolor2) . ');"';
	}
	if ( $max_value < (float) $new_line['value'] ) {
		$max_value = $new_line['value'];
	}
	$graph_lines_data[] = $new_line;
}

foreach ( $graph_lines_data as $line ) {
	if ( $max_value > 100.00 ) {
		$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
	} else {
		$percentage_value = $line['value'];
	}
	if( '' != $layout_style ){

		if( !empty($units) ){
			$unit = ' <span class="vc_label_units fs-14 h-font"' . $line['txtcolor'] . '>' . $line['value'] . $units . '</span>';
		}else{
			$unit = ' <span class="vc_label_units fs-14 h-font"' . $line['txtcolor'] . '>' . $line['value'].'</span>';
		}

		if( !empty($line['label']) ){
			$output .= '<span class="progress-bar-title fs-15 h-font"' . $line['txtcolor'] . '>' . $line['label'] . '</span>';
		}

		$output .= '<div class="vc_general vc_single_bar">';
		if( 'prb_vl_move' == $layout_style ){
			$output .= '<span class="vc_bar ' . esc_attr( implode( ' ', $bar_options ) ) . '" data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . '"' . $line['bgcolor'] . '>'. $unit .'</span>';
		}
		else{
			$output .= '<span class="vc_bar ' . esc_attr( implode( ' ', $bar_options ) ) . '" data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . '"' . $line['bgcolor'] . '></span>';
			$output .= $unit;
		}
		$output .= '</div>';

	}
	else{
		if( !empty($units) ){
			$unit = ' <span class="vc_label_units fs-14 h-font" >' . $line['value'] . $units . '</span>';
		}else{
			$unit = ' <span class="vc_label_units fs-14 h-font" >' . $line['value'] . '</span>';
		}

		$output .= '<div class = "vc_general vc_single_bar">';
		$output .= '<div class="vc_label fs-15 h-font"' . $line['txtcolor'] . '>' . '<span>'.$line['label'].'</span>'.$unit.'</div>';
		$output .= '<span class="vc_bar ' . esc_attr( implode( ' ', $bar_options ) ) . '" data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . '"' . $line['bgcolor'] . '></span>';
		$output .= '</div>';
	}
}
$output .= '</div>';

echo sprintf('%s',$output);