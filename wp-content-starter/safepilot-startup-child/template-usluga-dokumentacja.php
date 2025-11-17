<?php
/**
 * Template Name: Szablon - Usługa (Dokumentacja BHP)
 *
 * @package safepilot-startup-child
 */

get_header(); // Wczytuje plik header.php
?>

<style>
/* ==========================================================================
   SafePilot - Unikalne Style dla Podstrony Usługi "Dokumentacja BHP"
   Prefiks: sp-s-doc-
   ========================================================================== */

/* ---------------------------------- */
/* 1. Nagłówek i Nawigacja            */
/* ---------------------------------- */
.sp-s-doc-page-header {
    background: var(--secondary-navy, #213543);
    color: var(--white-color, #ffffff);
    padding: 60px 0;
    text-align: center;
}

.sp-s-doc-page-header .sp-s-doc-subtitle {
    color: var(--primary-teal, #4fb9ad);
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.sp-s-doc-page-header .sp-s-doc-title {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
    color: var(--white-color, #ffffff);
}

/* ---------------------------------- */
/* 2. Główny Layout i Boczna Nawigacja*/
/* ---------------------------------- */
.sp-s-doc-main-section {
    padding: 80px 0;
}

.sp-s-doc-sidebar-nav {
    position: -webkit-sticky;
    position: sticky;
    top: 120px; /* Dopasuj, jeśli masz stały header */
    background: var(--white-color, #ffffff);
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e8e8e8;
    box-shadow: 0 5px 25px rgba(33, 53, 67, 0.05);
}

.sp-s-doc-sidebar-nav .nav-link {
    color: var(--secondary-navy, #213543);
    font-weight: 600;
    padding: 10px 15px;
    border-left: 3px solid transparent;
    transition: all 0.25s ease;
}

.sp-s-doc-sidebar-nav .nav-link:hover {
    color: var(--primary-teal, #4fb9ad);
    background-color: #f5f9f8;
}

.sp-s-doc-sidebar-nav .nav-link.active {
    color: var(--primary-teal, #4fb9ad);
    border-left-color: var(--primary-teal, #4fb9ad);
    background-color: #e8f7f5;
}

/* ---------------------------------- */
/* 3. Bloki Treści                    */
/* ---------------------------------- */
.sp-s-doc-content-block {
    padding-bottom: 60px;
    margin-bottom: 60px;
    border-bottom: 1px dashed #d8d5c8;
}

.sp-s-doc-content-block:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.sp-s-doc-content-block h2 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    color: var(--secondary-navy, #213543);
    font-weight: 700;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.sp-s-doc-content-block h2 i {
    color: var(--primary-teal, #4fb9ad);
    margin-right: 15px;
    font-size: 1.2em;
}

.sp-s-doc-content-block ul {
    list-style: none;
    padding-left: 0;
}

.sp-s-doc-content-block ul li {
    position: relative;
    padding-left: 25px;
    margin-bottom: 10px;
    line-height: 1.7;
}

.sp-s-doc-content-block ul li::before {
    content: '\f058'; /* ikona check-circle */
    font-family: "Font Awesome 6 Pro";
    font-weight: 400; /* Regular */
    position: absolute;
    left: 0;
    top: 5px;
    color: var(--primary-teal, #4fb9ad);
}

.sp-s-doc-card {
    background: #f5f9f8;
    border: 1px solid #e8e8e8;
    border-radius: 12px;
    padding: 30px;
    margin-top: 20px;
}

.sp-s-doc-card h4 {
    font-weight: 700;
    color: var(--secondary-navy, #213543);
    border-bottom: 2px solid var(--primary-teal, #4fb9ad);
    padding-bottom: 10px;
    margin-bottom: 15px;
}

/* ---------------------------------- */
/* 4. Sekcja "Proces Współpracy"      */
/* ---------------------------------- */
.sp-s-doc-process-step {
    display: flex;
    position: relative;
    margin-bottom: 40px;
}

.sp-s-doc-process-step:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 30px;
    top: 60px;
    bottom: -40px;
    width: 2px;
    background: #e8e8e8;
    border: 1px dashed var(--primary-teal, #4fb9ad);
}

.sp-s-doc-process-icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    line-height: 60px;
    text-align: center;
    border-radius: 50%;
    background: var(--primary-teal, #4fb9ad);
    color: var(--white-color, #ffffff);
    font-size: 24px;
    margin-right: 20px;
    z-index: 1;
}

.sp-s-doc-process-content h5 {
    font-weight: 700;
    color: var(--secondary-navy, #213543);
}

/* ---------------------------------- */
/* 5. Końcowe CTA (Call to Action)    */
/* ---------------------------------- */
.sp-s-doc-cta-section {
    padding: 80px 0;
    background-color: var(--tertiary-color, #19222a);
    color: var(--white-color, #ffffff);
    border-radius: 12px;
}

.sp-s-doc-cta-section h2 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
    color: var(--white-color, #ffffff);
}
</style>

<main id="main" class="site-main" role="main">
<!-- 
==========================================================================
    SafePilot - Podstrona Usługi "Dokumentacja BHP"
    Design premium by GitHub Copilot
========================================================================== 
-->

<!-- Nagłówek podstrony -->
<header class="sp-s-doc-page-header">
    <div class="container">
        <p class="sp-s-doc-subtitle" data-wow-delay=".2s">Nasze Usługi</p>
        <h1 class="sp-s-doc-title display-5" data-wow-delay=".4s">Dokumentacja BHP – Kompleksowe Opracowanie i Aktualizacja</h1>
    </div>
</header>

<!-- Główna sekcja z treścią i nawigacją -->
<section class="sp-s-doc-main-section margin-extech-shortcode">
    <div class="container">
        <div class="row">
            <!-- Boczna nawigacja (lewa kolumna) -->
            <div class="col-lg-4">
                <nav class="sp-s-doc-sidebar-nav nav flex-column" id="service-doc-nav">
                    <a class="nav-link active" href="#dlaczego-wazne">Dlaczego to ważne?</a>
                    <a class="nav-link" href="#ocena-ryzyka">1. Ocena ryzyka zawodowego (ORZ)</a>
                    <a class="nav-link" href="#instrukcje-bhp">2. Instrukcje stanowiskowe i ogólne</a>
                    <a class="nav-link" href="#bioz-ibwr">3. Plany BIOZ i IBWR</a>
                    <a class="nav-link" href="#proces-wspolpracy">Jak przebiega współpraca?</a>
                    <a class="nav-link" href="#dlaczego-safepilot">Dlaczego warto?</a>
                </nav>
            </div>

            <!-- Główna treść (prawa kolumna) -->
            <div class="col-lg-8">
                <!-- Wprowadzenie -->
                <div class="sp-s-doc-content-block">
                    <p class="lead">Dokumentacja BHP to fundament bezpiecznego funkcjonowania każdego przedsiębiorstwa. W SafePilot dbamy o to, aby Twoja firma była prowadzona stabilnie, świadomie i bez chaosu – jak zaufany pilot, który zna trasę i potrafi wychwycić zagrożenia, zanim staną się realnym problemem.</p>
                </div>
                
                <!-- Sekcja "Dlaczego dokumentacja jest ważna?" -->
                <div id="dlaczego-wazne" class="sp-s-doc-content-block scroll-margin-top" data-wow-delay=".3s">
                    <h2><i class="fa-solid fa-shield-halved"></i>Dlaczego dokumentacja BHP jest tak ważna?</h2>
                    <p>Dokumentacja BHP jest obowiązkowa dla każdego pracodawcy, niezależnie od branży czy liczby pracowników. To zestaw narzędzi, które:</p>
                    <ul>
                        <li>Określają zasady bezpiecznej pracy</li>
                        <li>Minimalizują ryzyko wypadków</li>
                        <li>Zabezpieczają firmę przed konsekwencjami prawnymi</li>
                        <li>Ułatwiają organizację pracy</li>
                        <li>Chronią zdrowie i życie zatrudnionych</li>
                    </ul>
                    <p>Właściwie przygotowana dokumentacja jest spójna, aktualna i dopasowana do specyfiki firmy. Taka właśnie powstaje w SafePilot.</p>
                </div>

                <!-- Sekcja "Ocena ryzyka zawodowego" -->
                <div id="ocena-ryzyka" class="sp-s-doc-content-block scroll-margin-top" data-wow-delay=".3s">
                    <h2><i class="fa-solid fa-magnifying-glass-chart"></i>1. Ocena ryzyka zawodowego (ORZ)</h2>
                    <p>Jeden z kluczowych dokumentów wymaganych przez prawo pracy. W SafePilot opracowujemy rzetelną i profesjonalną ORZ, która zawiera:</p>
                    <ul>
                        <li>Identyfikację zagrożeń na poszczególnych stanowiskach,</li>
                        <li>Analizę prawdopodobieństwa i skutków wystąpienia zagrożeń,</li>
                        <li>Dobór skutecznych środków ochrony,</li>
                        <li>Wskazanie działań profilaktycznych,</li>
                        <li>Zalecenia usprawniające warunki pracy.</li>
                    </ul>
                    <div class="sp-s-doc-card">
                        <h4>Przygotowujemy ORZ dla stanowisk:</h4>
                        <p>biurowych, produkcyjnych, magazynowych, budowlanych, administracyjnych i specjalistycznych, a także tych z obsługą maszyn i urządzeń.</p>
                    </div>
                </div>

                <!-- Sekcja "Instrukcje BHP" -->
                <div id="instrukcje-bhp" class="sp-s-doc-content-block scroll-margin-top" data-wow-delay=".3s">
                    <h2><i class="fa-solid fa-file-lines"></i>2. Instrukcje stanowiskowe i ogólne BHP</h2>
                    <p>Instrukcje BHP są niezbędnym elementem wyposażenia każdego stanowiska pracy. W SafePilot przygotowujemy:</p>
                    <div class="sp-s-doc-card mb-3">
                        <h4>Instrukcje ogólne BHP</h4>
                        <p>Zawierają zasady obowiązujące wszystkich pracowników na terenie firmy.</p>
                    </div>
                     <div class="sp-s-doc-card">
                        <h4>Instrukcje stanowiskowe BHP</h4>
                        <p>Dostosowane do konkretnych stanowisk, urządzeń oraz specyfiki pracy – jasne, czytelne i zgodne z wymogami prawnymi.</p>
                    </div>
                </div>

                <!-- Sekcja "Plany BIOZ i IBWR" -->
                <div id="bioz-ibwr" class="sp-s-doc-content-block scroll-margin-top" data-wow-delay=".3s">
                    <h2><i class="fa-solid fa-helmet-safety"></i>3. Plany BIOZ i IBWR</h4>
                    <p>Firmy realizujące prace budowlane lub inwestycyjne mają obowiązek przygotowania specjalistycznej dokumentacji bezpieczeństwa. Tworzymy:</p>
                     <div class="sp-s-doc-card mb-3">
                        <h4>Plan BIOZ (Plan Bezpieczeństwa i Ochrony Zdrowia)</h4>
                        <p>Określa organizację robót, zagrożenia, sposób minimalizacji ryzyka i zasady współpracy między wykonawcami.</p>
                    </div>
                     <div class="sp-s-doc-card">
                        <h4>IBWR (Instrukcja Bezpiecznego Wykonywania Robót)</h4>
                        <p>Dokument wymagany przed rozpoczęciem szczególnie niebezpiecznych prac. Obejmuje opis technologii, analizę ryzyka i procedury minimalizujące zagrożenia.</p>
                    </div>
                </div>

                <!-- Sekcja "Proces Współpracy" -->
                <div id="proces-wspolpracy" class="sp-s-doc-content-block scroll-margin-top" data-wow-delay=".3s">
                    <h2><i class="fa-solid fa-diagram-project"></i>Jak przebiega współpraca z SafePilot?</h2>
                    <div class="sp-s-doc-process-step">
                        <div class="sp-s-doc-process-icon">1</div>
                        <div class="sp-s-doc-process-content">
                            <h5>Audyt wstępny</h5>
                            <p>Analizujemy potrzeby firmy, charakter pracy, stanowiska i istniejącą dokumentację.</p>
                        </div>
                    </div>
                    <div class="sp-s-doc-process-step">
                        <div class="sp-s-doc-process-icon">2</div>
                        <div class="sp-s-doc-process-content">
                            <h5>Opracowanie dokumentów</h5>
                            <p>Tworzymy komplet dokumentów dostosowanych do specyfiki Twojej działalności.</p>
                        </div>
                    </div>
                     <div class="sp-s-doc-process-step">
                        <div class="sp-s-doc-process-icon">3</div>
                        <div class="sp-s-doc-process-content">
                            <h5>Konsultacje i wdrożenie</h5>
                            <p>Wyjaśniamy zastosowanie dokumentów i sposób ich wdrożenia w Twojej firmie.</p>
                        </div>
                    </div>
                     <div class="sp-s-doc-process-step">
                        <div class="sp-s-doc-process-icon">4</div>
                        <div class="sp-s-doc-process-content">
                            <h5>Aktualizacje i wsparcie</h5>
                            <p>Reagujemy na zmiany przepisów, warunków pracy i zapewniamy stałe wsparcie.</p>
                        </div>
                    </div>
                </div>

                <!-- Sekcja "Dlaczego Warto" -->
                <div id="dlaczego-safepilot" class="sp-s-doc-content-block scroll-margin-top" data-wow-delay=".3s">
                    <h2><i class="fa-solid fa-award"></i>Dlaczego warto wybrać SafePilot?</h2>
                     <ul>
                        <li>Dokumentację przygotowują doświadczeni specjaliści BHP i PPOŻ.</li>
                        <li>Każdy dokument powstaje na podstawie analizy realnych warunków pracy.</li>
                        <li>Wszystko zgodnie z przepisami, normami i wytycznymi PIP oraz PSP.</li>
                        <li>Działamy szybko, rzeczowo i bez niepotrzebnego chaosu.</li>
                        <li>Doradzamy i wspieramy przedsiębiorcę na każdym etapie współpracy.</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Końcowa sekcja CTA -->
<div class="container">
    <div class="sp-s-doc-cta-section text-center" data-wow-delay=".3s">
        <div class="container">
            <h2 class="mb-3">Potrzebujesz profesjonalnej dokumentacji BHP?</h2>
            <p class="lead mb-4">Skontaktuj się z nami. Odpowiemy na wszystkie pytania i przedstawimy ofertę dostosowaną do Twojej działalności.</p>
            <a href="https://safepilot.pl/kontakt" class="btn btn-primary btn-lg">Skontaktuj się z nami <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</div>

<!-- Opcjonalny skrypt do nawigacji -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#service-doc-nav',
            offset: 150
        });
    });
</script>

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