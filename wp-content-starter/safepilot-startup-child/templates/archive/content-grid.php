<?php
/**
 * SafePilot - Template wyświetlania wpisów w siatce
 * @package SafePilot
 * @version 2.0
 */

$size = 'medium-image';
$excerpt = get_the_excerpt();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sp-post-grid gf-item-wrap clearfix'); ?>>
    
    <!-- Obrazek wyróżniający -->
    <?php if (has_post_thumbnail()): ?>
        <div class="sp-post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail($size, array('class' => 'img-fluid')); ?>
                <img src="<?php get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" width="500" height="600">
            </a>
            <div class="sp-post-overlay">
                <a href="<?php the_permalink(); ?>" class="sp-overlay-link">
                    <i class="fa-solid fa-link"></i>
                </a>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="sp-entry-content-wrap">
        <!-- Data -->
        <div class="sp-post-date">
            <i class="fa-regular fa-calendar"></i>
            <?php echo get_the_date(); ?>
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
                <?php echo wp_trim_words($excerpt, 20, '...'); ?>
            </div>
        <?php endif; ?>
        
        <!-- Link czytaj więcej -->
        <a href="<?php the_permalink(); ?>" class="sp-link-more">
            Zobacz więcej <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</article>