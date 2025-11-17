<?php
/**
 * Template Name: Szablon - Kontakt (SafePilot)
 *
 * @package safepilot-startup-child
 */

get_header(); // Wczytuje plik header.php
?>

<style>
/* ==========================================================================
   SafePilot - Unikalne Style dla Podstrony "Kontakt"
   Prefiks: sp-contact-
   ========================================================================== */

/* ---------------------------------- */
/* 1. Kontakt - Banner Hero           */
/* ---------------------------------- */
.sp-contact-hero-banner {
    background-color: var(--secondary-navy, #213543);
    color: var(--white-color, #ffffff);
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}

.sp-contact-hero-banner::before {
    content: '\f0e0'; /* Ikona koperty (envelope) */
    font-family: var(--icon-font, "Font Awesome 6 Pro");
    font-weight: 400;
    position: absolute;
    font-size: 400px;
    color: rgba(79, 185, 173, 0.05);
    top: 50%;
    left: -80px;
    transform: translateY(-50%) rotate(-15deg);
    line-height: 1;
}

.sp-contact-hero-subtitle {
    font-weight: 700;
    color: var(--primary-teal, #4fb9ad);
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.sp-contact-hero-banner .display-4 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
    color: var(--white-color, #ffffff);
}

.sp-contact-hero-banner .lead {
    font-size: 1.1rem;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    color: rgba(255, 255, 255, 0.85);
}

/* ---------------------------------- */
/* 2. Kontakt - Sekcja Główna         */
/* ---------------------------------- */
.sp-contact-main-section {
    padding: 100px 0;
    background-color: var(--smoke-color, #f5f9f8);
}

.sp-contact-info-card {
    background: var(--white-color, #ffffff);
    border: 1px solid var(--border-color, #e8e8e8);
    border-radius: 12px;
    padding: 30px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    box-shadow: 0 5px 25px rgba(33, 53, 67, 0.05);
    margin-bottom: 25px;
}

.sp-contact-info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 35px rgba(33, 53, 67, 0.1);
    border-left: 5px solid var(--primary-teal, #4fb9ad);
}

.sp-contact-info-icon {
    font-size: 24px;
    color: var(--primary-teal, #4fb9ad);
    width: 50px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    border-radius: 50%;
    background-color: #e8f7f5;
    margin-right: 20px;
    flex-shrink: 0;
}

.sp-contact-info-title {
    font-weight: 700;
    color: var(--secondary-navy, #213543);
    margin-bottom: 5px;
}

.sp-contact-info-link {
    color: var(--text-color2, #4a5568);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.sp-contact-info-link:hover {
    color: var(--primary-teal, #4fb9ad);
}

/* Formularz kontaktowy */
.sp-contact-form-wrapper {
    background: var(--white-color, #ffffff);
    padding: 40px;
    border-radius: 12px;
    border: 1px solid var(--border-color, #e8e8e8);
    box-shadow: 0 5px 25px rgba(33, 53, 67, 0.05);
}

.sp-contact-form-title {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    color: var(--secondary-navy, #213543);
    font-weight: 700;
    margin-bottom: 25px;
}

.sp-contact-form .form-label {
    font-weight: 600;
    color: var(--secondary-navy, #213543);
}

.sp-contact-form .wpcf7-textarea, .wpcf7-tel {
    background-color: #f5f9f8;
    border: 1px solid #e8e8e8;
    padding: 12px 15px;
    border-radius: 8px;
}

.sp-contact-form .wpcf7-textarea:focus, .wpcf7-tel:focus {
    background-color: #ffffff;
    border-color: var(--primary-teal, #4fb9ad);
    box-shadow: 0 0 0 3px rgba(79, 185, 173, 0.2);
}

.sp-contact-form .wpcf7-tel {
    background-color: #f5f9f8;
    border: 1px solid #e8e8e8;
    padding: 12px 15px;
    border-radius: 8px;
}

.sp-contact-form .wpcf7-tel:focus {
    background-color: #ffffff;
    border-color: var(--primary-teal, #4fb9ad);
    box-shadow: 0 0 0 3px rgba(79, 185, 173, 0.2);
}

.sp-contact-form .wpcf7-text {
    background-color: #f5f9f8;
    border: 1px solid #e8e8e8;
    padding: 12px 15px;
    border-radius: 8px;
}

.sp-contact-form .wpcf7-text:focus {
    background-color: #ffffff;
    border-color: var(--primary-teal, #4fb9ad);
    box-shadow: 0 0 0 3px rgba(79, 185, 173, 0.2);
}

.sp-contact-form .wpcf7-submit {
    width: 100%;
    padding: 12px;
    font-weight: 700;
    font-size: 1rem;
}

/* ---------------------------------- */
/* 3. Kontakt - Sekcja Mapy           */
/* ---------------------------------- */
.sp-contact-map-section {
    position: relative;
    height: 500px;
}

.sp-contact-map-iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
    filter: grayscale(100%) contrast(1.2) opacity(0.8); /* Stylowanie mapy */
}

/* ---------------------------------- */
/* 4. Kontakt - Sekcja FAQ            */
/* ---------------------------------- */
.sp-contact-faq-section {
    padding: 100px 0;
    background-color: var(--white-color, #ffffff);
}
.sp-contact-faq-section .accordion-item {
    border-color: var(--border-color, #e8e8e8);
    border-radius: 12px !important;
    margin-bottom: 15px;
}
.sp-contact-faq-section .accordion-button {
    font-weight: 600;
    color: var(--secondary-navy, #213543);
}
.sp-contact-faq-section .accordion-button:not(.collapsed) {
    background-color: #e8f7f5;
    color: var(--secondary-navy, #213543);
}
</style>

<main id="main" class="site-main" role="main">
<!-- 
==========================================================================
    SafePilot - Podstrona "Kontakt" (Wersja z unikalnymi klasami CSS)
    Design premium by GitHub Copilot
========================================================================== 
-->

<!-- Sekcja Hero dla Kontaktu -->
<section class="sp-contact-hero-banner text-center">
    <div class="container position-relative">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <p class="sp-contact-hero-subtitle mb-3" data-wow-delay=".2s">Skontaktuj się z nami</p>
                <h1 class="display-4 mb-4" data-wow-delay=".4s">Jesteśmy Tu Dla Ciebie</h1>
                <p class="lead" data-wow-delay=".6s">
                    Szukasz profesjonalnego partnera, który zadba o bezpieczeństwo w Twojej firmie? Zadzwoń, napisz lub odwiedź nas w Krakowie. Zespół SafePilot jest gotowy, aby Ci pomóc.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Główna sekcja z informacjami i formularzem -->
<section class="sp-contact-main-section">
    <div class="container padding-extech-shortcode-footer">
        <div class="row g-5 align-items-center">

            <!-- Kolumna z informacjami kontaktowymi -->
            <div class="col-lg-5" data-wow-delay=".3s">
                <div class="mb-5">
                    <h2 class="sp-contact-form-title">Dane Kontaktowe</h2>
                    <p>Wybierz najwygodniejszy dla siebie sposób komunikacji. Odpowiadamy na wszystkie zapytania, zazwyczaj w ciągu 24 godzin roboczych.</p>
                </div>
                
                <!-- Karta Adres -->
                <div class="sp-contact-info-card">
                    <div class="sp-contact-info-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <h5 class="sp-contact-info-title">Adres Biura</h5>
                        <span class="sp-contact-info-link">ul. Kordiana 50B/65, 30-653 Kraków</span>
                    </div>
                </div>

                <!-- Karta Telefon -->
                <div class="sp-contact-info-card">
                    <div class="sp-contact-info-icon"><i class="fa-solid fa-phone"></i></div>
                    <div>
                        <h5 class="sp-contact-info-title">Szybki Kontakt Telefoniczny</h5>
                        <a href="tel:+48726739238" class="sp-contact-info-link">+48 726 739 238</a>
                    </div>
                </div>

                <!-- Karta Email -->
                <div class="sp-contact-info-card">
                    <div class="sp-contact-info-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <h5 class="sp-contact-info-title">Zapytania mailowe</h5>
                        <a href="mailto:biuro@safepilot.pl" class="sp-contact-info-link">biuro@safepilot.pl</a>
                    </div>
                </div>
            </div>

            <!-- Kolumna z formularzem kontaktowym -->
            <div class="col-lg-7" data-wow-delay=".5s">
                <div class="sp-contact-form-wrapper">
                    <h2 class="sp-contact-form-title">Wyślij do nas wiadomość</h2>
                    <!-- Uwaga: Aby formularz działał, potrzebujesz wtyczki typu 'Contact Form 7' lub 'WPForms'. Poniżej jest tylko struktura HTML. -->
                    <?php echo do_shortcode('[contact-form-7 id="1c490f9" title="Formularz-kontaktowy"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sekcja z Mapą -->
<section class="sp-contact-map-section" data-wow-delay=".3s">
    <iframe
        class="sp-contact-map-iframe"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2564.0470510999376!2d19.960724612479712!3d50.01047331882608!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fa42dc3a43b5ff9%3A0xf6f1f58fe907871a!2zU2FmZVBpbG90IE1hcmVrIFdpxZtuaW93c2tpIOKAkyBCSFAgaSBQUE_FuyBLcmFrw7N3!5e0!3m2!1spl!2spl!4v1763083726808!5m2!1spl!2spl"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</section>

<!-- Sekcja FAQ dla kontaktu -->
<section class="sp-contact-faq-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h2 class="sp-contact-form-title" data-wow-delay=".2s">Często Zadawane Pytania</h2>
                </div>
                <div class="accordion" id="contactFaqAccordion" data-wow-delay=".4s">
                    <!-- Pytanie 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-1" aria-expanded="true" aria-controls="faq-collapse-1">
                                Czy SafePilot oferuje bezpłatną konsultację?
                            </button>
                        </h2>
                        <div id="faq-collapse-1" class="accordion-collapse collapse show" aria-labelledby="faq-heading-1" data-bs-parent="#contactFaqAccordion">
                            <div class="accordion-body">
                                Tak, oferujemy bezpłatną wstępną konsultację, podczas której omawiamy Twoje potrzeby i proponujemy najlepsze rozwiązania. Konsultacja może odbyć się telefonicznie, mailowo lub podczas spotkania osobistego.
                            </div>
                        </div>
                    </div>
                    <!-- Pytanie 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-2" aria-expanded="false" aria-controls="faq-collapse-2">
                                Jak szybko mogę otrzymać ofertę?
                            </button>
                        </h2>
                        <div id="faq-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-heading-2" data-bs-parent="#contactFaqAccordion">
                            <div class="accordion-body">
                                Staramy się przygotowywać oferty w ciągu 24-48 godzin od otrzymania wszystkich niezbędnych informacji o Twojej firmie. W pilnych przypadkach jesteśmy w stanie skrócić ten czas.
                            </div>
                        </div>
                    </div>
                    <!-- Pytanie 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-3" aria-expanded="false" aria-controls="faq-collapse-3">
                                Czy SafePilot realizuje usługi tylko w Krakowie?
                            </button>
                        </h2>
                        <div id="faq-collapse-3" class="accordion-collapse collapse" aria-labelledby="faq-heading-3" data-bs-parent="#contactFaqAccordion">
                            <div class="accordion-body">
                                Nie, oferujemy usługi BHP na terenie całej Polski. Nasze biuro znajduje się w Krakowie, ale dysponujemy zespołem ekspertów, którzy mogą dotrzeć do Twojej firmy niezależnie od lokalizacji.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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

</main><!-- #main -->

<?php
get_footer(); // Wczytuje plik footer.php