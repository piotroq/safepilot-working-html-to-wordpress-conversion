<?php
/**
 * SafePilot - Konfiguracja shortcode Blog
 */

return array(
    'base' => 'g5plus_blog',
    'name' => esc_html__('Blog SafePilot', 'safepilot'),
    'icon' => 'fa fa-newspaper',
    'category' => 'SafePilot',
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Układ', 'safepilot'),
            'param_name' => 'layout',
            'value' => array(
                esc_html__('Duży obrazek', 'safepilot') => 'large-image',
                esc_html__('Siatka', 'safepilot') => 'grid',
                esc_html__('Masonry', 'safepilot') => 'masonry',
            ),
            'std' => 'large-image',
            'admin_label' => true,
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Liczba kolumn', 'safepilot'),
            'param_name' => 'columns',
            'value' => array(
                '2 kolumny' => '2',
                '3 kolumny' => '3'
            ),
            'std' => '2',
            'dependency' => array('element' => 'layout', 'value' => array('masonry', 'grid')),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Kategoria', 'safepilot'),
            'param_name' => 'category',
            'value' => safepilot_get_categories_dropdown(),
            'description' => esc_html__('Wybierz kategorię do wyświetlenia', 'safepilot'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Paginacja', 'safepilot'),
            'param_name' => 'post_paging',
            'value' => array(
                esc_html__('Pokaż wszystkie', 'safepilot') => 'all',
                esc_html__('Nawigacja', 'safepilot') => 'navigation',
                esc_html__('Załaduj więcej', 'safepilot') => 'load-more',
                esc_html__('Infinite Scroll', 'safepilot') => 'infinite-scroll',
            ),
            'std' => 'navigation',
        ),
        array(
            'type' => 'number',
            'heading' => esc_html__('Liczba wpisów', 'safepilot'),
            'description' => esc_html__('Liczba wpisów do wyświetlenia (-1 = wszystkie)', 'safepilot'),
            'param_name' => 'max_items',
            'value' => 6,
        ),
        array(
            'type' => 'number',
            'heading' => esc_html__('Wpisów na stronę', 'safepilot'),
            'param_name' => 'posts_per_page',
            'value' => 6,
            'dependency' => array('element' => 'post_paging', 'value' => array('navigation', 'load-more', 'infinite-scroll')),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Sortuj według', 'safepilot'),
            'param_name' => 'orderby',
            'value' => array(
                esc_html__('Data', 'safepilot') => 'date',
                esc_html__('Tytuł', 'safepilot') => 'title',
                esc_html__('Losowo', 'safepilot') => 'rand',
                esc_html__('Liczba komentarzy', 'safepilot') => 'comment_count',
                esc_html__('Ostatnio zmodyfikowane', 'safepilot') => 'modified',
            ),
            'std' => 'date',
            'group' => esc_html__('Ustawienia danych', 'safepilot'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Kolejność', 'safepilot'),
            'param_name' => 'order',
            'value' => array(
                esc_html__('Malejąco', 'safepilot') => 'DESC',
                esc_html__('Rosnąco', 'safepilot') => 'ASC',
            ),
            'std' => 'DESC',
            'group' => esc_html__('Ustawienia danych', 'safepilot'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Dodatkowa klasa CSS', 'safepilot'),
            'param_name' => 'el_class',
        )
    )
);

// Funkcja pomocnicza do pobierania kategorii
function safepilot_get_categories_dropdown() {
    $categories = get_categories();
    $cat_array = array(esc_html__('Wszystkie kategorie', 'safepilot') => '');
    
    foreach ($categories as $cat) {
        $cat_array[$cat->name] = $cat->slug;
    }
    
    return $cat_array;
}