<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * CalcHub DB base class
 *
 * @package     CalcHub
 * @subpackage  Classes/CalcHub DB
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */
class CalcHub_DB {

	public $table_name = 'calculator_builder';

	public function __construct() {
		add_action( 'wp_ajax_calchub_save_calc', [ $this, 'save_calculator' ] );
		add_action( 'admin_init', [ $this, 'remove_calculator' ] );
	}

	public function remove_calculator(): void {
		if ( empty( $_REQUEST['calculator_delete'] ) ) {
			return;
		}

		if ( empty( $_REQUEST['id'] ) ) {
			return;
		}

		if ( wp_verify_nonce( $_REQUEST['calculator_delete'], 'calchub_action' ) && current_user_can( 'manage_options' )
		) {
			global $wpdb;
			$table = $wpdb->prefix . $this->table_name;
			$wpdb->delete( $table, array( 'ID' => absint( $_REQUEST['id'] ) ), array( '%d' ) );
		}
	}

	public function save_calculator(): void {
		$response = 'No';
		if ( isset( $_POST['calculator_save'] ) ) {
			if ( ! empty( $_POST )
			     && wp_verify_nonce( $_POST['calculator_save'], 'calchub_save_action' )
			     && current_user_can( 'manage_options' )
			) {
				$response = $this->save_data();
			}
		}
		wp_send_json( $response );
		wp_die();
	}

	private function save_data(): array {
		$add     = ( isset( $_REQUEST['add'] ) ) ? absint( $_REQUEST['add'] ) : '';
		$id      = absint( $_POST['tool_id'] );
		$title   = sanitize_text_field( $_POST['title'] );
		$form    = CALCHUB()->sanitize->form( $_POST['form'], false );
		$formula = CALCHUB()->sanitize->formula( $_POST['formula'] );
		$tag     = sanitize_text_field( $_POST['tag'] );
		$param   = [];

		if ( $_POST['param'] ) {
			$param = map_deep( $_POST['param'], 'sanitize_text_field' );
			if ( $_POST['param']['style'] ) {
				$param['style'] = sanitize_textarea_field( $_POST['param']['style'] );
			}
			if ( $_POST['param']['calc_link'] ) {
				$param['calc_link'] = sanitize_url( $_POST['param']['calc_link'] );
			}
			$param = serialize( $param );
		}

		$response = [
			'status' => 'OK',
		];

		if ( $add === 1 ) {
			$this->insert_db( $title, $form, $formula, $param, $tag, $id );
			$response['message'] = __( 'Calculator Saved', 'calculator-builder' );
		} elseif ( $add === 2 ) {
			$this->update_db( $title, $form, $formula, $param, $tag, $id );
			$response['message'] = __( 'Calculator Updated', 'calculator-builder' );
		}

		return $response;
	}

	public function insert_db( $title, $form, $formula, $param, $tag, $id = null ): void {
		global $wpdb;
		$table = $wpdb->prefix . $this->table_name;

		if ( $id === null ) {
			$wpdb->query(
				$wpdb->prepare( " INSERT INTO {$table} ( title, param, form, formula, tag ) VALUES (  %s, %s, %s, %s, %s )",
					$title,
					$param,
					$form,
					$formula,
					$tag
				) );
		} else {
			$wpdb->query(
				$wpdb->prepare( " INSERT INTO {$table} ( id, title, form, formula, param, tag  ) VALUES ( %d, %s, %s, %s, %s, %s )",
					$id,
					$title,
					$form,
					$formula,
					$param,
					$tag
				) );
		}
	}

	public function update_db( $title, $form, $formula, $param, $tag, $id ): void {
		global $wpdb;
		$table = $wpdb->prefix . $this->table_name;

		$wpdb->query(
			$wpdb->prepare( " UPDATE  {$table} SET title = %s, form = %s, formula = %s, param = %s, tag = %s WHERE id= %d;",
				$title,
				$form,
				$formula,
				$param,
				$tag,
				$id
			) );
	}

	public function create_table(): void {
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		global $wpdb;
		$table = $wpdb->prefix . $this->table_name;

		dbDelta( "CREATE TABLE {$table} (
    	id mediumint(9) NOT NULL AUTO_INCREMENT,
		title VARCHAR(200) NOT NULL,
		param LONGTEXT,
		form LONGTEXT,
		formula LONGTEXT,
		tag TEXT,
		UNIQUE KEY id (id)
		) DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate};" );
	}

	public function get_settings(): array {
		global $wpdb;
		$table    = $wpdb->prefix . $this->table_name;
		$action   = isset( $_REQUEST["act"] ) ? sanitize_text_field( $_REQUEST["act"] ) : '';
		$last     = $wpdb->get_col( "SELECT id FROM $table" );
		$settings = [
			'id'         => '',
			'title'      => '',
			'tag'        => '',
			'tool_id'    => ! empty( $last ) ? max( $last ) + 1 : 1,
			'param'      => '',
			'form'       => '',
			'formula'    => '',
			'add_action' => '1',
			'btn'        => esc_attr__( 'Save', 'calculator-builder' ),
		];

		if ( $action === 'update' || $action === 'duplicate' ) {
			$id     = absint( $_REQUEST["id"] );
			$result = $wpdb->get_row( "SELECT * FROM $table WHERE id = $id" );

			if ( $result ) {
				$settings['param']   = unserialize( $result->param );
				$settings['form']    = $result->form;
				$settings['tag']     = $result->tag;
				$settings['formula'] = $result->formula;
			}

			if ( $result && $action === 'update' ) {
				$settings['id']         = $id;
				$settings['title']      = $result->title;
				$settings['tag']        = $result->tag;
				$settings['tool_id']    = $id;
				$settings['add_action'] = 2;
				$settings['btn']        = esc_attr__( 'Update', 'calculator-builder' );
			}
		}

		return $settings;
	}

	public function get_tags_from_table() {
		global $wpdb;
		$table    = $wpdb->prefix . $this->table_name;
		$all_tags = $wpdb->get_results( "SELECT DISTINCT tag FROM $table ORDER BY tag ASC", ARRAY_A );

		return ! empty( $all_tags ) ? $all_tags : false;
	}
}
