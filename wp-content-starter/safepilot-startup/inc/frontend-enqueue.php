<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 6/17/2016
 * Time: 10:18 AM
 */

/**
 * Load stylesheet
 */
if (!function_exists('g5plus_enqueue_styles')) {
    function g5plus_enqueue_styles()
    {
        $cdn_font_awesome = g5plus_get_option('cdn_font_awesome', '');
        $cdn_bootstrap_css = g5plus_get_option('cdn_bootstrap_css', '');
        $min_suffix = g5plus_get_option('enable_minifile_css', 0) == 1 ? '.min' : '';

        /*font-awesome*/
        $url_font_awesome = G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome.min.css';
        if (!empty($cdn_font_awesome)) {
            $url_font_awesome = $cdn_font_awesome;
        }
        wp_enqueue_style('fontawesome', $url_font_awesome, array());
        wp_enqueue_style('fontawesome_animation', G5PLUS_THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome-animation.min.css', array());

        /*bootstrap*/
        if (!empty($cdn_bootstrap_css)) {
	        wp_enqueue_style('bootstrap', $cdn_bootstrap_css, array());
        } else {
	        wp_enqueue_style('bootstrap', G5PLUS_THEME_URL . 'assets/plugins/bootstrap/css/bootstrap.min.css', array(),'3.4.1');
        }


        /*owl-carousel*/
        wp_enqueue_style('owl-carousel', G5PLUS_THEME_URL . 'assets/plugins/owl-carousel/assets/owl.carousel.min.css', array());

        /* light gallery */
        wp_enqueue_style('ligh-gallery', G5PLUS_THEME_URL . 'assets/plugins/light-gallery/css/lightgallery.min.css', array());

        /* perffect scrollbar */
        wp_enqueue_style('perffect-scrollbar', G5PLUS_THEME_URL . 'assets/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css', array());

	    $preset_id = g5plus_get_current_preset();

	    /**
	     * Enqueue style.css
	     */
        if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	        if (!$preset_id || !g5plus_enqueue_preset_style($preset_id, 'style')) {
		        wp_enqueue_style('g5plus_framework_style', G5PLUS_THEME_URL . 'style' . $min_suffix . '.css');
	        }
        } else {
            wp_enqueue_style('g5plus-dev-style-css', admin_url('admin-ajax.php') . '?action=gf_dev_less_to_css'
	            . ($preset_id ? '&amp;preset_id=' . $preset_id : ''), array(), false);
        }


    }

    add_action('wp_enqueue_scripts', 'g5plus_enqueue_styles', 11);
}
/**
 * Load script
 */
if(!function_exists('g5plus_enqueue_script')){
    function g5plus_enqueue_script(){
        $enable_minifile_js = g5plus_get_option('enable_minifile_js',0);
        $cdn_bootstrap_js = g5plus_get_option('cdn_bootstrap_js','');
        $min_suffix = (isset($enable_minifile_js) && $enable_minifile_js == 1) ? '.min' :  '';

        /*bootstrap*/
        if (isset($cdn_bootstrap_js) && !empty($cdn_bootstrap_js)) {
	        wp_enqueue_script('bootstrap', $cdn_bootstrap_js, array('jquery'), false, true);
        } else {
	        wp_enqueue_script('bootstrap', G5PLUS_THEME_URL . 'assets/plugins/bootstrap/js/bootstrap.min.js', array('jquery'), '3.4.1', true);
        }


        if (is_singular())	wp_enqueue_script('comment-reply');

        // startup-icons
        wp_enqueue_style('startup-icons', G5PLUS_THEME_URL . 'assets/plugins/pe-icon-7-stroke/css/pe-icon-7-stroke.css', array());

        /*plugins*/
        wp_enqueue_script('g5plus_framework_plugins', G5PLUS_THEME_URL . 'assets/js/plugin'.$min_suffix.'.js', array(), false, true);


	    // hc-sticky
        wp_enqueue_script('hc-sticky', G5PLUS_THEME_URL . 'assets/plugins/hc-sticky/jquery.hc-sticky'.$min_suffix.'.js', array('jquery'), '1.2.43', true);

        wp_enqueue_script('g5plus_framework_app', G5PLUS_THEME_URL . 'assets/js/main' . $min_suffix . '.js', array(), false, true);

        // Localize the script with new data
        $translation_array = array(
            'carousel_next' => esc_html__('Next','g5-startup'),
            'carousel_prev' => esc_html__('Back','g5-startup'),
            'add_cart_quantity' => array(
	            'min' => esc_html__('Sorry, the minimum value was reached','g5-startup'),
	            'max' => esc_html__('Sorry, the maximum value was reached','g5-startup')


            )
        );
        wp_localize_script('g5plus_framework_app', 'g5plus_framework_constant', $translation_array);
        wp_localize_script(
            'g5plus_framework_app',
            'g5plus_app_variable',
            array(
                'ajax_url' => get_site_url() . '/wp-admin/admin-ajax.php',
                'theme_url' => G5PLUS_THEME_URL,
                'site_url' => site_url()
            )
        );
    }
    add_action('wp_enqueue_scripts', 'g5plus_enqueue_script');
}

/**
 * Enqueue Preset Style
 * @preset_type: style, rtl, tta
 * *******************************************************
 */
if (!function_exists('g5plus_enqueue_preset_style')) {
	function g5plus_enqueue_preset_style($preset_id, $preset_type) {
		if (function_exists('gf_enqueue_preset_style')) {
			return gf_enqueue_preset_style($preset_id, $preset_type);
		}
		return false;
	}
}

/**
 * Load file rtl css
 * *******************************************************
 */
if (!function_exists('g5plus_enqueue_styles_rtl')) {
	function g5plus_enqueue_styles_rtl() {
		$preset_id = g5plus_get_current_preset();
		$enable_rtl_mode = g5plus_get_option('enable_rtl_mode', 0);

		/**
		 * Enqueue rtl.css
		 */
		if (is_rtl() || $enable_rtl_mode || isset($_GET['RTL'])) {
			if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
				if (!$preset_id || !g5plus_enqueue_preset_style($preset_id, 'rtl')) {
					wp_enqueue_style('g5plus_framework_rtl', G5PLUS_THEME_URL . 'assets/css/rtl.min.css');
				}
			}
			else {
				wp_enqueue_style( 'g5plus_framework_rtl', admin_url( 'admin-ajax.php' ) . '?action=gf_dev_less_to_css_rtl'
					. ($preset_id ? '&amp;preset_id=' . $preset_id : '') , array(), false );
			}
		}
	}
	add_action('wp_footer','g5plus_enqueue_styles_rtl');
}

if (!function_exists('g5plus_enqueue_fonts')) {
	function g5plus_enqueue_fonts() {
		if (!class_exists('GF_Loader')) {
			$fonts_url = g5plus_get_fonts_url();
			$fonts_css = g5plus_get_fonts_css();
			wp_enqueue_style('google-fonts',$fonts_url);
			wp_add_inline_style('google-fonts',$fonts_css);
		}
	}
	add_action('wp_enqueue_scripts', 'g5plus_enqueue_fonts',12);
}