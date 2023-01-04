<?php
/**
 * Plugin Name:       Calculator Builder | CalcHub
 * Plugin URI:        https://wordpress.org/plugins/calculator-builder/
 * Description:       Easily create Online calculators
 * Version:           0.4.3
 * Author:            CalcHub
 * Author URI:        https://calchub.xyz
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       calculator-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


if ( ! class_exists( 'Calculator_Builder' ) ) :

	/**
	 * Main WP_Plugin Class.
	 *
	 * @since 1.0
	 */
	final class Calculator_Builder {

		private static $instance;
		private CalcHub_List_Table $list_table;

		/**
		 * Main CalcHub Instance.
		 *
		 * Insures that only one instance of WP_Plugin exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @static
		 * @staticvar array $instance
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Calculator_Builder ) ) {

				self::$instance = new self;

				self::$instance->setup_constants();
				self::$instance->includes();

				self::$instance->admin    = new Calculator_Builder_Admin();
				self::$instance->public   = new Calculator_Builder_Public();
				self::$instance->tools    = new CalcHub_Export_Import();
				self::$instance->db       = new CalcHub_DB();
				self::$instance->sanitize = new CalcHub_Sanitize();
				self::$instance->notices  = new CalcHub_Notices();

				register_activation_hook( __FILE__, [ self::$instance, 'plugin_activate' ] );
				add_action( 'plugins_loaded', [ self::$instance, 'text_domain' ] );
				if ( get_option( 'calculator_builder_updater' ) === false ) {
					add_action( 'admin_init', [ self::$instance, 'plugin_updater' ] );
				}

			}

			return self::$instance;
		}

		/**
		 * Setup plugin constants.
		 *
		 * @access private
		 * @return void
		 * @since 0.4
		 */
		private function setup_constants() {
			// Plugin version.
			if ( ! defined( 'CALCHUB_VERSION' ) ) {
				define( 'CALCHUB_VERSION', '0.4.3' );
			}

			// Plugin Admin slug.
			if ( ! defined( 'CALCHUB_PLUGIN_SLUG' ) ) {
				define( 'CALCHUB_PLUGIN_SLUG', 'calchub' );
			}

			// Plugin Root File.
			if ( ! defined( 'CALCHUB_PLUGIN_FILE' ) ) {
				define( 'CALCHUB_PLUGIN_FILE', __FILE__ );
			}

			// Plugin Base Name.
			if ( ! defined( 'CALCHUB_PLUGIN_BASE' ) ) {
				define( 'CALCHUB_PLUGIN_BASE', plugin_basename( CALCHUB_PLUGIN_FILE ) );
			}

			// Plugin Folder Path.
			if ( ! defined( 'CALCHUB_PLUGIN_DIR' ) ) {
				define( 'CALCHUB_PLUGIN_DIR', plugin_dir_path( CALCHUB_PLUGIN_FILE ) );
			}

			// Plugin Folder URL.
			if ( ! defined( 'CALCHUB_PLUGIN_URL' ) ) {
				define( 'CALCHUB_PLUGIN_URL', plugin_dir_url( CALCHUB_PLUGIN_FILE ) );
			}
		}


		/**
		 * Throw error on object clone.
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @return void
		 * @access protected
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_attr__( 'Cheatin&#8217; huh?', 'calculator-builder' ), '1.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @return void
		 * @access protected
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_attr__( 'Cheatin&#8217; huh?', 'calculator-builder' ), '1.0' );
		}


		/**
		 * Include required files.
		 *
		 * @access private
		 * @since  1.0
		 */
		private function includes() {
			// Admin
			require_once CALCHUB_PLUGIN_DIR . 'admin/class-admin.php';
			require_once CALCHUB_PLUGIN_DIR . 'public/class-public.php';
			if ( ! class_exists( 'JavaScriptPacker' ) ) {
				require_once CALCHUB_PLUGIN_DIR . 'inc/class-js-packer.php';
			}
			require_once CALCHUB_PLUGIN_DIR . 'inc/class-calchub-list-table.php';
			require_once CALCHUB_PLUGIN_DIR . 'inc/class-calchub-export-import.php';
			require_once CALCHUB_PLUGIN_DIR . 'inc/class-calchub-db.php';
			require_once CALCHUB_PLUGIN_DIR . 'inc/class-calchub-sanitize.php';
			require_once CALCHUB_PLUGIN_DIR . 'inc/class-calchub-notices.php';
		}

		/**
		 * Activate the plugin.
		 * create the database
		 * create the folder in wp-upload
		 *
		 * @access public
		 * @return void
		 */
		public function plugin_activate(): void {
			self::$instance->db->create_table();
			update_option( 'calculator_builder_updater', '0.4' );
		}

		public function plugin_updater(): void {
			self::$instance->db->create_table();
		}

		/**
		 * Download the folder with languages.
		 *
		 * @access public
		 * @return void
		 */
		public function text_domain() {
			$languages_folder = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
			load_plugin_textdomain( 'calculator-builder', false, $languages_folder );
		}

	}

endif; // End if class_exists check.

/**
 * The main function for that returns WP_Plugin
 *
 * @since 1.0
 */
function CALCHUB() {
	return Calculator_Builder::instance();
}

// Get Running.
CALCHUB();
