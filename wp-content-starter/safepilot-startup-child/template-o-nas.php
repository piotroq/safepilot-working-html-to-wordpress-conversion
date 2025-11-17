<?php
/**
 * Template Name: Szablon Strony - O Nas (SafePilot)
 *
 * @package safepilot-startup-child
 */

get_header(); // Wczytuje plik header.php
?>

<style>
/* ==========================================================================
   SafePilot - Unikalne Style dla Podstrony "O Nas"
   Prefiks: sp-about-
   ========================================================================== */

/* ---------------------------------- */
/* 1. Banner Hero                     */
/* ---------------------------------- */
.sp-about-hero-banner {
    background-color: var(--secondary-navy, #213543);
    color: var(--white-color, #ffffff);
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
}

.sp-about-hero-banner .sp-about-subtitle {
    font-weight: 700;
    color: var(--primary-teal, #4fb9ad);
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.sp-about-hero-banner .display-4 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
}

.sp-about-hero-banner .lead {
    font-size: 1.1rem;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    color: rgba(255, 255, 255, 0.85);
}

.sp-about-hero-banner::before,
.sp-about-hero-banner::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(79, 185, 173, 0.07), transparent 70%);
    animation: sp-about-pulse 10s infinite ease-in-out;
}

.sp-about-hero-banner::before {
    top: -40%;
    left: -15%;
    width: 500px;
    height: 500px;
}

.sp-about-hero-banner::after {
    bottom: -50%;
    right: -15%;
    width: 600px;
    height: 600px;
    animation-delay: -5s;
}

@keyframes sp-about-pulse {
    50% { transform: scale(1.1); }
}

/* ---------------------------------- */
/* 2. Filozofia i Misja               */
/* ---------------------------------- */
.sp-about-philosophy .sp-about-card {
    background-color: var(--white-color, #ffffff);
    border: 1px solid var(--border-color, #d8d5c8);
    border-radius: 12px;
    padding: 30px;
    text-align: center;
    transition: all 0.3s ease-in-out;
    height: 100%;
}

.sp-about-philosophy .sp-about-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--box-shadow-2, 0px 4px 25px rgba(79, 185, 173, 0.12));
    border-color: var(--primary-teal, #4fb9ad);
}

.sp-about-philosophy .sp-about-card .icon {
    font-size: 48px;
    color: var(--primary-teal, #4fb9ad);
    margin-bottom: 20px;
    line-height: 1;
    transition: all 0.3s ease-in-out;
}

.sp-about-philosophy .sp-about-card:hover .icon {
    transform: scale(1.1) rotate(-5deg);
}

.sp-about-mission-block {
    background-color: var(--light-mint, #e8f7f5);
    color: var(--secondary-navy, #213543);
    border-radius: 15px;
    padding: 50px;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(79, 185, 173, 0.2);
}

.sp-about-mission-block .icon {
    font-size: 60px;
    color: var(--primary-teal, #4fb9ad);
    position: absolute;
    top: 30px;
    right: 40px;
    opacity: 0.2;
    transform: rotate(-15deg);
}

/* ---------------------------------- */
/* 3. Wyróżniki (Co nas wyróżnia)     */
/* ---------------------------------- */
.sp-about-distinction {
    background-color: var(--smoke-color, #f5f9f8);
}

.sp-about-distinction .sp-about-feature {
    display: flex;
    align-items: flex-start;
}

.sp-about-distinction .sp-about-feature .icon {
    font-size: 24px;
    color: var(--primary-teal, #4fb9ad);
    margin-right: 20px;
    margin-top: 5px;
    flex-shrink: 0;
    width: 30px;
    text-align: center;
}

.sp-about-distinction .sp-about-feature-body h5 {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--secondary-navy, #213543);
}

.sp-about-image-container {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    height: 100%;
    min-height: 400px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.sp-about-image-container img {
    object-fit: cover;
    height: 100%;
    width: 100%;
    transition: transform 0.4s ease;
}

.sp-about-image-container:hover img {
    transform: scale(1.05);
}

.sp-about-image-container::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(33, 53, 67, 0.6), transparent 60%);
}

/* ---------------------------------- */
/* 4. Specjalizacje                   */
/* ---------------------------------- */
.sp-about-specialties .nav-pills .nav-link {
    background-color: transparent;
    color: var(--text-color, #213543);
    border: 2px solid var(--border-color, #d8d5c8);
    border-radius: 50px;
    margin: 0 5px 10px;
    font-weight: 600;
    transition: all 0.3s ease;
    padding: 10px 25px;
}

.sp-about-specialties .nav-pills .nav-link.active,
.sp-about-specialties .nav-pills .nav-link:hover {
    background-color: var(--secondary-navy, #213543);
    color: var(--white-color, #ffffff);
    border-color: var(--secondary-navy, #213543);
}

.sp-about-specialties .tab-pane h3 {
    color: var(--secondary-navy, #213543);
    font-weight: 700;
}

.sp-about-list {
    list-style: none;
    padding-left: 0;
}

.sp-about-list li {
    position: relative;
    padding-left: 30px;
    margin-bottom: 12px;
}

.sp-about-list li::before {
    content: '\f058'; /* Font Awesome check-circle icon */
    font-family: var(--icon-font, "Font Awesome 6 Pro");
    font-weight: 900;
    position: absolute;
    left: 0;
    top: 2px;
    color: var(--primary-teal, #4fb9ad);
}

.sp-about-specialties .tab-content {
    min-height: 250px; /* Zapewnia spójną wysokość podczas przełączania */
}

/* ---------------------------------- */
/* 5. Wartości                        */
/* ---------------------------------- */
.sp-about-values {
    background-color: var(--smoke-color, #f5f9f8);
}

.sp-about-value-card {
    background-color: var(--white-color, #ffffff);
    border-radius: 12px;
    padding: 35px;
    height: 100%;
    transition: all 0.3s ease;
    border: 1px solid var(--border-color, #d8d5c8);
    border-bottom: 4px solid var(--primary-teal, #4fb9ad);
}

.sp-about-value-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(33, 53, 67, 0.08);
}

.sp-about-value-card .icon {
    font-size: 40px;
    color: var(--secondary-navy, #213543);
    margin-bottom: 15px;
}

/* ---------------------------------- */
/* 6. CTA (Call To Action)            */
/* ---------------------------------- */
.sp-about-cta {
    background-image: linear-gradient(45deg, var(--secondary-navy, #213543), var(--tertiary-dark, #19222a));
    color: var(--white-color, #ffffff);
}

.sp-about-cta h2 {
    color: var(--white-color, #ffffff);
}

.sp-about-cta .btn-primary {
    background-color: var(--primary-teal, #4fb9ad);
    border-color: var(--primary-teal, #4fb9ad);
    color: var(--secondary-navy, #213543);
    padding: 12px 30px;
    font-weight: 700;
}

.sp-about-cta .btn-primary:hover {
    background-color: var(--hover-teal, #41857d);
    border-color: var(--hover-teal, #41857d);
}

.sp-about-cta .btn-outline-light {
    padding: 12px 30px;
    font-weight: 700;
    border-width: 2px;
}
.sp-about-cta .btn-outline-light:hover {
    background-color: var(--white-color, #ffffff);
    color: var(--secondary-navy, #213543);
}

/* ---------------------------------- */
/* Generyczne Tytuły Sekcji           */
/* ---------------------------------- */
.sp-about-section-title {
    margin-bottom: 60px;
}

.sp-about-section-title .sp-about-subtitle {
    display: inline-block;
    font-weight: 700;
    color: var(--primary-teal, #4fb9ad);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.sp-about-section-title .sp-about-title-main {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    color: var(--secondary-navy, #213543);
    font-weight: 700;
}
/* ==========================================================================
   SafePilot - Unikalne Style dla Sekcji Parallax
   Prefiks: sp-parallax-
   ========================================================================== */

.sp-parallax-section {
    position: relative;
    padding: 140px 0;
    background-size: cover;
    background-position: center;
    background-attachment: fixed; /* Kluczowa właściwość dla efektu parallax */
    color: var(--white-color, #ffffff);
    z-index: 1;
}

/* Nakładka z filtrem koloru */
.sp-parallax-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(33, 53, 67, 0.75); /* Nakładka z koloru --secondary-navy z 75% przezroczystością */
    z-index: -1;
}

.sp-parallax-content {
    max-width: 800px;
    margin: 0 auto;
    background-color: rgba(0, 0, 0, 0.2); /* Lekkie tło dla lepszej czytelności */
    padding: 40px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(5px); /* Efekt "oszronionego szkła" dla nowoczesnego wyglądu */
    -webkit-backdrop-filter: blur(5px);
}

.sp-parallax-icon {
    font-size: 48px;
    color: var(--primary-teal, #4fb9ad);
    margin-bottom: 20px;
    display: block;
    transition: transform 0.3s ease, color 0.3s ease;
}

.sp-parallax-content:hover .sp-parallax-icon {
    transform: translateY(-5px) scale(1.1);
    color: var(--white-color, #ffffff);
}

.sp-parallax-title {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
    color: var(--white-color, #ffffff);
    margin-bottom: 15px;
    font-size: 2.5rem;
}

.sp-parallax-text {
    font-size: 1.15rem;
    line-height: 1.7;
    color: rgba(255, 255, 255, 0.9);
}

/* Responsywność */
@media (max-width: 767px) {
    .sp-parallax-section {
        padding: 80px 0;
        /* Wyłączenie efektu parallax na mobilnych urządzeniach dla lepszej wydajności */
        background-attachment: scroll; 
    }

    .sp-parallax-content {
        padding: 30px;
    }

    .sp-parallax-title {
        font-size: 2rem;
    }

    .sp-parallax-text {
        font-size: 1rem;
    }
}
</style>

<main id="main" class="site-main" role="main">
<!-- 
==========================================================================
    SafePilot - Strona "O Nas" (Wersja z unikalnymi klasami CSS)
    Design premium by GitHub Copilot
========================================================================== 
-->

<!-- Banner Hero -->
<section class="sp-about-hero-banner text-center">
    <div class="container position-relative">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <p class="sp-about-subtitle mb-3" data-wow-delay=".2s">O NAS – SAFEPILOT BHP I PPOŻ KRAKÓW</p>
                <h1 class="display-4 mb-4" data-wow-delay=".4s">Twój przewodnik po bezpiecznej pracy.<br>Bez zbędnych turbulencji!</h1>
                <p class="lead" data-wow-delay=".6s">
                    SafePilot to zespół ekspertów z zakresu BHP, ochrony przeciwpożarowej i pierwszej pomocy, którzy od lat wspierają polskie firmy w tworzeniu bezpiecznych i zgodnych z prawem miejsc pracy.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Nasza Filozofia i Misja -->
<section class="sp-about-philosophy section-padding margin-extech-shortcode-footer">
    <div class="container">
        <div class="sp-about-section-title text-center">
            <p class="sp-about-subtitle" data-wow-delay=".2s">DLACZEGO SAFEPILOT?</p>
            <h2 class="sp-about-title-main" data-wow-delay=".4s">Prowadzimy Twoją firmę przez skomplikowany świat przepisów</h2>
            <p class="lead mt-3 mx-auto" style="max-width: 700px;" data-wow-delay=".6s">Z nami możesz skupić się na rozwoju biznesu, mając pewność, że bezpieczeństwo jest pod pełną kontrolą.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6" data-wow-delay=".3s">
                <div class="sp-about-card">
                    <div class="icon"><i class="fa-solid fa-graduation-cap"></i></div>
                    <h4 class="mb-2">Edukacja</h4>
                    <p>Uczymy, jak działać odpowiedzialnie i reagować właściwie w sytuacjach zagrożenia.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-wow-delay=".5s">
                <div class="sp-about-card">
                    <div class="icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <h4 class="mb-2">Prewencja</h4>
                    <p>Analizujemy i eliminujemy ryzyka, zanim spowodują problemy i niepotrzebne koszty.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-wow-delay=".7s">
                <div class="sp-about-card">
                    <div class="icon"><i class="fa-solid fa-handshake-angle"></i></div>
                    <h4 class="mb-2">Współpraca</h4>
                    <p>Wspieramy pracodawców na każdym etapie, budując partnerskie i długotrwałe relacje.</p>
                </div>
            </div>
        </div>

        <div class="row mt-5 pt-4">
            <div class="col-12" data-wow-delay=".5s">
                <div class="sp-about-mission-block">
                    <div class="icon"><i class="fa-solid fa-rocket"></i></div>
                    <h3>Nazwa <b>SafePilot</b> to połączenie dwóch kluczowych idei, które definiują naszą misję i sposób działania:</h3>
                    <p><b>"Safe"</b> – bezpieczeństwo, które stanowi fundament każdej świadczonej przez nas usługi. To nie tylko zgodność z przepisami, ale przede wszystkim świadome i odpowiedzialne podejście do ochrony życia,zdrowia i zasobów.</p>
                    <p><b>"Pilot"</b> – symbol kompetentnego przewodnika, który zna trasę, rozumie warunki i potrafi bezpiecznie doprowadzić do celu. Właśnie tak widzimy naszą rolę: prowadzimy firmy przez dynamiczny i często złożony świat przepisów BHP, PPOŻ i organizacji pracy.</p>
                    <p><b>"SafePilot"</b> - tonie tylko nazwa – to deklaracja. Działamy jak nowoczesny pilot: z wiedzą, spokojem i pewnością – eliminując zbędne turbulencje, zanim się pojawią.</p>
                    
                    <h3 class="mt-5"><b>SafePilot – bez zbędnych turbulencji</b></h3>
                    <p>Bezpieczeństwo w pracy to nie przypadek. To efekt przemyślanego planu, wiedzy i doświadczenia.</p>
                    <p>Z nami zyskujesz **spokój, kontrolę i pewność**, że Twoja firma spełnia wszystkie wymogi BHP i PPOŻ.</p>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo do_shortcode('[contact-cta3]'); ?>

<!-- Co nas wyróżnia? -->
<section class="sp-about-distinction section-padding padding-extech-shortcode-footer2">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="sp-about-section-title mb-4">
                    <p class="sp-about-subtitle" data-wow-delay=".2s">NASZE ATUTY</p>
                    <h2 class="sp-about-title-main" data-wow-delay=".4s">Doświadczenie i Nowoczesne Podejście</h2>
                </div>
                <div data-wow-delay=".5s">
                    <div class="sp-about-feature mb-4">
                        <div class="icon"><i class="fa-solid fa-medal"></i></div>
                        <div class="sp-about-feature-body">
                            <h5>Wieloletnie doświadczenie w branży</h5>
                            <p class="mb-0">Gwarancja rzetelnej wiedzy i sprawdzonych rozwiązań.</p>
                        </div>
                    </div>
                    <div class="sp-about-feature mb-4">
                        <div class="icon"><i class="fa-solid fa-puzzle-piece"></i></div>
                        <div class="sp-about-feature-body">
                            <h5>Kompleksowa obsługa</h5>
                            <p class="mb-0">Od audytów, przez dokumentację, aż po szkolenia i nadzór.</p>
                        </div>
                    </div>
                    <div class="sp-about-feature mb-4">
                        <div class="icon"><i class="fa-solid fa-laptop-code"></i></div>
                        <div class="sp-about-feature-body">
                            <h5>Nowoczesne podejście</h5>
                            <p class="mb-0">Cyfrowe raporty, szkolenia online i czytelna komunikacja.</p>
                        </div>
                    </div>
                     <div class="sp-about-feature">
                        <div class="icon"><i class="fa-solid fa-arrows-up-down-left-right"></i></div>
                        <div class="sp-about-feature-body">
                            <h5>Mobilność i elastyczność</h5>
                            <p class="mb-0">Działamy na terenie całego kraju, dopasowując się do Twoich potrzeb.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-wow-delay=".6s">
                <div class="sp-about-image-container">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2832&auto=format&fit=crop" alt="Zespół ekspertów SafePilot podczas spotkania">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nasze Specjalizacje -->
<section class="sp-about-specialties section-padding margin-extech-shortcode-footer">
    <div class="container">
        <div class="sp-about-section-title text-center">
            <p class="sp-about-subtitle" data-wow-delay=".2s">NASZE SPECJALIZACJE</p>
            <h2 class="sp-about-title-main" data-wow-delay=".4s">Kompleksowe wsparcie dla Twojej firmy</h2>
        </div>

        <div class="d-flex justify-content-center flex-wrap" data-wow-delay=".5s">
            <ul class="nav nav-pills mb-4" id="sp-specialization-tabs" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" id="sp-bhp-doc-tab" data-bs-toggle="pill" data-bs-target="#sp-bhp-doc" type="button" role="tab">Dokumentacja BHP</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="sp-bhp-training-tab" data-bs-toggle="pill" data-bs-target="#sp-bhp-training" type="button" role="tab">Szkolenia BHP</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="sp-ppoz-doc-tab" data-bs-toggle="pill" data-bs-target="#sp-ppoz-doc" type="button" role="tab">Dokumentacja PPOŻ</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="sp-ppoz-training-tab" data-bs-toggle="pill" data-bs-target="#sp-ppoz-training" type="button" role="tab">Szkolenia PPOŻ i 1 Pomoc</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" id="sp-audits-tab" data-bs-toggle="pill" data-bs-target="#sp-audits" type="button" role="tab">Audyty i Nadzór</button></li>
            </ul>
        </div>

        <div class="tab-content pt-4" id="sp-specialization-tabs-content">
            <div class="tab-pane fade show active" id="sp-bhp-doc" role="tabpanel" data-wow-delay=".6s">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <h3><i class="fa-solid fa-file-signature me-2 text-primary"></i>Dokumentacja BHP</h3>
                        <p>Zapewniamy dokumentację zgodną z aktualnymi przepisami oraz indywidualnie dopasowaną do potrzeb Twojego zakładu pracy.</p>
                        <ul class="sp-about-list">
                            <li>Ocena Ryzyka Zawodowego (ORZ)</li>
                            <li>Instrukcje stanowiskowe i ogólne BHP</li>
                            <li>Plany BIOZ i Instrukcje Bezpiecznego Wykonywania Robót (IBWR)</li>
                            <li>Dokumentacja powypadkowa i wymagane rejestry</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-center d-none d-lg-block"><img src="https://images.unsplash.com/photo-1586985564230-da06979639b5?q=80&w=2940&auto=format&fit=crop" alt="Dokumentacja BHP" class="img-fluid rounded-3 shadow"></div>
                </div>
            </div>
            <div class="tab-pane fade" id="sp-bhp-training" role="tabpanel">
                <div class="row align-items-center g-4">
                     <div class="col-lg-6">
                        <h3><i class="fa-solid fa-chalkboard-user me-2 text-primary"></i>Szkolenia BHP</h3>
                        <p>Wykorzystujemy praktyczne metody i nowoczesne materiały, które zwiększają zaangażowanie uczestników i efektywność nauki.</p>
                        <ul class="sp-about-list">
                            <li>Szkolenia wstępne i okresowe dla wszystkich grup zawodowych</li>
                            <li>Praktyczne instruktaże stanowiskowe</li>
                            <li>Szkolenia dedykowane dla kadry kierowniczej i pracodawców</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-center d-none d-lg-block"><img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2940&auto=format&fit=crop" alt="Szkolenia BHP" class="img-fluid rounded-3 shadow"></div>
                </div>
            </div>
            <div class="tab-pane fade" id="sp-ppoz-doc" role="tabpanel">
                <div class="row align-items-center g-4">
                     <div class="col-lg-6">
                        <h3><i class="fa-solid fa-file-shield me-2 text-primary"></i>Dokumentacja i Procedury PPOŻ</h3>
                        <p>Z nami Twoja firma będzie w pełni przygotowana na sytuacje awaryjne, zgodnie z wymogami ochrony przeciwpożarowej.</p>
                        <ul class="sp-about-list">
                            <li>Instrukcje Bezpieczeństwa Pożarowego (IBP)</li>
                            <li>Opracowanie i aktualizacja planów ewakuacyjnych</li>
                            <li>Prawidłowe oznakowanie dróg ewakuacyjnych i sprzętu</li>
                            <li>Tworzenie procedur postępowania w razie pożaru</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-center d-none d-lg-block"><img src="https://images.unsplash.com/photo-1603400538620-3b83597647f3?q=80&w=2940&auto=format&fit=crop" alt="Dokumentacja PPOŻ" class="img-fluid rounded-3 shadow"></div>
                </div>
            </div>
            <div class="tab-pane fade" id="sp-ppoz-training" role="tabpanel">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <h3><i class="fa-solid fa-heart-pulse me-2 text-primary"></i>Szkolenia PPOŻ i Pierwszej Pomocy</h3>
                        <p>Wszystkie szkolenia są praktyczne, interaktywne i zgodne z obowiązującymi wymogami, prowadzone przez doświadczonych instruktorów.</p>
                        <ul class="sp-about-list">
                            <li>Praktyczne szkolenia z ochrony przeciwpożarowej</li>
                            <li>Organizacja i nadzór nad próbnymi ewakuacjami</li>
                            <li>Pokazy użycia gaśnic, hydrantów i innego sprzętu PPOŻ</li>
                            <li>Szkolenia z pierwszej pomocy z użyciem fantomów i AED</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-center d-none d-lg-block"><img src="https://images.unsplash.com/photo-1628186572183-8a39625a4537?q=80&w=2938&auto=format&fit=crop" alt="Szkolenia z pierwszej pomocy" class="img-fluid rounded-3 shadow"></div>
                </div>
            </div>
            <div class="tab-pane fade" id="sp-audits" role="tabpanel">
                <div class="row align-items-center g-4">
                     <div class="col-lg-6">
                        <h3><i class="fa-solid fa-magnifying-glass-chart me-2 text-primary"></i>Audyty i Nadzór BHP</h3>
                        <p>Dzięki naszym audytom możesz uniknąć kosztownych błędów, kar i zapewnić pracownikom bezpieczne środowisko pracy.</p>
                        <ul class="sp-about-list">
                            <li>Audyty zgodności z przepisami i normami</li>
                            <li>Okresowe kontrole warunków pracy</li>
                            <li>Analiza i optymalizacja ergonomii na stanowiskach</li>
                            <li>Analiza wypadków i zdarzeń potencjalnie wypadkowych</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-center d-none d-lg-block"><img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2940&auto=format&fit=crop" alt="Audyt BHP" class="img-fluid rounded-3 shadow"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nasze Wartości -->
<section class="sp-about-values section-padding padding-extech-shortcode-footer2">
    <div class="container">
        <div class="sp-about-section-title text-center">
            <p class="sp-about-subtitle" data-wow-delay=".2s">FUNDAMENTY NASZEJ PRACY</p>
            <h2 class="sp-about-title-main" data-wow-delay=".4s">Wartości, którymi się kierujemy</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-wow-delay=".3s">
                <div class="sp-about-value-card text-center">
                    <div class="icon"><i class="fa-solid fa-gem"></i></div>
                    <h5>Rzetelność</h5>
                    <p>Każde zadanie realizujemy zgodnie z normami i z pełnym zaangażowaniem.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-wow-delay=".5s">
                <div class="sp-about-value-card text-center">
                    <div class="icon"><i class="fa-solid fa-user-tie"></i></div>
                    <h5>Profesjonalizm</h5>
                    <p>Pracujemy z pasją i wiedzą, stale się rozwijając, aby oferować usługi na najwyższym poziomie.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-wow-delay=".7s">
                <div class="sp-about-value-card text-center">
                    <div class="icon"><i class="fa-solid fa-eye"></i></div>
                    <h5>Transparentność</h5>
                    <p>Zapewniamy jasne zasady współpracy, uczciwe doradztwo i klarowną komunikację.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-wow-delay=".9s">
                <div class="sp-about-value-card text-center">
                    <div class="icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                    <h5>Bezpieczeństwo</h5>
                    <p>To nie tylko nasza praca, ale misja, którą z dumą realizujemy każdego dnia.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 
==========================================================================
    SafePilot - Sekcja Parallax "O Nas"
    Design premium by GitHub Copilot
========================================================================== 
-->
<section 
    class="sp-parallax-section" 
    style="background-image: url('https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=2940&auto=format&fit=crop');"
    data-wow-delay=".3s">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="sp-parallax-content">
                    <h2 class="sp-parallax-title">
                        Więcej niż przepisy. Partnerstwo w kulturze bezpieczeństwa.
                    </h2>
                    <p class="sp-parallax-text">
                        W SafePilot rozumiemy, że prawdziwe bezpieczeństwo to nie tylko zgodność z dokumentami. To świadomość, odpowiedzialność i zaufanie. Dlatego budujemy z naszymi Klientami trwałe relacje, oparte na wspólnym celu: tworzeniu miejsc pracy, do których pracownicy przychodzą z poczuciem spokoju i pewności. Jesteśmy Twoim partnerem na każdym etapie tej drogi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Wezwanie do działania (CTA) -->
<section class="sp-about-cta section-padding">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="sp-about-section-title">
                    <h2 class="sp-about-title-main text-white" data-wow-delay=".3s">Porozmawiajmy o bezpieczeństwie w Twojej firmie</h2>
                    <p class="lead mt-3" data-wow-delay=".5s">Z nami zyskujesz spokój, kontrolę i pewność, że Twoja firma spełnia wszystkie wymogi BHP i PPOŻ.</p>
                </div>
                <div class="mt-4" data-wow-delay=".7s">
                    <a href="tel:+48726739238" class="btn btn-primary btn-lg me-md-3 mb-3 mb-md-0"><i class="fa-solid fa-phone me-2"></i> Zadzwoń: +48 726 739 238</a>
                    <a href="mailto:biuro@safepilot.pl" class="btn btn-outline-light btn-lg"><i class="fa-solid fa-envelope me-2"></i> Napisz do nas</a>
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