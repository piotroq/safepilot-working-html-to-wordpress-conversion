<style>
/* ==========================================================================
   SafePilot - Galeria Zdjęć ze Szkoleń z Lightbox
   Prefiks: sp-s-first-aid-gallery-
   ========================================================================== */

.sp-s-first-aid-gallery-section {
    background-color: #ffffff;
}

.sp-s-first-aid-gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    margin-bottom: 30px;
    cursor: pointer;
    box-shadow: 0 5px 20px rgba(33, 53, 67, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.sp-s-first-aid-gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(33, 53, 67, 0.15);
}

.sp-s-first-aid-gallery-img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}

.sp-s-first-aid-gallery-item:hover .sp-s-first-aid-gallery-img {
    transform: scale(1.1);
}

.sp-s-first-aid-gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(79, 185, 173, 0.9) 0%, rgba(65, 133, 125, 0.9) 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.sp-s-first-aid-gallery-item:hover .sp-s-first-aid-gallery-overlay {
    opacity: 1;
}

.sp-s-first-aid-gallery-icon {
    font-size: 48px;
    color: #ffffff;
    margin-bottom: 15px;
    animation: sp-s-first-aid-zoom-in 0.4s ease;
}

.sp-s-first-aid-gallery-text {
    color: #ffffff;
    font-size: 1rem;
    font-weight: 600;
    text-align: center;
    padding: 0 20px;
    animation: sp-s-first-aid-fade-in-up 0.4s ease;
}

@keyframes sp-s-first-aid-zoom-in {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes sp-s-first-aid-fade-in-up {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Lightbox Styles */
.sp-s-first-aid-lightbox {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.95);
    align-items: center;
    justify-content: center;
}

.sp-s-first-aid-lightbox.active {
    display: flex;
}

.sp-s-first-aid-lightbox-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
}

.sp-s-first-aid-lightbox-img {
    width: 100%;
    height: auto;
    max-height: 90vh;
    object-fit: contain;
    border-radius: 8px;
}

.sp-s-first-aid-lightbox-close {
    position: absolute;
    top: 20px;
    right: 30px;
    font-size: 40px;
    color: #ffffff;
    cursor: pointer;
    z-index: 10000;
    transition: transform 0.2s ease;
}

.sp-s-first-aid-lightbox-close:hover {
    transform: scale(1.2);
}

.sp-s-first-aid-lightbox-prev,
.sp-s-first-aid-lightbox-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 40px;
    color: #ffffff;
    cursor: pointer;
    padding: 20px;
    user-select: none;
    transition: opacity 0.3s ease;
}

.sp-s-first-aid-lightbox-prev:hover,
.sp-s-first-aid-lightbox-next:hover {
    opacity: 0.7;
}

.sp-s-first-aid-lightbox-prev {
    left: 20px;
}

.sp-s-first-aid-lightbox-next {
    right: 20px;
}

.sp-s-first-aid-lightbox-caption {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    color: #ffffff;
    background-color: rgba(0, 0, 0, 0.7);
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
}
</style>

