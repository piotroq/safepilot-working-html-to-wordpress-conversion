<?php
/**
 * Template Name: Szablon - Usługi (SafePilot)
 *
 * @package safepilot-startup-child
 */

get_header(); // Wczytuje plik header.php
?>

<style>
/* ==========================================================================
   SafePilot - Unikalne Style dla Podstrony "Usługi"
   Prefiks: sp-service-
   ========================================================================== */

/* ---------------------------------- */
/* 1. Usługi - Banner Hero            */
/* ---------------------------------- */
.sp-service-hero-banner {
    background-color: var(--secondary-navy, #213543);
    color: var(--white-color, #ffffff);
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}

.sp-service-hero-banner::before {
    content: '\f0ae'; /* Ikona "tasks" */
    font-family: var(--icon-font, "Font Awesome 6 Pro");
    font-weight: 900;
    position: absolute;
    font-size: 450px;
    color: rgba(79, 185, 173, 0.05);
    top: 50%;
    right: -100px;
    transform: translateY(-50%) rotate(15deg);
    line-height: 1;
}

.sp-service-hero-subtitle {
    font-weight: 700;
    color: var(--primary-teal, #4fb9ad);
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.sp-service-hero-banner .display-4 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
    color: var(--white-color, #ffffff);
}

.sp-service-hero-banner .lead {
    font-size: 1.1rem;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    color: rgba(255, 255, 255, 0.85);
}

/* ---------------------------------- */
/* 2. Usługi - Główna Siatka Usług    */
/* ---------------------------------- */
.sp-service-grid-section {
    padding: 100px 0;
    background-color: var(--smoke-color, #f5f9f8);
}

.sp-service-card {
    background-color: var(--white-color, #ffffff);
    border-radius: 12px;
    border: 1px solid var(--border-color, #d8d5c8);
    padding: 40px;
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    box-shadow: 0 5px 25px rgba(33, 53, 67, 0.05);
}

.sp-service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(33, 53, 67, 0.1);
    border-color: var(--primary-teal, #4fb9ad);
}

.sp-service-card-icon {
    font-size: 48px;
    color: var(--primary-teal, #4fb9ad);
    margin-bottom: 25px;
    line-height: 1;
}

.sp-service-card-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--secondary-navy, #213543);
    margin-bottom: 15px;
}

.sp-service-card-text {
    color: var(--text-color2, #4a5568);
    font-size: 1rem;
    line-height: 1.7;
    margin-bottom: 25px;
    flex-grow: 1;
}

.sp-service-card-list {
    padding-left: 0;
    list-style: none;
    margin: 0;
    flex-grow: 1;
}

.sp-service-card-list li {
    position: relative;
    padding-left: 25px;
    margin-bottom: 10px;
}

.sp-service-card-list li::before {
    content: '\f058'; /* check-circle */
    font-family: var(--icon-font, "Font Awesome 6 Pro");
    font-weight: 400; /* Regular weight for a lighter icon */
    position: absolute;
    left: 0;
    top: 3px;
    color: var(--primary-teal, #4fb9ad);
}

.sp-service-card-link {
    font-weight: 700;
    color: var(--secondary-navy, #213543);
    text-decoration: none;
    display: inline-block;
    margin-top: auto; /* Push link to the bottom */
}

.sp-service-card-link i {
    transition: transform 0.3s ease;
    margin-left: 5px;
}

.sp-service-card:hover .sp-service-card-link i {
    transform: translateX(5px);
}

/* ---------------------------------- */
/* 3. Usługi - Sekcja "Dlaczego My"   */
/* ---------------------------------- */
.sp-service-why-us {
    padding: 100px 0;
    background-color: var(--white-color, #ffffff);
}

.sp-service-section-title .sp-service-subtitle {
    display: inline-block;
    font-weight: 700;
    color: var(--primary-teal, #4fb9ad);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.sp-service-section-title .sp-service-title-main {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    color: var(--secondary-navy, #213543);
    font-weight: 700;
}

.sp-service-feature-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
}

.sp-service-feature-icon {
    font-size: 24px;
    color: var(--primary-teal, #4fb9ad);
    margin-right: 20px;
    margin-top: 5px;
    width: 30px;
    text-align: center;
}

.sp-service-feature-body h5 {
    font-weight: 700;
    color: var(--secondary-navy, #213543);
}

.sp-service-cta-contact {
    border: 2px dashed var(--primary-teal, #4fb9ad);
    border-radius: 12px;
    padding: 30px;
    margin-top: 40px;
    text-align: center;
    background-color: var(--light-mint, #e8f7f5);
}
/* ==========================================================================
   SafePilot - Dodatkowe Sekcje dla Podstrony "Usługi" (Unikalne Style)
   Prefiksy: sp-process-, sp-parallax-, sp-testimonials-
   ========================================================================== */

/* ---------------------------------------------------- */
/* 1. Sekcja "Proces Współpracy"                        */
/* ---------------------------------------------------- */
.sp-process-section {
    padding: 100px 0;
    background-color: var(--white-color, #ffffff);
}

.sp-process-section-title {
    margin-bottom: 60px;
}

.sp-process-section-title .sp-process-subtitle {
    display: inline-block;
    font-weight: 700;
    color: var(--primary-teal, #4fb9ad);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.sp-process-section-title .sp-process-title-main {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    color: var(--secondary-navy, #213543);
    font-weight: 700;
}

.sp-process-step {
    position: relative;
    padding-left: 80px;
    margin-bottom: 40px;
}

.sp-process-step-number {
    position: absolute;
    left: 0;
    top: 0;
    font-size: 4rem;
    font-weight: 700;
    font-family: var(--title-font, "Rajdhani", sans-serif);
    color: var(--primary-teal, #4fb9ad);
    opacity: 0.2;
    line-height: 1;
}

.sp-process-step-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--secondary-navy, #213543);
    margin-bottom: 10px;
}

.sp-process-step-text {
    color: var(--text-color2, #4a5568);
    line-height: 1.7;
}

.sp-process-image-wrapper {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(33, 53, 67, 0.1);
    height: 100%;
    min-height: 400px;
}

.sp-process-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ---------------------------------------------------- */
/* 2. Sekcja Parallax                                   */
/* ---------------------------------------------------- */
.sp-parallax-wrapper {
    position: relative;
    padding: 150px 0;
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
    color: var(--white-color, #ffffff);
    z-index: 1;
}

.sp-parallax-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: var(--secondary-navy, #213543); /* Kolor #213543 */
    opacity: 0.8; /* Przyciemnienie na 80% */
    z-index: -1;
}

.sp-parallax-content {
    max-width: 800px;
    margin: 0 auto;
}

.sp-parallax-slogan {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-size: 3rem;
    font-weight: 700;
    line-height: 1.3;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

@media (max-width: 767px) {
    .sp-parallax-wrapper {
        background-attachment: scroll; /* Lepsza wydajność na mobilkach */
        padding: 100px 0;
    }
    .sp-parallax-slogan {
        font-size: 2.2rem;
    }
}

/* ---------------------------------------------------- */
/* 3. Sekcja Testimonials (Opinie Klientów)             */
/* ---------------------------------------------------- */
.sp-testimonials-section {
    padding: 100px 0;
    position: relative;
    overflow: hidden;
    /* Gradient w kolorach brandu */
    background: linear-gradient(135deg, var(--light-mint, #e8f7f5) 0%, var(--white-color, #ffffff) 100%);
}

.sp-testimonials-card {
    background-color: var(--white-color, #ffffff);
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(33, 53, 67, 0.08);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.sp-testimonials-quote-icon {
    font-size: 40px;
    color: var(--primary-teal, #4fb9ad);
    opacity: 0.3;
}

.sp-testimonials-text {
    font-style: italic;
    font-size: 1.1rem;
    line-height: 1.7;
    margin: 20px 0;
    color: var(--secondary-navy, #213543);
    flex-grow: 1;
}

.sp-testimonials-author {
    display: flex;
    align-items: center;
    margin-top: auto;
}

.sp-testimonials-author-avatar img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 15px;
}

.sp-testimonials-author-name {
    font-weight: 700;
    color: var(--secondary-navy, #213543);
    margin: 0;
}

.sp-testimonials-author-company {
    color: var(--text-color2, #4a5568);
    font-size: 0.9rem;
}

/* Style dla nawigacji Swiper.js */
.sp-testimonials-section .swiper-pagination-bullet {
    background-color: var(--primary-teal, #4fb9ad);
    opacity: 0.5;
    transition: all 0.3s ease;
}

.sp-testimonials-section .swiper-pagination-bullet-active {
    opacity: 1;
    transform: scale(1.2);
}
</style>

<main id="main" class="site-main" role="main">
<!-- 
==========================================================================
    SafePilot - Podstrona "Usługi" (Wersja z unikalnymi klasami CSS)
    Design premium by GitHub Copilot
========================================================================== 
-->

<!-- Sekcja Hero dla Usług -->
<section class="sp-service-hero-banner text-center">
    <div class="container position-relative">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <p class="sp-service-hero-subtitle mb-3" data-wow-delay=".2s">Kompleksowe Usługi</p>
                <h1 class="display-4 mb-4" data-wow-delay=".4s">BHP, PPOŻ i Pierwsza Pomoc</h1>
                <p class="lead" data-wow-delay=".6s">
                    Naszą misją jest prowadzenie firm przez dynamiczny świat przepisów z pełnym wsparciem i profesjonalizmem, zapewniając bezpieczeństwo bez zbędnych turbulencji.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Główna siatka usług -->
<section class="sp-service-grid-section">
    <div class="container padding-extech-shortcode-footer2">
        <div class="row g-4">

            <!-- Karta 1: Dokumentacja BHP -->
            <div class="col-lg-4 col-md-6 d-flex" data-wow-delay=".3s">
                <div class="sp-service-card">
                    <div class="sp-service-card-icon"><i class="fa-solid fa-file-signature"></i></div>
                    <h3 class="sp-service-card-title">Dokumentacja BHP</h3>
                    <p class="sp-service-card-text">Przygotowujemy i aktualizujemy pełen zakres dokumentacji, dostosowany do specyfiki działalności i zgodny z najnowszymi normami.</p>
                    <ul class="sp-service-card-list">
                        <li>Ocena Ryzyka Zawodowego (ORZ)</li>
                        <li>Instrukcje stanowiskowe i ogólne</li>
                        <li>Plany BIOZ i IBWR dla budownictwa</li>
                    </ul>
                    <a href="#" class="sp-service-card-link">Dowiedz się więcej <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Karta 2: Szkolenia BHP -->
            <div class="col-lg-4 col-md-6 d-flex" data-wow-delay=".4s">
                <div class="sp-service-card">
                    <div class="sp-service-card-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                    <h3 class="sp-service-card-title">Szkolenia BHP</h3>
                    <p class="sp-service-card-text">Prowadzimy profesjonalne szkolenia dla wszystkich grup zawodowych, wykorzystując nowoczesne i praktyczne metody nauczania.</p>
                    <ul class="sp-service-card-list">
                        <li>Szkolenia wstępne i okresowe</li>
                        <li>Praktyczne instruktaże stanowiskowe</li>
                        <li>Szkolenia online i stacjonarne</li>
                    </ul>
                    <a href="#" class="sp-service-card-link">Zobacz terminy <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Karta 3: Audyty i Nadzór BHP -->
            <div class="col-lg-4 col-md-6 d-flex" data-wow-delay=".5s">
                <div class="sp-service-card">
                    <div class="sp-service-card-icon"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                    <h3 class="sp-service-card-title">Audyty i Nadzór BHP</h3>
                    <p class="sp-service-card-text">Oferujemy stały nadzór nad bezpieczeństwem pracy, pozwalający na wczesne wykrycie nieprawidłowości i uniknięcie sankcji.</p>
                    <ul class="sp-service-card-list">
                        <li>Kontrole warunków pracy</li>
                        <li>Analizy wypadków i zdarzeń</li>
                        <li>Doradztwo w zakresie ergonomii</li>
                    </ul>
                    <a href="#" class="sp-service-card-link">Zamów audyt <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Karta 4: Dokumentacja PPOŻ -->
            <div class="col-lg-4 col-md-6 d-flex" data-wow-delay=".3s">
                <div class="sp-service-card">
                    <div class="sp-service-card-icon"><i class="fa-solid fa-file-shield"></i></div>
                    <h3 class="sp-service-card-title">Dokumentacja PPOŻ</h3>
                    <p class="sp-service-card-text">Opracowujemy kompletną dokumentację i wdrażamy skuteczne procedury PPOŻ, aby Twoja firma była gotowa na każdą ewentualność.</p>
                    <ul class="sp-service-card-list">
                        <li>Instrukcje Bezpieczeństwa Pożarowego (IBP)</li>
                        <li>Plany i oznakowanie dróg ewakuacyjnych</li>
                        <li>Procedury działań ratunkowych</li>
                    </ul>
                    <a href="#" class="sp-service-card-link">Szczegóły oferty <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Karta 5: Szkolenia PPOŻ -->
            <div class="col-lg-4 col-md-6 d-flex" data-wow-delay=".4s">
                <div class="sp-service-card">
                    <div class="sp-service-card-icon"><i class="fa-solid fa-fire-extinguisher"></i></div>
                    <h3 class="sp-service-card-title">Szkolenia i Ćwiczenia PPOŻ</h3>
                    <p class="sp-service-card-text">Praktyczne szkolenia uczą właściwego reagowania w sytuacjach zagrożenia. Organizujemy zajęcia teoretyczne i praktyczne.</p>
                     <ul class="sp-service-card-list">
                        <li>Szkolenia z ochrony przeciwpożarowej</li>
                        <li>Organizacja próbnych ewakuacji</li>
                        <li>Instruktaże użycia gaśnic i hydrantów</li>
                    </ul>
                    <a href="#" class="sp-service-card-link">Zapytaj o szkolenie <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Karta 6: Pierwsza Pomoc -->
            <div class="col-lg-4 col-md-6 d-flex" data-wow-delay=".5s">
                <div class="sp-service-card">
                    <div class="sp-service-card-icon"><i class="fa-solid fa-kit-medical"></i></div>
                    <h3 class="sp-service-card-title">Pierwsza Pomoc i RKO</h3>
                    <p class="sp-service-card-text">Prowadzimy szkolenia z pierwszej pomocy, ucząc umiejętności, które mogą uratować ludzkie życie w miejscu pracy i poza nim.</p>
                    <ul class="sp-service-card-list">
                        <li>Szkolenia z pierwszej pomocy przedmedycznej</li>
                        <li>Pokazy RKO z użyciem defibrylatora AED</li>
                        <li>Ćwiczenia praktyczne w różnych scenariuszach</li>
                    </ul>
                    <a href="#" class="sp-service-card-link">Poznaj program <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Sekcja "Dlaczego Warto" -->
<section class="sp-service-why-us margin-extech-shortcode-footer">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-wow-delay=".3s">
                <div class="sp-service-section-title mb-4">
                    <p class="sp-service-subtitle">ZAUFAJ SPECJALISTOM</p>
                    <h2 class="sp-service-title-main">Dlaczego warto wybrać SafePilot?</h2>
                </div>
                <p>Jako Twój przewodnik po świecie bezpieczeństwa pracy, pomagamy unikać turbulencji i działać bezpiecznie każdego dnia. Nasze podejście to gwarancja spokoju i pełnej zgodności z przepisami.</p>
                <div class="mt-4">
                    <div class="sp-service-feature-item">
                        <div class="sp-service-feature-icon"><i class="fa-solid fa-award"></i></div>
                        <div class="sp-service-feature-body">
                            <h5>Doświadczenie i Certyfikaty</h5>
                            <p class="mb-0">Nasz zespół to certyfikowani specjaliści z wieloletnim doświadczeniem w branży.</p>
                        </div>
                    </div>
                     <div class="sp-service-feature-item">
                        <div class="sp-service-feature-icon"><i class="fa-solid fa-sitemap"></i></div>
                        <div class="sp-service-feature-body">
                            <h5>Kompleksowa Obsługa</h5>
                            <p class="mb-0">Zapewniamy pełne wsparcie – od dokumentacji, przez szkolenia, po stały nadzór.</p>
                        </div>
                    </div>
                     <div class="sp-service-feature-item">
                        <div class="sp-service-feature-icon"><i class="fa-solid fa-handshake-simple"></i></div>
                        <div class="sp-service-feature-body">
                            <h5>Indywidualne Podejście</h5>
                            <p class="mb-0">Każdą ofertę i dokumentację dopasowujemy do unikalnych potrzeb Twojej firmy.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-wow-delay=".5s">
                <div class="sp-service-cta-contact">
                    <h3 class="mb-3">Gotowy na bezpieczny start?</h3>
                    <p class="lead mb-4" style="color: #000;">Skontaktuj się z nami już dziś i poznaj ofertę dopasowaną do Twojej firmy.</p>
                    <a href="tel:+48726739238" class="btn btn-primary btn-lg"><i class="fa-solid fa-phone me-2"></i>+48 726 739 238</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 
==========================================================================
    SafePilot - Dodatkowe Sekcje dla Podstrony "Usługi"
    Design premium by GitHub Copilot
========================================================================== 
-->

<!-- 
    SEKCJA 1: PROCES WSPÓŁPRACY
    Opis: Sekcja z dużą ilością tekstu pozycjonującego, przedstawiająca etapy współpracy.
-->
<section class="sp-process-section">
    <div class="container padding-extech-shortcode-footer2">
        <div class="sp-process-section-title text-center">
            <p class="sp-process-subtitle" data-wow-delay=".2s">JAK DZIAŁAMY?</p>
            <h2 class="sp-process-title-main" data-wow-delay=".4s">Nasz proces współpracy – od audytu po stały nadzór</h2>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6" data-wow-delay=".5s">
                <div class="sp-process-step">
                    <div class="sp-process-step-number">01</div>
                    <h3 class="sp-process-step-title">Analiza i Audyt Wstępny</h3>
                    <p class="sp-process-step-text">Każdą współpracę rozpoczynamy od dogłębnego zrozumienia specyfiki Twojej firmy. Przeprowadzamy kompleksowy audyt zerowy, podczas którego identyfikujemy istniejące zagrożenia, weryfikujemy zgodność z przepisami BHP i PPOŻ oraz oceniamy kompletność posiadanej dokumentacji. To kluczowy etap, który pozwala nam stworzyć precyzyjny plan działania, idealnie dopasowany do Twoich potrzeb.</p>
                </div>
                 <div class="sp-process-step">
                    <div class="sp-process-step-number">02</div>
                    <h3 class="sp-process-step-title">Opracowanie i Wdrożenie Rozwiązań</h3>
                    <p class="sp-process-step-text">Na podstawie audytu przygotowujemy i aktualizujemy niezbędną dokumentację, taką jak Ocena Ryzyka Zawodowego czy Instrukcja Bezpieczeństwa Pożarowego. Organizujemy dedykowane szkolenia dla pracowników i kadry kierowniczej, a także doradzamy w zakresie optymalizacji stanowisk pracy. Naszym celem jest nie tylko spełnienie wymogów prawa, ale realna poprawa standardów bezpieczeństwa.</p>
                </div>
                 <div class="sp-process-step">
                    <div class="sp-process-step-number">03</div>
                    <h3 class="sp-process-step-title">Stały Nadzór i Wsparcie</h3>
                    <p class="sp-process-step-text">Bezpieczeństwo to proces, a nie jednorazowe działanie. W ramach stałej umowy serwisowej przejmujemy rolę zewnętrznego działu BHP, zapewniając regularne kontrole, doradztwo, prowadzenie rejestrów oraz reprezentowanie Twojej firmy przed organami kontroli (PIP, Sanepid). Dzięki temu masz pewność, że Twoja firma jest zawsze bezpieczna i zgodna z dynamicznie zmieniającymi się przepisami.</p>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block" data-wow-delay=".6s">
                <div class="sp-process-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1554200876-56c2f25224fa?q=80&w=2835&auto=format&fit=crop" alt="Proces współpracy z klientem w biurze">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 
    SEKCJA 2: PARALLAX
    Opis: Sekcja z efektem parallax, przyciemnionym tłem i hasłem.
-->
<section 
    class="sp-parallax-wrapper" 
    style="background-image: url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=2940&auto=format&fit=crop');"
>
    <div class="container text-center" data-wow-delay=".3s">
        <div class="row">
            <div class="col-12">
                <div class="sp-parallax-content">
                    <h2 class="sp-parallax-slogan" style="color: #fff;">Twoje bezpieczeństwo, nasza misja. Bez kompromisów.</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 
    SEKCJA 3: OPINIE KLIENTÓW (SLIDER)
    Opis: Karuzela z opiniami klientów, budująca zaufanie.
-->
<section class="sp-testimonials-section">
    <div class="container">
        <div class="sp-process-section-title text-center">
            <p class="sp-process-subtitle" data-wow-delay=".2s">ZAUFALI NAM</p>
            <h2 class="sp-process-title-main" data-wow-delay=".4s">Co mówią nasi klienci?</h2>
        </div>

        <!-- Slider Swiper.js -->
        <div class="swiper sp-testimonials-slider" data-wow-delay=".5s">
            <div class="swiper-wrapper">
                
                <!-- Opinia 1 -->
                <div class="swiper-slide">
                    <div class="sp-testimonials-card">
                        <i class="fa-solid fa-quote-left sp-testimonials-quote-icon"></i>
                        <p class="sp-testimonials-text">"Współpraca z SafePilot to czysta przyjemność. Pełen profesjonalizm, błyskawiczne terminy i ogromna wiedza. Wreszcie mamy pewność, że nasza dokumentacja BHP jest w idealnym porządku. Polecam każdemu przedsiębiorcy!"</p>
                        <div class="sp-testimonials-author">
                            <div class="sp-testimonials-author-avatar"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Jan Kowalski"></div>
                            <div>
                                <h6 class="sp-testimonials-author-name">Jan Kowalski</h6>
                                <span class="sp-testimonials-author-company">CEO, BuildCorp S.A.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Opinia 2 -->
                <div class="swiper-slide">
                    <div class="sp-testimonials-card">
                        <i class="fa-solid fa-quote-left sp-testimonials-quote-icon"></i>
                        <p class="sp-testimonials-text">"Szkolenie z pierwszej pomocy przeprowadzone przez SafePilot było najlepszym, w jakim braliśmy udział. Praktyczne ćwiczenia, świetny instruktor i zero nudy. Nasi pracownicy czują się teraz znacznie pewniej."</p>
                        <div class="sp-testimonials-author">
                             <div class="sp-testimonials-author-avatar"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Anna Nowak"></div>
                            <div>
                                <h6 class="sp-testimonials-author-name">Anna Nowak</h6>
                                <span class="sp-testimonials-author-company">HR Manager, Creative Minds</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Opinia 3 -->
                <div class="swiper-slide">
                    <div class="sp-testimonials-card">
                        <i class="fa-solid fa-quote-left sp-testimonials-quote-icon"></i>
                        <p class="sp-testimonials-text">"Dzięki audytowi PPOŻ od SafePilot uniknęliśmy poważnych problemów podczas kontroli straży pożarnej. Wszystkie zalecenia były trafne i konkretne. Niezastąpione wsparcie!"</p>
                        <div class="sp-testimonials-author">
                             <div class="sp-testimonials-author-avatar"><img src="https://randomuser.me/api/portraits/men/51.jpg" alt="Piotr Wiśniewski"></div>
                            <div>
                                <h6 class="sp-testimonials-author-name">Piotr Wiśniewski</h6>
                                <span class="sp-testimonials-author-company">Właściciel, Magazyn Centralny</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <!-- Opinia 4 (można dodać więcej) -->
                <div class="swiper-slide">
                    <div class="sp-testimonials-card">
                        <i class="fa-solid fa-quote-left sp-testimonials-quote-icon"></i>
                        <p class="sp-testimonials-text">"Stały nadzór BHP to usługa warta każdej złotówki. Mamy spokój ducha i możemy skupić się na rozwoju biznesu, wiedząc, że specjaliści z SafePilot czuwają nad wszystkim."</p>
                        <div class="sp-testimonials-author">
                             <div class="sp-testimonials-author-avatar"><img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Katarzyna Wójcik"></div>
                            <div>
                                <h6 class="sp-testimonials-author-name">Katarzyna Wójcik</h6>
                                <span class="sp-testimonials-author-company">Dyrektor Operacyjny, InnoTech</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Paginacja slidera -->
            <div class="swiper-pagination mt-4"></div>
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

<script>
    // Inicjalizacja slidera opinii dla SafePilot
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper !== 'undefined') {
            const testimonialsSlider = new Swiper('.sp-testimonials-slider', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                slidesPerView: 1,
                spaceBetween: 30,
                breakpoints: {
                    768: { slidesPerView: 2, spaceBetween: 30 },
                    992: { slidesPerView: 3, spaceBetween: 30 }
                }
            });
        }
    });
</script>

<?php
get_footer(); // Wczytuje plik footer.php