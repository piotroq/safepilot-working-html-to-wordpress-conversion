<?php
/**
 * G5PLUS FRAMEWORK PLUGIN ACTION
 * *******************************************************
 */

/**
 * Allow do_shortcode content: widget_text, widget_title
 * *******************************************************
 */
if (!function_exists('gf_do_shortcode_content')) {
    function gf_do_shortcode_content()
    {
        // Apply filter do_shortcode
        if (apply_filters('gf_do_shortcode_widget_text', true)) {
            add_filter('widget_text', 'do_shortcode');
        }
        if (apply_filters('gf_do_shortcode_widget_content', true)) {
            add_filter('widget_content', 'do_shortcode');
        }
    }

    add_action('after_setup_theme', 'gf_do_shortcode_content');
}

/**
 * Add VC style: js_composer.min.js
 * *******************************************************
 */
if (!function_exists('gf_add_js_composer_front')) {
    function gf_add_js_composer_front()
    {
        wp_enqueue_style('js_composer_front');
    }
}

/**
 * Add VC style before header: js_composer.min.js
 * *******************************************************
 */
if (!function_exists('gf_add_js_composer_front_enqueue')) {
    function gf_add_js_composer_front_enqueue()
    {
        $set_footer_custom = gf_get_option('set_footer_custom', 0);
        $set_page_title_block = gf_get_option('page_title_content_block', 0);
        $set_footer_above_custom = gf_get_option('set_footer_above_custom', 0);

        if ($set_footer_custom || $set_footer_above_custom || $set_page_title_block) {
            add_action('wp_enqueue_scripts', 'gf_add_js_composer_front');
        }
    }

    add_action('g5plus_header_before', 'gf_add_js_composer_front_enqueue');
}

/**
 * Add VC Frontend CSS
 * *******************************************************
 */
if (!function_exists('gf_addFrontCss')) {
    function gf_addFrontCss()
    {
        $set_footer_custom = gf_get_option('set_footer_custom', 0);
        $set_page_title_block = gf_get_option('page_title_content_block', 0);
        if(is_singular()) {
            $is_custom_page_title_content_block = g5plus_get_rwmb_meta('is_custom_page_title_content_block');
            if ($is_custom_page_title_content_block) {
                $set_page_title_block = g5plus_get_rwmb_meta('custom_page_title_content_block');
            }
        }
        if ($set_footer_custom) {
            gf_addPageCustomCss($set_footer_custom);
            gf_addShortcodesCustomCss($set_footer_custom);
        }
        if ($set_page_title_block) {
            gf_addPageCustomCss($set_page_title_block);
            gf_addShortcodesCustomCss($set_page_title_block);
        }

        $set_footer_above_custom = gf_get_option('set_footer_above_custom', 0);
        if ($set_footer_above_custom) {
            gf_addPageCustomCss($set_footer_above_custom);
            gf_addShortcodesCustomCss($set_footer_above_custom);
        }
        if ($set_footer_custom || $set_footer_above_custom || $set_page_title_block) {
            wp_enqueue_style('js_composer_front');
        }
    }

    add_action('wp_head', 'gf_addFrontCss', 1000);
}

/**
 * Add VC Frontend CSS: Page custom css
 * *******************************************************
 */
if (!function_exists('gf_addPageCustomCss')) {
    function gf_addPageCustomCss($id = null)
    {
        if ($id == get_the_ID()) {
            return;
        }
        if (!$id) {
            $id = get_the_ID();
        }
        if ($id) {
            $post_custom_css = get_post_meta($id, '_wpb_post_custom_css', true);
            if (!empty($post_custom_css)) {
                $post_custom_css = strip_tags($post_custom_css);
                echo '<style type="text/css" data-type="vc_custom-css">';
                echo $post_custom_css;
                echo '</style>';
            }
        }
    }
}

/**
 * Add VC Frontend CSS: Shortcode custom css
 * *******************************************************
 */
