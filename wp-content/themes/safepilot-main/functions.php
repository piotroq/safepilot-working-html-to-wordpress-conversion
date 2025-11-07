<?php
/**
 * SafePilot Theme Functions
 * 
 * @package SafePilot
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define theme constants
 */
define( 'SAFEPILOT_VERSION', '1.0.0' );
define( 'SAFEPILOT_THEME_DIR', get_template_directory() );
define( 'SAFEPILOT_THEME_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function safepilot_theme_setup() {
	// Make theme available for translation
	load_theme_textdomain( 'safepilot', SAFEPILOT_THEME_DIR . '/languages' );
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );
	
	// Enable support for Post Thumbnails on posts and pages
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 675, true );
	
	// Add custom image sizes
	add_image_size( 'safepilot-featured', 1200, 675, true );
	add_image_size( 'safepilot-thumbnail', 400, 300, true );
	add_image_size( 'safepilot-medium', 800, 600, true );
	
	// Register navigation menus
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'safepilot' ),
		'footer'  => __( 'Footer Menu', 'safepilot' ),
	) );
	
	// Switch default core markup to output valid HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );
	
	// Add theme support for selective refresh for widgets
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// Add support for custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	
	// Add support for Block Styles
	add_theme_support( 'wp-block-styles' );
	
	// Add support for full and wide align images
	add_theme_support( 'align-wide' );
	
	// Add support for editor styles
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style-editor.css' );
	
	// Add support for responsive embedded content
	add_theme_support( 'responsive-embeds' );
	
	// Add support for custom line height controls
	add_theme_support( 'custom-line-height' );
	
	// Add support for custom spacing controls
	add_theme_support( 'custom-spacing' );
	
	// Add support for custom units
	add_theme_support( 'custom-units' );
	
	// Add support for link color control
	add_theme_support( 'link-color' );
	
	// Add support for appearance tools
	add_theme_support( 'appearance-tools' );
}
add_action( 'after_setup_theme', 'safepilot_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet
 */
function safepilot_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'safepilot_content_width', 1200 );
}
add_action( 'after_setup_theme', 'safepilot_content_width', 0 );

/**
 * Register widget areas
 */
