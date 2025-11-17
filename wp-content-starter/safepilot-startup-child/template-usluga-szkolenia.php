<?php
/**
 * Template Name: Szablon - Usługa (Szkolenia BHP)
 *
 * @package safepilot-startup-child
 */

get_header(); // Wczytuje plik header.php
?>

<style>
/* ==========================================================================
   SafePilot - Unikalne Style dla Podstrony Usługi "Szkolenia BHP"
   Prefiks: sp-s-train-
   ========================================================================== */

/* ---------------------------------- */
/* 1. Nagłówek podstrony               */
/* ---------------------------------- */
.sp-s-train-header {
    padding: 80px 0;
    background-color: var(--secondary-navy, #213543);
    color: var(--white-color, #ffffff);
    position: relative;
    overflow: hidden;
}

.sp-s-train-header::before {
    content: '\f51c'; /* Ikona chalkboard-user */
    font-family: var(--icon-font, "Font Awesome 6 Pro");
    font-weight: 900;
    position: absolute;
    font-size: 350px;
    color: rgba(79, 185, 173, 0.05);
    top: 50%;
    right: -70px;
    transform: translateY(-50%) rotate(15deg);
    line-height: 1;
}

.sp-s-train-subtitle {
    font-weight: 700;
    color: var(--primary-teal, #4fb9ad);
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.sp-s-train-header .display-5 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
}

/* ---------------------------------- */
/* 2. Sekcja "Dlaczego My?"            */
/* ---------------------------------- */
.sp-s-train-intro-section {
    padding: 100px 0;
}

.sp-s-train-intro-img {
    border-radius: 12px;
    object-fit: cover;
    height: 100%;
    width: 100%;
}

.sp-s-train-list {
    list-style: none;
    padding-left: 0;
}

.sp-s-train-list li {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
    font-size: 1.05rem;
}

.sp-s-train-list i {
    color: var(--primary-teal, #4fb9ad);
    margin-right: 15px;
    font-size: 20px;
    margin-top: 5px;
}

/* ---------------------------------- */
/* 3. Zakładki z rodzajami szkoleń    */
/* ---------------------------------- */
.sp-s-train-tabs-section {
    padding: 100px 0;
    background-color: var(--smoke-color, #f5f9f8);
}

.sp-s-train-tabs .nav-link {
    border: 0;
    border-bottom: 3px solid transparent;
    color: var(--secondary-navy, #213543);
    font-size: 1.1rem;
    font-weight: 700;
    padding: 15px 30px;
    transition: all 0.3s ease;
}

.sp-s-train-tabs .nav-link:hover {
    color: var(--primary-teal, #4fb9ad);
}

.sp-s-train-tabs .nav-link.active {
    color: var(--primary-teal, #4fb9ad);
    border-bottom-color: var(--primary-teal, #4fb9ad);
    background-color: transparent;
}

.sp-s-train-tab-content {
    padding-top: 40px;
}

.sp-s-train-tab-content h3 {
    font-family: var(--title-font, "Rajdhani", sans-serif);
    font-weight: 700;
    color: var(--secondary-navy, #213543);
}

/* Karty wewnątrz zakładek */
.sp-s-train-card {
    background-color: var(--white-color, #ffffff);
    border: 1px solid #e8e8e8;
    border-left: 4px solid var(--accent-beige, #d8d5c8);
    padding: 30px;
    border-radius: 12px;
    height: 100%;
    transition: all 0.3s ease;
}

.sp-s-train-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(33, 53, 67, 0.08);
    border-left-color: var(--primary-teal, #4fb9ad);
}

.sp-s-train-card-icon {
    font-size: 32px;
    color: var(--primary-teal, #4fb9ad);
    margin-bottom: 15px;
}

.sp-s-train-card h5 {
    font-weight: 700;
    color: var(--secondary-navy, #213543);
}

/* ---------------------------------- */
/* 4. Sekcja Korzyści                 */
/* ---------------------------------- */
.sp-s-train-benefits-section {
    padding: 100px 0;
}

.sp-s-train-benefit-item {
    background: var(--white-color, #ffffff);
    padding: 30px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 5px 25px rgba(33, 53, 67, 0.05);
    transition: all 0.3s ease;
    border: 1px solid #e8e8e8;
    height: 100%;
}

.sp-s-train-benefit-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(33, 53, 67, 0.1);
}

.sp-s-train-benefit-icon {
    font-size: 40px;
    color: var(--primary-teal, #4fb9ad);
    margin-bottom: 20px;
}

.sp-s-train-benefit-item h5 {
    font-weight: 700;
    color: var(--secondary-navy, #213543);
}
</style>

<main id="main" class="site-main" role="main">
<!-- 
==========================================================================
    SafePilot - Podstrona Usługi "Szkolenia BHP" (Wersja z zakładkami)
    Design premium by GitHub Copilot
========================================================================== 
-->

<!-- Nagłówek podstrony -->
<header class="sp-s-train-header">
    <div class="container text-center">
        <p class="sp-s-train-subtitle" data-wow-delay=".2s">Nasze Usługi</p>
        <h1 class="display-5" data-wow-delay=".4s" style="color: #fff;">Profesjonalne Szkolenia BHP</h1>
        <p class="lead col-lg-8 mx-auto mt-3" data-wow-delay=".6s">Skuteczne szkolenia to nie formalność, lecz inwestycja w bezpieczeństwo firmy. W SafePilot uczymy praktycznie, zrozumiale i zgodnie z realiami Twojego miejsca pracy.</p>
    </div>
</header>

<!-- Sekcja "Dlaczego my?" -->
<section class="sp-s-train-intro-section margin-extech-shortcode">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-wow-delay=".3s">
                <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?q=80&w=2784&auto=format&fit=crop" alt="Specjalista BHP prowadzący szkolenie" class="sp-s-train-intro-img">
            </div>
            <div class="col-lg-6" data-wow-delay=".5s">
                <h2 class="title-2 mb-4">Wiedza, która działa w praktyce</h2>
                <p>Szkolenie prowadzone przez doświadczonych specjalistów, aktualizowane zgodnie z najnowszymi przepisami i uzupełnione praktycznymi przykładami to fundament bezpiecznego środowiska pracy.</p>
                <ul class="sp-s-train-list mt-4">
                    <li><i class="fa-solid fa-check-circle"></i>Stawiamy na zrozumiały przekaz zamiast pustych formułek.</li>
                    <li><i class="fa-solid fa-check-circle"></i>Koncentrujemy się na praktyce zamiast teoretycznych regułek.</li>
                    <li><i class="fa-solid fa-check-circle"></i>Dopasowujemy materiał do branży i specyfiki stanowisk pracy.</li>
                    <li><i class="fa-solid fa-check-circle"></i>Gwarantujemy pełną zgodność z obowiązującymi przepisami.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Sekcja z zakładkami rodzajów szkoleń -->
<section class="sp-s-train-tabs-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="title-2" data-wow-delay=".2s">Zakres Szkoleń BHP</h2>
            <p class="col-lg-7 mx-auto" data-wow-delay=".4s">Oferujemy pełne spektrum szkoleń BHP, dostosowanych do potrzeb każdej grupy zawodowej i wymagań prawnych.</p>
        </div>

        <!-- Nawigacja zakładek -->
        <ul class="nav justify-content-center sp-s-train-tabs" id="trainingTabs" role="tablist" data-wow-delay=".5s">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="wstepne-tab" data-bs-toggle="tab" data-bs-target="#wstepne-content" type="button" role="tab" aria-controls="wstepne-content" aria-selected="true">Szkolenia Wstępne</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="okresowe-tab" data-bs-toggle="tab" data-bs-target="#okresowe-content" type="button" role="tab" aria-controls="okresowe-content" aria-selected="false">Szkolenia Okresowe</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="stanowiskowe-tab" data-bs-toggle="tab" data-bs-target="#stanowiskowe-content" type="button" role="tab" aria-controls="stanowiskowe-content" aria-selected="false">Instruktaż Stanowiskowy</button>
            </li>
        </ul>

        <!-- Zawartość zakładek -->
        <div class="tab-content sp-s-train-tab-content" id="trainingTabsContent">
            <!-- Zakładka 1: Szkolenia Wstępne -->
            <div class="tab-pane fade show active" id="wstepne-content" role="tabpanel" aria-labelledby="wstepne-tab">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h3>Obowiązkowe dla każdego nowego pracownika</h3>
                        <p class="mt-3">Przeprowadzamy profesjonalne instruktaże ogólne, obejmujące podstawy prawa pracy, zasady bezpieczeństwa, procedury wypadkowe, PPOŻ i pierwszą pomoc. Materiały tworzymy w zrozumiałej i aktualnej formie.</p>
                    </div>
                </div>
            </div>

            <!-- Zakładka 2: Szkolenia Okresowe -->
            <div class="tab-pane fade" id="okresowe-content" role="tabpanel" aria-labelledby="okresowe-tab">
                <div class="text-center">
                    <h3>Aktualizacja wiedzy dla wszystkich grup zawodowych</h3>
                    <p class="mt-3 col-lg-8 mx-auto">Szkolenia okresowe muszą być regularnie odnawiane. Ich celem jest aktualizacja wiedzy pracowników i kadry kierowniczej oraz zwiększenie świadomości zagrożeń.</p>
                </div>
                <div class="row g-4 mt-4">
                    <div class="col-lg-6" data-wow-delay=".2s">
                        <div class="sp-s-train-card">
                            <div class="sp-s-train-card-icon"><i class="fa-solid fa-user-tie"></i></div>
                            <h5>Pracodawcy i osoby kierujące pracownikami</h5>
                            <p>Skupiamy się na odpowiedzialności prawnej, organizacji środowiska pracy, nadzorze BHP i analizie ryzyka.</p>
                        </div>
                    </div>
                    <div class="col-lg-6" data-wow-delay=".3s">
                        <div class="sp-s-train-card">
                            <div class="sp-s-train-card-icon"><i class="fa-solid fa-helmet-safety"></i></div>
                            <h5>Pracownicy inżynieryjno-techniczni</h5>
                            <p>Przekazujemy wiedzę praktyczną, techniczną i branżową, zgodną z wymaganiami danego sektora.</p>
                        </div>
                    </div>
                    <div class="col-lg-6" data-wow-delay=".4s">
                        <div class="sp-s-train-card">
                            <div class="sp-s-train-card-icon"><i class="fa-solid fa-laptop-file"></i></div>
                            <h5>Pracownicy biurowi</h5>
                            <p>Omawiamy ergonomię, zagrożenia w biurze, pracę przy komputerze i psychospołeczne aspekty pracy.</p>
                        </div>
                    </div>
                    <div class="col-lg-6" data-wow-delay=".5s">
                        <div class="sp-s-train-card">
                            <div class="sp-s-train-card-icon"><i class="fa-solid fa-person-digging"></i></div>
                            <h5>Pracownicy fizyczni i produkcyjni</h5>
                            <p>Uczymy o zagrożeniach na stanowiskach, obsłudze maszyn i postępowaniu w razie wypadku.</p>
                        </div>
                    </div>
                </div>
                <p class="text-center mt-4"><strong>Dostępne formy:</strong> stacjonarnie, online (wideokonferencja), e-learning.</p>
            </div>

            <!-- Zakładka 3: Instruktaż Stanowiskowy -->
            <div class="tab-pane fade" id="stanowiskowe-content" role="tabpanel" aria-labelledby="stanowiskowe-tab">
                 <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h3>Niezbędny etap dopuszczenia pracownika do pracy</h3>
                        <p class="mt-3">Instruktaż prowadzimy w oparciu o analizę ryzyka, instrukcje stanowiskowe i praktyczne ćwiczenia na miejscu pracy. Kończy się weryfikacją wiedzy i odnotowaniem w dokumentacji.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sekcja "Korzyści" -->
<section class="sp-s-train-benefits-section margin-extech-shortcode">
    <div class="container">
         <div class="text-center mb-5">
            <h2 class="title-2" data-wow-delay=".2s">Korzyści dla Twojej Firmy</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-wow-delay=".3s">
                <div class="sp-s-train-benefit-item">
                    <div class="sp-s-train-benefit-icon"><i class="fa-solid fa-gavel"></i></div>
                    <h5>Zgodność z prawem</h5>
                    <p>Pełna zgodność z obowiązkami prawnymi i wymaganiami PIP.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-wow-delay=".4s">
                <div class="sp-s-train-benefit-item">
                    <div class="sp-s-train-benefit-icon"><i class="fa-solid fa-shield-heart"></i></div>
                    <h5>Mniej wypadków</h5>
                    <p>Zmniejszenie liczby wypadków i niebezpiecznych zdarzeń w miejscu pracy.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-wow-delay=".5s">
                <div class="sp-s-train-benefit-item">
                    <div class="sp-s-train-benefit-icon"><i class="fa-solid fa-brain"></i></div>
                    <h5>Wyższa świadomość</h5>
                    <p>Zwiększona świadomość zagrożeń i odpowiedzialności wśród pracowników i kadry.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Końcowa sekcja CTA -->
<div class="container my-5">
    <div class="sp-s-doc-cta-section text-center" data-wow-delay=".3s">
        <div class="container">
            <h2 class="mb-3">Zorganizuj szkolenie BHP w swojej firmie</h2>
            <p class="lead mb-4">Skontaktuj się z nami, aby omówić szczegóły i otrzymać ofertę dopasowaną do potrzeb Twojego zespołu.</p>
            <a href="https://safepilot.pl/kontakt" class="btn btn-primary btn-lg">Zapytaj o szkolenie <i class="fa-solid fa-arrow-right ms-2"></i></a>
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