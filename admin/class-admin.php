<?php

/**
 * Admin Class
 *
 * @package     Wow_Plugin
 * @author      Dmytro Lobov <helper@wow-company.com>
 * @license     GNU Public License
 * @version     1.0
 */

namespace calculator_builder;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WP_Plugin_Admin
 *
 * @package wow_plugin
 *
 * @property array plugin - base information about the plugin
 * @property array url    - home, pro and other URL for plugin
 * @property array rating - website and link for rating
 *
 */
class WP_Plugin_Admin {

	/**
	 * Setup to admin panel of the plugin
	 *
	 * @param array $info general information about the plugin
	 *
	 * @since 1.0
	 */
	public function __construct( $info ) {
		$this->plugin = $info['plugin'];
		$this->url    = $info['url'];
		$this->rating = $info['rating'];

		add_filter( 'plugin_action_links', array( $this, 'settings_link' ), 10, 2 ); // add settings link
		add_filter( 'admin_footer_text', array( $this, 'footer_text' ) ); // add footer information
		add_action( 'admin_menu', array( $this, 'add_admin_page' ) ); // add admin page
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) ); // add admin script
		add_action( 'wp_ajax_' . $this->plugin['prefix'] . '_item_save', array( $this, 'item_save' ) ); // save element
		add_action( 'wp_ajax_wow_plugin_message', array( $this, 'ad_message_deactivate' ) ); // deactivate Ad message
		add_action( 'admin_init', [ $this, 'export_data' ] );
		add_action( 'admin_init', [ $this, 'import_data' ] );
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
		if ( false === strpos( $plugin_file, plugin_basename( $this->plugin['file'] ) ) ) {
			return $actions;
		}
		$link          = admin_url( 'admin.php?page=' . esc_attr( $this->plugin['slug'] ) );
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
		global $wow_plugin_page;
		if ( $wow_plugin_page == $this->plugin['slug'] ) {
			$text = sprintf(
				__( 'Thank you for using <a href="%1$s" target="_blank">%2$s</a>! Please <a href="%3$s" target="_blank">rate us on %4$s</a>', 'calculator-builder' ),
				esc_url( $this->url['home'] ),
				esc_attr( $this->plugin['name'] ),
				esc_url( $this->rating['url'] ),
				esc_attr( $this->rating['website'] )
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
		$title      = $this->plugin['name'] . ' version ' . $this->plugin['version'];
		$menu_title = $this->plugin['menu'];
		$capability = 'manage_options';
		$slug       = $this->plugin['slug'];
		$icon       = 'dashicons-calculator';
		add_menu_page( $title, $menu_title, $capability, $slug, array( $this, 'plugin_page' ), $icon, 90 );
		add_submenu_page( $slug, 'All Calculators', 'All Calculators', $capability, $slug );

		$subpages_arr = array(
			'settings'  => array( 'Add New Calculator', 'Add New' ),
			'tools'     => array( 'Import/Export tool', 'Import/Export' ),
			'docs'      => array( 'Calculator Builder Documentation', 'Documentation' ),
			'changelog' => array( 'Calculator Builder Changelog', 'Changelog' ),
			'support'   => array( 'Calculator Builder Support', 'Support' ),
		);

		$subpages = apply_filters( $this->plugin['slug'] . '_sub_menu', $subpages_arr );

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
		global $wow_plugin_page;
		$wow_plugin_page = $this->plugin['slug'];
		require_once 'page-main.php';
	}


	/**
	 * Include admin style and scripts on the plugin page
	 *
	 * @since 1.0
	 */
	public function admin_scripts( $hook ) {
		$page = 'toplevel_page_' . $this->plugin['slug'];

		if ( $page != $hook ) {
			return false;
		}

		$slug       = $this->plugin['slug'];
		$version    = $this->plugin['version'];
		$url_assets = plugin_dir_url( __FILE__ ) . 'assets/';
		$pre_suffix = '';

		$url_navigation = $url_assets . 'js/navigation' . $pre_suffix . '.js';
		wp_enqueue_script( $slug . '-navigation', $url_navigation, array( 'jquery' ), $version, true );

		wp_enqueue_style( $slug . '-admin', $url_assets . 'css/main' . $pre_suffix . '.css', false, $version );
		wp_enqueue_style( $slug . '-custom', $url_assets . 'css/customize.css', false, $version );


		if ( isset( $_GET['tab'] ) && $_GET['tab'] !== 'settings' ) {
			return false;
		}


		wp_enqueue_style( $slug . '-form', $url_assets . 'css/form-style-min.css', false, $version );
		// include sortable
		wp_enqueue_script( 'jquery-ui-sortable' );

		wp_enqueue_script( 'code-editor' );
		wp_enqueue_style( 'code-editor' );
		wp_enqueue_script( 'jshint' );
		wp_enqueue_script( 'csslint' );

		do_action( 'cb_admin_enqueue_scripts' );

		// include the plugin admin script
		$url_script = $url_assets . 'js/script' . $pre_suffix . '.js';
		wp_enqueue_script( $slug . '-admin', $url_script, array( 'jquery' ), $version, true );

		$url_builder = $url_assets . 'js/builder.js';
		wp_enqueue_script( $slug . '-builder', $url_builder, array( 'jquery' ), $version, true );




	}


	/**
	 * Deactivate the Ad message on plugin page
	 *
	 * @since 1.0
	 */
	public function ad_message_deactivate() {
		update_option( 'wow_' . $this->plugin['prefix'] . '_message', 'read' );
		wp_die();
	}

	/**
	 * Filters text content and strips out disallowed HTML.
	 *
	 * @since 1.0
	 */

	public function sanitize_form( $string, $echo = true ) {
		$allowed_html = array(
			'fieldset' => array(
				'class' => true,
			),
			'div'      => array(
				'class' => true,
				'id'    => true,
				'style' => true,
			),
			'a'        => array(
				'href'  => true,
				'title' => true,
				'class' => true,
			),
			'span'     => array(
				'class' => true,
			),
			'label'    => array(
				'for'   => true,
				'class' => true,
			),
			'select'   => array(
				'name'  => true,
				'class' => true,
				'id'    => true,
			),
			'option'   => array(
				'value'    => true,
				'selected' => true,
			),
			'input'    => array(
				'type'         => true,
				'name'         => true,
				'id'           => true,
				'class'        => true,
				'value'        => true,
				'step'         => true,
				'min'          => true,
				'max'          => true,
				'checked'      => true,
				'readonly'     => true,
				'has-required' => true,
			),
			'button'   => array(
				'type'  => true,
				'class' => true,
			),
			'hr'       => array(
				'style' => true,
			),

		);

		$out = wp_unslash( $string );

		if ( $echo ) {
			echo wp_kses( $out, $allowed_html );
		}

		return wp_kses( $out, $allowed_html );

	}


	/**
	 * Save and Update the Item into the plugin Database
	 *
	 * @return array response from DB
	 *
	 * @since 1.0
	 */
	public function save_data() {
		global $wpdb;

		$add     = ( isset( $_REQUEST['add'] ) ) ? absint( $_REQUEST['add'] ) : '';
		$table   = ( isset( $_REQUEST['data'] ) ) ? sanitize_text_field( $_REQUEST['data'] ) : '';
		$id      = absint( $_POST['tool_id'] );
		$title   = sanitize_text_field( $_POST['title'] );
		$form    = $this->sanitize_form( $_POST['form'], false );
		$formula = sanitize_textarea_field( wp_unslash( $_POST['formula'] ) );
		$param   = '';
		if ( $_POST['param'] ) {
			$param = map_deep( $_POST['param'], array( $this, 'sanitize_param' ) );
			if($_POST['param']['style']) {
				$param['style'] = sanitize_textarea_field($_POST['param']['style']);
			}
			$param = serialize( $param );
		}


		if ( $add === 1 ) {

			$insert = $wpdb->query(
				$wpdb->prepare( " INSERT INTO {$table} ( id, title, form, formula, param  ) VALUES ( %d, %s, %s, %s, %s )",
					$id,
					$title,
					$form,
					$formula,
					$param
				) );


		} elseif ( $add === 2 ) {
			$update =
				$wpdb->query(
					$wpdb->prepare( " UPDATE  {$table} SET title = %s, form = %s, formula = %s, param = %s WHERE id= %d;",
						$title,
						$form,
						$formula,
						$param,
						$id
					) );
		}

		$response = array(
			'status'  => 'OK',
			'message' => esc_attr__( 'Item Updated', 'calculator-builder' ),
		);

		return $response;
	}

	public function sanitize_param( $value ) {
		return wp_unslash( sanitize_text_field( $value ) );
	}

	public function item_save() {
		$response = 'No';
		if ( isset( $_POST[ $this->plugin['slug'] . '_nonce' ] ) ) {
			if ( ! empty( $_POST )
			     && wp_verify_nonce( $_POST[ $this->plugin['slug'] . '_nonce' ], $this->plugin['slug'] . '_action' )
			     && current_user_can( 'manage_options' )
			) {
				$response = self:: save_data();
			}
		}
		wp_send_json( $response );
		wp_die();
	}

	public function import_data() {

		if ( empty( $_POST[ $this->plugin['slug'] . '_import_nonce' ] ) ) {
			return;
		}


		if ( ! wp_verify_nonce( $_POST[ $this->plugin['slug'] . '_import_nonce' ], $this->plugin['slug'] . '_import_nonce' ) ) {
			return;
		}


		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( $this->get_file_extension( $_FILES['import_file']['name'] ) != 'json' ) {
			wp_die( esc_attr__( 'Please upload a valid .json file', $this->plugin['text'] ), __( 'Error', $this->plugin['text'] ), array( 'response' => 400 ) );
		}

		$import_file = $_FILES['import_file']['tmp_name'];

		if ( empty( $import_file ) ) {
			wp_die( esc_attr__( 'Please upload a file to import', $this->plugin['text'] ), __( 'Error', $this->plugin['text'] ), array( 'response' => 400 ) );
		}

		// Retrieve the settings from the file and convert the json object to an array
		$settings = json_decode( file_get_contents( $import_file ) );

		$update = ! empty( $_POST['wow_import_update'] ) ? '1' : '';

		global $wpdb;
		$table = $wpdb->prefix . $this->plugin['prefix'];

		foreach ( $settings as $key => $val ) {
			$id      = $val->id;
			$title   = $val->title;
			$param   = $val->param;
			$form    = $val->form;
			$formula = $val->formula;

			$check_row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE id = %d", $id ) );

			if ( ! empty( $update ) && ! empty( $check_row ) ) {
				$wpdb->query(
					$wpdb->prepare( " UPDATE  {$table} SET title = %s, param = %s, form = %s, formula = %s  WHERE id= %d;",
						$title,
						$param,
						$form,
						$formula,
						$id
					) );

			} elseif ( ! empty( $check_row ) ) {
				$wpdb->query(
					$wpdb->prepare( " INSERT INTO {$table} ( title, param, form, formula ) VALUES (  %s, %s, %s, %s )",
						$title,
						$param,
						$form,
						$formula
					) );
			} else {
				$wpdb->query(
					$wpdb->prepare( " INSERT INTO {$table} ( id, title, param, form, formula ) VALUES ( %d, %s, %s, %s, %s )",
						$id,
						$title,
						$param,
						$form,
						$formula
					) );
			}

		}

		wp_safe_redirect( admin_url( 'admin.php?page=' . esc_attr( $this->plugin['slug'] ) ) );
		exit;


	}

	public function export_data() {

		if ( empty( $_REQUEST[ $this->plugin['slug'] . '_export_nonce' ] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_REQUEST[ $this->plugin['slug'] . '_export_nonce' ], $this->plugin['slug'] . '_export_nonce' ) ) {
			return;
		}


		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$file_name = $this->plugin['shortcode'] . '-database-' . date( 'm-d-Y' ) . '.json';

		global $wpdb;
		$table  = $wpdb->prefix . $this->plugin['prefix'];
		$result = $wpdb->get_results( "SELECT * FROM " . $table . " order by id asc" );

		if ( $_GET['id'] ) {
			$query  = $wpdb->prepare( "SELECT * FROM $table WHERE id=%d", absint( $_GET['id'] ) );
			$result = $wpdb->get_results( $query );
			if ( $result[0]->title ) {
				$name      = trim( $result[0]->title );
				$name      = str_replace( ' ', '-', $name );
				$file_name = $name . '-database-' . date( 'm-d-Y' ) . '.json';
			} else {
				$file_name = 'Untitle-database-' . date( 'm-d-Y' ) . '.json';
			}
		}

		$settings = array();
		if ( count( $result ) > 0 ) {
			foreach ( $result as $key => $val ) {
				$settings[] = array(
					'id'      => $val->id,
					'title'   => $val->title,
					'param'   => $val->param,
					'form'    => $val->form,
					'formula' => $val->formula,
				);
			}
		}
		ignore_user_abort( true );
		nocache_headers();
		header( 'Content-Type: application/json; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=' . $file_name );
		header( "Expires: 0" );

		echo json_encode( $settings );
		exit;


	}

	function get_file_extension( $str ) {
		$parts = explode( '.', $str );

		return end( $parts );
	}

}
