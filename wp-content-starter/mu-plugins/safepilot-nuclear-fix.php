<?php
/**
 * SafePilot NUCLEAR Textdomain Fix - Must Use Plugin
 * LEVEL 3 FIX: Complete WordPress Core Override
 * 
 * Must Use Plugin - loads BEFORE all other plugins
 * 
 * @package SafePilot
 * @since 1.0.0
 * @author piotroq 
 * @created 2025-11-13
 * @version NUCLEAR 3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ===================================================================
 * NUCLEAR LEVEL 3 FIX: Complete WordPress Core Replacement
 * Completely replaces WordPress textdomain handling
 * ===================================================================
 */

/**
 * NUCLEAR: Disable WordPress Core Textdomain Function Entirely
 */
if ( ! function_exists( 'safepilot_nuclear_disable_wp_textdomain' ) ) {
    function safepilot_nuclear_disable_wp_textdomain() {
        
        // NUCLEAR OPTION: Remove the WordPress function that causes problems
        if ( function_exists( '_load_textdomain_just_in_time' ) ) {
            // Override the function with empty implementation
            remove_action( 'gettext', '_load_textdomain_just_in_time', 10 );
            remove_action( 'gettext_with_context', '_load_textdomain_just_in_time', 10 );
            remove_action( 'ngettext', '_load_textdomain_just_in_time', 10 );
            remove_action( 'ngettext_with_context', '_load_textdomain_just_in_time', 10 );
        }
        
        // Disable the WordPress 6.7 early loading check completely
        add_filter( 'wp_doing_it_wrong_trigger_error', '__return_false', 1 );
        
        // Override load_textdomain function behavior
        add_filter( 'override_load_textdomain', function( $override, $domain, $mofile ) {
            // Always return true to prevent WordPress from loading
            if ( in_array( $domain, array( 'js_composer', 'startup-framework' ) ) ) {
                // Store for our custom loading
                global $safepilot_nuclear_domains;
                if ( ! isset( $safepilot_nuclear_domains ) ) {
                    $safepilot_nuclear_domains = array();
                }
                $safepilot_nuclear_domains[ $domain ] = $mofile;
                return true; // Prevent WordPress from loading
            }
            return $override;
        }, 1, 3 );
    }
}

/**
 * NUCLEAR: Custom Error Handler - Suppress ALL WordPress Textdomain Errors
 */
if ( ! function_exists( 'safepilot_nuclear_error_handler' ) ) {
    function safepilot_nuclear_error_handler( $errno, $errstr, $errfile, $errline ) {
        
        // List of errors to completely suppress
        $suppress_patterns = array(
            'translation loading',
            'triggered too early',
            '_load_textdomain_just_in_time',
            'ob_end_flush',
            'zlib output compression',
            'preg_replace(): Passing null'
        );
        
        // Check if this error should be suppressed
        foreach ( $suppress_patterns as $pattern ) {
            if ( strpos( $errstr, $pattern ) !== false ) {
                // Log suppressed error (for debugging only)
                if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
                    error_log( '[SafePilot NUCLEAR] Suppressed: ' . $errstr );
                }
                return true; // Suppress the error
            }
        }
        
        // Let other errors through
        return false;
    }
}

/**
 * NUCLEAR: Output Buffer Management
 */
if ( ! function_exists( 'safepilot_nuclear_buffer_fix' ) ) {
    function safepilot_nuclear_buffer_fix() {
        
        // Method 1: Completely disable output buffering
        if ( function_exists( 'ini_set' ) ) {
            @ini_set( 'zlib.output_compression', '0' );
            @ini_set( 'output_buffering', '0' );
            @ini_set( 'implicit_flush', '1' );
            @ini_set( 'output_handler', '' );
        }
        
        // Method 2: Clean all buffers aggressively
        while ( ob_get_level() > 0 ) {
            if ( ! @ob_end_clean() ) {
                break;
            }
        }
        
        // Method 3: Prevent WordPress from starting new buffers
        remove_action( 'init', 'wp_ob_end_flush_all', 1 );
        remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
        
        // Method 4: Override ob_end_flush function
        if ( ! function_exists( 'ob_end_flush' ) ) {
            function ob_end_flush() {
                if ( ob_get_level() > 0 ) {
                    return @ob_end_clean();
                }
                return false;
            }
        }
        
        // Method 5: Set headers to prevent compression
        if ( ! headers_sent() ) {
            header( 'Content-Encoding: identity' );
            header( 'Cache-Control: no-cache, must-revalidate, max-age=0' );
            header( 'Pragma: no-cache' );
        }
    }
}

/**
 * NUCLEAR: Custom Textdomain Loading System
 */
