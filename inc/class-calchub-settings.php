<?php
/**
 * Add the General settings pages
 *
 * @package     CalcHub
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class CalcHub_Settings {
	public function __construct() {
		add_filter( 'calchub_admin_sub_menu', [ $this, 'add_settins_page' ] );
		add_filter( 'calchub_tab_menu', [ $this, 'admin_tab_menu' ] );
		add_filter( 'calchub_menu_file', [ $this, 'settings_file' ] );
		add_action( 'admin_init', [ $this, 'page_init' ] );
//		add_action( 'update_option', [ $this, 'settings_changed' ], 10, 3 );

		add_filter( 'pre_update_option', [ $this, 'pre_update' ], 30, 3 );
	}

	public function add_settins_page( $subpages ) {
		if ( isset( $subpages['calchub_settings'] ) ) {
			return $subpages;
		}

		$subpages['calchub_settings'] = [
			__( 'CalcHub Settings', 'calculator-builder' ),
			__( 'Settings', 'calculator-builder' ),
		];

		return $subpages;
	}

	public function admin_tab_menu( $tabs ) {
		if ( isset( $tabs['calchub_settings'] ) ) {
			return $tabs;
		}
		$tabs['calchub_settings'] = __( 'Settings', 'calculator-builder' );

		return $tabs;
	}

	public function page_init() {
		register_setting( 'calchub-settings-group', 'calchub_settings' );
	}

	public function settings_file( $tab ) {
		if ( $tab === 'page-calchub_settings' ) {
			$tab = plugin_dir_path( __FILE__ ) . 'page-settings';
		}

		return $tab;
	}

	public function pre_update( $value, $option, $old_value ) {
		if ( $option !== 'calchub_settings' ) {
			return $value;
		}

		if ( is_array( $old_value ) ) {
			return array_merge( $old_value, $value );
		}

		return $value;
	}

}