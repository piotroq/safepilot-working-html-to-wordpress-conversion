<?php
/**
 * SafePilot Startup Child Theme - Functions
 * 
 * @package SafePilot_Startup_Child
 * @since 1.0.0
 * @author piotroq
 * @modified 2025-01-13 - COMPLETE FIX for WordPress 6.7 + PHP 8.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ===================================================================
 * COMPLETE FIX: WordPress 6.7+ Compatibility
 * Fixes all textdomain and output buffer issues
 * ===================================================================
 */

/**
 * Child Theme Text Domain Loading (WordPress 6.7+ Compatible)
 * Loads at correct time with proper domain names
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'safepilot_child_load_textdomains' ) ) {
    function safepilot_child_load_textdomains() {
        
        // 1. Load Child Theme textdomain with CORRECT name
        if ( ! is_textdomain_loaded( 'safepilot-startup-child' ) ) {
            load_child_theme_textdomain( 
                'safepilot-startup-child', 
                get_stylesheet_directory() . '/languages' 
            );
        }
        
        // 2. Ensure Parent Theme textdomain is loaded with CORRECT name
        if ( ! is_textdomain_loaded( 'g5-startup' ) ) {
            load_theme_textdomain( 
                'g5-startup', 
                get_template_directory() . '/languages' 
            );
        }
        
        // 3. Force reload problematic plugin textdomains
        if ( defined( 'WPB_VC_VERSION' ) && ! is_textdomain_loaded( 'js_composer' ) ) {
            $vc_locale = apply_filters( 'plugin_locale', get_locale(), 'js_composer' );
            $vc_paths = array(
                WP_PLUGIN_DIR . '/js_composer/locale/js_composer-' . $vc_locale . '.mo',
                WP_PLUGIN_DIR . '/js_composer/languages/js_composer-' . $vc_locale . '.mo',
                WP_CONTENT_DIR . '/plugins/js_composer/locale/js_composer-' . $vc_locale . '.mo'
            );
            
            foreach ( $vc_paths as $mofile ) {
                if ( file_exists( $mofile ) ) {
                    load_textdomain( 'js_composer', $mofile );
                    break;
                }
            }
        }
        
        // 4. Force reload Startup Framework textdomain
        if ( ! is_textdomain_loaded( 'startup-framework' ) ) {
            $sf_locale = apply_filters( 'plugin_locale', get_locale(), 'startup-framework' );
            $sf_paths = array(
                WP_PLUGIN_DIR . '/startup-framework/languages/startup-framework-' . $sf_locale . '.mo',
                get_template_directory() . '/languages/startup-framework-' . $sf_locale . '.mo'
            );
            
            foreach ( $sf_paths as $mofile ) {
                if ( file_exists( $mofile ) ) {
                    load_textdomain( 'startup-framework', $mofile );
                    break;
                }
            }
        }
    }
}
add_action( 'init', 'safepilot_child_load_textdomains', 5 );

/**
 * Enhanced Early Loading Prevention
 * Stronger prevention of early textdomain loading
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'safepilot_child_prevent_early_loading' ) ) {
    function safepilot_child_prevent_early_loading() {
        
        // Remove ALL possible early loading hooks with various priorities
        $priorities = array( 1, 5, 8, 10, 15, 20 );
        
        foreach ( $priorities as $priority ) {
            remove_action( 'plugins_loaded', 'load_plugin_textdomain', $priority );
            remove_action( 'after_setup_theme', 'load_theme_textdomain', $priority );
        }
        
        // Enhanced Visual Composer prevention
        if ( class_exists( 'Vc_Manager' ) || defined( 'WPB_VC_VERSION' ) ) {
            $vc_actions = array(
                'plugins_loaded',
                'vc_after_init', 
                'vc_before_init',
                'init'
            );
            
            foreach ( $vc_actions as $action ) {
                foreach ( $priorities as $priority ) {
                    remove_action( $action, array( 'Vc_Manager', 'loadTextDomain' ), $priority );
                }
            }
        }
        
        // Enhanced Startup Framework prevention
        global $gf_loader;
        if ( isset( $gf_loader ) && is_object( $gf_loader ) ) {
            foreach ( $priorities as $priority ) {
                remove_action( 'plugins_loaded', array( $gf_loader, 'load_text_domain' ), $priority );
                remove_action( 'init', array( $gf_loader, 'load_text_domain' ), $priority );
            }
        }
    }
}
add_action( 'plugins_loaded', 'safepilot_child_prevent_early_loading', 1 );

/**
 * Additional Output Buffer Fix for Child Theme
 * Enhanced buffer management
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'safepilot_child_fix_output_buffer' ) ) {
    function safepilot_child_fix_output_buffer() {
        
        // Multiple approaches to prevent buffer issues
        if ( function_exists( 'ini_set' ) ) {
            @ini_set( 'zlib.output_compression', 'Off' );
            @ini_set( 'output_buffering', 'Off' );
            @ini_set( 'implicit_flush', 'On' );
        }
        
        // Remove WordPress compression
        remove_action( 'init', 'wp_ob_end_flush_all', 1 );
        remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
        
        // Custom flush handling
        if ( ob_get_level() > 0 && ob_get_length() > 0 ) {
            @ob_end_clean();
        }
    }
}
add_action( 'plugins_loaded', 'safepilot_child_fix_output_buffer', 2 );

/**
 * ===================================================================
 * Child Theme Styles and Scripts
 * ===================================================================
 */

