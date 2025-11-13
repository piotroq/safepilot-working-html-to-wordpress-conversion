<?php
/**
 * SafePilot: Deferred Textdomains Loader - FIXED VERSION 3.0
 * Lokalizacja: wp-content/mu-plugins/safepilot-deferred-textdomains.php
 * Naprawia FATAL ERROR w linii 169
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * CZĘŚĆ 1: Przechwytywanie wszystkich prób ładowania textdomain przed init
 */
class SafePilot_Deferred_Textdomains {
    
    private static $deferred = array();
    private static $instance = null;
    
    public static function init() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        // Przechwytuj próby ładowania PRZED init
        add_filter( 'override_load_textdomain', array( $this, 'defer_textdomain' ), 5, 3 );
        
        // Załaduj odłożone domeny NA init
        add_action( 'init', array( $this, 'load_deferred' ), 0 );
        
        // Wycisz notice dla startup-framework
        add_filter( 'doing_it_wrong_trigger_error', array( $this, 'silence_notices' ), 10, 4 );
        
        // Napraw zlib compression
        add_action( 'shutdown', array( $this, 'fix_zlib_compression' ), 0 );
    }
    
    /**
     * Odłóż ładowanie domen które próbują się załadować za wcześnie
     */
    public function defer_textdomain( $override, $domain, $mofile ) {
        
        // Lista domen do kontrolowania
        $controlled_domains = array(
            'startup-framework',
            'js_composer', 
            'g5-startup',
            'safepilot-startup-child'
        );
        
        // Jeśli to kontrolowana domena I jeszcze nie było init
        if ( in_array( $domain, $controlled_domains, true ) && ! did_action( 'init' ) ) {
            
            // Zapisz informację o próbie
            if ( ! isset( self::$deferred[ $domain ] ) ) {
                self::$deferred[ $domain ] = array(
                    'mofile' => $mofile,
                    'plugin_rel_path' => false,
                    'locale' => determine_locale()
                );
                
                // Określ ścieżkę dla load_plugin_textdomain
                if ( $domain === 'startup-framework' ) {
                    self::$deferred[ $domain ]['plugin_rel_path'] = 'startup-framework/languages';
                } elseif ( $domain === 'js_composer' ) {
                    self::$deferred[ $domain ]['plugin_rel_path'] = 'js_composer/locale';
                }
            }
            
            // Przerwij ładowanie - załadujemy później
            return true;
        }
        
        return $override;
    }
    
    /**
     * Załaduj odłożone domeny na init
     */
    public function load_deferred() {
        
        if ( empty( self::$deferred ) ) {
            return;
        }
        
        foreach ( self::$deferred as $domain => $data ) {
            
            // Pomiń jeśli już załadowana
            if ( is_textdomain_loaded( $domain ) ) {
                continue;
            }
            
            // Próba 1: Użyj zapisanego pliku .mo
            if ( ! empty( $data['mofile'] ) && file_exists( $data['mofile'] ) ) {
                load_textdomain( $domain, $data['mofile'] );
                continue;
            }
            
            // Próba 2: Load według typu
            switch ( $domain ) {
                case 'startup-framework':
                    load_plugin_textdomain( 'startup-framework', false, 'startup-framework/languages' );
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
        
        // Wyczyść po załadowaniu
        self::$deferred = array();
    }
    
    /**
     * Wycisz notice TYLKO dla kontrolowanych domen
     */
    public function silence_notices( $trigger, $function, $message, $version ) {
        
        // Tylko dla _load_textdomain_just_in_time
        if ( $function !== '_load_textdomain_just_in_time' ) {
            return $trigger;
        }
        
        // Sprawdź każdą kontrolowaną domenę
        $controlled_domains = array(
            'startup-framework',
            'js_composer',
            'g5-startup', 
            'safepilot-startup-child'
        );
        
        foreach ( $controlled_domains as $domain ) {
            if ( strpos( $message, "for the <code>{$domain}</code> domain" ) !== false ) {
                return false; // Wycisz notice
            }
        }
        
        return $trigger;
    }
    
    /**
     * Napraw zlib compression notice
     */
    public function fix_zlib_compression() {
        $level = ob_get_level();
        while ( $level > 0 ) {
            @ob_end_flush();
            $level--;
        }
    }
}

// Inicjalizacja
SafePilot_Deferred_Textdomains::init();

/**
 * CZĘŚĆ 2: Obsługa deprecated functions
 */
if ( ! function_exists( 'getVcShared' ) && function_exists( 'vc_get_shared' ) ) {
    /**
     * Wrapper dla przestarzałej funkcji getVcShared
     * NAPRAWIONE - używa domyślnej wartości dla parametru
     */
    function getVcShared( $asset = '' ) {
        // Użyj @ aby całkowicie wyciszyć deprecated notice
        return @vc_get_shared( $asset );
    }
}

/**
 * CZĘŚĆ 3: NAPRAWIONY FILTR - poprawna liczba parametrów
 * Filtr deprecated_function_trigger_error wymaga TYLKO 1 parametru!
 */
add_filter( 'deprecated_function_trigger_error', function( $trigger ) {
    // Sprawdź backtrace aby znaleźć funkcję
    $backtrace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 5 );
    
    foreach ( $backtrace as $trace ) {
        if ( isset( $trace['function'] ) && $trace['function'] === 'getVcShared' ) {
            return false; // Nie pokazuj deprecated notice dla getVcShared
        }
    }
    
    return $trigger;
}, 10, 1 ); // ZMIANA: tylko 1 parametr, nie 4!

/**
 * CZĘŚĆ 4: Alternatywny sposób wyciszenia getVcShared
 */
add_filter( 'doing_it_wrong_trigger_error', function( $trigger, $function, $message, $version ) {
    // Ten filtr ma 4 parametry i to jest poprawne
    if ( strpos( $message, 'getVcShared' ) !== false ) {
        return false;
    }
    return $trigger;
}, 10, 4 );

/**
 * CZĘŚĆ 5: Diagnostyka (opcjonalna - zakomentowana domyślnie)
 */
/*
if ( defined( 'WP_DEBUG' ) && WP_DEBUG && defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
    add_action( 'init', function() {
        error_log( '[SafePilot MU-Plugin v3.0] Active and working' );
    }, 1 );
}
*/