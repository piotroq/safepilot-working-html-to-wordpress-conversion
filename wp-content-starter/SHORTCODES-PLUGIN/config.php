<?php
return array(
	'base' => 'g5plus_blog',
	'name' => esc_html__('Blog','startup-framework'),
	'icon' => 'fa fa-file-text',
	'category' => GF_SHORTCODE_CATEGORY,
	'params' => array(
		gf_vc_map_add_narrow_category(),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout', 'startup-framework'),
			'param_name' => 'layout',
			'value' => array(
				esc_html__('Large Image','startup-framework') => 'large-image',
				esc_html__('Grid','startup-framework') => 'grid',
				esc_html__('Masonry', 'startup-framework' ) => 'masonry',
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns', 'startup-framework'),
			'param_name' => 'columns',
			'value' => array('2' => 2 , '3' => 3),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array('element' => 'layout', 'value' => array('masonry','grid') ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Post Paging', 'startup-framework'),
			'param_name' => 'post_paging',
			'value' => array(
				esc_html__('Show all', 'startup-framework') => 'all',
				esc_html__('Navigation', 'startup-framework') => 'navigation',
				esc_html__('Load More', 'startup-framework') => 'load-more',
				esc_html__('Infinite Scroll', 'startup-framework') => 'infinite-scroll',
			),
			'std' => 'all',
			'edit_field_class' => 'vc_col-sm-6 vc_column',
		),
		array(
			'type' => 'number',
			'heading' => esc_html__('Number of posts', 'startup-framework' ),
			'description' => esc_html__('Enter number of posts to display.', 'startup-framework' ),
			'param_name' => 'max_items',
			'value' => -1,
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			"type" => "number",
			"heading" => esc_html__("Posts per page", 'startup-framework'),
			"param_name" => "posts_per_page",
			"value" => get_option('posts_per_page'),
			"description" => esc_html__('Number of items to show per page', 'startup-framework'),
			'dependency' => array('element' => 'post_paging','value' => array('navigation', 'load-more', 'infinite-scroll')),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Order by', 'startup-framework'),
			'param_name' => 'orderby',
			'value' => array(
				esc_html__('Date', 'startup-framework') => 'date',
				esc_html__('Order by post ID', 'startup-framework') => 'ID',
				esc_html__('Author', 'startup-framework') => 'author',
				esc_html__('Title', 'startup-framework') => 'title',
				esc_html__('Last modified date', 'startup-framework') => 'modified',
				esc_html__('Post/page parent ID', 'startup-framework') => 'parent',
				esc_html__('Number of comments', 'startup-framework') => 'comment_count',
				esc_html__('Menu order/Page Order', 'startup-framework') => 'menu_order',
				esc_html__('Meta value', 'startup-framework') => 'meta_value',
				esc_html__('Meta value number', 'startup-framework') => 'meta_value_num',
				esc_html__('Random order', 'startup-framework') => 'rand',
			),
			'description' => esc_html__('Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'startup-framework'),
			'group' => esc_html__('Data Settings', 'startup-framework'),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Sorting', 'startup-framework'),
			'param_name' => 'order',
			'group' => esc_html__('Data Settings', 'startup-framework'),
			'value' => array(
				esc_html__('Descending', 'startup-framework') => 'DESC',
				esc_html__('Ascending', 'startup-framework') => 'ASC',
			),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'description' => esc_html__('Select sorting order.', 'startup-framework'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__('Meta key', 'startup-framework'),
			'param_name' => 'meta_key',
			'description' => esc_html__('Input meta key for grid ordering.', 'startup-framework'),
			'group' => esc_html__('Data Settings', 'startup-framework'),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'dependency' => array(
				'element' => 'orderby',
				'value' => array('meta_value', 'meta_value_num'),
			),
		),
		gf_vc_map_add_extra_class()
	)
);