if (!function_exists('gf_addShortcodesCustomCss')) {
    function gf_addShortcodesCustomCss($id = null)
    {
        if ($id == get_the_ID()) {
            return;
        }
        if (!$id) {
            $id = get_the_ID();
        }

        if ($id) {
            $shortcodes_custom_css = get_post_meta($id, '_wpb_shortcodes_custom_css', true);
            if (!empty($shortcodes_custom_css)) {
                $shortcodes_custom_css = strip_tags($shortcodes_custom_css);
                echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                echo $shortcodes_custom_css;
                echo '</style>';
            }
        }
    }
}

/**
 * Add to the allowed tags array and hook into WP comments
 * *******************************************************
 */
if (!function_exists('gf_allowed_tags')) {
    function gf_allowed_tags()
    {
        global $allowedposttags;
        $allowedposttags['a']['data-hash'] = true;
        $allowedposttags['a']['data-product_id'] = true;
        $allowedposttags['a']['data-original-title'] = true;
        $allowedposttags['a']['aria-describedby'] = true;
        $allowedposttags['a']['data-quantity'] = true;
        $allowedposttags['a']['data-product_sku'] = true;
        $allowedposttags['a']['data-rel'] = true;
        $allowedposttags['a']['data-product-type'] = true;
        $allowedposttags['a']['data-product-id'] = true;
        $allowedposttags['a']['data-toggle'] = true;

        $allowedposttags['div']['data-plugin-options'] = true;
        $allowedposttags['div']['data-player'] = true;
        $allowedposttags['div']['data-audio'] = true;
        $allowedposttags['div']['data-title'] = true;
        $allowedposttags['div']['data-animsition-in-class'] = true;
        $allowedposttags['div']['data-animsition-out-class'] = true;
        $allowedposttags['div']['data-animsition-overlay'] = true;

        $allowedposttags['textarea']['placeholder'] = true;

        $allowedposttags['iframe']['align'] = true;
        $allowedposttags['iframe']['frameborder'] = true;
        $allowedposttags['iframe']['height'] = true;
        $allowedposttags['iframe']['longdesc'] = true;
        $allowedposttags['iframe']['marginheight'] = true;
        $allowedposttags['iframe']['marginwidth'] = true;
        $allowedposttags['iframe']['name'] = true;
        $allowedposttags['iframe']['sandbox'] = true;
        $allowedposttags['iframe']['scrolling'] = true;
        $allowedposttags['iframe']['seamless'] = true;
        $allowedposttags['iframe']['src'] = true;
        $allowedposttags['iframe']['srcdoc'] = true;
        $allowedposttags['iframe']['width'] = true;
        $allowedposttags['iframe']['defer'] = true;

        $allowedposttags['input']['accept'] = true;
        $allowedposttags['input']['align'] = true;
        $allowedposttags['input']['alt'] = true;
        $allowedposttags['input']['autocomplete'] = true;
        $allowedposttags['input']['autofocus'] = true;
        $allowedposttags['input']['checked'] = true;
        $allowedposttags['input']['class'] = true;
        $allowedposttags['input']['disabled'] = true;
        $allowedposttags['input']['form'] = true;
        $allowedposttags['input']['formaction'] = true;
        $allowedposttags['input']['formenctype'] = true;
        $allowedposttags['input']['formmethod'] = true;
        $allowedposttags['input']['formnovalidate'] = true;
        $allowedposttags['input']['formtarget'] = true;
        $allowedposttags['input']['height'] = true;
        $allowedposttags['input']['list'] = true;
        $allowedposttags['input']['max'] = true;
        $allowedposttags['input']['maxlength'] = true;
        $allowedposttags['input']['min'] = true;
        $allowedposttags['input']['multiple'] = true;
        $allowedposttags['input']['name'] = true;
        $allowedposttags['input']['pattern'] = true;
        $allowedposttags['input']['placeholder'] = true;
        $allowedposttags['input']['readonly'] = true;
        $allowedposttags['input']['required'] = true;
        $allowedposttags['input']['size'] = true;
        $allowedposttags['input']['src'] = true;
        $allowedposttags['input']['step'] = true;
        $allowedposttags['input']['type'] = true;
        $allowedposttags['input']['value'] = true;
        $allowedposttags['input']['width'] = true;
        $allowedposttags['input']['accesskey'] = true;
        $allowedposttags['input']['class'] = true;
        $allowedposttags['input']['contenteditable'] = true;
        $allowedposttags['input']['contextmenu'] = true;
        $allowedposttags['input']['dir'] = true;
        $allowedposttags['input']['draggable'] = true;
        $allowedposttags['input']['dropzone'] = true;
        $allowedposttags['input']['hidden'] = true;
        $allowedposttags['input']['id'] = true;
        $allowedposttags['input']['lang'] = true;
        $allowedposttags['input']['spellcheck'] = true;
        $allowedposttags['input']['style'] = true;
        $allowedposttags['input']['tabindex'] = true;
        $allowedposttags['input']['title'] = true;
        $allowedposttags['input']['translate'] = true;

        $allowedposttags['span']['data-id'] = true;

    }

    add_action('init', 'gf_allowed_tags');
}

