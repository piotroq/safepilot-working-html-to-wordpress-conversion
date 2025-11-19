/**
 * Ładowanie tłumaczeń dla motywu potomnego SafePilot
 * 
 * Ta funkcja kieruje WordPress do użycia plików tłumaczeniowych
 * z folderu /languages/ w motywie potomnym
 */
function safepilot_child_load_translations() {
    // Ładowanie tłumaczeń dla motywu potomnego
    load_child_theme_textdomain('g5-startup', get_stylesheet_directory() . '/languages');
    
    // Nadpisanie tłumaczeń motywu rodzica
    unload_textdomain('g5-startup');
    load_theme_textdomain('g5-startup', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'safepilot_child_load_translations', 100);

/**
 * Alternatywna metoda - filtrowanie ścieżki do plików tłumaczeniowych
 * Używaj tej funkcji, jeśli powyższa nie działa
 */
function safepilot_child_override_translation_path($mofile, $domain) {
    if ('g5-startup' === $domain) {
        $mofile = get_stylesheet_directory() . '/languages/' . $domain . '-' . get_locale() . '.mo';
    }
    return $mofile;
}
add_filter('load_textdomain_mofile', 'safepilot_child_override_translation_path', 10, 2);

/**
 * Debugowanie - sprawdzenie czy tłumaczenia są ładowane
 * (Usuń po zakończeniu konfiguracji)
 */
function safepilot_debug_translations() {
    if (current_user_can('administrator')) {
        $locale = get_locale();
        $textdomain_loaded = is_textdomain_loaded('g5-startup');
        error_log('SafePilot Debug - Locale: ' . $locale . ', Textdomain loaded: ' . ($textdomain_loaded ? 'YES' : 'NO'));
    }
}
add_action('init', 'safepilot_debug_translations');