<?php
/**
 * Class Install Demo
 *
 * @package WordPress
 * @subpackage emo
 * @since emo 1.0
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
if (!class_exists('GF_Dashboard_Install_Demo')) {
	class GF_Dashboard_Install_Demo {
		/**
		 * The instance of this object
		 *
		 * @static
		 * @access private
		 * @var null | object
		 */
		private static $instance;

		public static function init()
		{
			if (self::$instance == NULL) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		private function __construct()
		{
			add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_styles'));
			add_action( 'wp_ajax_g5plus_install_demo', array($this, 'install_demo') );
		}

		/**
		 * Binder Page
		 */
		public function binder_page()
		{
			gf_get_template('core/dashboard/templates/dashboard', array('current_page' => 'install-demo'));
		}

		public function admin_enqueue_styles()
		{
			if (!gfDashboard()->is_dashboard_page('install-demo')) return;
			$min_suffix = (defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG) ? '' : '.min';
			wp_enqueue_style('gf_install_demo_data', GF_PLUGIN_URL . 'core/dashboard/install-demo/assets/css/style'. $min_suffix .'.css');
			wp_enqueue_script('gf_install_demo_data', GF_PLUGIN_URL . 'core/dashboard/install-demo/assets/js/app'. $min_suffix .'.js', false, true);
			wp_localize_script('gf_install_demo_data', 'gf_install_demo_meta', array(
				'ajax_url' => admin_url('admin-ajax.php?activate-multi=true')
			));
		}

		public function  install_demo() {
			/**
			 * Check security
			 */
			if (!(isset($_REQUEST['security']) && current_user_can( 'manage_options' )) )
			{
				ob_end_clean();
				$data_response = array(
					'code' => 'error',
					'message' => esc_html__("Permission error!",'startup-framework')
				);
				echo json_encode($data_response);
				die();
			}

			if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
				define( 'WP_LOAD_IMPORTERS', true );
			}

			// Load Importer API
			require_once ABSPATH . 'wp-admin/includes/import.php';

			if ( file_exists( ABSPATH . 'wp-content/plugins/revslider/revslider_admin.php' ) ) {
				require_once( ABSPATH . 'wp-content/plugins/revslider/revslider_admin.php' );
			}

			$demo_site = isset($_REQUEST['demo_site']) ? $_REQUEST['demo_site'] : '.';

			$importer_error = false;
			$import_file_path    = GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR ."data" . DIRECTORY_SEPARATOR . $demo_site . DIRECTORY_SEPARATOR ."demo-data.xml";
			$import_setting_path = GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR ."data" . DIRECTORY_SEPARATOR . $demo_site . DIRECTORY_SEPARATOR ."setting.json";

			//check if wp_importer, the base importer class is available, otherwise include it
			if ( ! class_exists( 'WP_Importer' ) ) {
				$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				if ( file_exists( $class_wp_importer ) ) {
					require_once( $class_wp_importer );
				} else {
					$importer_error = true;
				}
			}

			if ( ! class_exists( 'G5_Import' ) ) {
				$class_wp_import = GF_PLUGIN_DIR . 'core/dashboard/install-demo/wordpress-importer.php';
				if ( file_exists( $class_wp_import ) ) {
					require_once( $class_wp_import );
				} else {
					$importer_error = true;
				}
			}


			/**
			 * File Not Found
			 */
			if ($importer_error !== false) {
				ob_end_clean();
				$data_response = array(
					'code' => 'fileNotFound',
					'message' => esc_html__("The Auto importing script could not be loaded. please use the wordpress importer and import the XML file that is located in your themes folder manually.",'startup-framework')
				);
				echo json_encode($data_response);
				die();
			}
			else {

				if ( class_exists( 'G5_Import' ) ) {
					include_once( GF_PLUGIN_DIR . 'core/dashboard/install-demo/g5plus_import_class.php' );
				}

				$importer = new GF_Import();
				$type      = $_REQUEST['type'];
				$other_data = $_REQUEST['other_data'];
				ob_start();
				switch (trim($type)) {
					case 'init':
						$demo_data_directory = GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $demo_site . DIRECTORY_SEPARATOR;
						$arr_demo_file = array(
							$demo_data_directory . 'demo-data.xml',
							$demo_data_directory . 'setting.json',
							$demo_data_directory . 'change-data.json',
						);
						foreach ( $arr_demo_file as $file_demo ) {
							if (!file_exists($file_demo)) {
								ob_end_clean();
								$data_response = array(
									'code' => 'fileNotFound',
									'message' => esc_html__("File not found! Please check file exists in directory:\n[your-theme]/assets/data-demo/",'startup-framework') . $demo_site
								);
								echo json_encode($data_response);
								die();
							}
						}

						/**
						 * Remove log file
						 */
						if ( $handle = opendir( GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . "log" ) ) {
							while ( false !== ( $entry = readdir( $handle ) ) ) {
								if ( $entry != "." && $entry != ".." ) {
									unlink( GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . "data". DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR . $entry );
								}
							}
						}

						/**
						 * Clear All Post & Page
						 */

						global $wpdb;

						$sql_query = $wpdb->prepare("DELETE FROM $wpdb->postmeta WHERE 1", '');
						$wpdb->query($sql_query);

						// posts
						$sql_query = $wpdb->prepare("DELETE FROM $wpdb->posts WHERE 1", '');
						$wpdb->query($sql_query);

						ob_end_clean();
						$data_response = array(
							'code' => 'setting',
							'message' => ''
						);
						echo json_encode($data_response);
						break;
					case 'setting':
						if ( ! $importer->saveOptions( $import_setting_path ) ) {
							ob_end_clean();
							$data_response = array(
								'code' => 'fileNotFound',
								'message' => esc_html__("File not found! Please check file exists in directory:\n[your-theme]/assets/data-demo/",'startup-framework') . $demo_site
							);
							echo json_encode($data_response);
							die();
						}

						ob_end_clean();
						$data_response = array(
							'code' => 'core',
							'message' => ''
						);
						echo json_encode($data_response);
						die();

					case 'core':
						$importer->fetch_attachments = true;
						/*$args = array(
							'public' => true,
							'label'  => 'Services'
						);
						register_post_type( 'services', $args );*/

						try {
							$import_return = $importer->import( $import_file_path );
							if ( $import_return !== true ) {
								ob_end_clean();
								$data_response = array(
									'code' => 'core',
									'message' => $import_return
								);
								echo json_encode($data_response);
								die();
							}
						}
						catch (Exception $ex) {
							ob_end_clean();
							$data_response = array(
								'code' => 'core',
								'message' => $other_data
							);
							echo json_encode($data_response);
							die();
						}

						ob_end_clean();
						$data_response = array(
							'code' => 'slider',
							'message' => ''
						);
						echo json_encode($data_response);
						die();
					case 'slider':
						$import_return = $importer->import_revslider($other_data);
						if ( $import_return === false  ) {
							ob_end_clean();
							$data_response = array(
								'code' => 'fileNotFound',
								'message' => esc_html__("File not found! Please check file exists in directory:\n[your-theme]/assets/data-demo/",'startup-framework') . $demo_site
							);
							echo json_encode($data_response);
							die();
						}
						else if ( $import_return !== 'done'  ) {
							ob_end_clean();
							$data_response = array(
								'code' => 'slider',
								'message' => $import_return
							);
							echo json_encode($data_response);
							die();
						}

						$data_response = array(
							'code' => 'update-id',
							'message' => ''
						);
						echo json_encode($data_response);
						die();
					case 'update-id':
						// update post id has changed after import
						$importer->update_missing_id();

						// generate less to css
						$gen_css = gf_generate_less();
						if ($gen_css['status'] == 'error') {
							ob_end_clean();

							$data_response = array(
								'code' => 'done',
								'message' => $gen_css['message']
							);

							echo json_encode($data_response);
							die();
						}

						ob_end_clean();

						$data_response = array(
							'code' => 'done',
							'message' => ''
						);
						echo json_encode($data_response);

						die();
					case 'fix-data':

						$demo_data_directory = GF_PLUGIN_DIR . 'core' . DIRECTORY_SEPARATOR . 'dashboard' . DIRECTORY_SEPARATOR . 'install-demo' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $demo_site . DIRECTORY_SEPARATOR;
						$arr_demo_file = array(
							$demo_data_directory . 'setting.json',
							$demo_data_directory . 'change-data.json',
						);
						foreach ( $arr_demo_file as $file_demo ) {
							if (!file_exists($file_demo)) {
								ob_end_clean();
								$data_response = array(
									'code' => 'fileNotFound',
									'message' => esc_html__("File not found! Please check file exists in directory:\n[your-theme]/assets/data-demo/",'startup-framework')
								);
								echo json_encode($data_response);
								die();
							}
						}

						// update post id has changed after import
						$importer->update_missing_id();

						// generate less to css
						$gen_css = gf_generate_less();
						if ($gen_css['status'] == 'error') {
							ob_end_clean();

							$data_response = array(
								'code' => 'done',
								'message' => $gen_css['message']
							);

							echo json_encode($data_response);
							die();
						}

						ob_end_clean();

						$data_response = array(
							'code' => 'done',
							'message' => ''
						);
						echo json_encode($data_response);
						die();
					case 'import-setting':
						$importer->fetch_attachments = true;
						try {
							$importer->import_setting( $import_file_path );
						}
						catch (Exception $ex) {
							ob_end_clean();
							$data_response = array(
								'code' => 'error',
								'message' => esc_html__('Import Error','startup-framework')
							);
							echo json_encode($data_response);
							die();
						}

						ob_end_clean();
						$data_response = array(
							'code' => 'done',
							'message' => ''
						);
						echo json_encode($data_response);
						die();
				}
			}
			die();
		}
	}
}