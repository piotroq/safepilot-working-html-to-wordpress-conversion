<?php
/**
 * SafePilot - Archive Template
 * @package SafePilot
 * @version 2.0
 */

get_header(); ?>

<div class="sp-archive-page">
    <!-- Breadcrumbs -->
    <div class="sp-breadcrumbs-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Strona główna</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Page Header -->
    <div class="sp-page-header">
        <div class="container">
            <h1 class="sp-page-title">
                <?php 
                if (is_category()) {
                    single_cat_title();
                } elseif (is_tag()) {
                    single_tag_title();
                } elseif (is_author()) {
                    the_author();
                } elseif (is_day()) {
                    echo get_the_date();
                } elseif (is_month()) {
                    echo get_the_date('F Y');
                } elseif (is_year()) {
                    echo get_the_date('Y');
                } else {
                    echo 'Blog';
                }
                ?>
            </h1>
            <?php if (is_category() && category_description()) : ?>
                <div class="sp-category-description">
                    <?php echo category_description(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Archive Posts -->
    <div class="sp-archive-content">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 sp-posts-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col">
                            <?php get_template_part('templates/archive/content', 'grid'); ?>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Paginacja -->
                <?php
                $pagination = paginate_links(array(
                    'total' => $GLOBALS['wp_query']->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'format' => '?paged=%#%',
                    'prev_text' => '<i class="fa-solid fa-chevron-left"></i> Poprzednia',
                    'next_text' => 'Następna <i class="fa-solid fa-chevron-right"></i>',
                    'type' => 'array',
                    'mid_size' => 2,
                    'end_size' => 1,
                ));

                if ($pagination) : ?>
                    <nav class="sp-pagination" aria-label="Paginacja wpisów">
                        <ul class="pagination justify-content-center">
                            <?php foreach ($pagination as $page) : ?>
                                <li class="page-item <?php echo strpos($page, 'current') !== false ? 'active' : ''; ?>">
                                    <?php echo str_replace('page-numbers', 'page-link', $page); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

            <?php else : ?>
                <?php get_template_part('templates/archive/content', 'none'); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>