<?php
/**
 * Public Class
 *
 * @package     CalcHub
 * @subpackage  Public
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Calculator_Builder_Public {


	public const SHORTCODE = 'Calculator';
	private $table_name = 'calculator_builder';

	public function __construct() {
		add_shortcode( self::SHORTCODE, [ $this, 'shortcode' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'shortcode_scripts' ] );
	}

	public function shortcode( $atts ) {
		extract( shortcode_atts( array( 'id' => "" ), $atts ) );
		global $wpdb;
		$table  = $wpdb->prefix . $this->table_name;
		$sSQL   = $wpdb->prepare( "select * from $table WHERE id = %d", $id );
		$result = $wpdb->get_row( $sSQL );
		if ( ! empty( $result ) ) {
			$param = unserialize( $result->param );
			$form  = $result->form;

			$form = preg_replace( '#<div class="action-elements">(.*?)</div>#s', ' ', $form );
			$form = str_replace( [ ' ui-sortable-handle', 'has-result', 'has-required' ],
				[ '', 'has-result is-hidden', 'required' ], $form );

			$content = '<form action="' . esc_url( get_permalink() ) . '" name="formbox" class="formbox" id="calculator_' . absint( $id ) . '">';
			$content .= $form;
			$content .= '</form>';

			$content = apply_filters( 'calchub_action_buttons', $content, $id );

			wp_enqueue_script( CALCHUB_PLUGIN_SLUG, CALCHUB_PLUGIN_URL . 'assets/js/calchub.js', null, CALCHUB_VERSION,
				true );

			$data = "function calculator_{$id}(x){ let y = [];
				" . wp_specialchars_decode( $result->formula, ENT_QUOTES ) . "
				return y;}";

			if ( ! empty( $param['obfuscation'] ) ) {
				$script_packer = new JavaScriptPacker();
				$packer        = new $script_packer( $data, 'Normal', true, false );
				$data          = $packer->pack();
			}
			wp_add_inline_script( CALCHUB_PLUGIN_SLUG, $data );

			do_action( 'calchub_shortcode_style', $id );

			return $content;
		}
	}


	public function shortcode_scripts(): void {
		if ( ! is_singular() ) {
			return;
		}
		global $post;
		if ( has_shortcode( $post->post_content, self::SHORTCODE ) ) {
			wp_enqueue_style( CALCHUB_PLUGIN_SLUG, CALCHUB_PLUGIN_URL . 'assets/css/calchub.css', null,
				CALCHUB_VERSION );
		}
	}

}