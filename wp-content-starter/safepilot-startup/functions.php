<?php
define('G5PLUS_HOME_URL', trailingslashit(home_url('/')));
define('G5PLUS_THEME_DIR', trailingslashit(get_template_directory()));
define('G5PLUS_THEME_URL', trailingslashit(get_template_directory_uri()));

/**
 * Include Theme Library
 * *******************************************************
 */
if (!function_exists('g5plus_include_library')) {
    function g5plus_include_library()
    {
	    require_once(G5PLUS_THEME_DIR . 'inc/register-require-plugin.php');
        require_once(G5PLUS_THEME_DIR . 'inc/frontend-enqueue.php');
	    require_once(G5PLUS_THEME_DIR . 'inc/admin-enqueue.php');
        require_once(G5PLUS_THEME_DIR . 'inc/theme-setup.php');
	    require_once(G5PLUS_THEME_DIR . 'inc/theme-filter.php');
        require_once(G5PLUS_THEME_DIR . 'inc/theme-functions.php');
	    require_once(G5PLUS_THEME_DIR . 'inc/theme-action.php');
        require_once(G5PLUS_THEME_DIR . 'inc/post-view.class.php');
	    require_once(G5PLUS_THEME_DIR . 'inc/ajax.php');
        require_once(G5PLUS_THEME_DIR . 'inc/sidebar.php');
        require_once(G5PLUS_THEME_DIR . 'core/widget-custom-class.php');
	    require_once(G5PLUS_THEME_DIR . 'core/woocommerce.php');

	    g5plus_post_view()->init();
    }
    g5plus_include_library();
}