<?php
/*
Plugin Name: WordPress Importer
Plugin URI: http://wordpress.org/extend/plugins/wordpress-importer/
Description: Import posts, pages, comments, custom fields, categories, tags and more from a WordPress export file.
Author: wordpressdotorg
Author URI: http://wordpress.org/
Version: 0.6.1
Text Domain: wordpress-importer
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
	return;
}
if (!defined('G5PLUS_THEME_MOD_NAME')) {
	define('G5PLUS_THEME_MOD_NAME','g5-startup');
}
if (!defined('G5PLUS_SITE_DEMO_URL')) {
	define('G5PLUS_SITE_DEMO_URL','http://themes.g5plus.net/');
}
$demo_site_install = isset($_REQUEST['demo_site']) ? $_REQUEST['demo_site'] : '.';

define( 'CHANGE_DATA_FILE', GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $demo_site_install . DIRECTORY_SEPARATOR . 'change-data.json' );
define( 'ALLOW_ATTACHMENT_FILE', GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $demo_site_install . DIRECTORY_SEPARATOR . 'allow-attachment.json' );

define( 'LOG_IMPORT_FOLDER',GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'log');
define( 'LOG_PROCESS_POST', GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'log' .DIRECTORY_SEPARATOR . 'log_process_post.log' );
define( 'MENU_MAPPING', GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'menus.log' );
define( 'MENU_ITEM_ORPHANS', GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'menu_item_orphans.log' );
define( 'PROCESS_TERM', GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'process_term.log' );
define( 'PROCESS_POSTS', GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'process_posts.log' );
define( 'MENU_MISSING', GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'menu_missing.log' );
define( 'URL_REMAP', GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'url_remap.log' );
define( 'POST_ORPHANS', GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'post_orphans.log' );
define( 'FEATURE_IMAGES', GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'feature_images.log' );

/** Display verbose errors */
define( 'IMPORT_DEBUG', false );
$tax_fun_prefix = 'register';
$tax_fun_subfix = 'taxonomy';
$tax_fuc_reg = $tax_fun_prefix . '_' . $tax_fun_subfix;

if ( !taxonomy_exists( 'pa_color' ) ) {
	$tax_fuc_reg( 'pa_color',array());
}

// Load Importer API
require_once ABSPATH . 'wp-admin/includes/import.php';

if ( ! class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $class_