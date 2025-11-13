<?php
/**
 * Register Sidebar
 * *******************************************************
 */
if (!function_exists('g5plus_register_sidebar')) {
    function g5plus_register_sidebar()
    {
        $sidebars = array(
            array(
                'id'          => 'main-sidebar',
                'name'        => esc_html__('Main Sidebar', 'g5-startup'),
                'description' => esc_html__('Add widgets here to appear in your sidebar', 'g5-startup'),
            ),
	        array(
		        'name'          => esc_html__("Top Drawer",'g5-startup'),
		        'id'            => 'top_drawer_sidebar',
		        'description'   => esc_html__("Top Drawer",'g5-startup'),
	        ),
	        array(
		        'name'          => esc_html__("Top Bar Left",'g5-startup'),
		        'id'            => 'top_bar_left',
		        'description'   => esc_html__("Top Bar Left",'g5-startup'),
	        ),
	        array(
		        'name'          => esc_html__("Top Bar Right",'g5-startup'),
		        'id'            => 'top_bar_right',
		        'description'   => esc_html__("Top Bar Right",'g5-startup'),
	        ),
	        array(
		        'name'          => esc_html__("Footer 1",'g5-startup'),
		        'id'            => 'footer-1',
		        'description'   => esc_html__("Footer 1",'g5-startup'),
	        ),
	        array(
		        'name'          => esc_html__("Footer 2",'g5-startup'),
		        'id'            => 'footer-2',
		        'description'   => esc_html__("Footer 2",'g5-startup'),
	        ),
	        array(
		        'name'          => esc_html__("Footer 3",'g5-startup'),
		        'id'            => 'footer-3',
		        'description'   => esc_html__("Footer 3",'g5-startup'),
	        ),
	        array(
		        'name'          => esc_html__("Footer 4",'g5-startup'),
		        'id'            => 'footer-4',
		        'description'   => esc_html__("Footer 4",'g5-startup'),
	        ),
	        array(
		        'name'          => esc_html__("Bottom Bar Left",'g5-startup'),
		        'id'            => 'bottom_bar_left',
		        'description'   => esc_html__("Bottom Bar Left",'g5-startup'),
	        ),
	        array(
		        'name'          => esc_html__("Bottom Bar Right",'g5-startup'),
		        'id'            => 'bottom_bar_right',
		        'description'   => esc_html__("Bottom Bar Right",'g5-startup'),
	        ),
	        array(
		        'name'          => esc_html__("Canvas Sidebar",'g5-startup'),
		        'id'            => 'canvas-sidebar',
		        'description'   => esc_html__("Canvas  Sidebar Widget Area",'g5-startup'),
	        ),
            array(
                'name'          => esc_html__("Woocommerce Filter",'g5-startup'),
                'id'            => 'woocommerce-filter',
                'description'   => esc_html__("Woocommerce Filter",'g5-startup'),
            )
        );
        foreach ($sidebars as $sidebar) {
            register_sidebar(array(
                'name'          => $sidebar['name'],
                'id'            => $sidebar['id'],
                'description'   => $sidebar['description'],
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h4 class="widget-title"><span>',
                'after_title'   => '</span></h4>',
            ));
        }
    }

    add_action('widgets_init', 'g5plus_register_sidebar');
}

/**
 * Add filter for dynamic sidebar
 * *******************************************************
 */
if (!function_exists('g5plus_redux_custom_widget_area_filter')) {
	function g5plus_redux_custom_widget_area_filter($arg) {
		return array(
			'before_title'  => '<h4 class="widget-title"><span>',
			'after_title'   => '</span></h4>',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>'
		);
	}
	add_filter('redux_custom_widget_args','g5plus_redux_custom_widget_area_filter');
}
