<?php
/**
 * The template for displaying class-g5plus-post-view.php
 *
 * @package WordPress
 * @subpackage emo
 * @since emo 1.0
 */
if (!defined('ABSPATH')) {
	exit('Direct script access denied.');
}
if (!class_exists('G5Plus_Inc_Post_View')) {
	class G5Plus_Inc_Post_View {
		public $key = 'g5plus_startup_post_view';

		private static $_instance;
		public static function getInstance()
		{
			if (self::$_instance == NULL) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function init()
		{
			add_action('wp_head',array($this,'update_view_count'));
		}

		public function render($post_id = null){
			g5plus_get_template('single/post-view.php',array('post_id' => $post_id));
		}

		/**
		 * Get Post View Count
		 *
		 * @param null $post_id
		 * @return int|mixed
		 */
		public function get_view_count($post_id = null) {
			if (!isset($post_id) || ($post_id == null)) {
				$post_id = get_the_ID();
			}

			$view_count = get_post_meta($post_id,$this->key,true);
			if ($view_count === '') {
				$view_count = 0;
			}
			return $view_count;
		}

		public function update_view_count() {
			global $post;
			if ( ! is_singular() || wp_is_post_revision( $post )) {
				return;
			}
			$post_id = get_the_ID();
			$view_count = $this->get_view_count();
			$view_count++;
			update_post_meta($post_id,$this->key,$view_count);
		}
	}

	if (!function_exists('g5plus_post_view')) {
		/**
		 * @return G5Plus_Inc_Post_View
		 */
		function g5plus_post_view() {
			return G5Plus_Inc_Post_View::getInstance();
		}
	}
}