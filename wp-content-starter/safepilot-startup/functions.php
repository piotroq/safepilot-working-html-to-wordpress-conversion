<?php
define('G5PLUS_HOME_URL', trailingslashit(home_url('/')));
define('G5PLUS_THEME_DIR', trailingslashit(get_template_directory()));
define('G5PLUS_THEME_URL', trailingslashit(get_template_directory_uri()));

/**
 * ===================================================================
 * ENHANCED WordPress 6.7+ Compatibility Fix - LEVEL 2
 * Works in conjunction with MU-Plugin
 * ===================================================================
 */

/**
 * Enhanced Output Buffer Fix
 * Multiple approaches to prevent ob_end_flush errors
 */
if ( ! function_exists( 'safepilot_enhanced_output_buffer_fix' ) ) {
    function safepilot_enhanced_output_buffer_fix() {
        
        // Method 1: Disable compression completely
        if ( function_exists( 'ini_set' ) ) {
            @ini_set( 'zlib.output_compression', '0' );
            @ini_set( 'output_buffering', '0' );
            @ini_set( 'implicit_flush', '1' );
        }
        
        // Method 2: Remove WordPress compression hooks
        remove_action( 'init', 'wp_ob_end_flush_all', 1 );
        remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
        
        // Method 3: Clean any existing buffers safely
        while ( ob_get_level() > 0 ) {
            if ( ! @ob_end_clean() ) {
                break;
            }
        }
        
        // Method 4: Prevent WordPress from using ob_gzhandler
        if ( function_exists( 'ob_gzhandler' ) ) {
            remove_action( 'init', 'ob_gzhandler' );
        }
        
        // Method 5: Set explicit no-compression headers
        if ( ! headers_sent() ) {
            header( 'Content-Encoding: identity' );
            header( 'Cache-Control: no-cache, must-revalidate' );
        }
    }
}
add_action( 'plugins_loaded', 'safepilot_enhanced_output_buffer_fix', 1 );

/**
 * Enhanced Plugin Hook Removal
 * Stronger removal of problematic plugin hooks
 */
if ( ! function_exists( 'safepilot_aggressive_hook_removal' ) ) {
    function safepilot_aggressive_hook_removal() {
        
        global $wp_filter;
        
        // Remove textdomain loading from all possible hooks
        $hooks_to_clean = array(
            'plugins_loaded',
            'after_setup_theme',
            'init',
            'muplugins_loaded',
            'wp_loaded'
        );
        
        foreach ( $hooks_to_clean as $hook ) {
            if ( isset( $wp_filter[ $hook ] ) ) {
                
                // Search through all priorities
                foreach ( $wp_filter[ $hook ]->callbacks as $priority => $callbacks ) {
                    
                    foreach ( $callbacks as $callback_id => $callback ) {
                        
                        // Check if this callback is related to textdomain loading
                        if ( is_array( $callback['function'] ) ) {
                            
                            $class = $callback['function'][0];
                            $method = $callback['function'][1];
                            
                            // Remove Visual Composer textdomain loading
                            if ( ( is_object( $class ) && get_class( $class ) === 'Vc_Manager' && $method === 'loadTextDomain' ) ||
                                 ( is_string( $class ) && $class === 'Vc_Manager' && $method === 'loadTextDomain' ) ) {
                                
                                unset( $wp_filter[ $hook ]->callbacks[ $priority ][ $callback_id ] );
                            }
                            
                            // Remove Startup Framework textdomain loading
                            if ( ( is_object( $class ) && get_class( $class ) === 'GF_Loader' && $method === 'load_text_domain' ) ||
                                 ( is_string( $class ) && $class === 'GF_Loader' && $method === 'load_text_domain' ) ) {
                                
                                unset( $wp_filter[ $hook ]->callbacks[ $priority ][ $callback_id ] );
                            }
                        }
                        
                        // Check for function name based callbacks
                        if ( is_string( $callback['function'] ) ) {
                            if ( strpos( $callback['function'], 'load_textdomain' ) !== false ||
                                 strpos( $callback['function'], 'load_plugin_textdomain' ) !== false ) {
                                
                                unset( $wp_filter[ $hook ]->callbacks[ $priority ][ $callback_id ] );
                            }
                        }
                    }
                }
            }
        }
    }
}
add_action( 'plugins_loaded', 'safepilot_aggressive_hook_removal', 0 );

/**
 * Controlled Theme Textdomain Loading
 * Only loads theme domains, plugins handled by MU-plugin
 */
if ( ! function_exists( 'safepilot_controlled_theme_textdomains' ) ) {
    function safepilot_controlled_theme_textdomains() {
        
        // Only load theme textdomains here
        if ( ! is_textdomain_loaded( 'g5-startup' ) ) {
            load_theme_textdomain( 'g5-startup', get_template_directory() . '/languages' );
        }
    }
}
add_action( 'init', 'safepilot_controlled_theme_textdomains', 5 );

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