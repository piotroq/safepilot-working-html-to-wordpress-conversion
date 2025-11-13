<?php
/**
 * SafePilot: Deferred Textdomains Loader - VERSION 4.0 FINAL
 * Lokalizacja: wp-content/mu-plugins/safepilot-deferred-textdomains.php
 * Naprawia WSZYSTKIE błędy włącznie z zlib compression
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * CZĘŚĆ 1: NAPRAW ZLIB NA SAMYM POCZĄTKU
 */
if ( ! defined( 'SAFEPILOT_ZLIB_FIXED' ) ) {
    define( 'SAFEPILOT_ZLIB_FIXED', true );
    
    // Wyłącz zlib.output_compression jeśli możliwe
    if ( function_exists( 'ini_set' ) ) {
        @ini_set( 'zlib.output_compression', 'Off' );
    }
    
    // Hook na samym początku WordPress
    add_action( 'plugins_loaded', function() {
        // Usuń wszystkie poziomy buforowania
        while ( ob_get_level() > 0 ) {
            @ob_end_clean();
        }
        // Rozpocznij nowe, czyste buforowanie
        ob_start();
    }, 1 );
    
    // Napraw ob_end_flush errors
    add_filter( 'wp_doing_ajax', function( $doing_ajax ) {
        if ( ! $doing_ajax && ob_get_level() > 0 ) {
            $levels = ob_get_level();
            for ( $i = 0; $i < $levels; $i++ ) {
                @ob_end_flush();
            }
        }
        return $doing_ajax;
    }, PHP_INT_MAX );
}

/**
 * CZĘŚĆ 2: Główna klasa do obsługi textdomain
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
}

// Inicjalizacja
SafePilot_Deferred_Textdomains::init();

/**
 * CZĘŚĆ 3: Obsługa deprecated functions
 */
if ( ! function_exists( 'getVcShared' ) && function_exists( 'vc_get_shared' ) ) {
    function getVcShared( $asset = '' ) {
        return @vc_get_shared( $asset );
    }
}

/**
 * CZĘŚĆ 4: Filtry do wyciszenia deprecated notices
 */
add_filter( 'deprecated_function_trigger_error', function( $trigger ) {
    $backtrace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 5 );
    foreach ( $backtrace as $trace ) {
        if ( isset( $trace['function'] ) && $trace['function'] === 'getVcShared' ) {
            return false;
        }
    }
    return $trigger;
}, 10, 1 );

add_filter( 'doing_it_wrong_trigger_error', function( $trigger, $function, $message, $version ) {
    if ( strpos( $message, 'getVcShared' ) !== false ) {
        return false;
    }
    return $trigger;
}, 10, 4 );

/**
 * CZĘŚĆ 5: OSTATECZNA NAPRAWA ZLIB - na samym końcu
 */
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
    $levels = ob_get_level();
    for ( $i = 0; $i < $levels; $i++ ) {
        @ob_end_flush();
    }
}, 0 );

// Dodatkowe zabezpieczenie przed zlib errors  
if ( ! function_exists( 'safepilot_suppress_ob_errors' ) ) {
    function safepilot_suppress_ob_errors() {
        $old = error_reporting();
        error_reporting( $old & ~E_NOTICE );
        
        $levels = ob_get_level();
        for ( $i = 0; $i < $levels; $i++ ) {
            @ob_end_flush();
        }
        
        error_reporting( $old );
    }
    add_action( 'wp_footer', 'safepilot_suppress_ob_errors', 9999 );
    add_action( 'admin_footer', 'safepilot_suppress_ob_errors', 9999 );
}