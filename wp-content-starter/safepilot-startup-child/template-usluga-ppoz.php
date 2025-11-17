<?php
/**
 * Template Name: Szablon - Usługa (Dokumentacja PPOŻ)
 *
 * @package safepilot-startup-child
 */

get_header(); // Wczytuje plik header.php
?>

<style>
/* ==========================================================================
   SafePilot - Unikalne Style dla Podstrony "Dokumentacja PPOŻ"
   Prefiks: sp-s-ppoz-
   ========================================================================== */

/* ---------------------------------- */
/* 1. Nagłówek i sekcja wprowadzająca */
/* ---------------------------------- */
.sp-s-ppoz-header {
    padding: 80px 0;
    background-color: var(--secondary-navy, #213543);
    color: var(--white-color, #ffffff);
    text-align: center;
}

.sp-s-ppoz-header .sp-s-ppoz-subtitle {
    color: var(--primary-teal, #4fb9ad);
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.sp-s-ppoz-header .display-5 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
}

.sp-s-ppoz-intro-section {
    padding: 100px 0;
}

/* ---------------------------------- */
/* 2. Sekcja "Zakres Usługi" - Akordeon */
/* ---------------------------------- */
.sp-s-ppoz-scope-section {
    padding: 100px 0;
    background-color: var(--smoke-color, #f5f9f8);
}

.sp-s-ppoz-accordion .accordion-item {
    border: 1px solid #e8e8e8;
    border-radius: 12px !important; /* Ważne, aby nadpisać domyślne style Bootstrapa */
    margin-bottom: 20px;
    background-color: var(--white-color, #ffffff);
    box-shadow: 0 5px 25px rgba(33, 53, 67, 0.05);
    overflow: hidden; /* Zapewnia, że zaokrąglenia są widoczne */
}

.sp-s-ppoz-accordion .accordion-header {
    border-radius: 12px;
}

.sp-s-ppoz-accordion .accordion-button {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--secondary-navy, #213543);
    padding: 25px 30px;
    display: flex;
    align-items: center;
    transition: background-color 0.3s ease;
}

.sp-s-ppoz-accordion .accordion-button:focus {
    box-shadow: 0 0 0 3px rgba(79, 185, 173, 0.3);
}

.sp-s-ppoz-accordion .accordion-button:not(.collapsed) {
    background-color: #e8f7f5;
    color: var(--primary-teal, #4fb9ad);
    box-shadow: none;
}

.sp-s-ppoz-accordion .accordion-button .sp-s-ppoz-accordion-icon {
    margin-right: 20px;
    font-size: 24px;
    width: 40px;
    text-align: center;
    color: var(--primary-teal, #4fb9ad);
}

/* Zmiana ikony +/- w akordeonie */
.sp-s-ppoz-accordion .accordion-button::after {
    flex-shrink: 0;
    width: 1.5rem;
    height: 1.5rem;
    margin-left: auto;
    content: "\2b"; /* Plus sign */
    font-family: "Font Awesome 6 Pro";
    font-weight: 900;
    background-image: none;
    transition: transform .2s ease-in-out;
}

.sp-s-ppoz-accordion .accordion-button:not(.collapsed)::after {
    content: "\f068"; /* Minus sign */
    transform: rotate(0deg);
}

.sp-s-ppoz-accordion .accordion-body {
    padding: 30px;
    padding-top: 10px;
    line-height: 1.8;
}

.sp-s-ppoz-accordion ul {
    list-style: none;
    padding-left: 0;
}
.sp-s-ppoz-accordion ul li {
    position: relative;
    padding-left: 25px;
    margin-bottom: 10px;
}
.sp-s-ppoz-accordion ul li::before {
    content: '\f058'; /* ikona check-circle */
    font-family: "Font Awesome 6 Pro";
    font-weight: 400; /* Regular */
    position: absolute;
    left: 0;
    top: 5px;
    color: var(--primary-teal, #4fb9ad);
}

/* ---------------------------------- */
/* 3. Sekcja "Dlaczego My"            */
/* ---------------------------------- */
.sp-s-ppoz-why-us-section {
    padding: 100px 0;
}

.sp-s-ppoz-benefit-item {
    text-align: center;
    padding: 20px;
}

.sp-s-ppoz-benefit-icon {
    font-size: 48px;
    color: var(--primary-teal, #4fb9ad);
    margin-bottom: 20px;
    transition: transform 0.3s ease;
}

.sp-s-ppoz-benefit-item:hover .sp-s-ppoz-benefit-icon {
    transform: scale(1.1);
}

.sp-s-ppoz-benefit-item h5 {
    font-weight: 700;
    color: var(--secondary-navy, #213543);
}

/* ---------------------------------- */
/* 4. Końcowe CTA (Call to Action)    */
/* ---------------------------------- */
.sp-s-ppoz-cta-section {
    padding: 80px 0;
    background: linear-gradient(135deg, var(--primary-teal, #4fb9ad) 0%, var(--hover-color, #41857d) 100%);
    color: var(--white-color, #ffffff);
    border-radius: 12px;
}

.sp-s-ppoz-cta-section h2 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
    color: var(--white-color, #ffffff);
}

.sp-s-ppoz-cta-section .btn-light {
    font-weight: 700;
    padding: 12px 30px;
}
</style>

<main id="main" class="site-main" role="main">
<!-- 
==========================================================================
    SafePilot - Podstrona Usługi "Dokumentacja PPOŻ" (Wersja z akordeonem)
    Design premium by GitHub Copilot
========================================================================== 
-->

<!-- Nagłówek podstrony -->
<header class="sp-s-ppoz-header">
    <div class="container">
        <p class="sp-s-ppoz-subtitle" data-wow-delay=".2s">Ochrona Przeciwpożarowa</p>
        <h1 class="display-5" data-wow-delay=".4s" style="color: #fff;">Dokumentacja PPOŻ</h1>
        <p class="lead col-lg-8 mx-auto mt-3" data-wow-delay=".6s">
            Opracowujemy kompletną i profesjonalną dokumentację, która chroni życie, zdrowie oraz mienie, a także minimalizuje ryzyko przestojów i strat.
        </p>
    </div>
</header>

<!-- Sekcja wprowadzająca -->
<section class="sp-s-ppoz-intro-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h2 class="title-2 mb-4" data-wow-delay=".2s">Pełna gotowość na każdą ewentualność</h2>
                <p class="lead" data-wow-delay=".4s" style="color: #000;">
                    "Safe" – bezpieczeństwo jako fundament; "Pilot" – przewodnik prowadzący przez złożone wymagania. Działamy jak pilot współczesnych systemów bezpieczeństwa: z pełną kontrolą, wiedzą i spokojem, eliminując ryzyka, zanim przerodzą się w kryzys.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Sekcja "Zakres Usługi" z akordeonem -->
<section class="sp-s-ppoz-scope-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="title-2" data-wow-delay=".2s">Co obejmuje dokumentacja PPOŻ?</h2>
            <p class="col-lg-7 mx-auto" data-wow-delay=".4s">Opracowujemy pełen zakres dokumentacji niezbędnej w biurach, magazynach, zakładach produkcyjnych i na terenach budowy, w oparciu o aktualne przepisy i normy.</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="accordion sp-s-ppoz-accordion" id="ppozAccordion" data-wow-delay=".5s">
                    <!-- Akordeon 1: IBP -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span class="sp-s-ppoz-accordion-icon"><i class="fa-solid fa-file-shield"></i></span>
                                Instrukcja Bezpieczeństwa Pożarowego (IBP)
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#ppozAccordion">
                            <div class="accordion-body">
                                <p>To podstawowy dokument wymagany w wielu obiektach, którego brak może skutkować poważnymi konsekwencjami prawnymi. Nasza IBP jest przejrzysta, funkcjonalna i zawiera m.in.:</p>
                                <ul>
                                    <li>Analizę warunków ochrony przeciwpożarowej budynku.</li>
                                    <li>Identyfikację i ocenę zagrożeń pożarowych.</li>
                                    <li>Szczegółowe procedury ewakuacji.</li>
                                    <li>Zasady zabezpieczenia prac niebezpiecznych pożarowo.</li>
                                    <li>Wytyczne postępowania dla pracowników i użytkowników obiektu.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Akordeon 2: Plany Ewakuacyjne -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <span class="sp-s-ppoz-accordion-icon"><i class="fa-solid fa-map-location-dot"></i></span>
                                Plany i oznakowanie ewakuacyjne
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#ppozAccordion">
                            <div class="accordion-body">
                                <p>W sytuacji pożaru liczy się każda sekunda. Klarowny, dobrze zaprojektowany schemat ewakuacji może realnie uratować życie. W ramach usługi przygotowujemy:</p>
                                <ul>
                                    <li>Graficzne plany ewakuacyjne zgodne z normą PN-ISO 23601.</li>
                                    <li>Projekty oznakowania dróg ewakuacyjnych (tablice, piktogramy).</li>
                                    <li>Schematy rozmieszczenia sprzętu przeciwpożarowego.</li>
                                    <li>Instrukcje użytkowania gaśnic i hydrantów.</li>
                                    <li>Aktualizację planów po zmianach w obiekcie.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Akordeon 3: Procedury -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <span class="sp-s-ppoz-accordion-icon"><i class="fa-solid fa-person-running"></i></span>
                                Procedury ewakuacyjne i alarmowe
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#ppozAccordion">
                            <div class="accordion-body">
                                <p>W sytuacji kryzysowej pracownicy muszą działać automatycznie. Dlatego tworzymy jasne i jednoznaczne procedury, które można natychmiast wdrożyć. Obejmują one:</p>
                                <ul>
                                    <li>Szczegółowe procedury ewakuacyjne dla wszystkich użytkowników.</li>
                                    <li>Instrukcje alarmowe i procedury zgłoszenia pożaru.</li>
                                    <li>Schematy współpracy ze Strażą Pożarną i innymi służbami.</li>
                                    <li>Praktyczne zestawienia ról i odpowiedzialności.</li>
                                    <li>Wsparcie przy organizacji i przeprowadzaniu próbnych ewakuacji.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sekcja "Dlaczego SafePilot?" -->
<section class="sp-s-ppoz-why-us-section margin-extech-shortcode">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="title-2" data-wow-delay=".2s">Dlaczego Warto Nam Zaufać?</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-wow-delay=".3s">
                <div class="sp-s-ppoz-benefit-item">
                    <div class="sp-s-ppoz-benefit-icon"><i class="fa-solid fa-stamp"></i></div>
                    <h5>Pełna zgodność z prawem</h5>
                    <p>Znajomość przepisów PPOŻ, norm europejskich i wytycznych KG PSP.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-wow-delay=".4s">
                <div class="sp-s-ppoz-benefit-item">
                    <div class="sp-s-ppoz-benefit-icon"><i class="fa-solid fa-puzzle-piece"></i></div>
                    <h5>Indywidualne podejście</h5>
                    <p>Dokumentacja dopasowana do realiów obiektu, a nie tworzona metodą "kopiuj-wklej".</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-wow-delay=".5s">
                <div class="sp-s-ppoz-benefit-item">
                    <div class="sp-s-ppoz-benefit-icon"><i class="fa-solid fa-gears"></i></div>
                    <h5>Doświadczenie i wsparcie</h5>
                    <p>Doświadczenie w pracy z różnymi branżami i wsparcie w kontaktach z PSP.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Końcowa sekcja CTA -->
<div class="container my-5">
    <div class="sp-s-ppoz-cta-section text-center" data-wow-delay=".3s">
        <div class="container">
            <h2 class="mb-3">Zabezpiecz swoją firmę przed ogniem</h2>
            <p class="lead mb-4">Skontaktuj się z nami, aby przygotować profesjonalną dokumentację PPOŻ i zapewnić bezpieczeństwo swojemu zespołowi.</p>
            <a href="https://safepilot.pl/kontakt/" class="btn btn-light btn-lg">Zapytaj o dokumentację PPOŻ <i class="fa-solid fa-arrow-right ms-2"></i></a>
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