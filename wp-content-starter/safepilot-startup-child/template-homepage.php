<?php
/**
 * Template Name: Szablon - Strona Główna (SafePilot)
 *
 * @package safepilot-startup-child
 */

get_header(); // Wczytuje plik header.php
?>

<!-- #main zaczyna się content po header -->

<?php echo do_shortcode('[index1-first-section]'); ?>

<?php echo do_shortcode('[sekcja_uslugi_v2]'); ?>

<?php echo do_shortcode('[sekcja_o_nas]'); ?>

<?php echo do_shortcode('[sekcja_faq]'); ?>

<?php echo do_shortcode('[sekcja_cta_1]'); ?>

<?php echo do_shortcode('[sekcja_uslugi_v3]'); ?>

<?php echo do_shortcode('[sekcja_cta_2]'); ?>

<?php echo do_shortcode('[sekcja_kontakt_template_homepage]'); ?>

<?php
// Sprawdza, czy WordPress ma jakiekolwiek "posty" (strony, wpisy) do wyświetlenia.
if ( have_posts() ) :
    // Pętla, która będzie działać tak długo, jak długo są posty do wyświetlenia.
    // Dla pojedynczej strony wykona się tylko raz.
    while ( have_posts() ) :
        // Przygotowuje dane bieżącej strony/wpisu do użycia.
        the_post();

        // **NAJWAŻNIEJSZA FUNKCJA**
        // Ta funkcja pobiera treść z edytora, przetwarza ją (dodaje paragrafy,
        // renderuje bloki Gutenberga, wykonuje shortcody WPBakery) i wyświetla na ekranie.
        the_content();

    endwhile;
else :
    // Opcjonalnie: co wyświetlić, jeśli treść strony nie zostanie znaleziona.
    echo '<p>Niestety, nie znaleziono treści do wyświetlenia.</p>';
endif;
?>

<!-- #main kończy się content po header -->

<?php
get_footer(); // Wczytuje plik footer.php