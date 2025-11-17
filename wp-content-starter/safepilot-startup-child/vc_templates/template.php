<?php
/**
 * SafePilot - Shortcode Blog
 * @var $atts
 * @var $this WPBakeryShortCode_G5Plus_Blog
 */

$el_class = $layout = $max_items = $posts_per_page = $order = $orderby = $meta_key = $post_paging = $category = $columns = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

global $wp_query;

// Klasy wrappera
$wrapper_classes = array(
    'sp-archive-wrap',
    'clearfix',
    $this->getExtraClass($el_class)
);

$wrapper_classes[] = 'sp-archive-' . $layout;

// Paginacja
$paged = is_front_page() ? 
    (get_query_var('page') ? intval(get_query_var('page')) : 1) : 
    (get_query_var('paged') ? intval(get_query_var('paged')) : 1);

$max_items = ($max_items == '') ? -1 : $max_items;

// Argumenty zapytania
$args = array(
    'post_type' => 'post',
    'paged' => $paged,
    'ignore_sticky_posts' => true,
    'posts_per_page' => $max_items > 0 ? $max_items : $posts_per_page,
    'orderby' => $orderby,
    'order' => $order,
    'meta_key' => $orderby == 'meta_key' ? $meta_key : '',
);

if ($post_paging == 'all' && $max_items == -1) {
    $args['nopaging'] = true;
}

// Kategorie
if (!empty($category)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'terms' => explode(',', $category),
            'field' => 'slug',
            'operator' => 'IN'
        )
    );
}

query_posts($args);

// Klasy blog wrappera
$blog_wrap_classes = array('sp-blog-wrap', 'clearfix');

if (in_array($layout, array('grid', 'masonry'))) {
    $page_layouts = &gf_get_page_layout_settings();
    $blog_wrap_classes[] = 'row';
    $blog_wrap_classes[] = 'g-4';
    
    if ($columns == 2) {
        $blog_wrap_classes[] = 'row-cols-1 row-cols-md-2';
    } elseif ($columns == 3) {
        $blog_wrap_classes[] = 'row-cols-1 row-cols-md-2 row-cols-lg-3';
    }
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode(' ', $wrapper_classes), $this->settings['base'], $atts);
?>

<div class="<?php echo esc_attr($css_class); ?>">
    <div class="<?php echo esc_attr(join(' ', $blog_wrap_classes)); ?>">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                if (in_array($layout, array('grid', 'masonry'))) {
                    echo '<div class="col">';
                }
                
                get_template_part('templates/archive/content', $layout);
                
                if (in_array($layout, array('grid', 'masonry'))) {
                    echo '</div>';
                }
            endwhile;
        else :
            get_template_part('templates/archive/content', 'none');
        endif;
        ?>
    </div>
    
    <?php 
    // Paginacja
    if ($wp_query->max_num_pages > 1 && $max_items == -1) {
        echo '<div class="sp-blog-pagination">';
        get_template_part('templates/paging/' . $post_paging);
        echo '</div>';
    }
    ?>
</div>

<?php wp_reset_query(); ?>