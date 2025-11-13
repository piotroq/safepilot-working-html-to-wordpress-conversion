<?php
/**
 * SafePilot MU-Plugin: Nuclear Fix (UPROSZCZONA WERSJA)
 * Lokalizacja: wp-content/mu-plugins/safepilot-nuclear-fix.php
 * Cel: Opóźnione ładowanie textdomain + czyste logi + kompatybilność VC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. Przechwycenie wczesnego ładowania tłumaczeń – kolejkowanie przed init.
 */
add_filter( 'override_load_textdomain', function( $override, $domain, $mofile ) {
    $controlled = array(
        'js_composer',
        'startup-framework',
        'g5-startup',
        'safepilot-startup-child'
    );
    if ( in_array( $domain, $controlled, true ) && ! did_action( 'init' ) ) {
        if ( ! isset( $GLOBALS['safepilot_delayed_textdomains'] ) ) {
            $GLOBALS['safepilot_delayed_textdomains'] = array();
        }
        $GLOBALS['safepilot_delayed_textdomains'][ $domain ] = $mofile;
        return true; // WordPress nie ładuje teraz – my zrobimy to później.
    }
    return $override;
}, 10, 3);

/**
 * 2. Ładowanie opóźnionych textdomain po init.
 */
add_action( 'init', function() {
    if ( isset( $GLOBALS['safepilot_delayed_textdomains'] ) && is_array( $GLOBALS['safepilot_delayed_textdomains'] ) ) {
        foreach ( $GLOBALS['safepilot_delayed_textdomains'] as $domain => $mofile ) {
            if ( file_exists( $mofile ) ) {
                load_textdomain( $domain, $mofile );
            } else {
                safepilot_nuclear_alt_textdomain( $domain );
            }
        }
        unset( $GLOBALS['safepilot_delayed_textdomains'] );
    }

    // Pewne ładowanie motywu i child theme
    if ( ! is_textdomain_loaded( 'g5-startup' ) ) {
        load_theme_textdomain( 'g5-startup', get_template_directory() . '/languages' );
    }
    if ( ! is_textdomain_loaded( 'safepilot-startup-child' ) ) {
        load_child_theme_textdomain( 'safepilot-startup-child', get_stylesheet_directory() . '/languages' );
    }
}, 1);

/**
 * 3. Alternatywne ścieżki textdomain.
 */
function safepilot_nuclear_alt_textdomain( $domain ) {
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
            load_theme_textdomain( 'g5-startup', get_template_directory() . '/languages' );
            break;
        case 'safepilot-startup-child':
            load_child_theme_textdomain( 'safepilot-startup-child', get_stylesheet_directory() . '/languages' );
            break;
    }
}

/**
 * 4. Wrapper VC (jeśli jeszcze gdzieś wywoływane jest getVcShared).
 * Możesz też zostawić tylko w fix-vc-deprecated.php – duplikacja nie szkodzi, warunek chroni.
 */
if ( function_exists( 'vc_get_shared' ) && ! function_exists( 'getVcShared' ) ) {
    function getVcShared( $asset = '' ) {
        return vc_get_shared( $asset );
    }
}

/**
 * 5. Opcjonalna supresja notice "triggered too early" tłumaczeń (tylko WP_DEBUG = true).
 */
if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
    add_filter( 'wp_doing_it_wrong_trigger_error', function( $trigger, $function, $message, $version ) {
        if ( $function === '_load_textdomain_just_in_time' && strpos( $message, 'triggered too early' ) !== false ) {
            return false;
        }
        return $trigger;
    }, 10, 4 );
}