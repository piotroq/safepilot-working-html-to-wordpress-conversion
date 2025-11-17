<?php
/**
 * SafePilot - Related Posts Section
 * @package SafePilot
 * @version 2.0
 */

global $post;

// Sprawdź czy funkcja istnieje
if (!function_exists('g5plus_get_option')) {
    $single_related_post_enable = 1;
    $single_related_post_total = 3;
    $single_related_post_column = 3;
    $related_by_category = true;
    $related_by_tag = false;
} else {
    $single_related_post_enable = g5plus_get_option('single_related_post_enable', 1);
    if (!$single_related_post_enable || !isset($post->ID)) return;
    
    $single_related_post_condition = g5plus_get_option('single_related_post_condition', array());
    $related_by_category = isset($single_related_post_condition['category']) && $single_related_post_condition['category'] == 1;
    $related_by_tag = isset($single_related_post_condition['tag']) && $single_related_post_condition['tag'] == 1;
    $single_related_post_total = g5plus_get_option('single_related_post_total', 3);
    $single_related_post_column = g5plus_get_option('single_related_post_column', 3);
}

// Pobierz tagi i kategorie
$tag_slugs = wp_get_post_tags($post->ID, array('fields' => 'slugs'));
$cat_ids = wp_get_post_terms($post->ID, 'category', array('fields' => 'ids'));

if (empty($tag_slugs) && empty($cat_ids)) return;

// Argumenty zapytania
$args = array(
    'posts_per_page'      => $single_related_post_total,
    'ignore_sticky_posts' => 1,
    'post__not_in'        => array($post->ID),
    'post_status'         => 'publish',
    'tax_query'           => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => array('post-format-quote', 'post-format-link'),
            'operator' => 'NOT IN'
        )
    )
);

if ($related_by_category && !empty($cat_ids)) {
    $args['category__in'] = $cat_ids;
}

if ($related_by_tag && !empty($tag_slugs)) {
    $args['tax_query'][] = array(
        'taxonomy' => 'post_tag',
        'field'    => 'slug',
        'terms'    => $tag_slugs,
        'operator' => 'IN'
    );
}

$args = apply_filters('g5plus_related_post_args', $args);
$related_posts = new WP_Query($args);

if (!$related_posts->have_posts()) return;
?>

<section class="sp-related-posts">
    <div class="container padding-extech-shortcode-footer2">
        <div class="sp-section-header">
            <h2 class="sp-section-title">
                <span class="sp-title-icon"><i class="fa-solid fa-newspaper"></i></span>
                Sprawdź także inne wpisy
            </h2>
            <p class="sp-section-subtitle">Artykuły powiązane tematycznie</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-<?php echo esc_attr($single_related_post_column); ?> g-4">
            <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                <div class="col">
                    <article class="sp-related-card">
                        
                        <!-- Image -->
                        <div class="sp-related-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php 
                                    $thumbnail_id = get_post_thumbnail_id();
                                    echo wp_get_attachment_image($thumbnail_id, 'sp-grid', false, array(
                                        'class' => 'img-fluid',
                                        'alt' => get_the_title(),
                                        'loading' => 'lazy'
                                    ));
                                    ?>
                                <?php else : ?>
                                    <div class="sp-no-image-placeholder">
                                        <i class="fa-regular fa-image"></i>
                                    </div>
                                <?php endif; ?>
                            </a>
                            
                            <!-- Category Badge -->
                            <?php 
                            $categories = get_the_category();
                            if (!empty($categories)) : ?>
                                <span class="sp-category-badge">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Content -->
                        <div class="sp-related-content">
                            <div class="sp-related-meta">
                                <span class="sp-meta-date">
                                    <i class="fa-regular fa-calendar"></i>
                                    <?php echo get_the_date(); ?>
                                </span>
                            </div>

                            <h3 class="sp-related-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>

                            <?php if (has_excerpt()) : ?>
                                <p class="sp-related-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                </p>
                            <?php endif; ?>

                            <a href="<?php the_permalink(); ?>" class="sp-related-link">
                                Czytaj więcej <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- View All Button -->
        <div class="sp-related-footer">
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="sp-btn-view-all">
                Zobacz wszystkie wpisy <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<?php 
wp_reset_postdata(); 
?>