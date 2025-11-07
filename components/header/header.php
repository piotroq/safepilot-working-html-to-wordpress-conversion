<?php

/**
 * Header Component - SafePilot WordPress Theme
 *
 * @package    SafePilot
 * @subpackage Components/Header
 * @version    2.0.0
 * @author     PB MEDIA
 * @since      1.0.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// Get theme options.
$theme_options = get_theme_mod('safepilot_header_settings', array());
$sticky_header = get_theme_mod('safepilot_sticky_header', true);
$transparent_header = get_theme_mod('safepilot_transparent_header', false);
$topbar_enabled = get_theme_mod('safepilot_topbar_enabled', true);

// Get contact information.
$phone_primary = get_theme_mod('safepilot_phone_primary', '+48 726 739 238');
$email_primary = get_theme_mod('safepilot_email_primary', 'biuro@safepilot.pl');
$business_hours = get_theme_mod('safepilot_business_hours', 'Pon-Pt: 8:00-16:00');

// Header classes.
$header_classes = array('safepilot-header');
if ($sticky_header) {
    $header_classes[] = 'safepilot-header--sticky';
}
if ($transparent_header && is_front_page()) {
    $header_classes[] = 'safepilot-header--transparent';
}

// Check if WooCommerce is active.
$woocommerce_active = class_exists('WooCommerce');
?>

<!-- Start Header Area -->
<header id="masthead" class="<?php echo esc_attr(implode(' ', $header_classes)); ?>" role="banner" itemscope itemtype="https://schema.org/WPHeader">

    <?php if ($topbar_enabled) : ?>
        <!-- Start Topbar -->
        <div class="safepilot-topbar" role="complementary">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-7">
                        <div class="safepilot-topbar__info">
                            <?php if (! empty($business_hours)) : ?>
                                <div class="safepilot-topbar__item safepilot-topbar__item--hours">
                                    <i class="fas fa-clock" aria-hidden="true"></i>
                                    <span><?php echo esc_html($business_hours); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (! empty($phone_primary)) : ?>
                                <div class="safepilot-topbar__item safepilot-topbar__item--phone">
                                    <i class="fas fa-phone-alt" aria-hidden="true"></i>
                                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_primary)); ?>"
                                        aria-label="<?php esc_attr_e('Zadzwoń do nas', 'safepilot'); ?>">
                                        <?php echo esc_html($phone_primary); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if (! empty($email_primary)) : ?>
                                <div class="safepilot-topbar__item safepilot-topbar__item--email">
                                    <i class="fas fa-envelope" aria-hidden="true"></i>
                                    <a href="mailto:<?php echo esc_attr($email_primary); ?>"
                                        aria-label="<?php esc_attr_e('Napisz do nas', 'safepilot'); ?>">
                                        <?php echo esc_html($email_primary); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-5">
                        <div class="safepilot-topbar__right">
                            <?php
                            // Social Media Links.
                            get_template_part('components/social-links/social-links');

                            // Language Switcher (WPML/Polylang compatibility).
                            if (function_exists('pll_the_languages')) : ?>
                                <div class="safepilot-topbar__lang">
                                    <?php
                                    pll_the_languages(
                                        array(
                                            'dropdown' => 0,
                                            'show_flags' => 1,
                                            'show_names' => 0,
                                            'hide_current' => 0,
                                        )
                                    );
                                    ?>
                                </div>
                            <?php endif; ?>

                            <!-- Accessibility Tools -->
                            <div class="safepilot-topbar__accessibility">
                                <button type="button"
                                    class="safepilot-accessibility-toggle"
                                    aria-label="<?php esc_attr_e('Opcje dostępności', 'safepilot'); ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#accessibilityModal">
                                    <i class="fas fa-universal-access" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
    <?php endif; ?>

    <!-- Start Main Header -->
    <div class="safepilot-header__main">
        <div class="container">
            <div class="row align-items-center">

                <!-- Logo Column -->
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="safepilot-header__logo">
                        <?php
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');

                        if (has_custom_logo()) :
                            the_custom_logo();
                        else : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>"
                                rel="home"
                                class="safepilot-logo-link"
                                aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                <svg class="safepilot-logo" width="200" height="60" viewBox="0 0 200 60" xmlns="http://www.w3.org/2000/svg">
                                    <!-- SafePilot Logo SVG -->
                                    <g class="safepilot-logo__icon">
                                        <path d="M15 30 L25 15 L35 30 L25 45 Z" fill="#4fb9ad" />
                                        <path d="M25 25 L30 20 L35 25 L30 30 Z" fill="#213543" />
                                    </g>
                                    <text x="45" y="35" font-family="Rajdhani, sans-serif" font-size="24" font-weight="600" fill="#213543">
                                        SafePilot
                                    </text>
                                    <text x="45" y="48" font-family="Plus Jakarta Sans, sans-serif" font-size="10" fill="#4fb9ad">
                                        Bez zbędnych turbulencji!
                                    </text>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Navigation Column -->
                <div class="col-lg-7 col-md-5 d-none d-lg-block">
                    <nav id="site-navigation"
                        class="safepilot-header__nav"
                        role="navigation"
                        aria-label="<?php esc_attr_e('Menu główne', 'safepilot'); ?>"
                        itemscope
                        itemtype="https://schema.org/SiteNavigationElement">

                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'primary',
                                'menu_id'         => 'primary-menu',
                                'menu_class'      => 'safepilot-nav safepilot-nav--primary',
                                'container'       => false,
                                'fallback_cb'     => 'SafePilot\Theme\Components\Navigation::fallback_menu',
                                'walker'          => new SafePilot\Theme\Components\Bootstrap_Walker_Nav_Menu(),
                                'depth'           => 3,
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            )
                        );
                        ?>
                    </nav>
                </div>

                <!-- Action Buttons Column -->
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="safepilot-header__actions">

                        <!-- Search Toggle -->
                        <button type="button"
                            class="safepilot-header__search-toggle"
                            aria-label="<?php esc_attr_e('Otwórz wyszukiwanie', 'safepilot'); ?>"
                            aria-expanded="false"
                            aria-controls="search-overlay">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </button>

                        <?php if ($woocommerce_active) : ?>
                            <!-- Mini Cart -->
                            <div class="safepilot-header__cart">
                                <a href="<?php echo esc_url(wc_get_cart_url()); ?>"
                                    class="safepilot-cart-toggle"
                                    aria-label="<?php esc_attr_e('Koszyk', 'safepilot'); ?>">
                                    <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                                    <?php if (WC()->cart->get_cart_contents_count() > 0) : ?>
                                        <span class="safepilot-cart-count">
                                            <?php echo esc_html(WC()->cart->get_cart_contents_count()); ?>
                                        </span>
                                    <?php endif; ?>
                                </a>

                                <!-- Mini Cart Dropdown -->
                                <div class="safepilot-minicart" aria-hidden="true">
                                    <?php woocommerce_mini_cart(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- User Account -->
                        <div class="safepilot-header__user">
                            <?php if (is_user_logged_in()) : ?>
                                <?php
                                $current_user = wp_get_current_user();
                                $account_url = $woocommerce_active ? wc_get_page_permalink('myaccount') : admin_url('profile.php');
                                ?>
                                <div class="dropdown">
                                    <button class="safepilot-user-toggle dropdown-toggle"
                                        type="button"
                                        id="userDropdown"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        aria-label="<?php esc_attr_e('Menu użytkownika', 'safepilot'); ?>">
                                        <?php echo get_avatar($current_user->ID, 32, '', '', array('class' => 'safepilot-user-avatar')); ?>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li class="dropdown-header">
                                            <?php
                                            /* translators: %s: user display name */
                                            printf(esc_html__('Witaj, %s', 'safepilot'), esc_html($current_user->display_name));
                                            ?>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo esc_url($account_url); ?>">
                                                <i class="fas fa-user-circle me-2"></i>
                                                <?php esc_html_e('Moje konto', 'safepilot'); ?>
                                            </a>
                                        </li>
                                        <?php if ($woocommerce_active) : ?>
                                            <li>
                                                <a class="dropdown-item" href="<?php echo esc_url(wc_get_endpoint_url('orders', '', $account_url)); ?>">
                                                    <i class="fas fa-box me-2"></i>
                                                    <?php esc_html_e('Moje zamówienia', 'safepilot'); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (current_user_can('manage_options')) : ?>
                                            <li>
                                                <a class="dropdown-item" href="<?php echo esc_url(admin_url()); ?>">
                                                    <i class="fas fa-cog me-2"></i>
                                                    <?php esc_html_e('Panel administracyjny', 'safepilot'); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo esc_url(wp_logout_url(home_url())); ?>">
                                                <i class="fas fa-sign-out-alt me-2"></i>
                                                <?php esc_html_e('Wyloguj się', 'safepilot'); ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php else : ?>
                                <a href="<?php echo esc_url(wp_login_url()); ?>"
                                    class="safepilot-login-btn"
                                    aria-label="<?php esc_attr_e('Zaloguj się', 'safepilot'); ?>">
                                    <i class="fas fa-user" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                        </div>

                        <!-- CTA Button -->
                        <div class="safepilot-header__cta d-none d-xl-block">
                            <a href="<?php echo esc_url(get_theme_mod('safepilot_header_cta_url', '/kontakt')); ?>"
                                class="btn btn-primary btn-sm safepilot-btn safepilot-btn--gradient">
                                <i class="fas fa-calendar-check me-2"></i>
                                <?php echo esc_html(get_theme_mod('safepilot_header_cta_text', __('Umów konsultację', 'safepilot'))); ?>
                            </a>
                        </div>

                        <!-- Mobile Menu Toggle -->
                        <button type="button"
                            class="safepilot-header__mobile-toggle d-lg-none"
                            aria-label="<?php esc_attr_e('Otwórz menu mobilne', 'safepilot'); ?>"
                            aria-expanded="false"
                            aria-controls="mobile-menu">
                            <span class="safepilot-hamburger">
                                <span class="safepilot-hamburger__line"></span>
                                <span class="safepilot-hamburger__line"></span>
                                <span class="safepilot-hamburger__line"></span>
                            </span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Main Header -->

    <!-- Start Mobile Menu -->
    <div class="safepilot-mobile-menu" id="mobile-menu" aria-hidden="true">
        <div class="safepilot-mobile-menu__overlay"></div>
        <div class="safepilot-mobile-menu__content">

            <!-- Mobile Menu Header -->
            <div class="safepilot-mobile-menu__header">
                <div class="safepilot-mobile-menu__logo">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <span class="safepilot-mobile-menu__title">
                            <?php bloginfo('name'); ?>
                        </span>
                    <?php endif; ?>
                </div>
                <button type="button"
                    class="safepilot-mobile-menu__close"
                    aria-label="<?php esc_attr_e('Zamknij menu', 'safepilot'); ?>">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>

            <!-- Mobile Menu Search -->
            <div class="safepilot-mobile-menu__search">
                <form role="search"
                    method="get"
                    class="safepilot-search-form"
                    action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="input-group">
                        <input type="search"
                            class="form-control"
                            placeholder="<?php esc_attr_e('Szukaj...', 'safepilot'); ?>"
                            value="<?php echo get_search_query(); ?>"
                            name="s"
                            aria-label="<?php esc_attr_e('Szukaj', 'safepilot'); ?>" />
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Mobile Menu Navigation -->
            <nav class="safepilot-mobile-menu__nav"
                role="navigation"
                aria-label="<?php esc_attr_e('Menu mobilne', 'safepilot'); ?>">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'  => 'mobile',
                        'menu_id'         => 'mobile-menu-list',
                        'menu_class'      => 'safepilot-mobile-nav',
                        'container'       => false,
                        'fallback_cb'     => 'SafePilot\Theme\Components\Navigation::mobile_fallback_menu',
                        'walker'          => new SafePilot\Theme\Components\Mobile_Walker_Nav_Menu(),
                        'depth'           => 3,
                    )
                );
                ?>
            </nav>

            <!-- Mobile Menu Contact Info -->
            <div class="safepilot-mobile-menu__contact">
                <h3 class="safepilot-mobile-menu__subtitle">
                    <?php esc_html_e('Kontakt', 'safepilot'); ?>
                </h3>
                <ul class="safepilot-contact-list">
                    <?php if (! empty($phone_primary)) : ?>
                        <li>
                            <i class="fas fa-phone-alt text-primary"></i>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone_primary)); ?>">
                                <?php echo esc_html($phone_primary); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (! empty($email_primary)) : ?>
                        <li>
                            <i class="fas fa-envelope text-primary"></i>
                            <a href="mailto:<?php echo esc_attr($email_primary); ?>">
                                <?php echo esc_html($email_primary); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <i class="fas fa-map-marker-alt text-primary"></i>
                        <span>ul. Kordiana 50B/65, 30-653 Kraków</span>
                    </li>
                </ul>
            </div>

            <!-- Mobile Menu CTA -->
            <div class="safepilot-mobile-menu__cta">
                <a href="<?php echo esc_url(get_theme_mod('safepilot_header_cta_url', '/kontakt')); ?>"
                    class="btn btn-primary btn-block safepilot-btn safepilot-btn--gradient">
                    <i class="fas fa-calendar-check me-2"></i>
                    <?php echo esc_html(get_theme_mod('safepilot_header_cta_text', __('Umów konsultację', 'safepilot'))); ?>
                </a>

                <?php if (! empty(get_theme_mod('safepilot_whatsapp_number'))) : ?>
                    <a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', get_theme_mod('safepilot_whatsapp_number'))); ?>"
                        class="btn btn-success btn-block safepilot-btn mt-2"
                        target="_blank"
                        rel="noopener noreferrer">
                        <i class="fab fa-whatsapp me-2"></i>
                        <?php esc_html_e('WhatsApp', 'safepilot'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Social Links -->
            <div class="safepilot-mobile-menu__social">
                <?php get_template_part('components/social-links/social-links', 'mobile'); ?>
            </div>
        </div>
    </div>
    <!-- End Mobile Menu -->

    <!-- Start Search Overlay -->
    <div class="safepilot-search-overlay" id="search-overlay" aria-hidden="true">
        <button type="button"
            class="safepilot-search-overlay__close"
            aria-label="<?php esc_attr_e('Zamknij wyszukiwanie', 'safepilot'); ?>">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>

        <div class="safepilot-search-overlay__content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <form role="search"
                            method="get"
                            class="safepilot-search-form safepilot-search-form--large"
                            action="<?php echo esc_url(home_url('/')); ?>">
                            <div class="safepilot-search-form__wrapper">
                                <input type="search"
                                    class="safepilot-search-form__input"
                                    placeholder="<?php esc_attr_e('Wpisz szukaną frazę...', 'safepilot'); ?>"
                                    value="<?php echo get_search_query(); ?>"
                                    name="s"
                                    autocomplete="off"
                                    aria-label="<?php esc_attr_e('Szukaj', 'safepilot'); ?>" />
                                <button class="safepilot-search-form__submit" type="submit">
                                    <i class="fas fa-search" aria-hidden="true"></i>
                                    <span><?php esc_html_e('Szukaj', 'safepilot'); ?></span>
                                </button>
                            </div>
                        </form>

                        <!-- Popular Searches -->
                        <?php
                        $popular_searches = get_theme_mod('safepilot_popular_searches', array('BHP', 'Szkolenia', 'Pierwsza pomoc', 'PPOŻ', 'Ocena ryzyka'));
                        if (! empty($popular_searches)) :
                        ?>
                            <div class="safepilot-search-overlay__popular">
                                <h3><?php esc_html_e('Popularne wyszukiwania:', 'safepilot'); ?></h3>
                                <div class="safepilot-search-tags">
                                    <?php foreach ($popular_searches as $term) : ?>
                                        <a href="<?php echo esc_url(home_url('/?s=' . urlencode($term))); ?>"
                                            class="safepilot-search-tag">
                                            <?php echo esc_html($term); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search Overlay -->

    <!-- Progress Bar for Sticky Header -->
    <?php if ($sticky_header && is_singular('post')) : ?>
        <div class="safepilot-reading-progress" aria-hidden="true">
            <div class="safepilot-reading-progress__bar"></div>
        </div>
    <?php endif; ?>

</header>
<!-- End Header Area -->

<!-- Accessibility Modal -->
<div class="modal fade" id="accessibilityModal" tabindex="-1" aria-labelledby="accessibilityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accessibilityModalLabel">
                    <i class="fas fa-universal-access me-2"></i>
                    <?php esc_html_e('Opcje dostępności', 'safepilot'); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php esc_attr_e('Zamknij', 'safepilot'); ?>"></button>
            </div>
            <div class="modal-body">
                <div class="safepilot-accessibility-options">

                    <!-- Font Size Controls -->
                    <div class="safepilot-accessibility-option">
                        <label><?php esc_html_e('Rozmiar tekstu:', 'safepilot'); ?></label>
                        <div class="btn-group" role="group" aria-label="<?php esc_attr_e('Zmień rozmiar tekstu', 'safepilot'); ?>">
                            <button type="button" class="btn btn-outline-primary" data-font-size="small">
                                A-
                            </button>
                            <button type="button" class="btn btn-outline-primary active" data-font-size="normal">
                                A
                            </button>
                            <button type="button" class="btn btn-outline-primary" data-font-size="large">
                                A+
                            </button>
                        </div>
                    </div>

                    <!-- Contrast Controls -->
                    <div class="safepilot-accessibility-option">
                        <label><?php esc_html_e('Kontrast:', 'safepilot'); ?></label>
                        <div class="btn-group" role="group" aria-label="<?php esc_attr_e('Zmień kontrast', 'safepilot'); ?>">
                            <button type="button" class="btn btn-outline-primary active" data-contrast="normal">
                                <?php esc_html_e('Normalny', 'safepilot'); ?>
                            </button>
                            <button type="button" class="btn btn-outline-primary" data-contrast="high">
                                <?php esc_html_e('Wysoki', 'safepilot'); ?>
                            </button>
                            <button type="button" class="btn btn-outline-primary" data-contrast="dark">
                                <?php esc_html_e('Ciemny', 'safepilot'); ?>
                            </button>
                        </div>
                    </div>

                    <!-- Other Accessibility Options -->
                    <div class="safepilot-accessibility-option">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="underlinkLinks" data-accessibility="underline">
                            <label class="form-check-label" for="underlinkLinks">
                                <?php esc_html_e('Podkreśl linki', 'safepilot'); ?>
                            </label>
                        </div>
                    </div>

                    <div class="safepilot-accessibility-option">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="readableFont" data-accessibility="readable-font">
                            <label class="form-check-label" for="readableFont">
                                <?php esc_html_e('Czytelna czcionka', 'safepilot'); ?>
                            </label>
                        </div>
                    </div>

                    <div class="safepilot-accessibility-option">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="stopAnimations" data-accessibility="stop-animations">
                            <label class="form-check-label" for="stopAnimations">
                                <?php esc_html_e('Zatrzymaj animacje', 'safepilot'); ?>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="resetAccessibility">
                    <?php esc_html_e('Resetuj', 'safepilot'); ?>
                </button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                    <?php esc_html_e('Zastosuj', 'safepilot'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<?php
// Hook for adding additional content after header.
do_action('safepilot_after_header');
?>