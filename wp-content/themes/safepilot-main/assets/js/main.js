/*-----------------------------------------------------------------
Template Name: Extech - IT Solution & Technology HTML Template<
Author:  ex-coders
Author URI: https://themeforest.net/user/ex-coders
Developer: Masirul Islam
Version: 1.0.0
Description: Extech - IT Solution & Technology HTML Template<
-------------------------------------------------------------------
Js TABLE OF CONTENTS
-------------------------------------------------------------------
01. header
02. animated text with swiper slider
03. magnificPopup
04. counter up 
05. wow animation
06. nice select
07. swiper slider
08. team hover effect
09. search popup
10. mouse cursor
11. Set Background Image
12. Global Slider
13. Progress Bar Animation 
14. Checkbox
15. preloader
------------------------------------------------------------------*/
(function ($) {
  'use strict';

  $(document).ready(function () {
    $('#mobile-menu').meanmenu({
      meanMenuContainer: '.mobile-menu',
      meanScreenWidth: '991',
      meanExpand: ['<i class="far fa-plus"></i>'],
    });

    $('.offcanvas__close,.offcanvas__overlay').on('click', function () {
      $('.offcanvas__info').removeClass('info-open');
      $('.offcanvas__overlay').removeClass('overlay-open');
    });
    $('.sidebar__toggle').on('click', function () {
      $('.offcanvas__info').addClass('info-open');
      $('.offcanvas__overlay').addClass('overlay-open');
    });

    $('.body-overlay').on('click', function () {
      $('.offcanvas__area').removeClass('offcanvas-opened');
      $('.df-search-area').removeClass('opened');
      $('.body-overlay').removeClass('opened');
    });

    $(window).scroll(function () {
      if ($(this).scrollTop() > 250) {
        $('#header-sticky').addClass('sticky');
      } else {
        $('#header-sticky').removeClass('sticky');
      }
    });

    const sliderActive2 = '.hero-slider';
    const sliderInit2 = new Swiper(sliderActive2, {
      loop: true,
      slidesPerView: 1,
      effect: 'fade',
      speed: 3000,
      autoplay: {
        delay: 7000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: '.array-prev',
        prevEl: '.array-next',
      },
    });

    function animatedSwiper(selector, init) {
      const animateFn = function () {
        $(selector + ' [data-animation]').each(function () {
          const anim = $(this).data('animation');
          const delay = $(this).data('delay');
          const duration = $(this).data('duration');
          $(this)
            .removeClass('anim' + anim)
            .addClass(anim + ' animated')
            .css({
              webkitAnimationDelay: delay,
              animationDelay: delay,
              webkitAnimationDuration: duration,
              animationDuration: duration,
            })
            .one('animationend', function () {
              $(this).removeClass(anim + ' animated');
            });
        });
      };
      animateFn();
      init.on('slideChange', function () {
        $(sliderActive2 + ' [data-animation]').removeClass('animated');
      });
      init.on('slideChange', animateFn);
    }
    animatedSwiper(sliderActive2, sliderInit2);

    $('.popup-image').magnificPopup({
      type: 'image',
      mainClass: 'mfp-zoom-in',
      removalDelay: 260,
      gallery: { enabled: true },
    });

    $('.popup-video').magnificPopup({
      type: 'iframe',
      removalDelay: 260,
      mainClass: 'mfp-zoom-in',
    });

    $('.popup-content').magnificPopup({
      type: 'inline',
      midClick: true,
    });

    $('.img-popup').magnificPopup({
      type: 'image',
      gallery: { enabled: true },
    });

    $('.counter-number').counterUp({
      delay: 10,
      time: 1000,
    });

    new WOW().init();

    $('select').niceSelect();

    // Swiper initializations without storing unused variables
    new Swiper('.brand-slider', {
      spaceBetween: 30,
      speed: 1300,
      loop: true,
      centeredSlides: true,
      autoplay: { delay: 2000, disableOnInteraction: false },
      breakpoints: {
        1199: { slidesPerView: 5 },
        991: { slidesPerView: 4 },
        767: { slidesPerView: 3 },
        575: { slidesPerView: 2 },
        0: { slidesPerView: 1 },
      },
    });

    new Swiper('.brand-slider-2', {
      spaceBetween: 30,
      speed: 1300,
      loop: true,
      centeredSlides: true,
      autoplay: { delay: 2000, disableOnInteraction: false },
      breakpoints: {
        1199: { slidesPerView: 5 },
        991: { slidesPerView: 4 },
        767: { slidesPerView: 3 },
        575: { slidesPerView: 2 },
        0: { slidesPerView: 1 },
      },
    });

    new Swiper('.service-slider-2', {
      spaceBetween: 30,
      speed: 1500,
      loop: true,
      autoplay: { delay: 1500, disableOnInteraction: false },
      pagination: { el: '.dot-2', clickable: true },
      breakpoints: {
        1199: { slidesPerView: 4 },
        991: { slidesPerView: 2 },
        767: { slidesPerView: 2 },
        575: { slidesPerView: 2 },
        0: { slidesPerView: 1 },
      },
    });

    new Swiper('.project-slider-2', {
      spaceBetween: 30,
      speed: 1500,
      loop: true,
      autoplay: { delay: 1500, disableOnInteraction: false },
      pagination: { el: '.dot-2', clickable: true },
      navigation: { nextEl: '.array-prev', prevEl: '.array-next' },
      breakpoints: {
        1199: { slidesPerView: 3 },
        991: { slidesPerView: 2 },
        767: { slidesPerView: 2 },
        575: { slidesPerView: 1 },
        0: { slidesPerView: 1 },
      },
    });

    new Swiper('.project-slider-3', {
      spaceBetween: 30,
      speed: 1500,
      loop: true,
      autoplay: { delay: 1500, disableOnInteraction: false },
      pagination: { el: '.dot-2', clickable: true },
      breakpoints: {
        1199: { slidesPerView: 4 },
        991: { slidesPerView: 2 },
        767: { slidesPerView: 2 },
        650: { slidesPerView: 2 },
        575: { slidesPerView: 1 },
        0: { slidesPerView: 1 },
      },
    });

    new Swiper('.testimonial-slider-2', {
      speed: 1500,
      loop: true,
      spaceBetween: 30,
      autoplay: { delay: 1500, disableOnInteraction: false },
      navigation: { nextEl: '.array-prev', prevEl: '.array-next' },
      breakpoints: {
        991: { slidesPerView: 2 },
        767: { slidesPerView: 1 },
        575: { slidesPerView: 1 },
        0: { slidesPerView: 1 },
      },
    });

    new Swiper('.news-slider', {
      spaceBetween: 30,
      speed: 1500,
      loop: true,
      autoplay: { delay: 2000, disableOnInteraction: false },
      navigation: { nextEl: '.array-prev', prevEl: '.array-next' },
      breakpoints: {
        1199: { slidesPerView: 3 },
        991: { slidesPerView: 2 },
        767: { slidesPerView: 2 },
        575: { slidesPerView: 1 },
        0: { slidesPerView: 1 },
      },
    });

    new Swiper('.team-slider', {
      spaceBetween: 30,
      speed: 1500,
      loop: true,
      autoplay: { delay: 1500, disableOnInteraction: false },
      pagination: { el: '.dot-2', clickable: true },
      breakpoints: {
        1199: { slidesPerView: 4 },
        991: { slidesPerView: 2 },
        767: { slidesPerView: 2 },
        575: { slidesPerView: 2 },
        0: { slidesPerView: 1 },
      },
    });

    const teamItems = document.querySelectorAll('.team-items');
    function followImageCursor(event, teamItemEl) {
      const rect = teamItemEl.getBoundingClientRect();
      const dx = event.clientX - rect.x;
      const dy = event.clientY - rect.y;
      if (teamItemEl.children[2]) {
        teamItemEl.children[2].style.transform = `translate(${dx}px, ${dy}px) rotate(0)`;
      }
    }
    teamItems.forEach((item) => {
      item.addEventListener('mousemove', (event) => {
        followImageCursor(event, item);
      });
    });

    const $searchWrap = $('.search-wrap');
    const $navSearch = $('.nav-search');
    const $searchClose = $('#search-close');

    $('.search-trigger').on('click', function (e) {
      e.preventDefault();
      $searchWrap.animate({ opacity: 'toggle' }, 500);
      $navSearch.add($searchClose).addClass('open');
    });

    $('.search-close').on('click', function (e) {
      e.preventDefault();
      $searchWrap.animate({ opacity: 'toggle' }, 500);
      $navSearch.add($searchClose).removeClass('open');
    });

    function closeSearch() {
      $searchWrap.fadeOut(200);
      $navSearch.add($searchClose).removeClass('open');
    }

    $(document.body).on('click', function () {
      closeSearch();
    });

    $('.search-trigger, .main-search-input').on('click', function (e) {
      e.stopPropagation();
    });

    function mousecursor() {
      if ($('body')) {
        const inner = document.querySelector('.cursor-inner');
        const outer = document.querySelector('.cursor-outer');
        if (!inner || !outer) return;

        window.onmousemove = function (s) {
          outer.style.transform = 'translate(' + s.clientX + 'px, ' + s.clientY + 'px)';
          inner.style.transform = 'translate(' + s.clientX + 'px, ' + s.clientY + 'px)';
        };

        $('body').on('mouseenter', 'a, .cursor-pointer', function () {
          inner.classList.add('cursor-hover');
          outer.classList.add('cursor-hover');
        });
        $('body').on('mouseleave', 'a, .cursor-pointer', function () {
          if (!($(this).is('a') && $(this).closest('.cursor-pointer').length)) {
            inner.classList.remove('cursor-hover');
            outer.classList.remove('cursor-hover');
          }
        });
        inner.style.visibility = 'visible';
        outer.style.visibility = 'visible';
      }
    }
    mousecursor();

    if ($('[data-bg-src]').length > 0) {
      $('[data-bg-src]').each(function () {
        const src = $(this).attr('data-bg-src');
        $(this).css('background-image', 'url(' + src + ')');
        $(this).removeAttr('data-bg-src').addClass('background-image');
      });
    }

    if ($('[data-mask-src]').length > 0) {
      $('[data-mask-src]').each(function () {
        const mask = $(this).attr('data-mask-src');
        $(this).css({
          'mask-image': 'url(' + mask + ')',
          '-webkit-mask-image': 'url(' + mask + ')',
        });
        $(this).addClass('bg-mask');
        $(this).removeAttr('data-mask-src');
      });
    }

    $('.gt-slider').each(function () {
      const gtSlider = $(this);
      const settings = $(this).data('slider-options') || {};

      const prevArrow = gtSlider.find('.slider-prev');
      const nextArrow = gtSlider.find('.slider-next');
      const paginationEl = gtSlider.find('.slider-pagination');
      const paginationElN = gtSlider.find('.slider-pagination.pagi-number');

      const paginationType = settings.paginationType ? settings.paginationType : 'bullets';
      const autoplayconditon = settings.autoplay;

      const sliderDefault = {
        slidesPerView: 1,
        spaceBetween: settings.spaceBetween ? settings.spaceBetween : 24,
        loop: settings.loop === false ? false : true,
        speed: settings.speed ? settings.speed : 1000,
        initialSlide: settings.initialSlide ? settings.initialSlide : 0,
        centeredSlides: settings.centeredSlides === true,
        autoplay: autoplayconditon
          ? autoplayconditon
          : { delay: 6000, disableOnInteraction: false },
        navigation: {
          nextEl: nextArrow.get(0),
          prevEl: prevArrow.get(0),
        },
        pagination: {
          el: paginationEl.get(0),
          type: paginationType,
          clickable: true,
          renderBullet(index, className) {
            const number = index + 1;
            const formattedNumber = number < 10 ? '0' + number : number;
            if (paginationElN.length) {
              return '<span class="' + className + ' number">' + formattedNumber + '</span>';
            }
            return (
              '<span class="' +
              className +
              '" aria-label="Go to Slide ' +
              formattedNumber +
              '"></span>'
            );
          },
        },
      };

      const options = $.extend({}, sliderDefault, settings);
      // Initialize Swiper instance (side effects only, instance not used)
      new Swiper(gtSlider.get(0), options);

      if ($('.slider-area').length > 0) {
        $('.slider-area').closest('.container').parent().addClass('arrow-wrap');
      }
    });

    function animationProperties() {
      $('[data-ani]').each(function () {
        const animationName = $(this).data('ani');
        $(this).addClass(animationName);
      });

      $('[data-ani-delay]').each(function () {
        const delayTime = $(this).data('ani-delay');
        $(this).css('animation-delay', delayTime);
      });
    }
    animationProperties();

    $('[data-slider-prev], [data-slider-next]').on('click', function () {
      const sliderSelector = $(this).data('slider-prev') || $(this).data('slider-next');
      const targetSlider = $(sliderSelector);

      if (targetSlider.length) {
        const swiper = targetSlider[0].swiper;
        if (swiper) {
          if ($(this).data('slider-prev')) {
            swiper.slidePrev();
          } else {
            swiper.slideNext();
          }
        }
      }
    });

    $('.progress-bar').each(function () {
      const $this = $(this);
      const match = $this.attr('style') ? $this.attr('style').match(/width:\s*(\d+)%/) : null;
      if (!match) return;
      const progressWidth = match[1] + '%';

      $this.waypoint(
        function () {
          $this.css({
            '--progress-width': progressWidth,
            animation: 'animate-positive 1.8s forwards',
            opacity: '1',
          });
        },
        { offset: '75%' }
      );
    });

    const checkbox = $('#agreeCheckbox');
    const submitButton = $('#submitButton');

    checkbox.on('change', function () {
      submitButton.prop('disabled', !this.checked);
    });
  });

  function loader() {
    $(window).on('load', function () {
      $('.preloader').addClass('loaded');
      $('.preloader').delay(600).fadeOut();
    });
  }
  loader();
})(jQuery);
