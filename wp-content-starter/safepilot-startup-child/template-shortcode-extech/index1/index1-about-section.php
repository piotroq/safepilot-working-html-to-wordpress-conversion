<section class="about-section space fix bg-theme-color sp-about-home">
   <div class="about-container-wrapper style1 px-5">
      <div class="shape1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/aboutShape1_1.png" alt="kształt"></div>
      <div class="shape2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/aboutShape1_2.png" alt="kształt"></div>
      <div class="shape3"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/aboutShape1_3.png" alt="kształt"></div>
      
      <div class="container">
         <div class="row gy-5 gx-70">
            
            <!-- Lewa kolumna: Obrazki -->
            <div class="col-xl-6">
               <div class="about-thumb">
                  <div class="thumb1">
                     <img class="img-custom-anim-left wow fadeInUp" data-wow-delay=".5s"
                        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/about/aboutThumb1_1.png" 
                        alt="SafePilot - Specjalista BHP">

                     <!-- SVG Mask -->
                     <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" style="position: absolute;">
                        <clipPath id="aboutThumbdMask1">
                           <path d="M0 20C0 8.95431 8.9543 0 20 0H395.5C423.114 0 445.5 22.3858 445.5 50V72.5C445.5 100.114 467.886 122.5 495.5 122.5H520C547.614 122.5 570 144.886 570 172.5V321.5L562.197 537.223C561.808 547.98 552.975 556.5 542.21 556.5H20C8.95432 556.5 0 547.546 0 536.5V20Z" />
                        </clipPath>
                     </svg>
                  </div>
                  
                  <div class="thumb2">
                     <img class="img-custom-anim-top wow fadeInUp" data-wow-delay=".8s"
                        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/about/aboutThumb1_2.png" 
                        alt="SafePilot - Szkolenie BHP">
                  </div>

                  <div class="shape">
                     <a href="<?php echo home_url('/kontakt/'); ?>">
                        <img class="rotate360" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/aboutShape1_4.png" alt="kształt">
                     </a>
                  </div>
               </div>
            </div>
            
            <!-- Prawa kolumna: Treść -->
            <div class="col-xl-6">
               <div class="about-content">
                  <div class="section-title mxw-560">
                     <div class="subtitle text-white wow fadeInUp" data-wow-delay=".3s">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/arrowLeftWhite.svg" alt="ikona">
                        <span class="text-white">O firmie SafePilot</span>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon/arrowRightWhite.svg" alt="ikona">
                     </div>
                     
                     <h2 class="title text-white wow fadeInUp" data-wow-delay=".6s">
                        Bezpieczeństwo<br>bez turbulencji
                     </h2>
                     
                     <p class="mt-25 text-white wow fadeInUp" data-wow-delay=".5s">
                        Jesteśmy Twoim kompetentnym przewodnikiem w świecie BHP i PPOŻ. 
                        Jak doświadczony pilot prowadzimy firmy przez dynamiczny świat przepisów 
                        z pełnym wsparciem, wiedzą i profesjonalizmem. Działamy w Krakowie 
                        i małopolsce, zapewniając kompleksową obsługę bezpieczeństwa pracy.
                     </p>
                  </div>
                  
                  <!-- Ikony - Główne usługi -->
                  <div class="fancy-box-wrapper style2">
                     <div class="fancy-box style2 wow fadeInUp" data-wow-delay=".3s">
                        <div class="item">
                           <div class="icon">
                              <i class="fa-solid fa-helmet-safety"></i>
                           </div>
                        </div>
                        <div class="item">
                           <h6>Dokumentacja i Szkolenia BHP</h6>
                        </div>
                     </div>
                     
                     <div class="fancy-box style2 wow fadeInUp" data-wow-delay=".5s">
                        <div class="item">
                           <div class="icon">
                              <i class="fa-solid fa-fire-extinguisher"></i>
                           </div>
                        </div>
                        <div class="item">
                           <h6>Ochrona Przeciwpożarowa</h6>
                        </div>
                     </div>
                  </div>
                  
                  <!-- Liczniki - Statystyki -->
                  <div class="counter-box-wrapper style1">
                     <div class="counter-box style1 wow fadeInUp" data-wow-delay=".3s">
                        <h3>
                           <span class="counter-number">500</span>+
                        </h3>
                        <h6>Obsłużonych Firm</h6>
                     </div>
                     
                     <div class="counter-box style1 wow fadeInUp" data-wow-delay=".5s">
                        <h3>
                           <span class="counter-number">15</span>+
                        </h3>
                        <h6>Lat Doświadczenia</h6>
                     </div>
                     
                     <div class="counter-box style1 wow fadeInUp" data-wow-delay=".8s">
                        <h3>
                           <span class="counter-number">2000</span>+
                        </h3>
                        <h6>Dokumentów</h6>
                     </div>
                  </div>
               </div>
            </div>
            
         </div>
      </div>
   </div>
</section>