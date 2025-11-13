<?php
/**
 * SafePilot Startup Child Theme - Functions
 * NUCLEAR Level 3 Fix - Minimal Implementation
 * 
 * @package SafePilot_Startup_Child
 * @since 1.0.0
 * @author piotroq
 * @modified 2025-11-13 - NUCLEAR LEVEL 3 FIX for WordPress 6.7+
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ===================================================================
 * NUCLEAR LEVEL 3: Minimal Child Theme Implementation
 * MU-Plugin handles all complex logic
 * ===================================================================
 */

/**
 * Minimal Child Theme Setup
 */
if ( ! function_exists( 'safepilot_nuclear_child_setup' ) ) {
    function safepilot_nuclear_child_setup() {
        
        // Only load if MU-Plugin failed
        if ( ! is_textdomain_loaded( 'safepilot-startup-child' ) ) {
            load_child_theme_textdomain( 
                'safepilot-startup-child', 
                get_stylesheet_directory() . '/languages' 
            );
        }
        
        // Theme support
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'editor-styles' );
        
        // SafePilot image sizes
        add_image_size( 'safepilot-hero', 1920, 800, true );
        add_image_size( 'safepilot-card', 400, 300, true );
    }
}
add_action( 'init', 'safepilot_nuclear_child_setup', 25 ); // After MU-Plugin and parent

/**
 * Enqueue Styles
 */
if ( ! function_exists( 'safepilot_nuclear_child_styles' ) ) {
    function safepilot_nuclear_child_styles() {
        
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
    }
}
add_action( 'wp_enqueue_scripts', 'safepilot_nuclear_child_styles', 15 );

/**
 * Child Theme Additional Setup
 */
if ( ! function_exists( 'safepilot_nuclear_child_theme_setup' ) ) {
    function safepilot_nuclear_child_theme_setup() {
        
        // Additional theme features
        add_theme_support( 'custom-spacing' );
        add_theme_support( 'custom-units' );
        
        // Editor styles
        add_editor_style( 'style-editor.css' );
    }
}
add_action( 'after_setup_theme', 'safepilot_nuclear_child_theme_setup', 11 );