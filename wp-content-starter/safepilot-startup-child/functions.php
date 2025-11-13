<?php
/**
 * SafePilot Startup Child Theme - Functions
 * ENHANCED Level 2 Fix
 * 
 * @package SafePilot_Startup_Child
 * @since 1.0.0
 * @author piotroq
 * @modified 2025-01-13 - LEVEL 2 FIX for WordPress 6.7 + PHP 8.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ===================================================================
 * LEVEL 2 ENHANCED FIX: WordPress 6.7+ Compatibility
 * Works with MU-Plugin for complete control
 * ===================================================================
 */

/**
 * Child Theme Setup - Simplified
 * MU-Plugin handles textdomain loading
 */
if ( ! function_exists( 'safepilot_child_simplified_setup' ) ) {
    function safepilot_child_simplified_setup() {
        
        // Only load child theme domain here
        if ( ! is_textdomain_loaded( 'safepilot-startup-child' ) ) {
            load_child_theme_textdomain( 
                'safepilot-startup-child', 
                get_stylesheet_directory() . '/languages' 
            );
        }
        
        // Ensure parent theme domain is loaded (fallback)
        if ( ! is_textdomain_loaded( 'g5-startup' ) ) {
            load_theme_textdomain( 
                'g5-startup', 
                get_template_directory() . '/languages' 
            );
        }
    }
}
add_action( 'init', 'safepilot_child_simplified_setup', 10 );

/**
 * Enhanced Buffer Management for Child Theme
 */
if ( ! function_exists( 'safepilot_child_enhanced_buffer_fix' ) ) {
    function safepilot_child_enhanced_buffer_fix() {
        
        // Additional buffer cleanup for child theme
        if ( ob_get_level() > 1 ) {
            @ob_end_clean();
        }
        
        // Prevent any late buffer issues
        if ( function_exists( 'fastcgi_finish_request' ) ) {
            register_shutdown_function( 'fastcgi_finish_request' );
        }
    }
}
add_action( 'wp_loaded', 'safepilot_child_enhanced_buffer_fix', 1 );

/**
 * ===================================================================
 * Child Theme Styles and Scripts
 * ===================================================================
 */

/**
 * Enqueue child theme styles
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
        
        // Child theme style
        wp_enqueue_style( 
            'safepilot-startup-child', 
            get_stylesheet_directory_uri() . '/style.css',
            array( 'safepilot-startup-parent' ),
            wp_get_theme()->get('Version')
        );
        
        // SafePilot custom styles
        if ( file_exists( get_stylesheet_directory() . '/assets/css/safepilot-custom.css' ) ) {
            wp_enqueue_style(
                'safepilot-custom',
                get_stylesheet_directory_uri() . '/assets/css/safepilot-custom.css',
                array( 'safepilot-startup-child' ),
                '1.0.0'
            );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'safepilot_startup_child_enqueue_styles', 15 );

/**
 * ===================================================================
 * Theme Setup
 * ===================================================================
 */

/**
 * Child theme additional setup
 */
if ( ! function_exists( 'safepilot_startup_child_theme_setup' ) ) {
    function safepilot_startup_child_theme_setup() {
        
        // Add theme support for additional features
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'editor-styles' );
        add_theme_support( 'custom-spacing' );
        
        // SafePilot specific image sizes
        add_image_size( 'safepilot-hero', 1920, 800, true );
        add_image_size( 'safepilot-card', 400, 300, true );
        add_image_size( 'safepilot-thumb', 300, 200, true );
    }
}
add_action( 'after_setup_theme', 'safepilot_startup_child_theme_setup', 11 );