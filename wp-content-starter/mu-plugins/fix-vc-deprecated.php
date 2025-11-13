<?php
/**
 * Fix Visual Composer deprecated getVcShared function
 * SafePilot - Final Fix
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add to Nuclear MU-Plugin error suppression
 */
add_action( 'muplugins_loaded', 'safepilot_fix_vc_deprecated', 1 );

function safepilot_fix_vc_deprecated() {
    
    // 1. Replace deprecated getVcShared with vc_get_shared
    if ( ! function_exists( 'getVcShared' ) && function_exists( 'vc_get_shared' ) ) {
        function getVcShared( $asset = '' ) {
            return vc_get_shared( $asset );
        }
    }
    
    // 2. Add to Nuclear error suppression
    add_filter( 'deprecated_function_trigger_error', function( $trigger, $function, $replacement, $version, $message ) {
        if ( strpos( $function, 'getVcShared' ) !== false ) {
            return false; // Suppress this specific deprecated notice
        }
        return $trigger;
    }, 1, 5 );
    
    // 3. Add to wp_doing_it_wrong suppression
    add_filter( 'wp_doing_it_wrong_trigger_error', function( $trigger, $function, $message, $version ) {
        if ( strpos( $function, 'getVcShared' ) !== false ) {
            return false; // Suppress the notice
        }
        return $trigger;
    }, 1, 4 );
}