<?php
/**
 * The template for displaying page-title
 *
 * @package WordPress
 * @subpackage Startup
 * @since emo 1.0
 */
$page_title_enable = g5plus_get_option('page_title_enable','1');
if ($page_title_enable == '0') return;
$page_title_content_block = g5plus_get_option('page_title_content_block','');
if (is_singular()) {
    $is_custom_page_title_visible = g5plus_get_rwmb_meta('custom_page_title_visible');
    if($is_custom_page_title_visible == '0') return;
    $is_custom_page_title_content_block = g5plus_get_rwmb_meta('is_custom_page_title_content_block');
    if ($is_custom_page_title_content_block) {
        $page_title_content_block = g5plus_get_rwmb_meta('custom_page_title_content_block');
    }
}


$wrapper_classes = array(
    'gf-page-title'
);
if (empty($page_title_content_block)){
    $wrapper_classes[] = 'gf-page-title-default';
}

$wrapper_class = implode(' ', array_filter($wrapper_classes));
?>
<div class="<?php echo esc_attr($wrapper_class) ?>">
    <div class="container">
    <?php if (!empty($page_title_content_block)): ?>
        <?php echo g5plus_content_block($page_title_content_block); ?>
    <?php else: ?>
        <?php
        $page_title = g5plus_get_page_title();
        $page_subtitle = g5plus_get_page_subtitle();
        ?>
        <div data-table-cell="true" class="page-title-inner">
            <div class="page-title-content sm-mg-bottom-20">
                <h1 class="s-font"><?php echo esc_html($page_title);?></h1>
                <?php if(!empty($page_subtitle)): ?>
                    <p><?php echo wp_kses_post($page_subtitle); ?></p>
                <?php endif; ?>
            </div>
            <div class="breadcrumbs">
                <?php g5plus_get_template('breadcrumb.php'); ?>
            </div>
        </div>
    <?php endif; ?>
    </div>
</div>
