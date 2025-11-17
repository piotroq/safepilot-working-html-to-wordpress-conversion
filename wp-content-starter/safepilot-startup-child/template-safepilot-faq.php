<?php
/**
 * Template Name: Szablon - FAQ & Pytania
 *
 * @package safepilot-startup-child
 */

get_header(); // Wczytuje plik header.php
?>

<style>
/* ==========================================================================
   SafePilot - Unikalne Style dla Podstrony "FAQ & Pytania"
   Prefiks: sp-faq-
   ========================================================================== */

/* ---------------------------------- */
/* 1. FAQ - Banner Hero               */
/* ---------------------------------- */
.sp-faq-hero-banner {
    background-color: var(--secondary-navy, #213543);
    color: var(--white-color, #ffffff);
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}

.sp-faq-hero-banner::before {
    content: '\f059'; /* Ikona koła z pytajnikiem */
    font-family: var(--icon-font, "Font Awesome 6 Pro");
    font-weight: 900;
    position: absolute;
    font-size: 400px;
    color: rgba(79, 185, 173, 0.05); /* --primary-teal z niską przezroczystością */
    top: 50%;
    left: -80px;
    transform: translateY(-50%) rotate(-15deg);
    line-height: 1;
}

.sp-faq-hero-subtitle {
    font-weight: 700;
    color: var(--primary-teal, #4fb9ad);
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.sp-faq-hero-banner .display-4 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
    color: var(--white-color, #ffffff);
}

.sp-faq-hero-banner .lead {
    font-size: 1.1rem;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    color: rgba(255, 255, 255, 0.85);
}

/* ---------------------------------- */
/* 2. FAQ - Sekcja z Akordeonem       */
/* ---------------------------------- */
.sp-faq-section {
    background-color: var(--smoke-color, #f5f9f8);
    padding: 100px 0;
}

.sp-faq-section-title .sp-faq-subtitle {
    display: inline-block;
    font-weight: 700;
    color: var(--primary-teal, #4fb9ad);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.sp-faq-section-title .sp-faq-title-main {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    color: var(--secondary-navy, #213543);
    font-weight: 700;
}

.sp-faq-accordion .accordion-item {
    border: 1px solid var(--border-color, #d8d5c8);
    border-radius: 8px !important; /* Ważne, żeby nadpisać style bootstrapa */
    margin-bottom: 15px;
    overflow: hidden;
    background-color: var(--white-color, #ffffff);
    box-shadow: 0 2px 15px rgba(33, 53, 67, 0.04);
    transition: all 0.3s ease;
}

.sp-faq-accordion .accordion-item:hover {
    box-shadow: 0 8px 25px rgba(33, 53, 67, 0.08);
    transform: translateY(-3px);
}

.sp-faq-accordion .accordion-header {
    margin: 0;
}

.sp-faq-accordion .accordion-button {
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--secondary-navy, #213543);
    background-color: var(--white-color, #ffffff);
    padding: 20px 25px;
    text-align: left;
    border: none;
    box-shadow: none;
}

.sp-faq-accordion .accordion-button:not(.collapsed) {
    background-color: var(--light-mint, #e8f7f5);
    color: var(--secondary-navy, #213543);
    box-shadow: inset 0 -1px 0 var(--border-color, #d8d5c8);
}

/* Customowa ikona strzałki */
.sp-faq-accordion .accordion-button::after {
    background-image: none; /* Usuwamy domyślną strzałkę bootstrapa */
    content: '\f078'; /* Strzałka w dół z Font Awesome */
    font-family: var(--icon-font, "Font Awesome 6 Pro");
    font-weight: 900;
    transform: rotate(0deg);
    transition: transform 0.3s ease;
}

.sp-faq-accordion .accordion-button:not(.collapsed)::after {
    transform: rotate(-180deg);
}

.sp-faq-accordion .accordion-body {
    padding: 25px;
    font-size: 1rem;
    line-height: 1.7;
}

.sp-faq-accordion .accordion-body ul {
    padding-left: 20px;
    margin-top: 15px;
}

.sp-faq-accordion .accordion-body ul li {
    margin-bottom: 8px;
}

/* ---------------------------------- */
/* 3. FAQ - Sekcja CTA                */
/* ---------------------------------- */
.sp-faq-cta-block {
    background-color: var(--tertiary-dark, #19222a);
    color: var(--white-color, #ffffff);
    padding: 80px 40px;
    border-radius: 15px;
    text-align: center;
}

.sp-faq-cta-block .sp-faq-title-main {
    color: var(--white-color, #ffffff);
}

.sp-faq-cta-block .lead {
    color: rgba(255, 255, 255, 0.8);
    max-width: 600px;
    margin: 15px auto 30px;
}

.sp-faq-cta-block .btn {
    padding: 12px 30px;
    font-weight: 700;
}
/* ==========================================================================
   SafePilot - Unikalne Style dla Sekcji "Inwestycja w Bezpieczeństwo"
   Prefiks: sp-invest-
   ========================================================================== */

.sp-invest-section {
    padding: 100px 0;
    background-color: var(--white-color, #ffffff);
    position: relative;
}

.sp-invest-section-title .sp-invest-subtitle {
    display: inline-block;
    font-weight: 700;
    color: var(--primary-teal, #4fb9ad);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.sp-invest-section-title .sp-invest-title-main {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    color: var(--secondary-navy, #213543);
    font-weight: 700;
}

.sp-invest-row {
    align-items: center;
    margin-bottom: 80px;
}
.sp-invest-row:last-child {
    margin-bottom: 0;
}

.sp-invest-image-wrapper {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(33, 53, 67, 0.1);
    height: 100%;
}

.sp-invest-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease-in-out;
}

.sp-invest-image-wrapper:hover img {
    transform: scale(1.05);
}

.sp-invest-content-wrapper {
    padding: 0 30px;
}

.sp-invest-icon {
    font-size: 40px;
    color: var(--primary-teal, #4fb9ad);
    margin-bottom: 20px;
    display: inline-block;
}

.sp-invest-content-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--secondary-navy, #213543);
    margin-bottom: 15px;
}

.sp-invest-content-text {
    color: var(--text-color2, #4a5568);
    line-height: 1.8;
}

/* Responsywność */
@media (max-width: 991px) {
    .sp-invest-content-wrapper {
        padding: 0;
        margin-top: 30px;
    }
    .sp-invest-image-wrapper {
        min-height: 300px;
    }
}
</style>

<main id="main" class="site-main" role="main">
<!-- 
==========================================================================
    SafePilot - Podstrona "FAQ & Pytania" (Wersja z unikalnymi klasami CSS)
    Design premium by GitHub Copilot
========================================================================== 
-->

<!-- Sekcja Hero dla FAQ -->
<section class="sp-faq-hero-banner text-center">
    <div class="container position-relative">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <p class="sp-faq-hero-subtitle mb-3" data-wow-delay=".2s">FAQ & Pytania</p>
                <h1 class="display-4 mb-4" data-wow-delay=".4s">Najczęściej zadawane pytania</h1>
                <p class="lead" data-wow-delay=".6s">
                    Zebraliśmy tu wszystko, co przedsiębiorcy pytają najczęściej. Działamy bez zbędnych turbulencji, dostarczając jasnych i konkretnych odpowiedzi na temat BHP, PPOŻ i pierwszej pomocy.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Główna sekcja z pytaniami i odpowiedziami -->
<section class="sp-faq-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="sp-faq-section-title text-center mb-5">
                    <p class="sp-faq-subtitle" data-wow-delay=".2s">Twoja baza wiedzy</p>
                    <h2 class="sp-faq-title-main" data-wow-delay=".4s">Znajdź odpowiedzi, których szukasz</h2>
                </div>

                <div class="sp-faq-accordion accordion" id="safePilotFaqAccordion">

                    <!-- Pytanie 1 -->
                    <div class="accordion-item" data-wow-delay=".3s">
                        <h2 class="accordion-header" id="heading-1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                Jakie są podstawowe obowiązki pracodawcy w zakresie BHP?
                            </button>
                        </h2>
                        <div id="collapse-1" class="accordion-collapse collapse show" aria-labelledby="heading-1" data-bs-parent="#safePilotFaqAccordion">
                            <div class="accordion-body">
                                Pracodawca musi przede wszystkim zapewnić bezpieczne i higieniczne warunki pracy. Obejmuje to m.in.: organizację szkoleń BHP, dokonywanie oceny ryzyka zawodowego, dostarczanie środków ochrony indywidualnej, kierowanie na badania lekarskie oraz prowadzenie wymaganej dokumentacji. SafePilot przejmuje te obowiązki, prowadząc firmę krok po kroku.
                            </div>
                        </div>
                    </div>

                    <!-- Pytanie 2 -->
                    <div class="accordion-item" data-wow-delay=".4s">
                        <h2 class="accordion-header" id="heading-2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                Jak często należy wykonywać szkolenia okresowe BHP?
                            </button>
                        </h2>
                        <div id="collapse-2" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#safePilotFaqAccordion">
                            <div class="accordion-body">
                                Częstotliwość szkoleń okresowych zależy od rodzaju stanowiska:
                                <ul>
                                    <li>Pracownicy administracyjno-biurowi – co 6 lat.</li>
                                    <li>Kadra kierownicza i pracodawcy – co 5 lat.</li>
                                    <li>Pracownicy na stanowiskach robotniczych – co 3 lata (lub co roku przy pracach szczególnie niebezpiecznych).</li>
                                </ul>
                                Szkolenie wstępne jest obowiązkowe dla każdego nowego pracownika przed dopuszczeniem do pracy.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pytanie 3 -->
                    <div class="accordion-item" data-wow-delay=".5s">
                        <h2 class="accordion-header" id="heading-3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                Czy SafePilot wykonuje dokumentację PPOŻ, taką jak Instrukcja Bezpieczeństwa Pożarowego?
                            </button>
                        </h2>
                        <div id="collapse-3" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#safePilotFaqAccordion">
                            <div class="accordion-body">
                                Tak, przygotowujemy pełną dokumentację z zakresu ochrony przeciwpożarowej, w tym kluczowy dokument, jakim jest <strong>Instrukcja Bezpieczeństwa Pożarowego (IBP)</strong>. Opracowujemy również plany ewakuacyjne, procedury PPOŻ oraz prowadzimy audyty przeciwpożarowe, zapewniając zgodność z przepisami Państwowej Straży Pożarnej.
                            </div>
                        </div>
                    </div>

                    <!-- Pytanie 4 -->
                    <div class="accordion-item" data-wow-delay=".6s">
                        <h2 class="accordion-header" id="heading-4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                Jak wygląda szkolenie z pierwszej pomocy i czy używacie AED?
                            </button>
                        </h2>
                        <div id="collapse-4" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#safePilotFaqAccordion">
                            <div class="accordion-body">
                                Nasze szkolenia z pierwszej pomocy są w pełni praktyczne. Uczestnicy ćwiczą na profesjonalnych fantomach treningowych, ucząc się resuscytacji krążeniowo-oddechowej (RKO) oraz obsługi automatycznego defibrylatora zewnętrznego (AED). Pokazujemy także, jak tamować krwotoki i postępować przy najczęstszych urazach.
                            </div>
                        </div>
                    </div>

                    <!-- Pytanie 5 -->
                    <div class="accordion-item" data-wow-delay=".7s">
                        <h2 class="accordion-header" id="heading-5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                Czy obsługujecie firmy spoza Krakowa?
                            </button>
                        </h2>
                        <div id="collapse-5" class="accordion-collapse collapse" aria-labelledby="heading-5" data-bs-parent="#safePilotFaqAccordion">
                            <div class="accordion-body">
                                Tak, działamy na terenie całej Polski. Szkolenia online, konsultacje i przygotowanie dokumentacji realizujemy zdalnie dla klientów z każdego regionu. W przypadku audytów, szkoleń praktycznych czy próbnych ewakuacji dojeżdżamy bezpośrednio do siedziby firmy.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pytanie 6 -->
                    <div class="accordion-item" data-wow-delay=".8s">
                        <h2 class="accordion-header" id="heading-6">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-6" aria-expanded="false" aria-controls="collapse-6">
                                Ile kosztują usługi BHP i czy jest darmowa wycena?
                            </button>
                        </h2>
                        <div id="collapse-6" class="accordion-collapse collapse" aria-labelledby="heading-6" data-bs-parent="#safePilotFaqAccordion">
                            <div class="accordion-body">
                                Cena zależy od wielkości firmy, liczby pracowników i zakresu obsługi. Podstawowe szkolenia BHP online zaczynają się już od kilkudziesięciu złotych za osobę. Stała obsługa (nadzór BHP) oraz kompleksowe dokumentacje wyceniamy indywidualnie. Oczywiście, oferujemy <strong>bezpłatną i niezobowiązującą wycenę</strong> – wystarczy skontaktować się z nami mailowo: <a href="mailto:biuro@safepilot.pl">biuro@safepilot.pl</a>.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sekcja CTA -->
                <div class="mt-5 pt-4" data-wow-delay=".9s">
                    <div class="sp-faq-cta-block">
                         <h3 class="sp-faq-title-main">Nie znalazłeś odpowiedzi?</h3>
                         <p class="lead">Nasz zespół ekspertów jest gotowy, aby odpowiedzieć na Twoje pytania. Skontaktuj się z nami, aby uzyskać bezpłatną konsultację.</p>
                         <a href="tel:+48726739238" class="btn btn-primary"><i class="fa-solid fa-phone me-2"></i>Zadzwoń teraz</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- 
==========================================================================
    SafePilot - Sekcja "Bezpieczeństwo to Inwestycja"
    Design premium by GitHub Copilot
========================================================================== 
-->
<section class="sp-invest-section margin-extech-shortcode">
    <div class="container">
        <!-- Tytuł sekcji -->
        <div class="sp-invest-section-title text-center mb-5">
            <p class="sp-invest-subtitle" data-wow-delay=".2s">NASZA FILOZOFIA BIZNESOWA</p>
            <h2 class="sp-invest-title-main" data-wow-delay=".4s">Bezpieczeństwo to inwestycja, nie koszt</h2>
            <p class="lead mt-3 mx-auto" style="max-width: 100%; color: #000;" data-wow-delay=".6s">Postrzeganie BHP i PPOŻ jako zbędnego wydatku to krótkowzroczne podejście. W SafePilot udowadniamy, że proaktywne zarządzanie bezpieczeństwem jest jednym z najmądrzejszych ruchów strategicznych, jakie może wykonać Twoja firma.</p>
        </div>

        <!-- Wiersz 1: Inwestycja w Ludzi -->
        <div class="row sp-invest-row" data-wow-delay=".3s">
            <div class="col-lg-6">
                <div class="sp-invest-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=2832&auto=format&fit=crop" alt="Zadowolony i bezpieczny zespół pracowników">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="sp-invest-content-wrapper">
                    <i class="fa-solid fa-users-gear sp-invest-icon"></i>
                    <h3 class="sp-invest-content-title">Inwestycja w najważniejszy kapitał: Ludzi</h3>
                    <p class="sp-invest-content-text">
                        Twoi pracownicy są fundamentem firmy. Zapewniając im bezpieczne, ergonomiczne i przyjazne środowisko, nie tylko spełniasz wymogi prawne. Budujesz lojalność, redukujesz absencję chorobową i zwiększasz produktywność. Pracownik, który czuje się zaopiekowany, jest bardziej zaangażowany i efektywny. To bezpośrednio przekłada się na jakość świadczonych usług, mniejszą rotację i silniejszy, zintegrowany zespół gotowy na wyzwania.
                    </p>
                </div>
            </div>
        </div>

        <!-- Wiersz 2: Inwestycja w Ciągłość Biznesu -->
        <div class="row sp-invest-row" data-wow-delay=".4s">
            <div class="col-lg-6 order-lg-2">
                <div class="sp-invest-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2940&auto=format&fit=crop" alt="Nowoczesne biuro z dobrze zorganizowanym procesem pracy">
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div class="sp-invest-content-wrapper">
                    <i class="fa-solid fa-chart-line sp-invest-icon"></i>
                    <h3 class="sp-invest-content-title">Inwestycja w ciągłość działania i finanse</h3>
                    <p class="sp-invest-content-text">
                        Jeden poważny wypadek przy pracy może sparaliżować działalność na wiele dni, a nawet tygodni. Koszty związane z postępowaniem powypadkowym, odszkodowaniami, karami od inspekcji pracy oraz stratami wizerunkowymi wielokrotnie przewyższają wydatki na prewencję. Profesjonalna obsługa BHP i PPOŻ to polisa ubezpieczeniowa dla Twojego biznesu, która minimalizuje ryzyko nieplanowanych przestojów i chroni Twoje finanse przed dotkliwymi konsekwencjami zaniedbań.
                    </p>
                </div>
            </div>
        </div>

        <!-- Wiersz 3: Inwestycja w Wizerunek -->
        <div class="row sp-invest-row" data-wow-delay=".5s">
            <div class="col-lg-6">
                <div class="sp-invest-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1516321497487-e288fb19713f?q=80&w=2940&auto=format&fit=crop" alt="Profesjonalny wizerunek firmy dbającej o standardy">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="sp-invest-content-wrapper">
                    <i class="fa-solid fa-building-shield sp-invest-icon"></i>
                    <h3 class="sp-invest-content-title">Inwestycja w wizerunek i reputację marki</h3>
                    <p class="sp-invest-content-text">
                        W dzisiejszym świecie firma, która dba o bezpieczeństwo, jest postrzegana jako odpowiedzialna, nowoczesna i godna zaufania. To przyciąga nie tylko najlepszych specjalistów na rynku pracy, ale także świadomych klientów i partnerów biznesowych, dla których etyka i standardy są kluczowe. Kultura bezpieczeństwa staje się Twoją wizytówką i przewagą konkurencyjną, która buduje pozytywną reputację na lata.
                    </p>
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