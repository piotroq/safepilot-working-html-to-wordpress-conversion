<?php
/**
 * Template Name: Szablon - Usługa (Szkolenia PPOŻ)
 *
 * @package safepilot-startup-child
 */

get_header(); // Wczytuje plik header.php
?>

<style>
/* ==========================================================================
   SafePilot - Unikalne Style dla Podstrony "Szkolenia i Ćwiczenia PPOŻ"
   Prefiks: sp-s-fire-train-
   ========================================================================== */

/* ---------------------------------- */
/* 1. Nagłówek podstrony               */
/* ---------------------------------- */
.sp-s-fire-train-header {
    padding: 100px 0;
    background-color: var(--secondary-navy, #213543);
    color: var(--white-color, #ffffff);
    position: relative;
    overflow: hidden;
}

.sp-s-fire-train-header::before {
    content: '\e005'; /* Ikona fire-extinguisher */
    font-family: var(--icon-font, "Font Awesome 6 Pro");
    font-weight: 900;
    position: absolute;
    font-size: 350px;
    color: rgba(79, 185, 173, 0.05);
    bottom: -80px;
    left: -50px;
    transform: rotate(-20deg);
    line-height: 1;
}

.sp-s-fire-train-subtitle {
    color: var(--primary-teal, #4fb9ad);
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.sp-s-fire-train-header .display-5 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
}

/* ---------------------------------- */
/* 2. Sekcja z Osią Czasu Szkoleń     */
/* ---------------------------------- */
.sp-s-fire-train-timeline-section {
    padding: 100px 0;
}

.sp-s-fire-train-timeline {
    position: relative;
}

.sp-s-fire-train-timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    bottom: 0;
    width: 3px;
    background-color: #e8f7f5;
    transform: translateX(-50%);
}

.sp-s-fire-train-timeline-item {
    position: relative;
    margin-bottom: 80px;
}

.sp-s-fire-train-timeline-content {
    position: relative;
    background: var(--white-color, #ffffff);
    border-radius: 12px;
    padding: 40px;
    border: 1px solid #e8e8e8;
    box-shadow: 0 5px 30px rgba(33, 53, 67, 0.05);
    width: 45%;
}

.sp-s-fire-train-timeline-item:nth-child(even) .sp-s-fire-train-timeline-content {
    float: right;
}

.sp-s-fire-train-timeline-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    line-height: 60px;
    text-align: center;
    border-radius: 50%;
    background: var(--primary-teal, #4fb9ad);
    color: var(--white-color, #ffffff);
    font-size: 24px;
    border: 4px solid #e8f7f5;
    z-index: 10;
}

.sp-s-fire-train-timeline-content h3 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    color: var(--secondary-navy, #213543);
    font-weight: 700;
    margin-bottom: 20px;
}

.sp-s-fire-train-timeline-content ul {
    list-style: none;
    padding-left: 0;
}
.sp-s-fire-train-timeline-content ul li {
    padding-left: 25px;
    margin-bottom: 10px;
    position: relative;
}
.sp-s-fire-train-timeline-content ul li::before {
    content: '\f14a'; /* check-square */
    font-family: "Font Awesome 6 Pro";
    font-weight: 400; /* Regular */
    position: absolute;
    left: 0;
    top: 4px;
    color: var(--primary-teal, #4fb9ad);
}

/* Responsywność osi czasu */
@media (max-width: 991.98px) {
    .sp-s-fire-train-timeline::before {
        left: 30px;
    }
    .sp-s-fire-train-timeline-item .sp-s-fire-train-timeline-content {
        width: auto;
        float: none !important;
        margin-left: 80px;
    }
    .sp-s-fire-train-timeline-icon {
        left: 30px;
    }
}

/* ---------------------------------- */
/* 3. Sekcja Korzyści                 */
/* ---------------------------------- */
.sp-s-fire-train-benefits-section {
    padding: 100px 0;
    background-color: var(--smoke-color, #f5f9f8);
}
.sp-s-fire-train-benefit-item {
    display: flex;
    align-items: flex-start;
}
.sp-s-fire-train-benefit-icon {
    font-size: 24px;
    color: var(--primary-teal, #4fb9ad);
    margin-right: 20px;
    margin-top: 5px;
}
.sp-s-fire-train-benefit-item h5 {
    font-weight: 700;
    color: var(--secondary-navy, #213543);
}

/* ---------------------------------- */
/* 4. Końcowe CTA (Call to Action)    */
/* ---------------------------------- */
.sp-s-fire-train-cta-section {
    padding: 80px 0;
    background-color: var(--secondary-navy, #213543);
    color: var(--white-color, #ffffff);
    border-radius: 12px;
}
.sp-s-fire-train-cta-section h2 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
    color: var(--white-color, #ffffff);
}
</style>

<main id="main" class="site-main" role="main">
<!-- 
==========================================================================
    SafePilot - Podstrona Usługi "Szkolenia i Ćwiczenia PPOŻ"
    Design premium by GitHub Copilot
========================================================================== 
-->

<!-- Nagłówek podstrony -->
<header class="sp-s-fire-train-header">
    <div class="container text-center">
        <p class="sp-s-fire-train-subtitle" data-wow-delay=".2s">Praktyczne przygotowanie do działania</p>
        <h1 class="display-5" data-wow-delay=".4s" style="color: #fff;">Szkolenia i Ćwiczenia PPOŻ</h1>
        <p class="lead col-lg-8 mx-auto mt-3" data-wow-delay=".6s">
            Fundamentem bezpieczeństwa jest świadomy, wyszkolony pracownik. Oferujemy kompleksowe szkolenia, które realnie podnoszą poziom bezpieczeństwa Twojej organizacji.
        </p>
    </div>
</header>

<!-- Sekcja z Osią Czasu Szkoleń -->
<section class="sp-s-fire-train-timeline-section margin-extech-shortcode">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="title-2" data-wow-delay=".2s">Praktyka, która zostaje na lata</h2>
            <p class="col-lg-7 mx-auto" data-wow-delay=".4s">Nasze szkolenia łączą teorię z intensywną praktyką, aby uczestnicy mogli nie tylko zdobyć wiedzę, ale przede wszystkim umiejętności niezbędne w przypadku pożaru.</p>
        </div>

        <div class="sp-s-fire-train-timeline">
            <!-- Etap 1: Szkolenia PPOŻ -->
            <div class="sp-s-fire-train-timeline-item clearfix" data-wow-delay=".3s">
                <div class="sp-s-fire-train-timeline-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                <div class="sp-s-fire-train-timeline-content">
                    <h3>1. Kompleksowe szkolenia PPOŻ</h3>
                    <p>Program zawsze dostosowujemy do branży, rodzaju obiektu, specyfiki stanowisk oraz poziomu ryzyka. Zakres obejmuje m.in.:</p>
                    <ul>
                        <li>Podstawowe przepisy i pojęcia PPOŻ.</li>
                        <li>Przyczyny pożarów i metody zapobiegania.</li>
                        <li>Zasady ewakuacji i obowiązki pracowników.</li>
                        <li>Praktyczne modele działania w pierwszych minutach pożaru.</li>
                        <li>Procedury alarmowania i współpracy z PSP.</li>
                    </ul>
                </div>
            </div>

            <!-- Etap 2: Próbne Ewakuacje -->
            <div class="sp-s-fire-train-timeline-item clearfix" data-wow-delay=".4s">
                <div class="sp-s-fire-train-timeline-icon"><i class="fa-solid fa-person-running"></i></div>
                <div class="sp-s-fire-train-timeline-content">
                    <h3>2. Próbne ewakuacje</h3>
                    <p>Próbna ewakuacja to obowiązek i kluczowy test bezpieczeństwa, który ujawnia realny poziom gotowości organizacji. Zapewniamy:</p>
                    <ul>
                        <li>Przygotowanie scenariusza dopasowanego do specyfiki obiektu.</li>
                        <li>Koordynację i monitoring przebiegu działań.</li>
                        <li>Analizę błędów oraz szczegółowy raport z rekomendacjami.</li>
                        <li>Wsparcie przy wprowadzaniu niezbędnych usprawnień.</li>
                    </ul>
                </div>
            </div>

            <!-- Etap 3: Instruktaże -->
            <div class="sp-s-fire-train-timeline-item clearfix" data-wow-delay=".5s">
                <div class="sp-s-fire-train-timeline-icon"><i class="fa-solid fa-fire-extinguisher"></i></div>
                <div class="sp-s-fire-train-timeline-content">
                    <h3>3. Instruktaże użycia sprzętu gaśniczego</h3>
                    <p>Pożar rozwija się szybko, a pierwsze sekundy są kluczowe. Uczymy nie tylko jak, ale również kiedy i czym gasić:</p>
                    <ul>
                        <li>Obsługa gaśnic proszkowych, śniegowych i pianowych.</li>
                        <li>Prawidłowe użycie hydrantów wewnętrznych.</li>
                        <li>Zasady doboru środka gaśniczego do rodzaju pożaru.</li>
                        <li>Praktyczne ćwiczenia z użyciem profesjonalnego trenażera pożarowego.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sekcja "Dlaczego warto?" -->
<section class="sp-s-fire-train-benefits-section">
    <div class="container padding-extech-shortcode-footer">
        <div class="text-center mb-5">
            <h2 class="title-2" data-wow-delay=".2s">Dlaczego Warto Szkolić z SafePilot?</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-wow-delay=".3s">
                <div class="sp-s-fire-train-benefit-item">
                    <div class="sp-s-fire-train-benefit-icon"><i class="fa-solid fa-hand-fist"></i></div>
                    <div>
                        <h5>Praktyka ponad teorią</h5>
                        <p>Łączymy teorię z praktyką – bez zbędnych wykładów, maksimum konkretów.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-wow-delay=".4s">
                <div class="sp-s-fire-train-benefit-item">
                    <div class="sp-s-fire-train-benefit-icon"><i class="fa-solid fa-sliders"></i></div>
                    <div>
                        <h5>Dopasowany program</h5>
                        <p>Dostosowujemy program do branży, charakteru obiektu i poziomu ryzyka.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-wow-delay=".5s">
                <div class="sp-s-fire-train-benefit-item">
                    <div class="sp-s-fire-train-benefit-icon"><i class="fa-solid fa-certificate"></i></div>
                    <div>
                        <h5>Pełna dokumentacja</h5>
                        <p>Zapewniamy kompletną dokumentację po każdym szkoleniu i próbnej ewakuacji.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Końcowa sekcja CTA -->
<div class="container my-5">
    <div class="sp-s-fire-train-cta-section text-center" data-wow-delay=".3s">
        <div class="container">
            <h2 class="mb-3">Bezpieczeństwo zaczyna się od ludzi. My uczymy ich działać.</h2>
            <p class="lead mb-4">Zorganizuj profesjonalne szkolenie PPOŻ w swojej firmie i zyskaj pewność, że Twój zespół jest gotowy na każdą ewentualność.</p>
            <a href="https://safepilot.pl/kontakt/" class="btn btn-primary btn-lg">Zapytaj o szkolenie PPOŻ <i class="fa-solid fa-arrow-right ms-2"></i></a>
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