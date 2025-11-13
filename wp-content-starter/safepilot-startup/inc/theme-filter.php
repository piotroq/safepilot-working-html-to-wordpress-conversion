<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/17/2016
 * Time: 10:32 AM
 */

/**
 * Body Class
 * *******************************************************
 */
if (!function_exists('g5plus_body_class_name')) {
    function g5plus_body_class_name($classes)
    {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        if ($is_lynx) $classes[] = 'lynx';
        elseif ($is_gecko) $classes[] = 'gecko';
        elseif ($is_opera) $classes[] = 'opera';
        elseif ($is_NS4) $classes[] = 'ns4';
        elseif ($is_safari) $classes[] = 'safari';
        elseif ($is_chrome) $classes[] = 'chrome';
        elseif ($is_IE) $classes[] = 'ie';
        else $classes[] = 'unknown';
        if ($is_iphone) $classes[] = 'iphone';

        $action = isset($_GET['action']) ? $_GET['action'] : '';
        $page_transition = g5plus_get_option('page_transition', '0');
        if (($page_transition === '1') && ($action != 'yith-woocompare-view-table')) {
            $classes[] = 'page-transitions';
        }

        if (is_singular()) {
            $page_class_extra =  g5plus_get_rwmb_meta('custom_page_css_class');
            if (!empty($page_class_extra)) {
                $classes[] = $page_class_extra;
            }
            $is_one_page = g5plus_get_rwmb_meta('is_one_page');
            if($is_one_page=='1'){
                $classes[] = 'one-page';
            }
        }

        if ($action === 'yith-woocompare-view-table') {
            $classes[] = 'woocommerce-compare-page';
        }

        $loading_animation = g5plus_get_option('loading_animation', '');
        if (!empty($loading_animation) && ($loading_animation != 'none')) {
            $classes[] = 'page-loading';
        }

        $layout_style = g5plus_get_option('layout_style', 'wide');

        if ($layout_style === 'boxed') {
            $classes[] = 'boxed';
        }

        if (g5plus_get_option('header_float', '0')) {
            $classes[] = 'header-is-float';

	        if (g5plus_get_option('header_sticky_change_style', '1')) {
		        $classes[] = 'header-sticky-fix-style';
	        }
        }

		$header_layout = g5plus_get_option('header_layout', 'header-1');
		if ($header_layout == 'header-6') {
			$classes[] = 'header-is-left';
		}

        $enable_rtl_mode = $enable_rtl_mode = g5plus_get_option('enable_rtl_mode', '0');
        if ($enable_rtl_mode === '1' || isset($_GET['RTL']) || is_rtl()) {
            $classes[] = 'rtl';
        }


	    $page_layouts = &g5plus_get_page_layout_settings();
	    if ($page_layouts['has_sidebar']) {
		    $classes[] = 'has-sidebar';
			$classes[] = 'sidebar-'.$page_layouts['sidebar_layout'];
	    }
        return $classes;
    }

    add_filter('body_class', 'g5plus_body_class_name');
}


/**
 * Filter Comment Fields
 */
if (!function_exists('g5plus_comment_form_fields')) {
    function g5plus_comment_form_fields() {
        $req      = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $commenter = wp_get_current_commenter();
        $html_req = ( $req ? " required='required'" : '' );
        $html5    = 'html5' === current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

        return  array(
            'author' => '<p class="comment-form-field comment-form-author">'.
                '<input placeholder="'. sprintf(esc_attr__('Your Name %s','g5-startup'),$req ? '*' : '') .'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>',
            'email'  => '<p class="comment-form-field comment-form-email">' .
                '<input placeholder="'. sprintf(esc_attr__('Email Address %s','g5-startup'),$req ? '*' : '') .'" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
            'url'    => '<p class="comment-form-field comment-form-url">' .
                '<input placeholder="'. esc_attr__('Website','g5-startup') .'" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
        );
    }
    add_filter('comment_form_default_fields','g5plus_comment_form_fields');
}

/**
 * Filter Comment Form Args Default
 */
