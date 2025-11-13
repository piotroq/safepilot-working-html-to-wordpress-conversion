<?php
define('G5PLUS_HOME_URL', trailingslashit(home_url('/')));
define('G5PLUS_THEME_DIR', trailingslashit(get_template_directory()));
define('G5PLUS_THEME_URL', trailingslashit(get_template_directory_uri()));

/**
 * ===================================================================
 * WordPress 6.7+ Compatibility Fix
 * Prevents "translation loading triggered too early" warnings
 * ===================================================================
 */

/**
 * Ensure textdomains are loaded at the correct time
 * This prevents WordPress 6.7 notices
 * 
 * @since 1.0.0
 */
function safepilot_parent_load_textdomain() {
    
    // Load parent theme textdomain properly
    if ( ! is_textdomain_loaded( 'safepilot-startup' ) ) {
        load_theme_textdomain( 
            'safepilot-startup', 
            get_template_directory() . '/languages' 
        );
    }
}
add_action( 'init', 'safepilot_parent_load_textdomain', 1 );

/**
 * Remove early textdomain loading from plugins
 * Prevents plugins from loading translations before 'init'
 * 
 * @since 1.0.0
 */
function safepilot_parent_prevent_early_loading() {
    
    // Remove common early loading hooks
    remove_action( 'plugins_loaded', 'load_plugin_textdomain', 1 );
    remove_action( 'after_setup_theme', 'load_theme_textdomain', 1 );
    
    // Specifically for Visual Composer
    if ( class_exists( 'Vc_Manager' ) ) {
        // Prevent VC from loading textdomain too early
        remove_action( 'plugins_loaded', array( 'Vc_Manager', 'loadTextDomain' ), 1 );
        remove_action( 'vc_after_init', array( 'Vc_Manager', 'loadTextDomain' ), 1 );
    }
}
add_action( 'plugins_loaded', 'safepilot_parent_prevent_early_loading', 0 );

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