/**
 * Process when after options saved or reset
 * *******************************************************
 */
if (!function_exists('gf_theme_options_saved')) {
    function gf_theme_options_saved($options)
    {
        if ((defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
            return;
        }
        gf_generate_less();

        /**
         * Delete gf_preset directory
         */
        global $wp_filesystem;

        $preset_dir = gf_get_preset_dir();
        if (file_exists($preset_dir)) {
            $wp_filesystem->rmdir($preset_dir, true);
        }

        /**
         * Create gf_preset directory
         */
        if (!file_exists($preset_dir)) {
            wp_mkdir_p($preset_dir);
        }

        /*// Generate preset css
        global $wpdb;
        $presets = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type=%s AND post_status = %s", 'gf_preset', 'publish') );
        foreach ($presets as $preset) {
            if (isset($preset->ID) && $preset->ID) {
                gf_generate_less($preset->ID);
            }
        }*/
    }

    add_action("redux/options/" . GF_OPTIONS_NAME . "/saved", 'gf_theme_options_saved');
    add_action("redux/options/" . GF_OPTIONS_NAME . "/reset", 'gf_theme_options_saved');
    add_action("redux/options/" . GF_OPTIONS_NAME . "/section/reset", 'gf_theme_options_saved');
}

/**
 * Set Preset Value to OPTION VALUE
 * *******************************************************
 */
if (!function_exists('gf_set_preset_value_to_option')) {
    function gf_set_preset_value_to_option()
    {
        $preset_id = gf_get_current_preset();
        if ($preset_id) {
            /**
             * Image Field Type
             */
            $image_fields = array(
                'logo',
                'logo_retina',
                'sticky_logo',
                'sticky_logo_retina',
                'mobile_logo',
                'mobile_logo_retina',
                'footer_bg_image',
                'bottom_bar_bg',
            );

            /**
             * Sorter Field Type
             */
            $sorter_fields = array(
                'header_customize_left',
                'header_customize_right',
                'header_customize_nav',
            );

            /**
             * Padding Field Type
             */
            $padding_fields = array(
                'content_padding',
                'content_padding_mobile',
                'logo_padding',
                'mobile_logo_padding',
                'top_drawer_padding',
                'top_bar_padding',
                'header_padding',
                'footer_padding',
                'bottom_bar_padding',
            );

            /**
             * Dimensions Field Type
             */
            $dimensions_fields = array(
                'navigation_height',
                'logo_max_height',
                'mobile_logo_max_height',
            );

            $color_fields = &gf_get_color_fields();

            $color_rgba_fields = &gf_get_color_rgba_fields();

            /**
             * Get List Key MetaBox
             */
            global $wpdb;
            $rows = $wpdb->get_results($wpdb->prepare("SELECT meta_key FROM $wpdb->postmeta WHERE post_id = %d and meta_key like %s", $preset_id, GF_METABOX_PREFIX . '%'));
            $meta_box_keys = array();
            foreach ($rows as &$row) {
                $meta_box_keys[] = preg_replace('/^' . GF_METABOX_PREFIX . '/', '', $row->meta_key);
            }

            /**
             * Set meta value into option
             */
            $options = &$GLOBALS[GF_OPTIONS_NAME];
            foreach ($meta_box_keys as &$meta_key) {
                if (in_array($meta_key, $image_fields)) {
                    $meta_value = gf_get_rwmb_meta_image($meta_key, $preset_id);

                    $options[$meta_key]['url'] = $meta_value;
                } elseif (in_array($meta_key, $sorter_fields)) {
                    $meta_value = gf_get_rwmb_meta($meta_key, array(), $preset_id);

                    $enable_arr = isset($meta_value['enable']) ? $meta_value['enable'] : '';
                    $enable_arr = explode('||', $enable_arr);

                    $options[$meta_key]['enabled'] = array();
                    $options[$meta_key]['disabled'] = array();
                    foreach ($enable_arr as $sorter_key) {
                        $options[$meta_key]['enabled'][$sorter_key] = '';
                    }
                } elseif (in_array($meta_key, $padding_fields)) {
                    $meta_value = gf_get_rwmb_meta($meta_key, array(), $preset_id);

                    $options[$meta_key]['padding-top'] = isset($meta_value['top']) && ($meta_value['top'] !== '') ? $meta_value['top'] . 'px' : '';
                    $options[$meta_key]['padding-bottom'] = isset($meta_value['bottom']) && ($meta_value['bottom'] !== '') ? $meta_value['bottom'] . 'px' : '';
                } elseif (in_array($meta_key, $dimensions_fields)) {
                    $meta_value = gf_get_rwmb_meta($meta_key, array(), $preset_id);

                    $options[$meta_key]['height'] = $meta_value;
                } elseif (isset($color_fields[$meta_key])) {
                    $condition_value = gf_get_rwmb_meta($color_fields[$meta_key], array(), $preset_id);
                    if ($condition_value) {
                        $meta_value = gf_get_rwmb_meta($meta_key, array(), $preset_id);

                        $options[$meta_key] = $meta_value;
                    }
                } elseif (array_key_exists($meta_key, $color_rgba_fields)) {
                    $condition = true;
                    foreach ($color_rgba_fields[$meta_key] as $key =>  $value) {
                        $condition_value = gf_get_rwmb_meta($key, array(), $preset_id);
                        if ($condition_value != $value) {
                            $condition = false;
                            break;
                        }
                    }
                    if ($condition) {
                        $meta_value = gf_get_rwmb_meta($meta_key, array(), $preset_id);
                        $options[$meta_key] = gf_rgba2hex($meta_value);
                    }
                } else {
                    $meta_value = gf_get_rwmb_meta($meta_key, array(), $preset_id);

                    $options[$meta_key] = $meta_value;
                }
            }
        }


        /**
         * If 404 page
         */
        if (!$preset_id && is_404()) {
            $options = &$GLOBALS[GF_OPTIONS_NAME];

            $options['layout_style'] = 'wide';
            $options['layout'] = 'full';
            $options['sidebar_layout'] = 'none';
            $options['page_title_enable'] = 0;
            $options['footer_show_hide'] = 1;
            $options['set_footer_above_custom'] = 0;
            $options['bottom_bar_visible'] = 1;

            $page_layouts = &gf_get_page_layout_settings();
            $page_layouts['remove_content_padding'] = 1;
        }
    }

    add_action('g5plus_header_before', 'gf_set_preset_value_to_option', 3);
}

/**
 * Generate css when preset updated
 * *******************************************************
 */
if (!function_exists('gf_generate_css_when_preset_updated')) {
    function gf_generate_css_when_preset_updated($post_id, $post)
    {
        if ($post->post_type === 'gf_preset') {
            /**
             * Delete gf_preset style
             */
            $preset_dir = gf_get_preset_dir();
            if (file_exists($preset_dir . $post_id . '.style.min.css')) {
                unlink($preset_dir . $post_id . '.style.min.css');
            }
            if (file_exists($preset_dir . $post_id . '.rtl.min.css')) {
                unlink($preset_dir . $post_id . '.rtl.min.css');
            }
        }
    }

    add_action('save_post', 'gf_generate_css_when_preset_updated', 10, 2);
}

/**
 * Add Mobile Nav Overlay For Drop Fly
 * *******************************************************
 */
if (!function_exists('gf_add_mobile_nav_overlay')) {
    function gf_add_mobile_nav_overlay($params)
    {
        if (gf_get_option('mobile_header_menu_drop', 'menu-drop-fly') === 'menu-drop-fly') {
            echo '<div class="mobile-nav-overlay"></div>';
        }
    }

    add_action('wp_footer', 'gf_add_mobile_nav_overlay');
}

/**
 * Set Page Layout Settings
 * *******************************************************
 */
if (!function_exists('gf_set_page_layout_setting')) {
    function gf_set_page_layout_setting()
    {
        $page_layouts = &gf_get_page_layout_settings();


        if (is_singular()) {
            // custom sidebar layout
            $sidebar_layout = gf_get_rwmb_meta('custom_page_sidebar_layout');
            if ($sidebar_layout !== '' && $sidebar_layout != '-1') {
                $page_layouts['sidebar_layout'] = $sidebar_layout;
            }
            // custom remove content padding
            $page_layouts['remove_content_padding'] = gf_get_rwmb_meta('remove_content_padding');

        }

        // set sidebar_layout
        $sidebar_layout = isset($_GET['sidebar-layout']) ? $_GET['sidebar-layout'] : '';
        if (array_key_exists($sidebar_layout, gf_get_sidebar_layout())) {
            $page_layouts['sidebar_layout'] = $sidebar_layout;
        }

        // set sidebar_width
        $sidebar_width = isset($_GET['sidebar-width']) ? $_GET['sidebar-width'] : '';
        if (array_key_exists($sidebar_width, gf_get_sidebar_width())) {
            $page_layouts['sidebar_width'] = $sidebar_width;
        }

        if ($page_layouts['sidebar_layout'] != 'none' && is_active_sidebar($page_layouts['sidebar'])) {
            $page_layouts['has_sidebar'] = 1;
        }
    }

    add_action('g5plus_header_before', 'gf_set_page_layout_setting', 5);
}

/**
 * Set Post Layout Settings
 * *******************************************************
 */
if (!function_exists('gf_set_post_layout_settings')) {
    function gf_set_post_layout_settings()
    {
        global $post;
        $post_type = get_post_type($post);
        if ((is_home() || is_category() || is_tag() || is_search() || is_archive()) && ($post_type == 'post')) {
            $post_layouts = &gf_get_post_layout_settings();

            // set post layout
            $post_layout = isset($_GET['post-layout']) ? $_GET['post-layout'] : '';
            if (array_key_exists($post_layout, gf_get_post_layout())) {
                $post_layouts['layout'] = $post_layout;
            }

            // set post column
            $post_column = isset($_GET['column']) ? $_GET['column'] : '';
            if (array_key_exists($post_column, gf_get_post_columns())) {
                $post_layouts['columns'] = $post_column;
            }

            // set paging
            $paging = isset($_GET['paging']) ? $_GET['paging'] : '';
            if (array_key_exists($paging, gf_get_paging_style())) {
                $post_layouts['paging'] = $paging;
            }
        }

    }

    add_action('g5plus_header_before', 'gf_set_post_layout_settings', 10);
}

/**
 * Add Preset Edit Into Admin Bar
 * *******************************************************
 */
if (!function_exists('gf_preset_edit_on_menu_bar')) {
    function gf_preset_edit_on_menu_bar($admin_bar)
    {
        if (!is_admin_bar_showing() || is_admin()) {
            return;
        }
        $preset_id = gf_get_current_preset();
        if ($preset_id) {
            $admin_bar->add_node(array(
                'id'    => 'preset_edit',
                'title' => esc_html__('Edit Preset', 'startup-framework'),
                'href'  => admin_url("post.php?post=$preset_id&action=edit"),
                'meta'  => array(
                    'title' => esc_html__('Edit Preset', 'startup-framework'),
                ),
            ));
        }
    }

    add_action('admin_bar_menu', 'gf_preset_edit_on_menu_bar', 100);
}

/* Add action custom user*/
add_action('show_user_profile', 'gf_add_customer_meta_fields');
add_action('edit_user_profile', 'gf_add_customer_meta_fields');

add_action('personal_options_update', 'gf_save_customer_meta_fields');
add_action('edit_user_profile_update', 'gf_save_customer_meta_fields');

//============================================
// Login Popup
//============================================
function startup_login_callback()
{
    ob_start();
    ?>
    <div id="startup-popup-login-wrapper" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form id="startup-popup-login-form" class="modal-content">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="<?php _e('Close', 'startup-framework'); ?>"><i class="fa fa-remove"></i></button>
                <div class="modal-header">
                    <h4 class="modal-title"><?php _e('Login', 'startup-framework'); ?></h4>
                    <p><?php _e('Hello. Welcome to your account.', 'startup-framework'); ?></p>
                </div>
                <div class="modal-body">
                    <div class="startup-popup-login-content">
                        <div class="form-group">
                            <div class="input-icon">
                                <input type="text" id="username" class="form-control" name="username"
                                       required="required" placeholder="<?php _e('Username', 'startup-framework') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <input type="password" id="password" name="password" class="form-control"
                                       required="required" placeholder="<?php _e('Password', 'startup-framework') ?>">
                            </div>
                        </div>
                        <div class="login-message"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" value="startup_login_ajax" />
                    <div class="modal-footer-left">
                        <input id="remember-me" type="checkbox" name="rememberme" checked="checked" />
                        <label for="remember-me" no-value="<?php _e('NO', 'startup-framework') ?>"
                               yes-value="<?php _e('YES', 'startup-framework') ?>"></label>
                        <?php _e('Remember me', 'startup-framework') ?>
                    </div>
                    <div class="modal-footer-right">
                        <button type="submit"
                                class="btn btn-color-accent btn-style-shadow btn-shape-round    "><?php echo __('Login', 'startup-framework'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    die(); // this is required to return a proper result
}

add_action('wp_ajax_nopriv_startup_login', 'startup_login_callback');
add_action('wp_ajax_startup_login', 'startup_login_callback');

function startup_login_ajax_callback()
{
    ob_start();
    global $wpdb;

    //We shall SQL escape all inputs to avoid sql injection.
    $username = esc_sql($_REQUEST['username']);
    $password = esc_sql($_REQUEST['password']);
    $remember = esc_sql($_REQUEST['rememberme']);

    if ($remember) $remember = "true";
    else $remember = "false";

    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;
    $login_data['remember'] = $remember;
    $user_verify = wp_signon($login_data, false);


    $code = 1;
    $message = '';

    if (is_wp_error($user_verify)) {
        $message = $user_verify->get_error_message();
        $code = -1;
    } else {
        wp_set_current_user($user_verify->ID, $username);
        do_action('set_current_user');
        $message = '';
    }

    $response_data = array(
        'code'    => $code,
        'message' => $message
    );

    ob_end_clean();
    echo json_encode($response_data);
    die(); // this is required to return a proper result
}

add_action('wp_ajax_nopriv_startup_login_ajax', 'startup_login_ajax_callback');
add_action('wp_ajax_startup_login_ajax', 'startup_login_ajax_callback');

//---------------------------------------------------
// SIGN UP Popup
//---------------------------------------------------
function startup_sign_up_callback()
{
    ob_start();
    ?>
    <div id="startup-popup-login-wrapper" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form id="startup-popup-login-form" class="modal-content">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="<?php _e('Close', 'startup-framework'); ?>"><i class="fa fa-remove"></i></button>
                <div class="modal-header">
                    <h4 class="modal-title"><?php _e('Create An Account', 'startup-framework'); ?></h4>
                    <p><?php _e('Hello. Welcome to your account.', 'startup-framework'); ?></p>
                </div>
                <div class="modal-body">
                    <div class="startup-popup-login-content">
                        <div class="form-group">
                            <div class="input-icon">
                                <input type="text" id="username" class="form-control" name="username"
                                       required="required" placeholder="<?php _e('Username', 'startup-framework') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <input type="email" id="email" name="email" class="form-control" required="required"
                                       placeholder="<?php _e('Email', 'startup-framework') ?>">
                            </div>
                        </div>
                        <div><?php _e('A password will be e-mailed to you', 'startup-framework') ?></div>
                        <div class="login-message"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" value="startup_sign_up_ajax" />
                    <div class="modal-footer-right">
                        <button type="submit"
                                class="btn btn-color-accent btn-style-shadow btn-shape-round"><?php echo __('Register', 'startup-framework'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    die(); // this is required to return a proper result
}

add_action('wp_ajax_nopriv_startup_sign_up', 'startup_sign_up_callback');
add_action('wp_ajax_startup_sign_up', 'startup_sign_up_callback');


function startup_sign_up_ajax_callback()
{
    include_once ABSPATH . WPINC . '/ms-functions.php';
    include_once ABSPATH . WPINC . '/user.php';

    ob_start();
    global $wpdb;

    //We shall SQL escape all inputs to avoid sql injection.
    $user_name = esc_sql($_REQUEST['username']);
    $user_email = esc_sql($_REQUEST['email']);


    $error = wpmu_validate_user_signup($user_name, $user_email);
    $code = 1;
    $message = '';
    if ($error['errors']->get_error_code() != '') {
        $code = -1;
        foreach ($error['errors']->get_error_messages() as $key => $value) {
            $message .= '<div/>' . __('<strong>ERROR:</strong> ', 'startup-framework') . esc_html($value) . '</div>';
        }
    } else {
        register_new_user($user_name, $user_email);
    }

    $response_data = array(
        'code'    => $code,
        'message' => $message
    );

    ob_end_clean();
    echo json_encode($response_data);
    die(); // this is required to return a proper result
}

add_action('wp_ajax_nopriv_startup_sign_up_ajax', 'startup_sign_up_ajax_callback');
add_action('wp_ajax_startup_sign_up_ajax', 'startup_sign_up_ajax_callback');

/*================================================
MAINTENANCE MODE
================================================== */
if (!function_exists('gf_maintenance_mode')) {
	function gf_maintenance_mode() {

		if (current_user_can( 'edit_themes' ) || is_user_logged_in()) {
			return;
		}

		$enable_maintenance = absint(gf_get_option('enable_maintenance','0'));

		switch ($enable_maintenance) {
			case 1 :
				wp_die( '<p style="text-align:center">' . esc_html__( 'We are currently in maintenance mode, please check back shortly.', 'startup-framework' ) . '</p>', get_bloginfo( 'name' ) );
				break;
			case 2:
				$maintenance_mode_page = gf_get_option('maintenance_mode_page','');
				if (empty($maintenance_mode_page)) {
					wp_die( '<p style="text-align:center">' . esc_html__( 'We are currently in maintenance mode, please check back shortly.', 'startup-framework' ) . '</p>', get_bloginfo( 'name' ) );
				} else {
					$maintenance_mode_page_url = get_permalink($maintenance_mode_page);
					$current_page_url = gf_current_page_url();
					if ($maintenance_mode_page_url != $current_page_url) {
						wp_redirect($maintenance_mode_page_url);
					}
				}
				break;
		}
	}
	add_action( 'get_header', 'gf_maintenance_mode' );
}

/*================================================
GET CURRENT PAGE URL
================================================== */
if (!function_exists('gf_current_page_url')) {
	function gf_current_page_url() {
		$pageURL = 'http';
		if ( isset( $_SERVER["HTTPS"] ) ) {
			if ( $_SERVER["HTTPS"] == "on" ) {
				$pageURL .= "s";
			}
		}
		$pageURL .= "://";
		if (( $_SERVER["SERVER_PORT"] != "80" ) && ( $_SERVER["SERVER_PORT"] != "1433" )) {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}

		return $pageURL;
	}
}

