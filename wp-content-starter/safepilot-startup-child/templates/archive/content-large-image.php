<?php
/**
 * SafePilot - Template wyświetlania wpisów z dużym obrazkiem
 * @package SafePilot
 * @version 2.2
 */

$excerpt = get_the_excerpt();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sp-post-large-image clearfix margin-extech-shortcode py-5 mb-60 mt-60'); ?>>
    
    <!-- Obrazek wyróżniający -->
    <?php if (has_post_thumbnail()): ?>
        <div class="sp-post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php 
                // Użyj wp_get_attachment_image zamiast the_post_thumbnail
                $thumbnail_id = get_post_thumbnail_id();
                echo wp_get_attachment_image($thumbnail_id, 'sp-large', false, array(
                    'class' => 'img-fluid sp-featured-img',
                    'alt' => get_the_title(),
                    'loading' => 'lazy'
                ));
                ?>
            </a>
        </div>
    <?php else: ?>
        <div class="sp-post-thumbnail sp-no-image">
            <a href="<?php the_permalink(); ?>">
                <div class="sp-placeholder-image sp-placeholder-large">
                    <i class="fa-regular fa-image"></i>
                    <span>Brak obrazka</span>
                </div>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="sp-entry-content-wrap clearfix">
        
        <!-- Data i informacje -->
        <div class="sp-entry-info clearfix">
            <div class="sp-entry-date-wrap">
                <div class="sp-entry-date">
                    <span class="day"><?php echo get_the_date('d'); ?></span>
                    <span class="month"><?php echo get_the_date('M'); ?></span>
                </div>
            </div>
            
            <div class="sp-entry-title-meta">
                <?php if (!empty(get_the_title())): ?>
                    <h3 class="sp-entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                <?php endif; ?>
                
                <!-- Meta informacje -->
                <div class="sp-entry-meta">
                    <span class="sp-meta-author">
                        <i class="fa-solid fa-user"></i>
                        <?php the_author_posts_link(); ?>
                    </span>
                    <span class="sp-meta-category">
                        <i class="fa-solid fa-folder"></i>
                        <?php the_category(', '); ?>
                    </span>
                    <?php if (comments_open()): ?>
                        <span class="sp-meta-comments">
                            <i class="fa-solid fa-comment"></i>
                            <?php comments_popup_link('0', '1', '%'); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Zajawka -->
        <?php if ($excerpt !== ''): ?>
            <div class="sp-entry-excerpt">
                <?php echo wp_trim_words($excerpt, 30, '...'); ?>
            </div>
        <?php endif; ?>
        
        <!-- Przycisk czytaj więcej -->
        <a href="<?php the_permalink(); ?>" class="sp-btn-read-more">
            Czytaj więcej <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</article>