if (!function_exists('g5plus_comment_form_defaults')) {
    function g5plus_comment_form_defaults($defaults) {
        $args = array(
            'comment_field'        => '<p class="comment-form-field comment-form-comment"><textarea placeholder="'. esc_attr__('Your Comment *','g5-startup') .'" id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea></p>',
            'title_reply_before' => '<h4 id="reply-title" class="blog-line-title">',
            'title_reply_after'  => '</h4>',
            'label_submit'         => esc_html__('SUBMIT','g5-startup'),
            'class_submit' => 'btn',
	        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-lg btn-primary btn-classic btn-radius-circle">%4$s</button>',
        );
        $defaults = array_merge( $defaults, $args );
        return $defaults;
    }
    add_filter('comment_form_defaults','g5plus_comment_form_defaults');
}

/**
 * Filter Layout Wrap Class
 */
if (!function_exists('g5plus_layout_wrap_class')) {
    function g5plus_layout_wrap_class($layout_wrap_class){
        global $post;
        $post_type = get_post_type($post);
        $wrap_class = array();
        // custom layout wrap class page
        if (is_page()) {
            $wrap_class[] = 'page-wrap';
        }else{
            // custom layout wrap class blog
            if ((is_home() || is_category() || is_tag() || is_search() || is_archive()) && ($post_type == 'post')) {
	            $post_layouts = &g5plus_get_post_layout_settings();
                $wrap_class[] = 'archive-wrap';
                $wrap_class[] = 'archive-' . $post_layouts['layout'];
            }


            // custom layout wrap class single blog
            if (is_singular('post')) {
                $wrap_class[] = 'single-blog-wrap';
            }

            // custom layout wrap class archive product
            if (is_post_type_archive( 'product' ) || is_tax('product_cat') || is_tax('product_tag') || (is_search() && ($post_type == 'product'))) {
                $wrap_class[] = 'archive-product-wrap';
            }

            // custom layout wrap class single product
            if (is_singular('product')) {
                $wrap_class[] = 'single-product-wrap';
            }
        }

        return array_merge($layout_wrap_class,$wrap_class);

    }
    add_filter('g5plus_filter_layout_wrap_class','g5plus_layout_wrap_class');
}

/**
 * Filter Layout Inner Class
 */
if (!function_exists('g5plus_layout_inner_class')){
    function g5plus_layout_inner_class($layout_inner_class){
        global $post;
        $post_type = get_post_type($post);
        $inner_class = array();

        // custom layout inner class page
        if (is_page()) {
            $inner_class[] = 'page-inner';
        }else{
            // custom layout inner class blog
            if ((is_home() || is_category() || is_tag() || is_search() || is_archive()) && ($post_type === 'post')) {
                $inner_class[] = 'archive-inner';
            }

            // custom layout inner class single blog
            if (is_singular('post')) {
                $inner_class[] = 'single-blog-inner';
            }

            // custom layout inner class archive product
            if (is_post_type_archive( 'product' ) || is_tax('product_cat') || is_tax('product_tag') || (is_search() && ($post_type === 'product'))) {
                $inner_class[] = 'archive-product-inner';
            }

            // custom layout inner class single product
            if (is_singular('product')) {
                $inner_class[] = 'single-product-inner';
            }
        }

        return array_merge($layout_inner_class,$inner_class);
    }
    add_filter('g5plus_filter_layout_inner_class','g5plus_layout_inner_class');
}

/**
 * Add search form before Mobile Menu
 * *******************************************************
 */
if (!function_exists('g5plus_search_form_before_menu_mobile')) {
	function g5plus_search_form_before_menu_mobile($params) {
		ob_start();
		if (g5plus_get_option('mobile_header_menu_drop', 'menu-drop-fly') === 'menu-drop-fly') {
			get_search_form();
		}
		$params .= ob_get_clean();
		return $params;
	}
	add_filter('g5plus_before_menu_mobile_filter','g5plus_search_form_before_menu_mobile', 10);
}

