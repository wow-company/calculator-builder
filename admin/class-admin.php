<?php
/**
 * Admin Class
 *
 * @package     CALCHUB
 * @subpackage  CALCHUB/Admin_Class
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Calculator_Builder_Admin {

	private $table_name = 'calculator_builder';

	/**
	 * Setup to admin panel of the plugin
	 *
	 * @param array $info general information about the plugin
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_filter( 'plugin_action_links', [ $this, 'settings_link' ], 10, 2 ); // add settings link
		add_filter( 'admin_footer_text', [ $this, 'footer_text' ] ); // add footer information
		add_action( 'admin_menu', [ $this, 'add_admin_page' ] ); // add admin page
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] ); // add admin script
	}

	/**
	 * Add the link to the plugin page on Plugins page
	 *
	 * @param $actions
	 * @param $plugin_file - the plugin main file
	 *
	 * @return mixed
	 */
	public function settings_link( $actions, $plugin_file ) {
		if ( false === strpos( $plugin_file, plugin_basename( CALCHUB_PLUGIN_FILE ) ) ) {
			return $actions;
		}
		$link          = admin_url( 'admin.php?page=' . esc_attr( CALCHUB_PLUGIN_SLUG ) );
		$text          = esc_attr__( 'Settings', 'calculator-builder' );
		$settings_link = '<a href="' . esc_url( $link ) . '">' . esc_attr( $text ) . '</a>';
		array_unshift( $actions, $settings_link );

		return $actions;
	}

	/**
	 * Add custom text in the footer on the wow plugin page
	 *
	 * @param $footer_text - text in the footer
	 *
	 * @return string - end text in the footer
	 * @since 1.0
	 */
	public function footer_text( $footer_text ) {
		global $calchub_plugin_page;
		if ( $calchub_plugin_page === CALCHUB_PLUGIN_SLUG ) {
			$text = sprintf(
				__( 'Thank you for using <a href="%1$s" target="_blank">%2$s</a>! Please <a href="%3$s" target="_blank">rate us on %4$s</a>',
					'calculator-builder' ),
				esc_url( 'https://wordpress.org/plugins/calculator-builder/' ),
				esc_attr__( 'Calculator Builder', 'calculator-builder' ),
				esc_url( 'https://wordpress.org/support/plugin/calculator-builder/reviews/#new-post' ),
				esc_attr( 'WordPress.org' )
			);

			return str_replace( '</span>', '', $footer_text ) . ' | ' . $text . '</span>';
		} else {
			return $footer_text;
		}
	}

	/**
	 * Add the plugin page in admin menu
	 *
	 * @since 1.0
	 */
	public function add_admin_page() {
		$title      = esc_attr__( 'CalcHub version ', 'calculator-builder' ) . CALCHUB_VERSION;
		$menu_title = esc_attr__( 'CalcHub', 'calculator-builder' );
		$capability = 'manage_options';
		$slug       = CALCHUB_PLUGIN_SLUG;
		$icon       = 'dashicons-calculator';
		add_menu_page( $title, $menu_title, $capability, $slug, [ $this, 'plugin_page' ], $icon, 90 );
		add_submenu_page( $slug, 'All Calculators', 'All Calculators', $capability, $slug );

		$subpages_arr = [
			'settings'   => [ 'Add New Calculator', 'Add New' ],
			'tools'      => [ 'Import/Export tool', 'Import/Export' ],
			'support'    => [ 'Calculator Builder Support', 'Support' ],
			'extensions' => [ 'Calculator Builder Extensions', 'Extensions' ],
		];

		$subpages = apply_filters( 'calchub_admin_sub_menu', $subpages_arr );

		foreach ( $subpages as $key => $val ) {
			$sub_slug = $slug . '&tab=' . $key;
			$url      = admin_url( 'admin.php?page=' . $sub_slug );
			add_submenu_page( $slug, $val[0], $val[1], $capability, $url );
		}
	}

	/**
	 * Include main plugin page
	 *
	 * @since 1.0
	 */
	public function plugin_page() {
		global $calchub_plugin_page;
		$calchub_plugin_page = CALCHUB_PLUGIN_SLUG;
		require_once 'page-main.php';
	}

	/**
	 * Include admin style and scripts on the plugin page
	 *
	 * @since 1.0
	 */
	public function admin_scripts( $hook ) {
		$page = 'toplevel_page_' . CALCHUB_PLUGIN_SLUG;

		if ( $page !== $hook ) {
			return false;
		}

		$slug    = CALCHUB_PLUGIN_SLUG;
		$version = CALCHUB_VERSION;
		$assets  = CALCHUB_PLUGIN_URL . 'assets/';

		wp_enqueue_script( $slug . '-navigation', $assets . 'js/admin-navigation.js', array( 'jquery' ), $version,
			true );

		if ( is_rtl() ) {
			wp_enqueue_style( $slug . '-admin', $assets . 'css/admin-main-rtl.css', false, $version );
			wp_enqueue_style( $slug . '-custom', $assets . 'css/admin-customize-rtl.css', false, $version );
		} else {
			wp_enqueue_style( $slug . '-admin', $assets . 'css/admin-main.css', false, $version );
			wp_enqueue_style( $slug . '-custom', $assets . 'css/admin-customize.css', false, $version );
		}

		do_action( 'calchub_admin_enqueue_scripts_general' );

		if ( empty( $_GET['tab'] ) || $_GET['tab'] !== 'settings' ) {
			return false;
		}
		if ( is_rtl() ) {
			wp_enqueue_style( $slug . '-form', $assets . 'css/admin-form-rtl.css', false, $version );
		} else {
			wp_enqueue_style( $slug . '-form', $assets . 'css/admin-form.css', false, $version );
		}
		// include sortable
		wp_enqueue_script( 'jquery-ui-sortable' );

		wp_enqueue_script( 'code-editor' );
		wp_enqueue_style( 'code-editor' );
		wp_enqueue_script( 'jshint' );
		wp_enqueue_script( 'csslint' );

		do_action( 'calchub_admin_enqueue_scripts' );

		// include the plugin admin script
		wp_enqueue_script( $slug . '-admin', $assets . 'js/admin-script.js', array( 'jquery' ), $version, true );
		wp_enqueue_script( $slug . '-builder', $assets . 'js/admin-builder.js', array( 'jquery' ), $version, true );
	}

	public function get_calc_tags() {
		global $wpdb;
		$table  = $wpdb->prefix . $this->table_name;
		$result = $wpdb->get_results( "SELECT * FROM $table order by tag desc", ARRAY_A );
		$tags   = [];
		if ( ! empty( $result ) ) {
			foreach ( $result as $column ) {
				if ( ! empty( $column['tag'] ) ) {
					$tags[ $column['tag'] ] = $column['tag'];
				}
			}
		}
		if ( ! empty( $tags ) ) {
			foreach ( $tags as $tag ) {
				echo '<option value="' . esc_attr( $tag ) . '">';
			}
		}
	}

}
