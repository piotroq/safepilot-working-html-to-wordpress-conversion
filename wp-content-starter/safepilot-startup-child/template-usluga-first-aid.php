<?php
/**
 * Template Name: Szablon - Usługa (Pierwsza Pomoc i RKO)
 *
 * @package safepilot-startup-child
 */

get_header(); // Wczytuje plik header.php
?>

<style>
/* ==========================================================================
   SafePilot - Pierwsza Pomoc i RKO - Unikalne Style
   Prefiks: sp-s-first-aid-
   ========================================================================== */

/* Header */
.sp-s-first-aid-header {
    padding: 100px 0;
    background: linear-gradient(135deg, #213543 0%, #19222a 100%);
    color: #ffffff;
    position: relative;
    overflow: hidden;
}

.sp-s-first-aid-header::before {
    content: '\f21e';
    font-family: "Font Awesome 6 Pro";
    font-weight: 900;
    position: absolute;
    font-size: 400px;
    color: rgba(79, 185, 173, 0.04);
    top: -100px;
    right: -80px;
    transform: rotate(15deg);
}

.sp-s-first-aid-subtitle {
    color: #4fb9ad;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.sp-s-first-aid-header .display-5 {
    font-family: "Rajdhani", sans-serif;
    font-weight: 700;
}

/* Stats Section */
.sp-s-first-aid-stats-section {
    padding: 80px 0;
    background-color: #f5f9f8;
}

.sp-s-first-aid-stat-box {
    text-align: center;
    padding: 30px;
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #e8e8e8;
    transition: all 0.3s ease;
    height: 100%;
}

.sp-s-first-aid-stat-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(33, 53, 67, 0.1);
}

.sp-s-first-aid-stat-number {
    font-size: 3rem;
    font-weight: 700;
    color: #4fb9ad;
    line-height: 1;
    margin-bottom: 10px;
}

.sp-s-first-aid-stat-label {
    font-size: 0.9rem;
    color: #213543;
    font-weight: 600;
}

/* Grid Cards Section */
.sp-s-first-aid-content-section {
    padding: 100px 0;
}

.sp-s-first-aid-card {
    background: #ffffff;
    border: 1px solid #e8e8e8;
    border-radius: 12px;
    padding: 35px;
    height: 100%;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.sp-s-first-aid-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 0;
    background: #4fb9ad;
    transition: height 0.3s ease;
}

.sp-s-first-aid-card:hover::before {
    height: 100%;
}

.sp-s-first-aid-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(33, 53, 67, 0.1);
}

.sp-s-first-aid-card-icon {
    font-size: 40px;
    color: #4fb9ad;
    margin-bottom: 20px;
}

.sp-s-first-aid-card h3 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #213543;
    margin-bottom: 15px;
}

.sp-s-first-aid-card ul {
    list-style: none;
    padding-left: 0;
}

.sp-s-first-aid-card ul li {
    padding-left: 25px;
    margin-bottom: 10px;
    position: relative;
}

.sp-s-first-aid-card ul li::before {
    content: '\f058';
    font-family: "Font Awesome 6 Pro";
    font-weight: 400;
    position: absolute;
    left: 0;
    top: 3px;
    color: #4fb9ad;
}

/* Benefits Section */
.sp-s-first-aid-benefits-section {
    padding: 100px 0;
    background-color: #f5f9f8;
}

.sp-s-first-aid-benefit-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 25px;
}

.sp-s-first-aid-benefit-icon {
    font-size: 22px;
    color: #4fb9ad;
    margin-right: 18px;
    margin-top: 3px;
    flex-shrink: 0;
}

.sp-s-first-aid-benefit-item h5 {
    font-weight: 700;
    color: #213543;
    margin-bottom: 5px;
}

/* CTA Section */
.sp-s-first-aid-cta-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #4fb9ad 0%, #41857d 100%);
    color: #ffffff;
    border-radius: 12px;
}

.sp-s-first-aid-cta-section h2 {
    font-family: "Rajdhani", sans-serif;
    font-weight: 700;
    color: #ffffff;
}
</style>