<!-- Gallery Section -->
    <section class="sp-s-first-aid-gallery-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="title-2" data-wow-delay=".2s">Galeria zdjęć SafePilot</h2>
                <p class="col-lg-7 mx-auto" data-wow-delay=".4s">Zobacz jak wyglądają nasze profesjonalne szkolenia z pierwszej pomocy i resuscytacji.</p>
            </div>

            <!-- Row 1 -->
            <div class="row g-4 mb-4">
                <div class="col-lg-4 col-md-6" data-wow-delay=".3s">
                    <div class="sp-s-first-aid-gallery-item" data-index="0">
                        <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?q=80&w=2940&auto=format&fit=crop" alt="Ćwiczenia RKO na fantomie" class="sp-s-first-aid-gallery-img">
                        <div class="sp-s-first-aid-gallery-overlay">
                            <i class="fa-solid fa-magnifying-glass-plus sp-s-first-aid-gallery-icon"></i>
                            <div class="sp-s-first-aid-gallery-text">Ćwiczenia RKO na fantomie treningowym</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-wow-delay=".4s">
                    <div class="sp-s-first-aid-gallery-item" data-index="1">
                        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=2853&auto=format&fit=crop" alt="Szkolenie z użycia AED" class="sp-s-first-aid-gallery-img">
                        <div class="sp-s-first-aid-gallery-overlay">
                            <i class="fa-solid fa-magnifying-glass-plus sp-s-first-aid-gallery-icon"></i>
                            <div class="sp-s-first-aid-gallery-text">Praktyczne użycie defibrylatora AED</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-wow-delay=".5s">
                    <div class="sp-s-first-aid-gallery-item" data-index="2">
                        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=2853&auto=format&fit=crop" alt="Opatrywanie ran" class="sp-s-first-aid-gallery-img">
                        <div class="sp-s-first-aid-gallery-overlay">
                            <i class="fa-solid fa-magnifying-glass-plus sp-s-first-aid-gallery-icon"></i>
                            <div class="sp-s-first-aid-gallery-text">Nauka opatrywania ran i bandażowania</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-wow-delay=".3s">
                    <div class="sp-s-first-aid-gallery-item" data-index="3">
                        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=2853&auto=format&fit=crop" alt="Instruktor pokazuje technikę" class="sp-s-first-aid-gallery-img">
                        <div class="sp-s-first-aid-gallery-overlay">
                            <i class="fa-solid fa-magnifying-glass-plus sp-s-first-aid-gallery-icon"></i>
                            <div class="sp-s-first-aid-gallery-text">Instruktor pokazuje prawidłową technikę</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-wow-delay=".4s">
                    <div class="sp-s-first-aid-gallery-item" data-index="4">
                        <img src="https://images.unsplash.com/photo-1603398938378-e54eab446dde?q=80&w=2940&auto=format&fit=crop" alt="Grupa podczas szkolenia" class="sp-s-first-aid-gallery-img">
                        <div class="sp-s-first-aid-gallery-overlay">
                            <i class="fa-solid fa-magnifying-glass-plus sp-s-first-aid-gallery-icon"></i>
                            <div class="sp-s-first-aid-gallery-text">Zajęcia grupowe z pierwszej pomocy</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-wow-delay=".5s">
                    <div class="sp-s-first-aid-gallery-item" data-index="5">
                        <img src="https://images.unsplash.com/photo-1504439468489-c8920d796a29?q=80&w=2942&auto=format&fit=crop" alt="Certyfikat po szkoleniu" class="sp-s-first-aid-gallery-img">
                        <div class="sp-s-first-aid-gallery-overlay">
                            <i class="fa-solid fa-magnifying-glass-plus sp-s-first-aid-gallery-icon"></i>
                            <div class="sp-s-first-aid-gallery-text">Uczestnicy otrzymują certyfikaty</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lightbox -->
    <div class="sp-s-first-aid-lightbox" id="sp-lightbox">
        <span class="sp-s-first-aid-lightbox-close" id="sp-lightbox-close">&times;</span>
        <span class="sp-s-first-aid-lightbox-prev" id="sp-lightbox-prev">&#10094;</span>
        <div class="sp-s-first-aid-lightbox-content">
            <img src="" alt="" class="sp-s-first-aid-lightbox-img" id="sp-lightbox-img">
            <div class="sp-s-first-aid-lightbox-caption" id="sp-lightbox-caption"></div>
        </div>
        <span class="sp-s-first-aid-lightbox-next" id="sp-lightbox-next">&#10095;</span>
    </div>
    
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const galleryItems = document.querySelectorAll('.sp-s-first-aid-gallery-item');
        const lightbox = document.getElementById('sp-lightbox');
        const lightboxImg = document.getElementById('sp-lightbox-img');
        const lightboxCaption = document.getElementById('sp-lightbox-caption');
        const closeBtn = document.getElementById('sp-lightbox-close');
        const prevBtn = document.getElementById('sp-lightbox-prev');
        const nextBtn = document.getElementById('sp-lightbox-next');
        
        let currentIndex = 0;
        const images = [
            {
                src: 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?q=80&w=2940&auto=format&fit=crop',
                caption: 'Ćwiczenia RKO na fantomie treningowym'
            },
            {
                src: 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=2853&auto=format&fit=crop',
                caption: 'Praktyczne użycie defibrylatora AED'
            },
            {
                src: 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=2853&auto=format&fit=crop',
                caption: 'Nauka opatrywania ran i bandażowania'
            },
            {
                src: 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=2853&auto=format&fit=crop',
                caption: 'Instruktor pokazuje prawidłową technikę'
            },
            {
                src: 'https://images.unsplash.com/photo-1603398938378-e54eab446dde?q=80&w=2940&auto=format&fit=crop',
                caption: 'Zajęcia grupowe z pierwszej pomocy'
            },
            {
                src: 'https://images.unsplash.com/photo-1504439468489-c8920d796a29?q=80&w=2942&auto=format&fit=crop',
                caption: 'Uczestnicy otrzymują certyfikaty'
            }
        ];

        function openLightbox(index) {
            currentIndex = index;
            lightboxImg.src = images[index].src;
            lightboxCaption.textContent = images[index].caption;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        }

        function showImage(index) {
            if (index < 0) {
                currentIndex = images.length - 1;
            } else if (index >= images.length) {
                currentIndex = 0;
            } else {
                currentIndex = index;
            }
            lightboxImg.src = images[currentIndex].src;
            lightboxCaption.textContent = images[currentIndex].caption;
        }

        // Open lightbox on click
        galleryItems.forEach(item => {
            item.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));
                openLightbox(index);
            });
        });

        // Close lightbox
        closeBtn.addEventListener('click', closeLightbox);
        
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });

        // Navigation
        prevBtn.addEventListener('click', function() {
            showImage(currentIndex - 1);
        });

        nextBtn.addEventListener('click', function() {
            showImage(currentIndex + 1);
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (!lightbox.classList.contains('active')) return;
            
            if (e.key === 'Escape') {
                closeLightbox();
            } else if (e.key === 'ArrowLeft') {
                showImage(currentIndex - 1);
            } else if (e.key === 'ArrowRight') {
                showImage(currentIndex + 1);
            }
        });
    });
    </script>