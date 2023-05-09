<?php
/**
 * Public Class
 *
 * @package     CalcHub
 * @subpackage  Public
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Calculator_Builder_Public {

	public const SHORTCODE = 'Calculator';
	private $table_name = 'calculator_builder';

	public function __construct() {
		add_action('init', [ $this, 'register_styles_script']);
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
			$form = str_replace( [ ' ui-sortable-handle', 'has-result', 'has-required', 'has-alert' ],
				[ '', 'has-result is-hidden', 'required', 'has-alert is-hidden' ], $form );

			$out = '<form action="' . esc_url( get_permalink() ) . '" name="formbox" class="formbox" id="calculator_' . absint( $id ) . '">';
			$out .= apply_filters( 'calhub_calculator_form', $form, $id );
			if ( ! empty( $param['calc_load'] ) ) {
				$out .= '<input type="hidden" id="calc-load-' . absint( $id ) . '" class="calc-load">';
			}
			if ( ! empty( $param['calc_reset'] ) ) {
				$out .= '<input type="hidden" class="calc-reset">';
			}

			$out .= '</form>';


			$content = '<div class="formbox-wrapper">';

			$content .= apply_filters( 'calhub_calculator_filter', $out, $id );

			if ( has_filter( 'calhub_calculator_buttons' ) ) {
				$content .= '<div class="formbox__actions_btns">';
				$content .= apply_filters( 'calhub_calculator_buttons', '', $id );
				$content .= '</div>';
			}

			$content .= '</div>';

			$this->includes_files( $id, $param );

			if ( is_rtl() ) {
				wp_enqueue_style( CALCHUB_PLUGIN_SLUG . '-rtl' );
			} else {
				wp_enqueue_style( CALCHUB_PLUGIN_SLUG );
			}

			wp_enqueue_script( CALCHUB_PLUGIN_SLUG);

			$data = "function calculator_{$id}(x, fieldset, field, label, calc){ let calcAlert = ''; let y = []; 
				" . wp_specialchars_decode( $result->formula, ENT_QUOTES ) . "
				
				return checkCalcVariable(y, calcAlert);}";

			if ( ! empty( $param['obfuscation'] ) ) {
				$packer = new JavaScriptPacker( $data );
				$data   = $packer->pack();
			}
			wp_add_inline_script( CALCHUB_PLUGIN_SLUG, $data );

			$content = apply_filters( 'calchub_shortcode_style', $content, $id );

			return $content;
		}
		return '';
	}

	public function register_styles_script(): void {
		$pre_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '-min';
		wp_register_style( CALCHUB_PLUGIN_SLUG, CALCHUB_PLUGIN_URL . 'assets/css/calchub' . $pre_suffix . '.css', null, CALCHUB_VERSION);
		wp_register_style( CALCHUB_PLUGIN_SLUG . '-rtl', CALCHUB_PLUGIN_URL . 'assets/css/calchub-rtl' . $pre_suffix . '.css', null, CALCHUB_VERSION);

		wp_register_script(CALCHUB_PLUGIN_SLUG, CALCHUB_PLUGIN_URL . 'assets/js/calchub' . $pre_suffix . '.js',null, CALCHUB_VERSION,true);
	}


	public function shortcode_scripts(): void {
		if ( ! is_singular() ) {
			return;
		}
		global $post;
		if ( has_shortcode( $post->post_content, self::SHORTCODE ) ) {
			if ( is_rtl() ) {
				wp_enqueue_style( CALCHUB_PLUGIN_SLUG . '-rtl' );
			} else {
				wp_enqueue_style( CALCHUB_PLUGIN_SLUG );
			}
		}
	}

	public function includes_files( $id, $param ) {
		$includes = isset( $param['includes'] ) ? count( $param['includes'] ) : 0;
		if ( $includes > 0 ) {
			for ( $i = 0; $i < $includes; $i ++ ) {
				$slug = CALCHUB_PLUGIN_SLUG . '-' . $id . '-' . $i;

				if ( $param['includes'][ $i ] === 'css' && ! empty( $param['includes_file'][ $i ] ) ) {
					wp_enqueue_style( $slug, esc_url( $param['includes_file'][ $i ] ), null,
						CALCHUB_VERSION );
				}
				if ( $param['includes'][ $i ] === 'js' && ! empty( $param['includes_file'][ $i ] ) ) {
					wp_enqueue_script( $slug, esc_url( $param['includes_file'][ $i ] ), null, CALCHUB_VERSION,
						true );
				}
			}
		}
	}
}