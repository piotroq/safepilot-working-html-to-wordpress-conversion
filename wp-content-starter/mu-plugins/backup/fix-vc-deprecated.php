<?php
/**
 * MU-Plugin: Fix Visual Composer deprecated getVcShared()
 * Lokalizacja: wp-content/mu-plugins/fix-vc-deprecated.php
 * Cel: Zapewnić zgodność z nowszym VC (getVcShared -> vc_get_shared)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Wrapper zgodności:
 * Jeśli kod w shortcodach woła getVcShared('colors'), to przekierujemy do vc_get_shared().
 */
if ( function_exists( 'vc_get_shared' ) && ! function_exists( 'getVcShared' ) ) {
    function getVcShared( $asset = '' ) {
        return vc_get_shared( $asset );
    }
}

/**
 * SUPRESJA komunikatów deprecated tylko dla getVcShared.
 * Uwaga: filtr deprecated_function_trigger_error przekazuje TYLKO 1 argument ($trigger).
 * Dodatkowo używamy akcji deprecated_function_run aby wykryć nazwę funkcji.
 */
$GLOBALS['safepilot_last_deprecated_function'] = null;

add_action( 'deprecated_function_run', function( $function, $replacement, $version ) {
    // Zapamiętaj ostatnią wywołaną deprecated funkcję.
    $GLOBALS['safepilot_last_deprecated_function'] = $function;
}, 10, 3);

add_filter( 'deprecated_function_trigger_error', function( $trigger ) {
    // Jeśli ostatnia deprecated to getVcShared – nie wywołuj trigger_error (czyli nie zapisuj w logu).
    if ( isset( $GLOBALS['safepilot_last_deprecated_function'] ) && $GLOBALS['safepilot_last_deprecated_function'] === 'getVcShared' ) {
        return false;
    }
    return $trigger;
}, 10, 1);