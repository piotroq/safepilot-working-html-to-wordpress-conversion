<?php
/**
 *    Plugin Name: Startup Framework
 *    Plugin URI: http://g5plus.net
 *    Description: The Startup Framework plugin.
 *    Version: 2.7
 *    Author: G5Theme
 *    Author URI: http://g5plus.net
 *
 *    Text Domain: startup-framework
 *    Domain Path: /languages/
 *
 * @category Core
 * @author g5plus
 *
 **/
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('GF_Loader')) {
    class GF_Loader
    {
        public function __construct()
        {
            $this->define_constants();
            $this->includes();

            add_action('admin_enqueue_scripts', array(&$this, 'enqueue_admin_resources'));
	        add_action('admin_enqueue_scripts', array(&$this, 'enqueue_admin_widget_resources'));
            add_action('wp_enqueue_scripts', array(&$this, 'enqueue_frontend_resources'),100);
            add_action('admin_enqueue_scripts',array($this,'dequeue_style'),100);

            add_action('load-post.php', array(&$this, 'enqueue_meta_box_resource'));
            add_action('load-post-new.php', array(&$this, 'enqueue_meta_box_resource'));

            add_action('admin_enqueue_scripts', array(&$this, 'enqueue_redux_resource'));

            add_action( 'plugins_loaded',array(&$this, 'define_plugin_version') );
            add_action( 'plugins_loaded',array(&$this, 'include_vc_shortcode') );
            
            // NUCLEAR: Textdomain loading completely disabled
            // MU-Plugin handles everything
            // add_action( 'init', array($this,'load_text_domain'), 10);

            add_action('wp_ajax_popup_icon', array(&$this,'popup_icon'));
            add_action( 'wp_footer', array($this,'enqueue_custom_script') );
        }

        //==============================================================================
        // Define constant - POPRAWIONE Z WSZYSTKIMI STAŁYMI
        //==============================================================================
        private function define_constants()
        {
            $plugin_dir_name = dirname(__FILE__);
            $plugin_dir_name = str_replace('\\', '/', $plugin_dir_name);
            $plugin_dir_name = explode('/', $plugin_dir_name);
            $plugin_dir_name = end($plugin_dir_name);

            if (!defined('GF_PLUGIN_NAME')) {
                define('GF_PLUGIN_NAME', $plugin_dir_name);
            }

            if (!defined('GF_PLUGIN_URL')) {
                define('GF_PLUGIN_URL', plugin_dir_url(__FILE__));
            }

            if (!defined('GF_PLUGIN_DIR')) {
                define('GF_PLUGIN_DIR', plugin_dir_path(__FILE__));
            }
            
            // DODANIE BRAKUJĄCYCH STAŁYCH
            if (!defined('GF_PLUGIN_PREFIX')) {
                define('GF_PLUGIN_PREFIX', 'gf_');
            }
            
            if (!defined('GF_METABOX_PREFIX')) {
                define('GF_METABOX_PREFIX', 'gsf_');
            }

            // GŁÓWNA BRAKUJĄCA STAŁA - OPTIONS NAME
            if (!defined('GF_OPTIONS_NAME')) {
                define('GF_OPTIONS_NAME', 'startup_framework_options');
            }

            // DODATKOWE STAŁE DLA FRAMEWORK'A
            if (!defined('GF_PLUGIN_VERSION')) {
                define('GF_PLUGIN_VERSION', '2.7');
            }

            if (!defined('G5PLUS_SCRIPT_DEBUG')) {
                define('G5PLUS_SCRIPT_DEBUG', false);
            }

            if (!defined('GF_THEME_OPTIONS_NAME')) {
                define('GF_THEME_OPTIONS_NAME', 'g5_startup_options');
            }
        }

        //==============================================================================
        // Include library for plugin - KOLEJNOŚĆ WAŻNA
        //==============================================================================
        private function includes()
        {
            /**
             * Include functions FIRST - zawiera potrzebne funkcje
             */
            if (file_exists(GF_PLUGIN_DIR . 'inc/functions.php')) {
                include_once GF_PLUGIN_DIR . 'inc/functions.php';
            }

            /**
             * custom post type
             */
            if (file_exists(GF_PLUGIN_DIR . 'cpt/cpt.php')) {
                include_once GF_PLUGIN_DIR . 'cpt/cpt.php';
            }

            /**
             * Include less library
             */
            if (file_exists(GF_PLUGIN_DIR . 'core/less/Less.php')) {
                include_once GF_PLUGIN_DIR . 'core/less/Less.php';
            }

            /**
             * Include less functions
             */
            if (file_exists(GF_PLUGIN_DIR . 'inc/less-functions.php')) {
                include_once GF_PLUGIN_DIR . 'inc/less-functions.php';
            }

            /**
             * Dashboard
             */
            if (file_exists(GF_PLUGIN_DIR . 'core/dashboard/class-gf-dashboard.php')) {
                include_once GF_PLUGIN_DIR . 'core/dashboard/class-gf-dashboard.php';
            }

            /**
             * Include Action - PO FUNCTIONS.PHP
             */
            if (file_exists(GF_PLUGIN_DIR . 'inc/action.php')) {
                include_once GF_PLUGIN_DIR . 'inc/action.php';
            }

            /**
             * Include Filters
             */
            if (file_exists(GF_PLUGIN_DIR . 'inc/filter.php')) {
                include_once GF_PLUGIN_DIR . 'inc/filter.php';
            }

            /**
             * Include Post Type
             */
            if (file_exists(GF_PLUGIN_DIR . 'inc/class-gf-custom-post-type.php')) {
                include_once GF_PLUGIN_DIR . 'inc/class-gf-custom-post-type.php';
            }

            /**
             * Include theme-options
             */
            if (file_exists(GF_PLUGIN_DIR . 'core/theme-options/framework.php')) {
                include_once GF_PLUGIN_DIR . 'core/theme-options/framework.php';
            }
            if (file_exists(GF_PLUGIN_DIR . 'inc/options-functions.php')) {
                include_once GF_PLUGIN_DIR . 'inc/options-functions.php';
            }
            if (file_exists(GF_PLUGIN_DIR . 'inc/options-config.php')) {
                include_once GF_PLUGIN_DIR . 'inc/options-config.php';
            }

            /**
             * Include MetaBox
             */
            if (file_exists(GF_PLUGIN_DIR . 'core/meta-box/meta-box.php')) {
                include_once GF_PLUGIN_DIR . 'core/meta-box/meta-box.php';
            }
            if (file_exists(GF_PLUGIN_DIR . 'inc/meta-boxes.php')) {
                include_once GF_PLUGIN_DIR . 'inc/meta-boxes.php';
            }

            /**
             * Include MetaBox For Term
             */
            if (file_exists(GF_PLUGIN_DIR . 'core/tax-meta-class/tax-meta-class.php')) {
                include_once GF_PLUGIN_DIR . 'core/tax-meta-class/tax-meta-class.php';
            }
            if (file_exists(GF_PLUGIN_DIR . 'inc/tax-meta.php')) {
                include_once GF_PLUGIN_DIR . 'inc/tax-meta.php';
            }

            /**
             * Include XMENU
             */
            if (file_exists(GF_PLUGIN_DIR . 'core/xmenu/xmenu.php')) {
                include_once GF_PLUGIN_DIR . 'core/xmenu/xmenu.php';
            }

            /**
             * Include Post Format UI
             */
            if (file_exists(GF_PLUGIN_DIR . 'core/post-format-ui/post-format-ui.php')) {
	            include_once GF_PLUGIN_DIR . 'core/post-format-ui/post-format-ui.php';
            }

            /**
             * Include widget
             */
            if (file_exists(GF_PLUGIN_DIR . 'widgets/widgets.php')) {
                include_once GF_PLUGIN_DIR . 'widgets/widgets.php';
            }
        }

        //==============================================================================
        // Define Plugin Version
        //==============================================================================
        public function define_plugin_version()
        {
            $plugin_version = '2.7';
            if (!defined('GF_PLUGIN_VERSION')) {
                define('GF_PLUGIN_VERSION', $plugin_version);
            }
        }

        /**
         * NUCLEAR: Textdomain loading completely disabled
         * MU-Plugin handles all textdomain management
         */
        public function load_text_domain() {
            // NUCLEAR: Completely disabled
            // MU-Plugin handles this
            return;
        }

        //////////////////////////////////////////////////////////////////
        // Dequeue Style Woocomerce
        //////////////////////////////////////////////////////////////////
        public function dequeue_style(){
            $screen         = get_current_screen();
            $screen_id      = $screen ? $screen->id : '';
            $screen_ids   = array(
                'widgets',
                'g5-startup_page__options'
            );

            if ( in_array( $screen_id, $screen_ids ) ) {
                wp_dequeue_style( 'woocommerce_admin_styles' );
                wp_dequeue_style('yith_wcan_admin');
                wp_dequeue_style('jquery-ui-style');
                wp_dequeue_style('yit-jquery-ui-style');
                wp_dequeue_style('yit-plugin-style');
                wp_dequeue_style('jquery-ui-overcast');
                wp_dequeue_style('woocommerce-activation');
                wp_dequeue_script('woocommerce_settings');
            }
        }

        //==============================================================================
        // Enqueue admin resources
        //==============================================================================
        public function enqueue_admin_resources()
        {
            $screen         = get_current_screen();
            $screen_id      = $screen ? $screen->id : '';
            if ( $screen_id === 'g5-startup_page__options' ) {
                return;
            }

            add_thickbox();
            // select2
            $min_suffix = (defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_style('select2',plugins_url(GF_PLUGIN_NAME. '/assets/plugins/jquery.select2/css/select2.min.css'),array(),'4.0.3','all');
            wp_enqueue_script('select2',plugins_url(GF_PLUGIN_NAME . '/assets/plugins/jquery.select2/js/select2.full.min.js'),array('jquery'),'4.0.3',true);
            // datetimepicker
            wp_enqueue_style('rwmb-datetimepicker',plugins_url(GF_PLUGIN_NAME. '/assets/plugins/datetimepicker/css/datetimepicker.min.css'),array(),false,'all');

            wp_enqueue_style(GF_PLUGIN_PREFIX . 'admin', plugins_url(GF_PLUGIN_NAME . '/assets/css/admin.min.css'), array(), false, 'all');

            wp_enqueue_script(GF_PLUGIN_PREFIX.'media',plugins_url(GF_PLUGIN_NAME . '/assets/js/g5plus-media-init'. $min_suffix .'.js'),array(),false,true);
            wp_enqueue_script(GF_PLUGIN_PREFIX.'popup-icon',plugins_url(GF_PLUGIN_NAME . '/assets/js/popup-icon'. $min_suffix .'.js'),array(),false,true);
            wp_localize_script(GF_PLUGIN_PREFIX . 'popup-icon', 'g5plus_framework_meta', array(
                'ajax_url' => admin_url('admin-ajax.php')
            ));

            wp_enqueue_script(GF_PLUGIN_PREFIX . 'admin', plugins_url(GF_PLUGIN_NAME . '/assets/js/admin' . $min_suffix . '.js'), array(), GF_PLUGIN_VERSION, true);
        }

        public function enqueue_admin_widget_resources() {
	        $screen         = get_current_screen();
	        $screen_id      = $screen ? $screen->id : '';
	        if ($screen_id === 'widgets') {
		        wp_enqueue_style(GF_PLUGIN_PREFIX . 'widget-acf', plugins_url(GF_PLUGIN_NAME . '/widgets/assets/css/widget-acf.css'), array(), false, 'all');
		        wp_enqueue_script(GF_PLUGIN_PREFIX.'widget-acf',plugins_url(GF_PLUGIN_NAME . '/widgets/assets/js/widget-acf.js'),array(),false,true);
            }
        }

        //==============================================================================
        // Enqueue frontend resources
        //==============================================================================
        public function enqueue_frontend_resources()
        {
            $min_suffix = function_exists('gf_get_option') ? (gf_get_option('enable_minifile_js') ? '.min' : '') : '';
            wp_enqueue_style(GF_PLUGIN_PREFIX . 'frontend', plugins_url(GF_PLUGIN_NAME . '/assets/css/frontend'.$min_suffix.'.css'), array(), false, 'all');
        }

        public function enqueue_custom_script(){
            $custom_js = function_exists('gf_get_option') ? gf_get_option('custom_js', '') : '';
            if ( $custom_js ) {
                echo sprintf('<script type="text/javascript">%s</script>',$custom_js);
            }
        }

        public function enqueue_meta_box_resource()
        {
            $min_suffix = (defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_script(GF_PLUGIN_PREFIX . 'meta_box', GF_PLUGIN_URL . 'assets/js/meta-box.app'. $min_suffix .'.js', array(), GF_PLUGIN_VERSION, true);
            wp_enqueue_style(GF_PLUGIN_PREFIX . 'meta_box', GF_PLUGIN_URL . 'assets/css/meta-box'. $min_suffix .'.css', false, GF_PLUGIN_VERSION);
            wp_localize_script(GF_PLUGIN_PREFIX . 'meta_box', 'gsf_meta_box',  array('meta_box_prefix' => GF_METABOX_PREFIX ));
        }

        public function enqueue_redux_resource($hook)
        {
            if (preg_match('/_page__options$/', $hook, $matches)) {
                $min_suffix = (defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG) ? '' : '.min';
                wp_enqueue_script(GF_PLUGIN_PREFIX . 'redux_admin', GF_PLUGIN_URL . 'assets/js/redux.app'. $min_suffix .'.js', array(), GF_PLUGIN_VERSION, true);
                wp_enqueue_style(GF_PLUGIN_PREFIX . 'redux_admin', GF_PLUGIN_URL . 'assets/css/redux-admin'. $min_suffix .'.css', false, GF_PLUGIN_VERSION);
            }
        }

        public function include_vc_shortcode(){
            /**
             * Include shortcodes
             */
            if (class_exists('Vc_Manager')) {
                if (file_exists(GF_PLUGIN_DIR . 'shortcodes/shortcodes.php')) {
                    include_once GF_PLUGIN_DIR . 'shortcodes/shortcodes.php';
                }
            }
        }

        public function popup_icon(){
            $font_awesome = function_exists('gf_get_font_awesome') ? gf_get_font_awesome() : array();
            $font_pe_icon_7_stroke = function_exists('gf_g5plus_get_pe_icon_7_stroke') ? gf_g5plus_get_pe_icon_7_stroke() : array();
            ob_start();
            ?>
            <div id="g5plus-framework-popup-icon-wrapper">
                <div class="popup-icon-wrapper">
                    <div class="popup-content">
                        <div class="popup-search-icon">
                            <input placeholder="Search" type="text" id="txtSearch">
                            <div class="preview">
                                <span></span> <a id="iconPreview" href="javascript:"><i class="fa fa-home"></i></a>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <div class="list-icon">
                            <h3><?php esc_html_e('Startup Icon','startup-framework') ?></h3>
                            <ul id="group-1">
                                <?php foreach ($font_pe_icon_7_stroke as $icon) {
                                    $arrkey=array_keys($icon);
                                    ?>
                                    <li><a title="<?php echo esc_attr($arrkey[0]); ?>" href="javascript:"><i class="<?php echo esc_attr($arrkey[0]); ?>"></i></a></li>
                                    <?php
                                } ?>
                            </ul><h3><?php esc_html_e('Font Awesome','startup-framework') ?></h3>
                            <ul id="group-2">
                                <?php foreach ($font_awesome as $icon) {
                                    $arrkey=array_keys($icon);
                                    ?>
                                    <li><a title="<?php echo esc_attr($arrkey[0]); ?>" href="javascript:"><i class="<?php echo esc_attr($arrkey[0]); ?>"></i></a></li>
                                    <?php
                                } ?>
                            </ul>
                            <br>
                        </div>
                    </div>
                    <div class="popup-bottom">
                        <a id="btnSave" href="javascript:" class="button button-primary"><?php esc_html_e('Insert Icon','startup-framework') ?></a>
                    </div>
                </div>
            </div>
            <?php
            die();
        }
    }

    /**
     * Instantiate the G5PLUS FRAMEWORK loader class.
     */
    $gf_loader = new GF_Loader();
}