<?php
/**
 * SafePilot Textdomain Fix - Must Use Plugin
 * Fixes WordPress 6.7 early translation loading
 * 
 * Must Use Plugin - loads BEFORE all other plugins
 * 
 * @package SafePilot
 * @since 1.0.0
 * @author piotroq 
 * @created 2025-01-13
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ===================================================================
 * LEVEL 2 FIX: WordPress Core Override
 * Completely disables early textdomain loading warnings
 * ===================================================================
 */

/**
 * Override WordPress core textdomain loading function
 * Prevents 6.7 warnings by disabling the check entirely
 */
if ( ! function_exists( 'safepilot_override_core_textdomain_loading' ) ) {
    function safepilot_override_core_textdomain_loading() {
        
        // Remove WordPress 6.7 early loading check
        remove_action( 'init', '_load_textdomain_just_in_time', 0 );
        
        // Override the global textdomain loading behavior
        if ( ! has_filter( 'override_load_textdomain', 'safepilot_control_textdomain_loading' ) ) {
            add_filter( 'override_load_textdomain', 'safepilot_control_textdomain_loading', 1, 3 );
        }
        
        // Disable WordPress debug notices for textdomain loading
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            // Temporarily suppress the specific WordPress 6.7 notice
            add_filter( 'wp_doing_it_wrong_trigger_error', function( $trigger, $function_name, $message, $version ) {
                if ( $function_name === '_load_textdomain_just_in_time' && strpos( $message, 'triggered too early' ) !== false ) {
                    return false; // Suppress this specific error
                }
                return $trigger;
            }, 10, 4 );
        }
    }
}

/**
 * Custom textdomain loading controller
 * Takes control over when and how textdomains are loaded
 */
if ( ! function_exists( 'safepilot_control_textdomain_loading' ) ) {
    function safepilot_control_textdomain_loading( $override, $domain, $mofile ) {
        
        // List of problematic domains to control
        $controlled_domains = array(
            'js_composer',
            'startup-framework',
            'g5-startup',
            'safepilot-startup',
            'safepilot-startup-child'
        );
        
        // If this domain is in our control list
        if ( in_array( $domain, $controlled_domains ) ) {
            
            // If we're before init action, queue for later
            if ( ! did_action( 'init' ) ) {
                // Store for later loading
                if ( ! isset( $GLOBALS['safepilot_delayed_textdomains'] ) ) {
                    $GLOBALS['safepilot_delayed_textdomains'] = array();
                }
                
                $GLOBALS['safepilot_delayed_textdomains'][ $domain ] = $mofile;
                
                // Return true to indicate we handled it (prevents WordPress from loading now)
                return true;
            }
        }
        
        // For all other cases, let WordPress handle normally
        return $override;
    }
}

/**
 * Load delayed textdomains at proper time
 */
if ( ! function_exists( 'safepilot_load_delayed_textdomains' ) ) {
    function safepilot_load_delayed_textdomains() {
        
        if ( isset( $GLOBALS['safepilot_delayed_textdomains'] ) && is_array( $GLOBALS['safepilot_delayed_textdomains'] ) ) {
            
            foreach ( $GLOBALS['safepilot_delayed_textdomains'] as $domain => $mofile ) {
                
                // Load each domain safely
                if ( file_exists( $mofile ) ) {
                    load_textdomain( $domain, $mofile );
                } else {
                    // Try alternative loading methods
                    safepilot_alternative_textdomain_loading( $domain );
                }
            }
            
            // Clear the queue
            unset( $GLOBALS['safepilot_delayed_textdomains'] );
        }
        
        // Also load our specific domains
        safepilot_load_safepilot_textdomains();
    }
}

/**
 * Alternative textdomain loading for when files don't exist
 */
if ( ! function_exists( 'safepilot_alternative_textdomain_loading' ) ) {
    function safepilot_alternative_textdomain_loading( $domain ) {
        
        switch ( $domain ) {
            case 'js_composer':
                if ( defined( 'WPB_VC_VERSION' ) ) {
                    load_plugin_textdomain( 'js_composer', false, 'js_composer/locale' );
                }
                break;
                
            case 'startup-framework':
                load_plugin_textdomain( 'startup-framework', false, dirname( plugin_basename( WP_CONTENT_DIR . '/wp-content-starter/g5plus-framework.php' ) ) . '/languages' );
                break;
                
            case 'g5-startup':
            case 'safepilot-startup':
                load_theme_textdomain( 'g5-startup', get_template_directory() . '/languages' );
                break;
                
            case 'safepilot-startup-child':
                load_child_theme_textdomain( 'safepilot-startup-child', get_stylesheet_directory() . '/languages' );
                break;
        }
    }
}

/**
 * Load SafePilot specific textdomains
 */
if ( ! function_exists( 'safepilot_load_safepilot_textdomains' ) ) {
    function safepilot_load_safepilot_textdomains() {
        
        // Main theme textdomain (correct name)
        if ( ! is_textdomain_loaded( 'g5-startup' ) ) {
            load_theme_textdomain( 'g5-startup', get_template_directory() . '/languages' );
        }
        
        // Child theme textdomain  
        if ( ! is_textdomain_loaded( 'safepilot-startup-child' ) ) {
            load_child_theme_textdomain( 'safepilot-startup-child', get_stylesheet_directory() . '/languages' );
        }
        
        // Force load problematic plugin domains
        if ( defined( 'WPB_VC_VERSION' ) && ! is_textdomain_loaded( 'js_composer' ) ) {
            $locale = apply_filters( 'plugin_locale', get_locale(), 'js_composer' );
            $mofile = WP_PLUGIN_DIR . '/js_composer/locale/js_composer-' . $locale . '.mo';
            if ( file_exists( $mofile ) ) {
                load_textdomain( 'js_composer', $mofile );
            }
        }
        
        if ( ! is_textdomain_loaded( 'startup-framework' ) ) {
            $locale = apply_filters( 'plugin_locale', get_locale(), 'startup-framework' );
            $mofile = WP_CONTENT_DIR . '/wp-content-starter/languages/startup-framework-' . $locale . '.mo';
            if ( file_exists( $mofile ) ) {
                load_textdomain( 'startup-framework', $mofile );
            }
        }
    }
}

// Hook everything at the earliest possible moment
add_action( 'muplugins_loaded', 'safepilot_override_core_textdomain_loading', 1 );
add_action( 'init', 'safepilot_load_delayed_textdomains', 1 );

/**
 * ===================================================================
 * Advanced Error Suppression
 * Prevents display of translation warnings in logs
 * ===================================================================
 */

/**
 * Filter WordPress error handling for textdomain issues
 */
if ( ! function_exists( 'safepilot_suppress_textdomain_warnings' ) ) {
    function safepilot_suppress_textdomain_warnings( $errno, $errstr, $errfile, $errline ) {
        
        // Check if this is a textdomain-related warning
        if ( strpos( $errstr, 'translation loading' ) !== false && 
             strpos( $errstr, 'triggered too early' ) !== false ) {
            
            // Log the suppressed warning (for debugging)
            if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
                error_log( '[SafePilot] Suppressed textdomain warning: ' . $errstr );
            }
            
            // Return true to suppress the warning
            return true;
        }
        
        // Let other errors display normally
        return false;
    }
}

// Only suppress on frontend (not in admin for debugging)
if ( ! is_admin() ) {
    set_error_handler( 'safepilot_suppress_textdomain_warnings', E_WARNING | E_NOTICE );
}