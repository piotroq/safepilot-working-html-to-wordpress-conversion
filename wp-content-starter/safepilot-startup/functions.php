<?php
define('G5PLUS_HOME_URL', trailingslashit(home_url('/')));
define('G5PLUS_THEME_DIR', trailingslashit(get_template_directory()));
define('G5PLUS_THEME_URL', trailingslashit(get_template_directory_uri()));

/**
 * ===================================================================
 * WordPress 6.7+ Compatibility Fix - COMPLETE SOLUTION
 * Prevents all translation loading and output buffer errors
 * ===================================================================
 */

/**
 * FIX #1: Disable Output Compression (Prevents ob_end_flush errors)
 * Must run before any output
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'safepilot_disable_output_compression' ) ) {
    function safepilot_disable_output_compression() {
        // Disable gzip compression to prevent buffer conflicts
        if ( function_exists( 'ini_set' ) ) {
            @ini_set( 'zlib.output_compression', '0' );
            @ini_set( 'output_buffering', '0' );
        }
        
        // Prevent WordPress from using ob_gzhandler
        remove_action( 'init', 'ob_gzhandler' );
        
        // Set proper headers for no compression
        if ( ! headers_sent() ) {
            header( 'Content-Encoding: identity' );
        }
    }
}
// Run immediately, before any output
add_action( 'plugins_loaded', 'safepilot_disable_output_compression', 1 );

/**
 * FIX #2: Prevent Early Translation Loading
 * Blocks plugins from loading translations before init
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'safepilot_prevent_early_textdomain' ) ) {
    function safepilot_prevent_early_textdomain() {
        
        // Remove early translation hooks from all plugins
        remove_action( 'plugins_loaded', 'load_plugin_textdomain', 1 );
        remove_action( 'plugins_loaded', 'load_plugin_textdomain', 5 );
        remove_action( 'plugins_loaded', 'load_plugin_textdomain', 10 );
        remove_action( 'plugins_loaded', 'load_plugin_textdomain', 15 );
        
        // Remove early theme translation hooks
        remove_action( 'after_setup_theme', 'load_theme_textdomain', 1 );
        remove_action( 'after_setup_theme', 'load_theme_textdomain', 5 );
        
        // Visual Composer specific fixes
        if ( class_exists( 'Vc_Manager' ) ) {
            remove_action( 'plugins_loaded', array( 'Vc_Manager', 'loadTextDomain' ), 1 );
            remove_action( 'vc_after_init', array( 'Vc_Manager', 'loadTextDomain' ), 1 );
            remove_action( 'vc_before_init', array( 'Vc_Manager', 'loadTextDomain' ), 1 );
        }
        
        // Startup Framework specific fixes
        global $gf_loader;
        if ( isset( $gf_loader ) && is_object( $gf_loader ) ) {
            remove_action( 'plugins_loaded', array( $gf_loader, 'load_text_domain' ), 1 );
            remove_action( 'plugins_loaded', array( $gf_loader, 'load_text_domain' ), 10 );
        }
    }
}
add_action( 'plugins_loaded', 'safepilot_prevent_early_textdomain', 0 );

/**
 * FIX #3: Proper Text Domain Loading (WordPress 6.7+ Compatible)
 * Loads all textdomains at the correct time with correct names
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'safepilot_load_textdomains_properly' ) ) {
    function safepilot_load_textdomains_properly() {
        
        // 1. Load main theme textdomain with CORRECT name
        if ( ! is_textdomain_loaded( 'g5-startup' ) ) {
            load_theme_textdomain( 
                'g5-startup', 
                get_template_directory() . '/languages' 
            );
        }
        
        // 2. Load Visual Composer textdomain properly
        if ( defined( 'WPB_VC_VERSION' ) && ! is_textdomain_loaded( 'js_composer' ) ) {
            $vc_paths = array(
                WP_PLUGIN_DIR . '/js_composer/locale',
                WP_PLUGIN_DIR . '/js_composer/languages',
                WP_CONTENT_DIR . '/plugins/js_composer/locale',
                WP_CONTENT_DIR . '/plugins/js_composer/languages'
            );
            
            $loaded = false;
            foreach ( $vc_paths as $path ) {
                if ( file_exists( $path ) && ! $loaded ) {
                    $relative_path = str_replace( WP_PLUGIN_DIR . '/', '', dirname( $path ) );
                    if ( load_plugin_textdomain( 'js_composer', false, $relative_path . '/locale' ) ||
                         load_plugin_textdomain( 'js_composer', false, $relative_path . '/languages' ) ) {
                        $loaded = true;
                        break;
                    }
                }
            }
            
            // Fallback for different VC versions
            if ( ! $loaded ) {
                $locale = apply_filters( 'plugin_locale', get_locale(), 'js_composer' );
                $fallback_paths = array(
                    WP_PLUGIN_DIR . '/js_composer/locale/js_composer-' . $locale . '.mo',
                    WP_PLUGIN_DIR . '/js_composer/languages/js_composer-' . $locale . '.mo'
                );
                
                foreach ( $fallback_paths as $mofile ) {
                    if ( file_exists( $mofile ) ) {
                        load_textdomain( 'js_composer', $mofile );
                        break;
                    }
                }
            }
        }
        
        // 3. Load Startup Framework textdomain properly
        if ( ! is_textdomain_loaded( 'startup-framework' ) ) {
            $sf_paths = array(
                WP_PLUGIN_DIR . '/startup-framework/languages',
                WP_CONTENT_DIR . '/plugins/startup-framework/languages',
                get_template_directory() . '/languages'  // Fallback to theme
            );
            
            $loaded = false;
            foreach ( $sf_paths as $path ) {
                if ( file_exists( $path ) && ! $loaded ) {
                    if ( strpos( $path, get_template_directory() ) === 0 ) {
                        // Theme path
                        load_theme_textdomain( 'startup-framework', $path );
                    } else {
                        // Plugin path
                        $relative_path = str_replace( WP_PLUGIN_DIR . '/', '', dirname( $path ) );
                        load_plugin_textdomain( 'startup-framework', false, $relative_path . '/languages' );
                    }
                    $loaded = true;
                    break;
                }
            }
            
            // Fallback
            if ( ! $loaded ) {
                $locale = apply_filters( 'plugin_locale', get_locale(), 'startup-framework' );
                $mofile = WP_PLUGIN_DIR . '/startup-framework/languages/startup-framework-' . $locale . '.mo';
                if ( file_exists( $mofile ) ) {
                    load_textdomain( 'startup-framework', $mofile );
                }
            }
        }
    }
}
add_action( 'init', 'safepilot_load_textdomains_properly', 1 );

/**
 * FIX #4: Override Plugin Textdomain Functions
 * Ensures plugins use our controlled loading
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'safepilot_override_plugin_textdomains' ) ) {
    function safepilot_override_plugin_textdomains() {
        
        // Override VC textdomain loading
        if ( class_exists( 'Vc_Manager' ) ) {
            add_action( 'vc_before_init', function() {
                if ( ! is_textdomain_loaded( 'js_composer' ) ) {
                    // Let our function handle it
                    safepilot_load_textdomains_properly();
                }
            }, 999 );
        }
        
        // Override Startup Framework loading
        add_action( 'startup_framework_init', function() {
            if ( ! is_textdomain_loaded( 'startup-framework' ) ) {
                // Let our function handle it
                safepilot_load_textdomains_properly();
            }
        }, 999 );
    }
}
add_action( 'init', 'safepilot_override_plugin_textdomains', 2 );

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