if(!function_exists('g5plus_add_grid_plus_skins')) {
    function g5plus_add_grid_plus_skins($grid_plus_skins) {
        $grid_plus_skins = array_merge(array(
            array(
                'name'    => 'Portfolio: Thumb, icon, title, cate',
                'slug'     => 'portfolio-skin-01',
                'template' => G5PLUS_THEME_DIR . 'grid-plus/skins/portfolio-skin-01.php',
                'admin_skin_css' => G5PLUS_THEME_URL . 'grid-plus/assets/css/portfolio-skin-01.css'
            ),
            array(
                'name'    => 'Portfolio: Thumb circle, icon - Title, cate',
                'slug'     => 'portfolio-skin-02',
                'template' => G5PLUS_THEME_DIR . 'grid-plus/skins/portfolio-skin-02.php',
                'admin_skin_css' => G5PLUS_THEME_URL . 'grid-plus/assets/css/portfolio-skin-02.css'
            ),
            array(
                'name'    => 'Portfolio: Thumb, icon - Cate, title, like',
                'slug'     => 'portfolio-skin-03',
                'template' => G5PLUS_THEME_DIR . 'grid-plus/skins/portfolio-skin-03.php',
                'admin_skin_css' => G5PLUS_THEME_URL . 'grid-plus/assets/css/portfolio-skin-03.css'
            ),
            array(
                'name'    => 'Blog: Thumb, icon, title, datetime, excerpt',
                'slug'     => 'blog-skin-01',
                'template' => G5PLUS_THEME_DIR . 'grid-plus/skins/blog-skin-01.php',
                'admin_skin_css' => G5PLUS_THEME_URL . 'grid-plus/assets/css/blog-skin.css'
            ),
            array(
                'name'    => 'Blog: Thumb, icon, title, excerpt,count view post',
                'slug'     => 'blog-skin-02',
                'template' => G5PLUS_THEME_DIR . 'grid-plus/skins/blog-skin-02.php',
                'admin_skin_css' => G5PLUS_THEME_URL . 'grid-plus/assets/css/blog-skin.css'
            ),
            array(
                'name'    => 'Product: Thumb, cart, title, price, rate',
                'slug'     => 'product-skin-01',
                'template' => G5PLUS_THEME_DIR . 'grid-plus/skins/product-skin-01.php',
                'admin_skin_css' => G5PLUS_THEME_URL . 'grid-plus/assets/css/product-skin-01.css'
            ),
            array(
                'name'    => 'Product: Thumb, cate, title, price',
                'slug'     => 'product-skin-02',
                'template' => G5PLUS_THEME_DIR . 'grid-plus/skins/product-skin-02.php',
                'admin_skin_css' => G5PLUS_THEME_URL . 'grid-plus/assets/css/product-skin-02.css'
            )
        ), $grid_plus_skins);
        return $grid_plus_skins;
    }
    add_filter('grid-plus-skins', 'g5plus_add_grid_plus_skins');
}

if(!function_exists('g5plus_grid_plus_custom_content_post_type')) {
    function g5plus_grid_plus_custom_content_post_type() {
        $content_block = new GF_Custom_Post_Type();
        return $content_block->get_content_block_post_type();
    }
    add_filter('grid_plus_content_post_type', 'g5plus_grid_plus_custom_content_post_type');
}


/**
 * Move cat_count category into tag A
 * *******************************************************
 */
if (!function_exists('g5plus_cat_count_span')) {
    function g5plus_cat_count_span($links) {
        $links = str_replace('</a> (', ' (', $links);
        $links = str_replace(')', ')</a>', $links);
        return $links;
    }
    add_filter('wp_list_categories', 'g5plus_cat_count_span');
}

/**
 * This code filters the Archive widget to include the post count inside the link
 * *******************************************************
 */
if (!function_exists('g5plus_archive_count_span')) {
    function g5plus_archive_count_span($links) {
        $links = str_replace('</a>&nbsp;(', ' (', $links);
        $links = str_replace(')', ')</a>', $links);
        return $links;
    }
    add_filter('get_archives_link', 'g5plus_archive_count_span');
}


if (!function_exists('g5plus_editor_stylesheets')) {
	function g5plus_editor_stylesheets($stylesheets) {
		$screen = get_current_screen();
		$post_id = '';
		if ( is_admin() && ($screen->id == 'post') ) {
			global $post;
			$post_id = $post->ID;
		}
		$stylesheets[] = G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome.min.css';
		$stylesheets[] = admin_url('admin-ajax.php') . '?action=gsf_custom_css_editor&post_id=' . $post_id;
		$stylesheets[] = g5plus_get_fonts_url();
		return $stylesheets;
	}
	add_filter( 'editor_stylesheets', 'g5plus_editor_stylesheets', 99 );
}