<main id="main" class="site-main" role="main">
<!-- Header -->
    <header class="sp-s-first-aid-header">
        <div class="container text-center">
            <p class="sp-s-first-aid-subtitle" data-wow-delay=".2s">Praktyczne Szkolenia Ratujące Życie</p>
            <h1 class="display-5" data-wow-delay=".4s" style="color: #fff;">Pierwsza Pomoc i RKO</h1>
            <p class="lead col-lg-8 mx-auto mt-3" data-wow-delay=".6s">
                W sytuacjach zagrożenia liczą się sekundy. Przygotowujemy pracowników do natychmiastowego i skutecznego działania z użyciem AED.
            </p>
        </div>
    </header>

    <!-- Stats Section -->
    <section class="sp-s-first-aid-stats-section">
        <div class="container padding-extech-shortcode-footer">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-wow-delay=".2s">
                    <div class="sp-s-first-aid-stat-box">
                        <div class="sp-s-first-aid-stat-number">2-3</div>
                        <div class="sp-s-first-aid-stat-label">minuty decydują o życiu</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-wow-delay=".3s">
                    <div class="sp-s-first-aid-stat-box">
                        <div class="sp-s-first-aid-stat-number">70%</div>
                        <div class="sp-s-first-aid-stat-label">szans przy użyciu AED</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-wow-delay=".4s">
                    <div class="sp-s-first-aid-stat-box">
                        <div class="sp-s-first-aid-stat-number">100%</div>
                        <div class="sp-s-first-aid-stat-label">praktycznych ćwiczeń</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-wow-delay=".5s">
                    <div class="sp-s-first-aid-stat-box">
                        <div class="sp-s-first-aid-stat-number"><i class="fa-solid fa-certificate"></i></div>
                        <div class="sp-s-first-aid-stat-label">Certyfikowani instruktorzy</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Grid Section -->
    <section class="sp-s-first-aid-content-section margin-extech-shortcode">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="title-2" data-wow-delay=".2s">Zakres Szkolenia</h2>
                <p class="col-lg-7 mx-auto" data-wow-delay=".4s">Program dostosowujemy do branży i typowych zagrożeń. Uczestnicy ćwiczą na profesjonalnym sprzęcie treningowym.</p>
            </div>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-lg-4 col-md-6" data-wow-delay=".3s">
                    <div class="sp-s-first-aid-card">
                        <div class="sp-s-first-aid-card-icon"><i class="fa-solid fa-hand-holding-medical"></i></div>
                        <h3>Pierwsza Pomoc</h3>
                        <ul>
                            <li>Ocena miejsca zdarzenia</li>
                            <li>Wezwanie pomocy</li>
                            <li>Tamowanie krwotoków</li>
                            <li>Pozycja boczna bezpieczna</li>
                            <li>Oparzenia i urazy</li>
                        </ul>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-4 col-md-6" data-wow-delay=".4s">
                    <div class="sp-s-first-aid-card">
                        <div class="sp-s-first-aid-card-icon"><i class="fa-solid fa-heart-pulse"></i></div>
                        <h3>RKO na Fantomach</h3>
                        <ul>
                            <li>Odpowiednia siła ucisków</li>
                            <li>Właściwa częstotliwość</li>
                            <li>Głębokość kompresji</li>
                            <li>Wizualny feedback</li>
                            <li>Realne scenariusze</li>
                        </ul>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-4 col-md-6" data-wow-delay=".5s">
                    <div class="sp-s-first-aid-card">
                        <div class="sp-s-first-aid-card-icon"><i class="fa-solid fa-bolt"></i></div>
                        <h3>Obsługa AED</h3>
                        <ul>
                            <li>Włączenie urządzenia</li>
                            <li>Przyklejanie elektrod</li>
                            <li>Bezpieczne wyładowanie</li>
                            <li>RKO po defibrylacji</li>
                            <li>Praktyka bez stresu</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="sp-s-first-aid-benefits-section">
        <div class="container padding-extech-shortcode-footer">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6" data-wow-delay=".3s">
                    <h2 class="title-2 mb-4">Dlaczego SafePilot?</h2>
                    <div class="sp-s-first-aid-benefit-item">
                        <div class="sp-s-first-aid-benefit-icon"><i class="fa-solid fa-user-doctor"></i></div>
                        <div>
                            <h5>Doświadczeni instruktorzy</h5>
                            <p>Certyfikowani specjaliści z realnym doświadczeniem ratowniczym.</p>
                        </div>
                    </div>
                    <div class="sp-s-first-aid-benefit-item">
                        <div class="sp-s-first-aid-benefit-icon"><i class="fa-solid fa-briefcase-medical"></i></div>
                        <div>
                            <h5>Profesjonalny sprzęt</h5>
                            <p>Fantomy treningowe z feedback, prawdziwe AED do ćwiczeń.</p>
                        </div>
                    </div>
                    <div class="sp-s-first-aid-benefit-item">
                        <div class="sp-s-first-aid-benefit-icon"><i class="fa-solid fa-building"></i></div>
                        <div>
                            <h5>Szkolenia na miejscu</h5>
                            <p>Przyjeżdżamy do Twojej firmy i dostosowujemy program do środowiska pracy.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-wow-delay=".5s">
                    <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?q=80&w=2940&auto=format&fit=crop" alt="Szkolenie pierwszej pomocy" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <div class="container my-5">
        <div class="sp-s-first-aid-cta-section text-center" data-wow-delay=".3s">
            <div class="container">
                <h2 class="mb-3">Bezpieczeństwo zaczyna się od ludzi</h2>
                <p class="lead mb-4">Przygotuj swój zespół do działania w sytuacjach zagrożenia życia. Organizujemy szkolenia, które dają kompetencje, nie tylko certyfikat.</p>
                <a href="https://safepilot.pl/kontakt/" class="btn btn-light btn-lg">Zapytaj o szkolenie <i class="fa-solid fa-arrow-right ms-2"></i></a>
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