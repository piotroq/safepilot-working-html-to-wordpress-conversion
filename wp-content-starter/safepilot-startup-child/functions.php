<?php
/**
 * SafePilot Startup Child Theme - Functions
 * 
 * @package SafePilot_Startup_Child
 * @since 1.0.0
 * @author piotroq
 * @modified 2025-01-13 - PHP 8.2 + WordPress 6.7 compatibility
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ===================================================================
 * FIX #1: Proper Textdomain Loading (WordPress 6.7+ Compatible)
 * Prevents "translation loading triggered too early" notices
 * ===================================================================
 */

/**
 * Load textdomains at the correct time (init action)
 * This fixes the WordPress 6.7 notices about early translation loading
 * 
 * @since 1.0.0
 */
function safepilot_load_textdomains() {
    
    // 1. Load Child Theme textdomain
    load_child_theme_textdomain( 
        'safepilot-startup-child', 
        get_stylesheet_directory() . '/languages' 
    );
    
    // 2. Load Parent Theme textdomain (if not already loaded)
    if ( ! is_textdomain_loaded( 'safepilot-startup' ) ) {
        load_theme_textdomain( 
            'safepilot-startup', 
            get_template_directory() . '/languages' 
        );
    }
    
    // 3. Fix Visual Composer (js_composer) early loading
    if ( defined( 'WPB_VC_VERSION' ) && ! is_textdomain_loaded( 'js_composer' ) ) {
        
        $vc_path = WP_PLUGIN_DIR . '/js_composer/locale';
        
        // Try multiple possible paths
        if ( file_exists( $vc_path ) ) {
            load_plugin_textdomain( 'js_composer', false, 'js_composer/locale' );
        } else {
            // Fallback for different VC versions
            $vc_locale = apply_filters( 'plugin_locale', get_locale(), 'js_composer' );
            $vc_mofile = WP_PLUGIN_DIR . '/js_composer/locale/js_composer-' . $vc_locale . '.mo';
            
            if ( file_exists( $vc_mofile ) ) {
                load_textdomain( 'js_composer', $vc_mofile );
            }
        }
    }
    
    // 4. Fix Startup Framework early loading
    if ( ! is_textdomain_loaded( 'startup-framework' ) ) {
        
        $sf_path = WP_PLUGIN_DIR . '/startup-framework/languages';
        
        if ( file_exists( $sf_path ) ) {
            load_plugin_textdomain( 'startup-framework', false, 'startup-framework/languages' );
        } else {
            // Fallback
            $sf_locale = apply_filters( 'plugin_locale', get_locale(), 'startup-framework' );
            $sf_mofile = WP_PLUGIN_DIR . '/startup-framework/languages/startup-framework-' . $sf_locale . '.mo';
            
            if ( file_exists( $sf_mofile ) ) {
                load_textdomain( 'startup-framework', $sf_mofile );
            }
        }
    }
}
// Hook at init with priority 1 (very early, but after WordPress core init)
add_action( 'init', 'safepilot_load_textdomains', 1 );


/**
 * ===================================================================
 * FIX #2: Prevent Plugins from Loading Translations Too Early
 * Forces plugins to wait for 'init' action
 * ===================================================================
 */

/**
 * Override early textdomain loading attempts by plugins
 * This runs before plugins try to load translations
 * 
 * @since 1.0.0
 */
function safepilot_prevent_early_translations() {
    
    // Remove any early translation loading hooks from plugins
    remove_action( 'plugins_loaded', 'load_plugin_textdomain', 1 );
    remove_action( 'plugins_loaded', 'load_plugin_textdomain', 5 );
    remove_action( 'plugins_loaded', 'load_plugin_textdomain', 10 );
    
    // For Visual Composer specifically
    if ( class_exists( 'Vc_Manager' ) ) {
        remove_action( 'plugins_loaded', array( 'Vc_Manager', 'loadTextDomain' ), 1 );
    }
}
add_action( 'plugins_loaded', 'safepilot_prevent_early_translations', 0 );


/**
 * ===================================================================
 * Enqueue Styles (Standard Child Theme Function)
 * ===================================================================
 */

/**
 * Enqueue parent and child theme styles
 * 
 * @since 1.0.0
 */
function safepilot_startup_child_enqueue_styles() {
    
    // Get theme versions for cache busting
    $parent_version = wp_get_theme( get_template() )->get( 'Version' );
    $child_version = wp_get_theme()->get( 'Version' );
    
    // Parent theme stylesheet
    wp_enqueue_style( 
        'safepilot-startup-parent-style', 
        get_template_directory_uri() . '/style.css',
        array(),
        $parent_version
    );
    
    // Child theme stylesheet (depends on parent)
    wp_enqueue_style( 
        'safepilot-startup-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'safepilot-startup-parent-style' ),
        $child_version
    );
}
add_action( 'wp_enqueue_scripts', 'safepilot_startup_child_enqueue_styles', 10 );


/**
 * ===================================================================
 * Theme Setup (After Parent Theme)
 * ===================================================================
 */

/**
 * Child theme setup
 * Runs after parent theme setup (priority 11)
 * 
 * @since 1.0.0
 */
function safepilot_startup_child_setup() {
    
    // Add child theme specific features
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    
    // Add editor stylesheet
    add_editor_style( 'style-editor.css' );
    
}
add_action( 'after_setup_theme', 'safepilot_startup_child_setup', 11 );


/**
 * ===================================================================
 * Debug Helper (Only for Development - Remove in Production)
 * ===================================================================
 */

/**
 * Log textdomain loading for debugging
 * Uncomment this function to see which textdomains are loaded and when
 * 
 * @since 1.0.0
 */
/*
function safepilot_debug_textdomain_loading( $domain ) {
    error_log( sprintf(
        '[SafePilot Debug] Textdomain "%s" loaded at action: %s',
        $domain,
        current_action() ?: 'unknown'
    ) );
}
add_action( 'load_textdomain', 'safepilot_debug_textdomain_loading', 10, 1 );
*/