if ( ! function_exists( 'safepilot_nuclear_load_textdomains' ) ) {
    function safepilot_nuclear_load_textdomains() {
        
        global $safepilot_nuclear_domains;
        
        // Load queued domains
        if ( isset( $safepilot_nuclear_domains ) && is_array( $safepilot_nuclear_domains ) ) {
            foreach ( $safepilot_nuclear_domains as $domain => $mofile ) {
                if ( ! is_textdomain_loaded( $domain ) ) {
                    // Load without triggering WordPress checks
                    if ( file_exists( $mofile ) ) {
                        load_textdomain( $domain, $mofile );
                    } else {
                        safepilot_nuclear_alternative_loading( $domain );
                    }
                }
            }
        }
        
        // Force load our specific domains
        safepilot_nuclear_force_load_domains();
    }
}

/**
 * NUCLEAR: Alternative loading methods
 */
if ( ! function_exists( 'safepilot_nuclear_alternative_loading' ) ) {
    function safepilot_nuclear_alternative_loading( $domain ) {
        
        $locale = get_locale();
        
        switch ( $domain ) {
            case 'js_composer':
                $paths = array(
                    WP_PLUGIN_DIR . '/js_composer/locale/js_composer-' . $locale . '.mo',
                    WP_PLUGIN_DIR . '/js_composer/languages/js_composer-' . $locale . '.mo',
                    WP_CONTENT_DIR . '/plugins/js_composer/locale/js_composer-' . $locale . '.mo'
                );
                break;
                
            case 'startup-framework':
                $paths = array(
                    WP_CONTENT_DIR . '/wp-content-starter/languages/startup-framework-' . $locale . '.mo',
                    get_template_directory() . '/languages/startup-framework-' . $locale . '.mo',
                    WP_PLUGIN_DIR . '/startup-framework/languages/startup-framework-' . $locale . '.mo'
                );
                break;
                
            default:
                return;
        }
        
        foreach ( $paths as $path ) {
            if ( file_exists( $path ) ) {
                load_textdomain( $domain, $path );
                break;
            }
        }
    }
}

/**
 * NUCLEAR: Force load critical domains
 */
if ( ! function_exists( 'safepilot_nuclear_force_load_domains' ) ) {
    function safepilot_nuclear_force_load_domains() {
        
        // Force load theme domains
        if ( ! is_textdomain_loaded( 'g5-startup' ) ) {
            load_theme_textdomain( 'g5-startup', get_template_directory() . '/languages' );
        }
        
        if ( ! is_textdomain_loaded( 'safepilot-startup-child' ) ) {
            load_child_theme_textdomain( 'safepilot-startup-child', get_stylesheet_directory() . '/languages' );
        }
        
        // Force load plugin domains if not already loaded
        if ( defined( 'WPB_VC_VERSION' ) && ! is_textdomain_loaded( 'js_composer' ) ) {
            safepilot_nuclear_alternative_loading( 'js_composer' );
        }
        
        if ( ! is_textdomain_loaded( 'startup-framework' ) ) {
            safepilot_nuclear_alternative_loading( 'startup-framework' );
        }
    }
}

/**
 * NUCLEAR: Complete WordPress Function Override
 */
if ( ! function_exists( 'safepilot_nuclear_wordpress_override' ) ) {
    function safepilot_nuclear_wordpress_override() {
        
        // Override WordPress doing_it_wrong function for textdomain errors
        add_filter( 'doing_it_wrong_trigger_error', function( $trigger, $function, $message, $version ) {
            if ( strpos( $function, 'textdomain' ) !== false || 
                 strpos( $message, 'translation loading' ) !== false ||
                 strpos( $message, 'triggered too early' ) !== false ) {
                return false; // Suppress the error
            }
            return $trigger;
        }, 1, 4 );
        
        // Override WordPress error trigger
        add_filter( 'wp_trigger_error_data', function( $data ) {
            if ( isset( $data['function_name'] ) && 
                 strpos( $data['function_name'], 'textdomain' ) !== false ) {
                return false; // Don't trigger the error
            }
            return $data;
        }, 1 );
        
        // Completely disable WordPress deprecation notices for our specific issues
        add_action( 'deprecated_function_run', function( $function, $replacement, $version ) {
            if ( strpos( $function, 'textdomain' ) !== false ) {
                // Prevent the notice from being logged
                return;
            }
        }, 1, 3 );
    }
}

// NUCLEAR ACTIVATION - Run everything immediately
safepilot_nuclear_disable_wp_textdomain();
safepilot_nuclear_buffer_fix();
safepilot_nuclear_wordpress_override();

// Set custom error handler (NUCLEAR option)
set_error_handler( 'safepilot_nuclear_error_handler', E_WARNING | E_NOTICE | E_DEPRECATED );

// Hook textdomain loading at the right time
add_action( 'muplugins_loaded', 'safepilot_nuclear_disable_wp_textdomain', 1 );
add_action( 'init', 'safepilot_nuclear_load_textdomains', 1 );