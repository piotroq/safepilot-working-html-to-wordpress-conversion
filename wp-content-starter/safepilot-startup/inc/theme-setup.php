<?php
/**
 * Theme Setup
 * *******************************************************
 */
if (!function_exists('g5plus_theme_setup')) {
    function g5plus_theme_setup()
    {
        if (!isset($content_width)) {
            $content_width = 1170;
        }

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Declare WooCommerce support
        add_theme_support('woocommerce');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'g5-startup'),
            'left-menu' => esc_html__('Left Menu ( Header 3 )', 'g5-startup'),
            'right-menu' => esc_html__('Right Menu ( Header 3 )', 'g5-startup'),
            'mobile'  => esc_html__('Mobile Menu', 'g5-startup'),
        ));

        // Enable support for Post Formats.
        add_theme_support('post-formats', array('gallery', 'video', 'audio', 'quote', 'link'));

	    add_theme_support("title-tag");
        add_theme_support("custom-header");
        add_theme_support("custom-background");

        // Enable support for HTML5 markup.
        add_theme_support('html5', array(
            'comment-list',
            'search-form',
            'comment-form',
            'gallery',
        ));

        $language_path = get_template_directory() . '/languages';
        load_theme_textdomain('g5-startup', $language_path);

	    $editor_style = apply_filters('g5plus_editor_style',array(
		    '/assets/plugins/bootstrap/css/bootstrap.min.css',
		    '/assets/css/editor-style.css',
	    ));

	    add_editor_style($editor_style);

	    add_theme_support('editor-styles');

	    add_theme_support( 'wp-block-styles' );

	    add_theme_support( 'responsive-embeds' );
    }

    add_action('after_setup_theme', 'g5plus_theme_setup');
}