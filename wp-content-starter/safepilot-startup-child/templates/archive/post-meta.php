<?php
/**
 * SafePilot - Meta informacje wpisu
 * @package SafePilot
 * @version 2.0
 */
?>

<div class="sp-post-meta">
    <!-- Autor -->
    <div class="sp-meta-item sp-meta-author">
        <i class="fa-solid fa-user"></i>
        <?php 
        printf(
            '<a href="%1$s" class="sp-author-link">%2$s</a>', 
            esc_url(get_author_posts_url(get_the_author_meta('ID'))), 
            esc_html(get_the_author())
        ); 
        ?>
    </div>
    
    <!-- Data -->
    <div class="sp-meta-item sp-meta-date">
        <i class="fa-regular fa-calendar"></i>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php echo get_the_date(); ?>
        </a>
    </div>
    
    <!-- Kategorie -->
    <div class="sp-meta-item sp-meta-categories">
        <i class="fa-solid fa-folder-open"></i>
        <?php the_category(', '); ?>
    </div>
    
    <!-- Komentarze -->
    <?php if (comments_open() || get_comments_number()): ?>
        <div class="sp-meta-item sp-meta-comments">
            <i class="fa-regular fa-comment"></i>
            <?php 
            comments_popup_link(
                __('0 komentarzy', 'safepilot'), 
                __('1 komentarz', 'safepilot'), 
                __('% komentarzy', 'safepilot')
            ); 
            ?>
        </div>
    <?php endif; ?>
    
    <!-- Liczba wyświetleń (jeśli funkcja istnieje) -->
    <?php if (function_exists('g5plus_post_view')): ?>
        <div class="sp-meta-item sp-meta-views">
            <i class="fa-regular fa-eye"></i>
            <?php g5plus_post_view()->render(get_the_ID()); ?>
        </div>
    <?php endif; ?>
</div>