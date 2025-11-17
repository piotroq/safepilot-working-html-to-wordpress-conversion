/**
 * SafePilot - Counter Animation dla sekcji About
 * Wersja: 1.0
 */

(function($) {
    'use strict';
    
    // Counter Animation
    function initCounters() {
        const counters = document.querySelectorAll('.counter-number');
        const speed = 200; // Prędkość animacji (mniejsza = szybciej)
        
        const animateCounter = (counter) => {
            const target = +counter.innerText;
            const increment = target / speed;
            
            const updateCount = () => {
                const count = +counter.innerText;
                
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = target;
                }
            };
            
            updateCount();
        };
        
        // Intersection Observer - uruchom licznik gdy sekcja jest widoczna
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    if (!counter.classList.contains('counted')) {
                        counter.classList.add('counted');
                        animateCounter(counter);
                    }
                }
            });
        }, { threshold: 0.5 });
        
        counters.forEach(counter => {
            observer.observe(counter);
        });
    }
    
    // Inicjalizacja po załadowaniu DOM
    $(document).ready(function() {
        initCounters();
    });
    
})(jQuery);