<?php
/**
 * SafePilot: Deferred Textdomains Loader
 * Lokalizacja: wp-content/mu-plugins/safepilot-deferred-textdomains.php
 * Cel: Eliminacja notice "translation loading too early" dla startup-framework
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Kolejka domen, które próbują załadować się zbyt wcześnie.
 */
$GLOBALS['safepilot_deferred_domains'] = array();

/**
 * Przechwycenie prób ładowania textdomain przed init.
 */
add_filter( 'override_load_textdomain', function( $override, $domain, $mofile ) {

    // Domeny które kontrolujemy
    $targets = array(
        'startup-framework',
        'js_composer',
        'g5-startup',
        'safepilot-startup-child'
    );

    if ( in_array( $domain, $targets, true ) ) {
        if ( ! did_action( 'init' ) ) {
            // Zapisz próbę
            $GLOBALS['safepilot_deferred_domains'][ $domain ] = $mofile;
            // Przerwij teraz – załadujemy później
            return true;
        }
    }
    return $override;
}, 10, 3 );

/**
 * Ładowanie opóźnionych domen na init.
 */
add_action( 'init', function() {

    if ( ! empty( $GLOBALS['safepilot_deferred_domains'] ) ) {
        foreach ( $GLOBALS['safepilot_deferred_domains'] as $domain => $mofile ) {

            if ( is_textdomain_loaded( $domain ) ) {
                continue;
            }

            if ( $mofile && file_exists( $mofile ) ) {
                load_textdomain( $domain, $mofile );
                continue;
            }

            // Alternatywne ścieżki
            switch ( $domain ) {
                case 'startup-framework':
                    // Szukamy standardowej ścieżki językowej pluginu
                    $plugin_rel_path = 'startup-framework/languages';
                    load_plugin_textdomain( 'startup-framework', false, $plugin_rel_path );
                    break;

                case 'js_composer':
                    load_plugin_textdomain( 'js_composer', false, 'js_composer/locale' );
                    break;

                case 'g5-startup':
                    load_theme_textdomain( 'g5-startup', get_template_directory() . '/languages' );
                    break;

                case 'safepilot-startup-child':
                    load_child_theme_textdomain( 'safepilot-startup-child', get_stylesheet_directory() . '/languages' );
                    break;
            }
        }
    }

}, 1 );

/**
 * Selektorowy filtr – wyłącz ONLY notice dla wcześniejszego ładowania domen startup-framework.
 */
add_filter( 'wp_doing_it_wrong_trigger_error', function( $trigger, $function, $message, $version ) {

    if ( $function === '_load_textdomain_just_in_time'
         && strpos( $message, 'startup-framework domain was triggered too early' ) !== false ) {
        return false; // Tylko ten notice wyciszamy
    }

    return $trigger;
}, 10, 4 );

/**
 * Dodatkowo – minimalne zabezpieczenie aby getVcShared nie generował deprecated spamu (jeśli jeszcze występuje).
 */
if ( function_exists( 'vc_get_shared' ) && ! function_exists( 'getVcShared' ) ) {
    function getVcShared( $asset = '' ) {
        return vc_get_shared( $asset );
    }
}

/**
 * Log kontrolny (opcjonalny – włącz jeśli chcesz sprawdzić czy domeny trafiają do kolejki)
 */
// add_action( 'init', function() {
//     if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
//         error_log( '[SafePilot] Deferred domains: ' . print_r( $GLOBALS['safepilot_deferred_domains'], true ) );
//     }
// }, 2 );