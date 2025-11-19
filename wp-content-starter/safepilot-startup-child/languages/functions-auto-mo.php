/**
 * Automatyczna konwersja PO na MO przy każdym ładowaniu
 * (Używaj tylko w środowisku developerskim!)
 */
function safepilot_auto_generate_mo_file() {
    // Tylko dla administratorów
    if (!current_user_can('manage_options')) {
        return;
    }
    
    $po_file = get_stylesheet_directory() . '/languages/g5-startup-pl_PL.po';
    $mo_file = get_stylesheet_directory() . '/languages/g5-startup-pl_PL.mo';
    
    // Sprawdź czy plik PO istnieje i jest nowszy niż MO
    if (file_exists($po_file)) {
        if (!file_exists($mo_file) || filemtime($po_file) > filemtime($mo_file)) {
            // Użyj msgfmt jeśli dostępne w systemie
            if (function_exists('exec')) {
                $output = array();
                $return_var = 0;
                exec("msgfmt -o $mo_file $po_file 2>&1", $output, $return_var);
                
                if ($return_var === 0) {
                    error_log('SafePilot: Plik MO został automatycznie wygenerowany z PO');
                } else {
                    error_log('SafePilot: Błąd generowania MO - ' . implode("\n", $output));
                }
            }
        }
    }
}
add_action('init', 'safepilot_auto_generate_mo_file');

/**
 * Ładowanie tłumaczeń z motywu potomnego
 */
function safepilot_child_load_textdomain() {
    // Usuń poprzednie tłumaczenia
    unload_textdomain('g5-startup');
    
    // Załaduj tłumaczenia z motywu potomnego
    $loaded = load_theme_textdomain('g5-startup', get_stylesheet_directory() . '/languages');
    
    if (WP_DEBUG) {
        error_log('SafePilot Translations Loaded: ' . ($loaded ? 'YES' : 'NO'));
        error_log('Locale: ' . get_locale());
        error_log('MO file path: ' . get_stylesheet_directory() . '/languages/g5-startup-' . get_locale() . '.mo');
    }
}
add_action('after_setup_theme', 'safepilot_child_load_textdomain', 100);