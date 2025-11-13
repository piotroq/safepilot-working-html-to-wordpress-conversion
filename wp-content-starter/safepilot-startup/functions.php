<?php
define('G5PLUS_HOME_URL', trailingslashit(home_url('/')));
define('G5PLUS_THEME_DIR', trailingslashit(get_template_directory()));
define('G5PLUS_THEME_URL', trailingslashit(get_template_directory_uri()));

/**
 * ===================================================================
 * NUCLEAR LEVEL 3 FIX: Minimal Theme Functions
 * MU-Plugin handles all textdomain and error management
 * ===================================================================
 */

/**
 * Minimal Theme Textdomain Loading (Backup only)
 * MU-Plugin is primary handler
 */
if ( ! function_exists( 'safepilot_minimal_textdomain' ) ) {
    function safepilot_minimal_textdomain() {
        // Only load if MU-Plugin failed
        if ( ! is_textdomain_loaded( 'g5-startup' ) ) {
            load_theme_textdomain( 'g5-startup', get_template_directory() . '/languages' );
        }
    }
}
add_action( 'init', 'safepilot_minimal_textdomain', 20 ); // Low priority, after MU-Plugin

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