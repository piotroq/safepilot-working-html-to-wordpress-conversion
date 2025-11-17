/**
 * SafePilot - Hero Slider Script
 * Wersja: 2.0
 * Funkcje: Autoplay, Nawigacja strzałkami, Dots indicator
 */

(function() {
    'use strict';
    
    // Konfiguracja slidera
    const config = {
        autoplayDelay: 7000, // 7 sekund na slajd
        animationDuration: 800, // 0.8s czas animacji
        totalSlides: 3
    };
    
    let currentSlide = 1;
    let autoplayInterval;
    let isAnimating = false;
    
    // Inicjalizacja slidera po załadowaniu DOM
    document.addEventListener('DOMContentLoaded', function() {
        initHeroSlider();
    });
    
    // Główna funkcja inicjalizująca
    function initHeroSlider() {
        startAutoplay();
        
        // Zatrzymaj autoplay przy najechaniu myszką
        const sliderSection = document.querySelector('.sp-hero-home-section');
        if (sliderSection) {
            sliderSection.addEventListener('mouseenter', stopAutoplay);
            sliderSection.addEventListener('mouseleave', startAutoplay);
        }
        
        // Obsługa klawiatury (strzałki lewo/prawo)
        document.addEventListener('keydown', handleKeyboard);
    }
    
    // Funkcja zmiany slajdu
    function changeSlide(targetSlide) {
        if (isAnimating || targetSlide === currentSlide) return;
        
        isAnimating = true;
        
        const slides = document.querySelectorAll('.sp-hero-slide');
        const dots = document.querySelectorAll('.sp-hero-dot');
        
        // Usuń aktywną klasę z obecnego slajdu
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Dodaj aktywną klasę do nowego slajdu
        slides[targetSlide - 1].classList.add('active');
        dots[targetSlide - 1].classList.add('active');
        
        currentSlide = targetSlide;
        
        // Odblokuj animację po jej zakończeniu
        setTimeout(() => {
            isAnimating = false;
        }, config.animationDuration);
    }
    
    // Następny slajd
    window.spHeroSliderNext = function() {
        const nextSlide = currentSlide >= config.totalSlides ? 1 : currentSlide + 1;
        changeSlide(nextSlide);
        resetAutoplay();
    };
    
    // Poprzedni slajd
    window.spHeroSliderPrev = function() {
        const prevSlide = currentSlide <= 1 ? config.totalSlides : currentSlide - 1;
        changeSlide(prevSlide);
        resetAutoplay();
    };
    
    // Przejdź do konkretnego slajdu
    window.spHeroSliderGoto = function(slideNumber) {
        changeSlide(slideNumber);
        resetAutoplay();
    };
    
    // Start autoplay
    function startAutoplay() {
        stopAutoplay();
        autoplayInterval = setInterval(() => {
            window.spHeroSliderNext();
        }, config.autoplayDelay);
    }
    
    // Stop autoplay
    function stopAutoplay() {
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
            autoplayInterval = null;
        }
    }
    
    // Reset autoplay (restart timera)
    function resetAutoplay() {
        stopAutoplay();
        startAutoplay();
    }
    
    // Obsługa klawiatury
    function handleKeyboard(e) {
        if (e.key === 'ArrowLeft') {
            window.spHeroSliderPrev();
        } else if (e.key === 'ArrowRight') {
            window.spHeroSliderNext();
        }
    }
    
    // Zatrzymaj autoplay gdy karta przeglądarki nieaktywna (optymalizacja)
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            stopAutoplay();
        } else {
            startAutoplay();
        }
    });
    
})();