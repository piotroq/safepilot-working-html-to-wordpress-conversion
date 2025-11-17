<?php
/**
 * Template Name: Szablon - Usługa (Audyty i Nadzór)
 *
 * @package safepilot-startup-child
 */

get_header(); // Wczytuje plik header.php
?>

<style>
/* ==========================================================================
   SafePilot - Unikalne Style dla Podstrony Usługi "Audyty i Nadzór BHP"
   Prefiks: sp-s-audit-
   ========================================================================== */

/* ---------------------------------- */
/* 1. Główny Layout i Nagłówek         */
/* ---------------------------------- */
.sp-s-audit-hero {
    padding: 100px 0;
    background: linear-gradient(rgba(33, 53, 67, 0.9), rgba(33, 53, 67, 0.9)), url('https://images.unsplash.com/photo-1581092921462-63f4a258c738?q=80&w=2940&auto=format&fit=crop') no-repeat center center;
    background-size: cover;
    color: var(--white-color, #ffffff);
}

.sp-s-audit-hero .sp-s-audit-subtitle {
    color: var(--primary-teal, #4fb9ad);
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.sp-s-audit-hero .display-5 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
}

/* ---------------------------------- */
/* 2. Sekcja "Zakres Usługi"           */
/* ---------------------------------- */
.sp-s-audit-scope-section {
    padding: 100px 0;
    background-color: var(--smoke-color, #f5f9f8);
}

.sp-s-audit-card {
    position: relative;
    background: var(--white-color, #ffffff);
    border-radius: 12px;
    padding: 40px;
    border: 1px solid #e8e8e8;
    box-shadow: 0 5px 25px rgba(33, 53, 67, 0.04);
    transition: all 0.3s ease-in-out;
    height: 100%;
}

.sp-s-audit-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(33, 53, 67, 0.1);
}

.sp-s-audit-card-icon {
    font-size: 36px;
    color: var(--primary-teal, #4fb9ad);
    margin-bottom: 20px;
}

.sp-s-audit-card h3 {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--secondary-navy, #213543);
    margin-bottom: 15px;
}

.sp-s-audit-card .sp-s-audit-list {
    list-style: none;
    padding-left: 0;
}

.sp-s-audit-card .sp-s-audit-list li {
    position: relative;
    padding-left: 25px;
    margin-bottom: 12px;
}

.sp-s-audit-card .sp-s-audit-list li::before {
    content: '\f00c'; /* ikona check */
    font-family: "Font Awesome 6 Pro";
    font-weight: 900; /* Solid */
    position: absolute;
    left: 0;
    top: 5px;
    font-size: 14px;
    color: var(--primary-teal, #4fb9ad);
}

/* ---------------------------------- */
/* 3. Sekcja "Dlaczego My"            */
/* ---------------------------------- */
.sp-s-audit-why-us-section {
    padding: 100px 0;
}

.sp-s-audit-why-us-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 30px;
}

.sp-s-audit-why-us-icon {
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    border-radius: 50%;
    background: #e8f7f5;
    color: var(--primary-teal, #4fb9ad);
    font-size: 22px;
    margin-right: 20px;
}

.sp-s-audit-why-us-item h5 {
    font-weight: 700;
    color: var(--secondary-navy, #213543);
    margin-bottom: 5px;
}

.sp-s-audit-why-us-img {
    border-radius: 12px;
    object-fit: cover;
    width: 100%;
    height: 100%;
    min-height: 400px;
}

/* ---------------------------------- */
/* 4. Końcowe CTA (Call to Action)    */
/* ---------------------------------- */
.sp-s-audit-cta-section {
    padding: 80px 0;
    background-color: var(--tertiary-color, #19222a);
    color: var(--white-color, #ffffff);
    border-radius: 12px;
}

.sp-s-audit-cta-section h2 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
    color: var(--white-color, #ffffff);
}
</style>

<main id="main" class="site-main" role="main">
<!-- 
==========================================================================
    SafePilot - Podstrona Usługi "Audyty i Nadzór BHP"
    Design premium by GitHub Copilot
========================================================================== 
-->

<!-- Nagłówek podstrony (Hero Section) -->
<header class="sp-s-audit-hero text-center">
    <div class="container">
        <p class="sp-s-audit-subtitle" data-wow-delay=".2s">Profesjonalna kontrola bezpieczeństwa</p>
        <h1 class="display-5" data-wow-delay=".4s" style="color: #fff;">Audyty i Nadzór BHP</h1>
        <p class="lead col-lg-8 mx-auto mt-3" data-wow-delay=".6s">
            Realizujemy audyty i stały nadzór BHP, eliminując ryzyka, przewidując problemy i wdrażając rozwiązania, które chronią ludzi oraz zasoby Twojej firmy.
        </p>
    </div>
</header>

<!-- Sekcja "Zakres Usług" -->
<section class="sp-s-audit-scope-section">
    <div class="container padding-extech-shortcode-footer">
        <div class="text-center mb-5">
            <h2 class="title-2" data-wow-delay=".2s">Zakres Usługi</h2>
            <p class="col-lg-7 mx-auto" data-wow-delay=".4s">Nasze działania obejmują kompleksową analizę środowiska pracy, dbając o zgodność z aktualnymi przepisami, normami oraz dobrymi praktykami.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Karta 1: Kontrole i Audyty -->
            <div class="col-lg-6 col-md-6" data-wow-delay=".3s">
                <div class="sp-s-audit-card">
                    <div class="sp-s-audit-card-icon"><i class="fa-solid fa-clipboard-check"></i></div>
                    <h3>Kontrole i audyty zgodności</h3>
                    <ul class="sp-s-audit-list">
                        <li>Ocena stanu BHP w zakładzie</li>
                        <li>Sprawdzenie organizacji stanowisk pracy</li>
                        <li>Analiza stanu maszyn i urządzeń</li>
                        <li>Weryfikacja dokumentacji BHP</li>
                    </ul>
                </div>
            </div>

            <!-- Karta 2: Stały Nadzór -->
            <div class="col-lg-6 col-md-6" data-wow-delay=".4s">
                <div class="sp-s-audit-card">
                    <div class="sp-s-audit-card-icon"><i class="fa-solid fa-user-shield"></i></div>
                    <h3>Stały nadzór BHP dla firm</h3>
                     <ul class="sp-s-audit-list">
                        <li>Rola zewnętrznej służby BHP</li>
                        <li>Bieżące kontrole i konsultacje</li>
                        <li>Udział w komisjach BHP</li>
                        <li>Przygotowanie procedur i regulaminów</li>
                    </ul>
                </div>
            </div>

            <!-- Karta 3: Ergonomia -->
            <div class="col-lg-6 col-md-6" data-wow-delay=".5s">
                <div class="sp-s-audit-card">
                    <div class="sp-s-audit-card-icon"><i class="fa-solid fa-chair"></i></div>
                    <h3>Doradztwo w zakresie ergonomii</h3>
                     <ul class="sp-s-audit-list">
                        <li>Audyty ergonomiczne stanowisk</li>
                        <li>Rekomendacje dla biur i produkcji</li>
                        <li>Minimalizacja obciążeń pracowników</li>
                        <li>Dobór wyposażenia i optymalizacja procesów</li>
                    </ul>
                </div>
            </div>

            <!-- Karta 4: Analiza Wypadków -->
            <div class="col-lg-6 col-md-6" data-wow-delay=".6s">
                <div class="sp-s-audit-card">
                    <div class="sp-s-audit-card-icon"><i class="fa-solid fa-person-falling-burst"></i></div>
                    <h3>Analizy powypadkowe</h3>
                     <ul class="sp-s-audit-list">
                        <li>Pełna procedura powypadkowa</li>
                        <li>Ustalanie przyczyn i okoliczności zdarzeń</li>
                        <li>Analiza czynników ludzkich i organizacyjnych</li>
                        <li>Opracowanie działań naprawczych i prewencyjnych</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sekcja "Dlaczego SafePilot?" -->
<section class="sp-s-audit-why-us-section">
    <div class="container padding-extech-shortcode-footer">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-wow-delay=".3s">
                <h2 class="title-2 mb-4">Twój Pilot w Świecie Bezpieczeństwa</h2>
                <p>Audyty BHP to nie tylko wymóg prawny. To skuteczne narzędzie zarządzania, które pozwala wykrywać błędy, optymalizować procesy i realnie zmniejszać ryzyko wypadków.</p>
                <div class="mt-4">
                    <div class="sp-s-audit-why-us-item">
                        <div class="sp-s-audit-why-us-icon"><i class="fa-solid fa-rocket"></i></div>
                        <div>
                            <h5>Działamy z misją</h5>
                            <p>Bezpieczeństwo to nasz fundament, a prowadzenie firm przez świat przepisów BHP to nasza specjalizacja.</p>
                        </div>
                    </div>
                    <div class="sp-s-audit-why-us-item">
                        <div class="sp-s-audit-why-us-icon"><i class="fa-solid fa-file-signature"></i></div>
                        <div>
                            <h5>Pracujemy przejrzyście</h5>
                            <p>Otrzymujesz jasne raporty z konkretnymi rekomendacjami, a nie urzędniczy żargon.</p>
                        </div>
                    </div>
                     <div class="sp-s-audit-why-us-item">
                        <div class="sp-s-audit-why-us-icon"><i class="fa-solid fa-bolt"></i></div>
                        <div>
                            <h5>Reagujemy szybko</h5>
                            <p>Jesteśmy do Twojej dyspozycji w sytuacjach nagłych, zapewniając merytoryczne wsparcie.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-wow-delay=".5s">
                <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2940&auto=format&fit=crop" alt="Zespół omawiający audyt BHP" class="sp-s-audit-why-us-img">
            </div>
        </div>
    </div>
</section>

<!-- Końcowa sekcja CTA -->
<div class="container my-5">
    <div class="sp-s-audit-cta-section text-center" data-wow-delay=".3s">
        <div class="container">
            <h2 class="mb-3">Zapewnij bezpieczeństwo w swojej firmie</h2>
            <p class="lead mb-4">Skontaktuj się z nami, aby wdrożyć profesjonalny nadzór BHP, przeprowadzić audyt lub upewnić się, że Twoja firma działa zgodnie z przepisami.</p>
            <a href="https://safepilot.pl/kontakt" class="btn btn-primary btn-lg">Skontaktuj się z nami <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</div>

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