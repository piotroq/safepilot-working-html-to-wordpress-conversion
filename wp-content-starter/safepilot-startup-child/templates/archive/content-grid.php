<?php
/**
 * SafePilot - Grid Post Template
 * @package SafePilot
 * @version 2.3
 */

$excerpt = get_the_excerpt();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('sp-post-card'); ?>>
    
    <!-- Featured Image -->
    <?php if (has_post_thumbnail()) : ?>
        <div class="sp-post-image">
            <a href="<?php the_permalink(); ?>">
                <?php 
                $thumbnail_id = get_post_thumbnail_id();
                echo wp_get_attachment_image($thumbnail_id, 'sp-grid', false, array(
                    'class' => 'img-fluid',
                    'alt' => get_the_title(),
                    'loading' => 'lazy'
                ));
                ?>
            </a>
            
            <!-- Category Badge -->
            <?php 
            $categories = get_the_category();
            if (!empty($categories)) : ?>
                <div class="sp-post-category">
                    <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                        <?php echo esc_html($categories[0]->name); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="sp-post-image sp-no-image">
            <a href="<?php the_permalink(); ?>">
                <div class="sp-placeholder">
                    <i class="fa-regular fa-image"></i>
                </div>
            </a>
        </div>
    <?php endif; ?>
    
    <!-- Post Content -->
    <div class="sp-post-content">
        
        <!-- Meta -->
        <div class="sp-post-meta">
            <span class="sp-meta-date">
                <i class="fa-regular fa-calendar"></i>
                <?php echo get_the_date(); ?>
            </span>
            <span class="sp-meta-author">
                <i class="fa-regular fa-user"></i>
                <?php the_author(); ?>
            </span>
        </div>
        
        <!-- Title -->
        <h2 class="sp-post-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
        
        <!-- Excerpt -->
        <?php if ($excerpt) : ?>
            <div class="sp-post-excerpt">
                <?php echo wp_trim_words($excerpt, 20, '...'); ?>
            </div>
        <?php endif; ?>
        
        <!-- Read More -->
        <a href="<?php the_permalink(); ?>" class="sp-read-more">
            Czytaj więcej <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</article>