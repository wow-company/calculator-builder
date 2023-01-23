<?php
/**
 * Class for Export and Import calculators
 *
 * @package     CalcHub
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class CalcHub_Export_Import {

	private $table_name = 'calculator_builder';

	public function __construct() {
		add_action( 'admin_init', [ $this, 'export_import' ] );
	}

	public function export_import() {
		if ( empty( $_REQUEST['calchub_export_import'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_REQUEST['calchub_export_import'], 'calchub_action' ) ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( empty( $_REQUEST['calchub_action'] ) ) {
			return;
		}

		if ( $_REQUEST['calchub_action'] === 'import_tool' ) {
			$this->import();
		} elseif ( $_REQUEST['calchub_action'] === 'export_tool' ) {
			$this->export();
		}
	}

	public function display_tags() {
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
			echo '<select name="calculators_tags">';
			echo '<option value="">' . esc_attr__( 'All Tags', 'calculator-builder' ) . '</option>';
			foreach ( $tags as $tag ) {
				echo '<option value="' . esc_attr( $tag ) . '">' . esc_attr( $tag ) . '</option>' . "\n";
			}
			echo '</select>';
		}
	}

	/**
	 * @throws JsonException
	 */
	public function import(): void {
		if ( $this->get_file_extension( $_FILES['import_file']['name'] ) !== 'json' ) {
			wp_die( esc_attr__( 'Please upload a valid .json file', 'calculator-builder' ),
				__( 'Error', 'calculator-builder' ), [ 'response' => 400 ] );
		}

		$import_file = $_FILES['import_file']['tmp_name'];

		if ( empty( $import_file ) ) {
			wp_die( esc_attr__( 'Please upload a file to import', 'calculator-builder' ),
				__( 'Error', 'calculator-builder' ), [ 'response' => 400 ] );
		}

		$settings = json_decode( file_get_contents( $import_file ), false, 512, JSON_THROW_ON_ERROR );

		$update = ! empty( $_POST['calchub_import_update'] ) ? '1' : '';

		global $wpdb;
		$table = $wpdb->prefix . $this->table_name;

		foreach ( $settings as $val ) {
			$id      = $val->id;
			$title   = $val->title;
			$tag     = $val->tag;
			$param   = $val->param;
			$form    = $val->form;
			$formula = $val->formula;

			$check_row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE id = %d", $id ) );

			if ( ! empty( $update ) && ! empty( $check_row ) ) {
				CALCHUB()->db->update_db( $title, $form, $formula, $param, $tag, $id );
			} elseif ( ! empty( $check_row ) ) {
				CALCHUB()->db->insert_db( $title, $form, $formula, $param, $tag );
			} else {
				CALCHUB()->db->insert_db( $title, $form, $formula, $param, $tag, $id );
			}
		}

		wp_safe_redirect( admin_url( 'admin.php?page=' . CALCHUB_PLUGIN_SLUG ) );
		exit;
	}

	/**
	 * @throws JsonException
	 */
	public function export(): void {
		$file_name = 'CalcHub-database-' . date( 'm-d-Y' ) . '.json';

		global $wpdb;
		$table  = $wpdb->prefix . $this->table_name;
		$result = $wpdb->get_results( "SELECT * FROM " . $table . " order by id asc" );

		if ( ! empty( $_REQUEST['calculators_tags'] ) ) {
			$tag    = sanitize_text_field( $_REQUEST['calculators_tags'] );
			$result = $wpdb->get_results( "SELECT * FROM " . $table . " WHERE tag='$tag' order by id asc" );
		}

		if ( isset( $_GET['id'] ) ) {
			$query  = $wpdb->prepare( "SELECT * FROM $table WHERE id=%d", absint( $_GET['id'] ) );
			$result = $wpdb->get_results( $query );

			if ( $result[0]->title ) {
				$name      = trim( $result[0]->title );
				$name      = str_replace( ' ', '-', $name );
				$file_name = $name . '-database-' . date( 'm-d-Y' ) . '.json';
			} else {
				$file_name = 'UnTitle-database-' . date( 'm-d-Y' ) . '.json';
			}
		}

		$settings = [];
		if ( count( $result ) > 0 ) {
			foreach ( $result as $val ) {
				$settings[] = array(
					'id'      => $val->id,
					'title'   => $val->title,
					'tag'     => $val->tag,
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

		echo json_encode( $settings, JSON_THROW_ON_ERROR );
		exit;
	}

	private function get_file_extension( $str ) {
		$parts = explode( '.', $str );

		return end( $parts );
	}

}