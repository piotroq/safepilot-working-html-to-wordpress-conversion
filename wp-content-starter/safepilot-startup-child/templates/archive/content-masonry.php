<?php
/**
 * SafePilot - Template wyświetlania wpisów masonry
 * @package SafePilot
 * @version 2.1
 */

$size = 'full';
$excerpt = get_the_excerpt();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sp-post-masonry gf-item-wrap clearfix'); ?>>
        
    <!-- Obrazek wyróżniający -->
    <?php if (has_post_thumbnail()): ?>
        <div class="sp-post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail($size, array('class' => 'img-fluid')); ?>
            </a>
            <div class="sp-post-category">
                <?php 
                $categories = get_the_category();
                if (!empty($categories)) {
                    echo '<span class="sp-cat-badge">' . esc_html($categories[0]->name) . '</span>';
                }
                ?>
            </div>
        </div>
    <?php else: ?>
        <div class="sp-post-thumbnail sp-no-image">
            <a href="<?php the_permalink(); ?>">
                <div class="sp-placeholder-image">
                    <i class="fa-regular fa-image"></i>
                    <span>Brak obrazka</span>
                </div>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="sp-entry-content-wrap">
        <!-- Meta -->
        <div class="sp-post-meta">
            <span class="sp-meta-date">
                <i class="fa-regular fa-clock"></i>
                <?php echo get_the_date(); ?>
            </span>
            <span class="sp-meta-author">
                <i class="fa-regular fa-user"></i>
                <?php the_author(); ?>
            </span>
        </div>
        
        <!-- Tytuł -->
        <?php if (!empty(get_the_title())): ?>
            <h3 class="sp-entry-title">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>
        <?php endif; ?>
        
        <!-- Zajawka -->
        <?php if ($excerpt !== ''): ?>
            <div class="sp-entry-excerpt">
                <?php echo wp_trim_words($excerpt, 25, '...'); ?>
            </div>
        <?php endif; ?>
        
        <!-- Przycisk -->
        <a href="<?php the_permalink(); ?>" class="sp-btn-more">
            Czytaj dalej
        </a>
    </div>
</article>