function safepilot_widgets_init() {
	// Footer widget area - 4 columns
	for ( $i = 1; $i <= 4; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( __( 'Footer Widget Area %d', 'safepilot' ), $i ),
			'id'            => 'footer-' . $i,
			'description'   => sprintf( __( 'Widget area for footer column %d', 'safepilot' ), $i ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
	
	// Contact widget area
	register_sidebar( array(
		'name'          => __( 'Contact Widget Area', 'safepilot' ),
		'id'            => 'contact-widget',
		'description'   => __( 'Widget area for contact information', 'safepilot' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'safepilot_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function safepilot_scripts() {
	// Enqueue Bootstrap CSS
	wp_enqueue_style( 
		'bootstrap', 
		SAFEPILOT_THEME_URI . '/assets/css/bootstrap.min.css',
		array(),
		'5.3.0'
	);
	
	// Enqueue Font Awesome
	wp_enqueue_style(
		'font-awesome',
		SAFEPILOT_THEME_URI . '/assets/css/all.min.css',
		array(),
		'6.4.0'
	);
	
	// Enqueue Animate CSS
	wp_enqueue_style(
		'animate',
		SAFEPILOT_THEME_URI . '/assets/css/animate.css',
		array(),
		SAFEPILOT_VERSION
	);
	
	// Enqueue Magnific Popup CSS
	wp_enqueue_style(
		'magnific-popup',
		SAFEPILOT_THEME_URI . '/assets/css/magnific-popup.css',
		array(),
		SAFEPILOT_VERSION
	);
	
	// Enqueue Mean Menu CSS
	wp_enqueue_style(
		'meanmenu',
		SAFEPILOT_THEME_URI . '/assets/css/meanmenu.css',
		array(),
		SAFEPILOT_VERSION
	);
	
	// Enqueue Swiper CSS
	wp_enqueue_style(
		'swiper-bundle',
		SAFEPILOT_THEME_URI . '/assets/css/swiper-bundle.min.css',
		array(),
		SAFEPILOT_VERSION
	);
	
	// Enqueue Nice Select CSS
	wp_enqueue_style(
		'nice-select',
		SAFEPILOT_THEME_URI . '/assets/css/nice-select.css',
		array(),
		SAFEPILOT_VERSION
	);
	
	// Enqueue main theme CSS from static template
	wp_enqueue_style(
		'safepilot-main-static',
		SAFEPILOT_THEME_URI . '/assets/css/main.css',
		array( 'bootstrap', 'font-awesome' ),
		SAFEPILOT_VERSION
	);
	
	// Enqueue theme stylesheet (style.css - for WordPress specific styles)
	wp_enqueue_style(
		'safepilot-style',
		get_stylesheet_uri(),
		array( 'safepilot-main-static' ),
		SAFEPILOT_VERSION
	);
	
	// Enqueue jQuery (WordPress includes its own)
	wp_enqueue_script( 'jquery' );
	
	// Enqueue Bootstrap JS
	wp_enqueue_script(
		'bootstrap',
		SAFEPILOT_THEME_URI . '/assets/js/bootstrap.bundle.min.js',
		array( 'jquery' ),
		'5.3.0',
		true
	);
	
	// Enqueue WOW.js for animations
	wp_enqueue_script(
		'wow',
		SAFEPILOT_THEME_URI . '/assets/js/wow.min.js',
		array( 'jquery' ),
		SAFEPILOT_VERSION,
		true
	);
	
	// Enqueue Waypoints
	wp_enqueue_script(
		'waypoints',
		SAFEPILOT_THEME_URI . '/assets/js/jquery.waypoints.js',
		array( 'jquery' ),
		SAFEPILOT_VERSION,
		true
	);
	
	// Enqueue CounterUp
	wp_enqueue_script(
		'counterup',
		SAFEPILOT_THEME_URI . '/assets/js/jquery.counterup.min.js',
		array( 'jquery', 'waypoints' ),
		SAFEPILOT_VERSION,
		true
	);
	
	// Enqueue Magnific Popup
	wp_enqueue_script(
		'magnific-popup',
		SAFEPILOT_THEME_URI . '/assets/js/jquery.magnific-popup.min.js',
		array( 'jquery' ),
		SAFEPILOT_VERSION,
		true
	);
	
	// Enqueue Nice Select
	wp_enqueue_script(
		'nice-select',
		SAFEPILOT_THEME_URI . '/assets/js/jquery.nice-select.min.js',
		array( 'jquery' ),
		SAFEPILOT_VERSION,
		true
	);
	
	// Enqueue Mean Menu
	wp_enqueue_script(
		'meanmenu',
		SAFEPILOT_THEME_URI . '/assets/js/jquery.meanmenu.min.js',
		array( 'jquery' ),
		SAFEPILOT_VERSION,
		true
	);
	
	// Enqueue Swiper (doesn't require jQuery)
	wp_enqueue_script(
		'swiper-bundle',
		SAFEPILOT_THEME_URI . '/assets/js/swiper-bundle.min.js',
		array(),
		SAFEPILOT_VERSION,
		true
	);
	
	// Enqueue Viewport
	wp_enqueue_script(
		'viewport',
		SAFEPILOT_THEME_URI . '/assets/js/viewport.jquery.js',
		array( 'jquery' ),
		SAFEPILOT_VERSION,
		true
	);
	
	// Enqueue theme main JS from static template
	wp_enqueue_script(
		'safepilot-main-static',
		SAFEPILOT_THEME_URI . '/assets/js/main.js',
		array( 'jquery', 'bootstrap' ),
		SAFEPILOT_VERSION,
		true
	);
	
	// Enqueue comment reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// Localize script for AJAX (only on pages that might need it)
	if ( is_singular() || is_archive() || is_home() || is_search() ) {
		wp_localize_script( 'safepilot-main-static', 'safepilot_ajax', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'safepilot_nonce' ),
		) );
	}
}
add_action( 'wp_enqueue_scripts', 'safepilot_scripts' );

/**
 * Register Custom Post Types
 */
function safepilot_register_post_types() {
	// Register Portfolio Custom Post Type
	register_post_type( 'portfolio', array(
		'labels'              => array(
			'name'               => __( 'Portfolio', 'safepilot' ),
			'singular_name'      => __( 'Portfolio Item', 'safepilot' ),
			'add_new'            => __( 'Add New', 'safepilot' ),
			'add_new_item'       => __( 'Add New Portfolio Item', 'safepilot' ),
			'edit_item'          => __( 'Edit Portfolio Item', 'safepilot' ),
			'new_item'           => __( 'New Portfolio Item', 'safepilot' ),
			'view_item'          => __( 'View Portfolio Item', 'safepilot' ),
			'search_items'       => __( 'Search Portfolio', 'safepilot' ),
			'not_found'          => __( 'No portfolio items found', 'safepilot' ),
			'not_found_in_trash' => __( 'No portfolio items found in trash', 'safepilot' ),
		),
		'public'              => true,
		'has_archive'         => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'menu_icon'           => 'dashicons-portfolio',
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'rewrite'             => array( 'slug' => 'portfolio' ),
	) );
	
	// Register Services Custom Post Type
	register_post_type( 'service', array(
		'labels'              => array(
			'name'               => __( 'Services', 'safepilot' ),
			'singular_name'      => __( 'Service', 'safepilot' ),
			'add_new'            => __( 'Add New', 'safepilot' ),
			'add_new_item'       => __( 'Add New Service', 'safepilot' ),
			'edit_item'          => __( 'Edit Service', 'safepilot' ),
			'new_item'           => __( 'New Service', 'safepilot' ),
			'view_item'          => __( 'View Service', 'safepilot' ),
			'search_items'       => __( 'Search Services', 'safepilot' ),
			'not_found'          => __( 'No services found', 'safepilot' ),
			'not_found_in_trash' => __( 'No services found in trash', 'safepilot' ),
		),
		'public'              => true,
		'has_archive'         => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'menu_icon'           => 'dashicons-admin-tools',
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'rewrite'             => array( 'slug' => 'services' ),
	) );
}
add_action( 'init', 'safepilot_register_post_types' );

/**
 * Add custom meta boxes for SEO
 */
function safepilot_add_seo_meta_boxes() {
	$post_types = array( 'post', 'page', 'portfolio', 'service' );
	
	foreach ( $post_types as $post_type ) {
		add_meta_box(
			'safepilot_seo_meta',
			__( 'SEO Settings', 'safepilot' ),
			'safepilot_seo_meta_box_callback',
			$post_type,
			'normal',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'safepilot_add_seo_meta_boxes' );

/**
 * SEO meta box callback
 */
function safepilot_seo_meta_box_callback( $post ) {
	wp_nonce_field( 'safepilot_seo_meta_box', 'safepilot_seo_meta_box_nonce' );
	
	$meta_description = get_post_meta( $post->ID, '_safepilot_meta_description', true );
	$meta_keywords = get_post_meta( $post->ID, '_safepilot_meta_keywords', true );
	$meta_author = get_post_meta( $post->ID, '_safepilot_meta_author', true );
	$og_description = get_post_meta( $post->ID, '_safepilot_og_description', true );
	$fb_app_id = get_post_meta( $post->ID, '_safepilot_fb_app_id', true );
	?>
	<p>
		<label for="safepilot_meta_description"><strong><?php _e( 'Meta Description:', 'safepilot' ); ?></strong></label><br>
		<textarea id="safepilot_meta_description" name="safepilot_meta_description" rows="3" style="width:100%;"><?php echo esc_textarea( $meta_description ); ?></textarea>
	</p>
	<p>
		<label for="safepilot_meta_keywords"><strong><?php _e( 'Meta Keywords:', 'safepilot' ); ?></strong></label><br>
		<input type="text" id="safepilot_meta_keywords" name="safepilot_meta_keywords" value="<?php echo esc_attr( $meta_keywords ); ?>" style="width:100%;">
	</p>
	<p>
		<label for="safepilot_meta_author"><strong><?php _e( 'Meta Author:', 'safepilot' ); ?></strong></label><br>
		<input type="text" id="safepilot_meta_author" name="safepilot_meta_author" value="<?php echo esc_attr( $meta_author ); ?>" style="width:100%;">
	</p>
	<p>
		<label for="safepilot_og_description"><strong><?php _e( 'Open Graph Description:', 'safepilot' ); ?></strong></label><br>
		<textarea id="safepilot_og_description" name="safepilot_og_description" rows="3" style="width:100%;"><?php echo esc_textarea( $og_description ); ?></textarea>
	</p>
	<p>
		<label for="safepilot_fb_app_id"><strong><?php _e( 'Facebook App ID:', 'safepilot' ); ?></strong></label><br>
		<input type="text" id="safepilot_fb_app_id" name="safepilot_fb_app_id" value="<?php echo esc_attr( $fb_app_id ); ?>" style="width:100%;">
	</p>
	<?php
}

/**
 * Save SEO meta box data
 */
function safepilot_save_seo_meta_box( $post_id ) {
	if ( ! isset( $_POST['safepilot_seo_meta_box_nonce'] ) ) {
		return;
	}
	
	if ( ! wp_verify_nonce( $_POST['safepilot_seo_meta_box_nonce'], 'safepilot_seo_meta_box' ) ) {
		return;
	}
	
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	$fields = array(
		'safepilot_meta_description',
		'safepilot_meta_keywords',
		'safepilot_meta_author',
		'safepilot_og_description',
		'safepilot_fb_app_id',
	);
	
	foreach ( $fields as $field ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
		}
	}
}
add_action( 'save_post', 'safepilot_save_seo_meta_box' );

/**
 * Output SEO meta tags
 */
function safepilot_output_seo_meta_tags() {
	if ( is_singular() ) {
		global $post;
		
		$meta_description = get_post_meta( $post->ID, '_safepilot_meta_description', true );
		$meta_keywords = get_post_meta( $post->ID, '_safepilot_meta_keywords', true );
		$meta_author = get_post_meta( $post->ID, '_safepilot_meta_author', true );
		$og_description = get_post_meta( $post->ID, '_safepilot_og_description', true );
		$fb_app_id = get_post_meta( $post->ID, '_safepilot_fb_app_id', true );
		
		if ( ! empty( $meta_description ) ) {
			echo '<meta name="description" content="' . esc_attr( $meta_description ) . '">' . "\n";
		}
		
		if ( ! empty( $meta_keywords ) ) {
			echo '<meta name="keywords" content="' . esc_attr( $meta_keywords ) . '">' . "\n";
		}
		
		if ( ! empty( $meta_author ) ) {
			echo '<meta name="author" content="' . esc_attr( $meta_author ) . '">' . "\n";
		}
		
		// Canonical URL
		echo '<link rel="canonical" href="' . esc_url( get_permalink() ) . '">' . "\n";
		
		// Open Graph meta tags
		echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '">' . "\n";
		
		if ( ! empty( $og_description ) ) {
			echo '<meta property="og:description" content="' . esc_attr( $og_description ) . '">' . "\n";
		}
		
		if ( has_post_thumbnail() ) {
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			if ( $thumbnail ) {
				echo '<meta property="og:image" content="' . esc_url( $thumbnail[0] ) . '">' . "\n";
			}
		}
		
		echo '<meta property="og:locale" content="pl_PL">' . "\n";
		
		if ( ! empty( $fb_app_id ) ) {
			echo '<meta property="fb:app_id" content="' . esc_attr( $fb_app_id ) . '">' . "\n";
		}
		
		echo '<meta property="og:type" content="website">' . "\n";
		echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'safepilot_output_seo_meta_tags' );

/**
 * Add Customizer settings
 */
function safepilot_customize_register( $wp_customize ) {
	// Add SafePilot Settings Section
	$wp_customize->add_section( 'safepilot_settings', array(
		'title'    => __( 'SafePilot Settings', 'safepilot' ),
		'priority' => 30,
	) );
	
	// Top Bar Email
	$wp_customize->add_setting( 'safepilot_top_bar_email', array(
		'default'           => 'info@safepilot.pl',
		'sanitize_callback' => 'sanitize_email',
		'transport'         => 'refresh',
	) );
	
	$wp_customize->add_control( 'safepilot_top_bar_email', array(
		'label'    => __( 'Top Bar Email', 'safepilot' ),
		'section'  => 'safepilot_settings',
		'type'     => 'email',
	) );
	
	// Top Bar Phone
	$wp_customize->add_setting( 'safepilot_top_bar_phone', array(
		'default'           => '+48 123 456 789',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	
	$wp_customize->add_control( 'safepilot_top_bar_phone', array(
		'label'    => __( 'Top Bar Phone', 'safepilot' ),
		'section'  => 'safepilot_settings',
		'type'     => 'text',
	) );
	
	// Social Media Links
	$social_networks = array(
		'facebook' => 'Facebook',
		'twitter'  => 'Twitter',
		'linkedin' => 'LinkedIn',
		'youtube'  => 'YouTube',
	);
	
	foreach ( $social_networks as $network => $label ) {
		$wp_customize->add_setting( "safepilot_social_{$network}", array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		) );
		
		$wp_customize->add_control( "safepilot_social_{$network}", array(
			'label'    => sprintf( __( '%s URL', 'safepilot' ), $label ),
			'section'  => 'safepilot_settings',
			'type'     => 'url',
		) );
	}
}
add_action( 'customize_register', 'safepilot_customize_register' );

/**
 * Load theme admin functions
 */
require_once SAFEPILOT_THEME_DIR . '/inc/admin-settings.php';
