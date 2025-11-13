<?php
/**
 * Orson woocommerce class
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
if ( class_exists( 'WooCommerce' ) && !class_exists('G5Plus_Woocommerce') ){
    class G5Plus_Woocommerce{

        function __construct() {
            $this->define_filter();
            $this->remove_hook();
            $this->define_hook();
        }

        function define_filter() {
            // custom page title
            add_filter('g5plus_page_title',array($this,'page_title'));
            add_filter('g5plus_sub_page_title',array($this,'page_sub_title'));

            // remove shop page title
            add_filter('woocommerce_show_page_title','__return_false');

            // shop per page
            add_filter('loop_shop_per_page', array($this,'loop_shop_per_page'));

            // filter pagination
            add_filter('woocommerce_pagination_args',array($this,'g5plus_woocommerce_pagination_args'));

            add_filter('woocommerce_product_description_heading', array($this, 'g5plus_product_description_heading'));

            add_filter('woocommerce_product_additional_information_heading','__return_false');

            add_filter('woocommerce_review_gravatar_size', array($this,'g5plus_woocommerce_review_gravatar_size'));

            // related columns and total
            add_filter('woocommerce_output_related_products_args',array($this,'g5plus_woocommerce_output_related_products_args'));

            // up-sell columns and total
            add_filter('woocommerce_upsell_display_args',array($this,'g5plus_woocommerce_upsell_display_args'));

        }

        function remove_hook() {

            // remove woocommerce sidebar
            remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);

            // remove rating, price
            remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
            remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

            // remove Breadcrumb
            remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);

            // remove archive description
            remove_action('woocommerce_archive_description','woocommerce_taxonomy_archive_description',10);
            remove_action('woocommerce_archive_description','woocommerce_product_archive_description',10);

            // remove result count and catalog ordering
            remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
            remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);

            // remove pagination
            //remove_action('woocommerce_after_shop_loop','woocommerce_pagination',10);

            // remove product single flash
            remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

            // remove product link close
            remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);
            remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);

            // remove add to cart
            remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10);

            // remove product thumb
            remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10);

            // remove product title
            remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);

            // remove single product title
            remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt' ,20);

            // Remove cross sell
            remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

            add_action('init',array($this,'change_compare_button_position'),30);


        }

        public function change_compare_button_position() {
            global $yith_woocompare;
            if ( isset($yith_woocompare) && isset($yith_woocompare->obj)) {
                remove_action( 'woocommerce_after_shop_loop_item', array($yith_woocompare->obj,'add_compare_link'), 20 );
                remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
            }
        }


        function define_hook() {
            // add catalog filter
            add_action('woocommerce_before_shop_loop',array($this,'catalog_filter'),10);

            // product add to cart button, price, rating
            add_action('woocommerce_shop_loop_item_title',array($this,'g5plus_woocommerce_template_loop_add_to_cart'),9);
            add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
            add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );

            // product actions
            add_action('g5plus_woocommerce_product_actions',array($this,'g5plus_woocomerce_template_loop_compare'),5);
            add_action('g5plus_woocommerce_product_actions',array($this,'g5plus_woocomerce_template_loop_wishlist'),10);
            add_action('g5plus_woocommerce_product_actions',array($this,'g5plus_woocomerce_template_loop_quick_view'),15);


            // product sale count down
            add_action('woocommerce_before_shop_loop_item_title',array($this,'g5plus_woocommerce_template_loop_sale_count_down'),10);
            add_action('g5plus_after_single_product_image_main',array($this,'g5plus_woocommerce_template_loop_sale_count_down'),10);

            // product images thumb
            add_action('woocommerce_before_shop_loop_item_title',array($this,'g5plus_woocommerce_template_loop_product_thumbnail'),20);

            // product link
            add_action('woocommerce_before_shop_loop_item_title',array($this,'g5plus_woocomerce_template_loop_link'),30);

            // product title
            add_action('woocommerce_shop_loop_item_title',array($this,'g5plus_woocommerce_template_loop_product_title'),10);

            // quick-views ajax
            add_action( 'wp_ajax_nopriv_product_quick_view', array($this,'popup_product_quick_view'));
            add_action( 'wp_ajax_product_quick_view', array($this,'popup_product_quick_view') );
            add_action( 'wp_footer', array( $this, 'quick_view' ) );

            // quick view
            // add_action('woocommerce_before_quick_view_product_summary','woocommerce_show_product_sale_flash',10);
            add_action('woocommerce_before_quick_view_product_summary',array($this,'g5plus_show_product_quick_view_images'),20);

            add_action('woocommerce_quick_view_product_summary',array($this,'g5plus_template_quick_view_product_title'),5);
            add_action('woocommerce_quick_view_product_summary',array($this,'g5plus_template_quick_view_rating'),10);
            add_action('woocommerce_quick_view_product_summary','woocommerce_template_single_price',10);
            add_action('woocommerce_quick_view_product_summary',array($this, 'g5plus_template_single_excerpt'),20);
            add_action('woocommerce_quick_view_product_summary','woocommerce_template_single_add_to_cart',30);
            add_action('woocommerce_quick_view_product_summary',array($this,'g5plus_woocommerce_template_single_function'),35);
            add_action('woocommerce_quick_view_product_summary','woocommerce_template_single_meta',40);
            add_action('woocommerce_quick_view_product_summary','woocommerce_template_single_sharing',50);

            // banner
            add_action('g5plus_before_archive',array($this,'g5plus_archive_product_banner_full'),10);
            add_action('woocommerce_before_shop_loop',array($this,'g5plus_archive_product_banner_container'),5);

            add_action('woocommerce_before_shop_loop',array($this,'g5plus_archive_product_settings'),50);

            // single product share
            add_action('woocommerce_share','g5plus_the_social_share',10);

            // product single flash
            add_action( 'woocommerce_before_single_product_summary_flash', 'woocommerce_show_product_sale_flash');

            // single product title
            add_action('woocommerce_single_product_summary',array($this, 'g5plus_template_single_excerpt'),20);

            // cross sell
            add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 11 );

            /*Shop Listing*/
            add_action( 'g5plus_woocommerce_shop_loop_list_image','woocommerce_show_product_sale_flash',5);
            add_action( 'g5plus_woocommerce_shop_loop_list_image', array($this,'g5plus_woocommerce_template_loop_product_image'));

            add_action( 'g5plus_woocommerce_shop_loop_list_info',array($this,'g5plus_woocommerce_template_loop_product_list_title'),10 );
            add_action( 'g5plus_woocommerce_shop_loop_list_info', 'woocommerce_template_loop_rating', 15);
            add_action( 'g5plus_woocommerce_shop_loop_list_info','woocommerce_template_loop_price',20 );
            add_action( 'g5plus_woocommerce_shop_loop_list_info',array($this,'g5plus_woocommerce_template_loop_product_excerpt'),25 );
            add_action( 'g5plus_woocommerce_shop_loop_list_info',array($this,'g5plus_woocommerce_template_loop_add_to_cart'),30 );
            add_action( 'g5plus_woocommerce_shop_loop_list_info',array($this,'g5plus_woocomerce_template_loop_compare'),35 );
            add_action( 'g5plus_woocommerce_shop_loop_list_info',array($this,'g5plus_woocomerce_template_loop_wishlist'),40 );

            /* Grid-skins */
            add_action('g5plus_grid_woocommerce_shop_loop_flash', 'woocommerce_show_product_sale_flash');
            add_action('g5plus_grid_woocommerce_shop_loop_add_to_cart',array($this,'g5plus_woocommerce_template_loop_add_to_cart'),9);
        }

        function page_title($page_title){
            if (is_post_type_archive('product')) {
                $shop_page_id = wc_get_page_id( 'shop' );
                if ($shop_page_id) {
                    if (!$page_title) {
                        $page_title   = get_the_title( $shop_page_id );
                    }
                    $is_custom_page_title = g5plus_get_rwmb_meta('is_custom_page_title',array(),$shop_page_id);
                    if ($is_custom_page_title) {
                        $page_title = g5plus_get_rwmb_meta('custom_page_title',array(),$shop_page_id);
                    }
                }
            }
            return $page_title;
        }

        function page_sub_title($page_sub_title){
            if (is_post_type_archive('product')) {
                $shop_page_id = wc_get_page_id( 'shop' );
                if ($shop_page_id) {
                    $is_custom_page_title = g5plus_get_rwmb_meta('is_custom_page_title',array(),$shop_page_id);
                    if ($is_custom_page_title) {
                        $page_sub_title = g5plus_get_rwmb_meta('custom_page_sub_title',array(),$shop_page_id);
                    }
                }
            }
            return $page_sub_title;
        }

        function g5plus_product_description_heading() {
            return esc_html__('Product Description', 'g5-startup');
        }
        function g5plus_woocommerce_template_loop_product_image() {
            wc_get_template('loop/product-image.php');
        }

        function g5plus_woocommerce_template_loop_product_excerpt(){
            global $post;
            if ( ! $post->post_excerpt ) {
                return;
            }
            ?>
            <div class="product-description">
                <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
            </div>
            <?php
        }

        function g5plus_woocommerce_template_loop_add_to_cart(){
            $product_add_to_cart_enable = g5plus_get_option('product_add_to_cart_enable', '1');
            if ($product_add_to_cart_enable) {
                global $product;
                echo '<div class="product-add-to-cart" data-toggle="tooltip" data-original-title="'.$product->add_to_cart_text().'">';
                woocommerce_template_loop_add_to_cart(array(
                    'class'    => implode( ' ', array_filter( array(
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : 'product_out_of_stock',
                        $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
                    ) ) )
                ));
                echo '</div>';
            }
        }

        function g5plus_archive_product_settings() {
            $g5plus_woocommerce_loop = &G5Plus_Woocommerce::get_woocommerce_loop();

            // setting columns
            $g5plus_woocommerce_loop['columns'] = g5plus_get_option('product_display_columns','3');
            $product_display_columns = isset($_GET['columns']) ? $_GET['columns'] : '';
            if (in_array($product_display_columns, array('2','3','4','5'))) {
                $g5plus_woocommerce_loop['columns'] = $product_display_columns;
            }

            // setting column gap
            $g5plus_woocommerce_loop['column_gap'] = g5plus_get_option('product_display_column_gap','');
        }

        function g5plus_archive_product_banner_full(){
            if (is_post_type_archive('product') || is_tax('product_cat')) {
                $banner_layout = g5plus_get_option('archive_product_banner_layout');
                $cat = get_queried_object();
                if ($cat && property_exists( $cat, 'term_id' )) {
                    $banner_layout_custom = g5plus_get_tax_meta($cat->term_id,'archive_product_banner_layout');
                    if (isset($banner_layout_custom) &&  ($banner_layout_custom != '') && ($banner_layout_custom != -1)) {
                        $banner_layout = $banner_layout_custom;
                    }
                }

                if ($banner_layout == 'full') {
                    wc_get_template('banner.php');
                }
            }
        }

        function g5plus_archive_product_banner_container(){
            if (is_post_type_archive('product') || is_tax('product_cat')) {
                $banner_layout = g5plus_get_option('archive_product_banner_layout');
                $cat = get_queried_object();
                if ($cat && property_exists( $cat, 'term_id' )) {
                    $banner_layout_custom = g5plus_get_tax_meta($cat->term_id,'archive_product_banner_layout');
                    if (isset($banner_layout_custom) &&  ($banner_layout_custom != '') && ($banner_layout_custom != -1)) {
                        $banner_layout = $banner_layout_custom;
                    }
                }

                if ($banner_layout == 'container') {
                    wc_get_template('banner.php');
                }
            }
        }
        function quick_view(){
            $product_quick_view = g5plus_get_option('product_quick_view_enable', '1');
            if ($product_quick_view) {
                wp_enqueue_script( 'wc-add-to-cart-variation' );
            }
        }

        function popup_product_quick_view(){
            $product_id = $_REQUEST['id'];
            global $post, $product;
            $post = get_post($product_id);
            setup_postdata($post);
            $product = wc_get_product( $product_id );
            wc_get_template_part('content-product-quick-view');
            wp_reset_postdata();
            die();

        }

        function g5plus_template_quick_view_product_title(){
            wc_get_template('quick-view/title.php');
        }

        function g5plus_template_quick_view_rating(){
            wc_get_template('quick-view/rating.php');
        }

        function g5plus_template_single_excerpt() {
            echo '<div class="single-product-description">';
            echo '<p class="woocommerce-description-heading">'.esc_html__("Description", "g5-startup").'</p>';
            wc_get_template('single-product/short-description.php');
            echo '</div>';
        }

        function g5plus_show_product_quick_view_images(){
            wc_get_template('quick-view/product-image.php');
        }


        function g5plus_woocommerce_output_related_products_args($args){
            $default = array(
                'posts_per_page' 	=> g5plus_get_option('related_product_count',6),
                'columns' 			=> g5plus_get_option('related_product_display_columns',4)
            );
            $args = array_merge($args,$default);
            return $args;
        }

        function g5plus_woocommerce_upsell_display_args($args){
            $default = array(
                'columns' 			=> g5plus_get_option('up_sells_product_display_columns',4)
            );
            $args = array_merge($args,$default);
            return $args;
        }

        function g5plus_woocommerce_review_gravatar_size(){
            return 62;
        }
        function g5plus_woocommerce_pagination_args($woocommerce_pagination_args) {
            $args = array(
                'type' => '',
                'prev_text' => wp_kses_post(__('<i class="fa fa-angle-left"></i>','g5-startup')) ,
                'next_text' => wp_kses_post(__('<i class="fa fa-angle-right"></i>','g5-startup')),
            );
            $woocommerce_pagination_args = array_merge($woocommerce_pagination_args,$args);
            return $woocommerce_pagination_args;
        }

        function g5plus_woocommerce_template_loop_product_thumbnail() {
            wc_get_template('loop/product-thumb.php');
        }

        function g5plus_woocommerce_template_loop_product_title() {
            echo '<div class="product-info-right">';
            wc_get_template( 'loop/title.php' );
        }

        function g5plus_woocommerce_template_loop_product_list_title() {
            wc_get_template( 'loop/title.php' );
        }

        function g5plus_woocomerce_template_loop_link() {
            wc_get_template( 'loop/link.php' );
        }

        function g5plus_woocomerce_template_loop_quick_view() {
            wc_get_template( 'loop/quick-view.php' );
        }

        function g5plus_woocomerce_template_loop_compare() {
            if (in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins'))) && get_option('yith_woocompare_compare_button_in_products_list') == 'yes') {
                if (!shortcode_exists('yith_compare_button') && class_exists('YITH_Woocompare') && function_exists('yith_woocompare_constructor')) {
                    $context = isset($_REQUEST['context']) ? $_REQUEST['context'] : null;
                    $_REQUEST['context'] = 'frontend';
                    yith_woocompare_constructor();
                    $_REQUEST['context'] = $context;
                }
                echo do_shortcode('[yith_compare_button container="false" type="link"]');
            }
        }

        function g5plus_woocomerce_template_loop_wishlist() {
            if (in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                echo do_shortcode('[yith_wcwl_add_to_wishlist]');
            }
        }

        // Catalog Page Size
        function catalog_page_size() {
            wc_get_template( 'loop/page-size.php' );
        }

        function catalog_filter() {
            wc_get_template( 'loop/catalog-filter.php' );
        }

        function loop_shop_per_page() {
            $product_per_page = g5plus_get_option('product_per_page','12,24,36');
            $product_per_page_arr = explode ( ",", $product_per_page );
            $page_size = isset( $_GET['page_size'] ) ? wc_clean( $_GET['page_size'] ) : $product_per_page_arr[0];
            return $page_size;
        }

        function g5plus_woocommerce_template_loop_sale_count_down(){
            wc_get_template('loop/sale-count-down.php');
        }

        // GET Woocommerce loop
        public static function &get_woocommerce_loop() {
            if (isset($GLOBALS['g5plus_woocommerce_loop']) && is_array($GLOBALS['g5plus_woocommerce_loop'])) {
                return $GLOBALS['g5plus_woocommerce_loop'];
            }
            $GLOBALS['g5plus_woocommerce_loop'] = array(
                'layout' => '',
                'columns' => '',
                'columns_md' => '',
                'columns_sm' => '',
                'columns_xs' => '',
                'columns_mb' => '',
                'column_gap' => '',
                'rows' => '',
                'nav' => 'false',
                'dots' => 'false',
                'arrows' => 'true',
                'arrows_position' => 'top',
                'arrows_style' => '',
                'size' => '',
                'category_enable' => '',
                'catalog_style' => '',
                'sale_count_down_enable' => ''
            );
            return $GLOBALS['g5plus_woocommerce_loop'];
        }

        public static function reset_loop() {
            unset($GLOBALS['g5plus_woocommerce_loop']);
        }
    }
    new G5Plus_Woocommerce();
}