/**
 * Enqueue child theme styles and scripts
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'safepilot_startup_child_enqueue_styles' ) ) {
    function safepilot_startup_child_enqueue_styles() {
        
        // Parent theme style
        wp_enqueue_style( 
            'safepilot-startup-parent', 
            get_template_directory_uri() . '/style.css',
            array(),
            wp_get_theme()->get('Version')
        );
        
        // Child theme style (loads after parent)
        wp_enqueue_style( 
            'safepilot-startup-child', 
            get_stylesheet_directory_uri() . '/style.css',
            array( 'safepilot-startup-parent' ),
            wp_get_theme()->get('Version')
        );
        
        // SafePilot custom styles
        wp_enqueue_style(
            'safepilot-custom',
            get_stylesheet_directory_uri() . '/assets/css/safepilot-custom.css',
            array( 'safepilot-startup-child' ),
            '1.0.0'
        );
        
        // SafePilot custom scripts
        wp_enqueue_script(
            'safepilot-custom-js',
            get_stylesheet_directory_uri() . '/assets/js/safepilot-custom.js',
            array( 'jquery' ),
            '1.0.0',
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'safepilot_startup_child_enqueue_styles', 15 );

/**
 * ===================================================================
 * Child Theme Setup
 * ===================================================================
 */

/**
 * Child theme setup function
 * Runs after parent theme setup
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'safepilot_startup_child_setup' ) ) {
    function safepilot_startup_child_setup() {
        
        // Add theme support for additional features
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'editor-styles' );
        add_theme_support( 'custom-spacing' );
        add_theme_support( 'custom-units' );
        
        // Add editor stylesheet
        add_editor_style( array(
            'style-editor.css',
            'assets/css/editor-styles.css'
        ));
        
        // SafePilot specific image sizes
        add_image_size( 'safepilot-hero', 1920, 800, true );
        add_image_size( 'safepilot-card', 400, 300, true );
        add_image_size( 'safepilot-thumb', 300, 200, true );
    }
}
add_action( 'after_setup_theme', 'safepilot_startup_child_setup', 11 );

/**
 * ===================================================================
 * Debug and Monitoring Functions (DEVELOPMENT ONLY)
 * ===================================================================
 */

/**
 * Debug textdomain loading (ONLY FOR DEVELOPMENT)
 * Uncomment to monitor textdomain loading
 * 
 * @since 1.0.0
 */
if ( defined( 'WP_DEBUG' ) && WP_DEBUG && false ) { // Change false to true for debugging
    
    function safepilot_debug_textdomain_loading( $domain ) {
        $action = current_action() ?: 'unknown';
        $backtrace = wp_debug_backtrace_summary( null, 3 );
        
        error_log( sprintf(
            '[SafePilot Debug] Textdomain "%s" loaded at action "%s" - Called from: %s',
            $domain,
            $action,
            $backtrace
        ) );
    }
    add_action( 'load_textdomain', 'safepilot_debug_textdomain_loading', 10, 1 );
    
    function safepilot_debug_early_loading_attempts() {
        if ( did_action( 'init' ) === 0 ) {
            $backtrace = wp_debug_backtrace_summary( null, 5 );
            error_log( '[SafePilot Debug] Early loading attempt detected before init: ' . $backtrace );
        }
    }
    add_action( 'load_textdomain', 'safepilot_debug_early_loading_attempts', 1 );
}