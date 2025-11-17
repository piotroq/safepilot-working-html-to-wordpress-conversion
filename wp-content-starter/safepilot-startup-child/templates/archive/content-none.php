<?php
/**
 * SafePilot - Template gdy brak treści
 * @package SafePilot
 * @version 2.0
 */
?>

<div class="sp-no-results not-found">
    <div class="sp-no-results-wrap">
        
        <div class="sp-no-results-icon">
            <i class="fa-regular fa-folder-open"></i>
        </div>
        
        <h2 class="sp-no-results-title">
            <?php esc_html_e('Brak wpisów', 'safepilot'); ?>
        </h2>
        
        <?php if (is_home() && current_user_can('publish_posts')): ?>
            <p class="sp-no-results-text">
                <?php 
                printf(
                    wp_kses_post(__('Gotowy do publikacji pierwszego wpisu? <a href="%1$s">Zacznij tutaj</a>.', 'safepilot')), 
                    esc_url(admin_url('post-new.php'))
                ); 
                ?>
            </p>
        <?php elseif (is_search()): ?>
            <p class="sp-no-results-text">
                <?php esc_html_e('Przepraszamy, ale nic nie pasuje do Twoich kryteriów wyszukiwania. Spróbuj ponownie z innymi słowami kluczowymi.', 'safepilot'); ?>
            </p>
            <div class="sp-search-form-wrapper">
                <?php get_search_form(); ?>
            </div>
        <?php else: ?>
            <p class="sp-no-results-text">
                <?php esc_html_e('Nie możemy znaleźć tego, czego szukasz. Może wyszukiwanie pomoże.', 'safepilot'); ?>
            </p>
            <div class="sp-search-form-wrapper">
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
        
    </div>
</div>