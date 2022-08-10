<?php
/**
 * Public Class
 *
 * @package     Wow_Plugin
 * @subpackage  Public
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

namespace calculator_builder;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WP_Plugin_Public {

	private $info;

	public function __construct( $info ) {
		$this->plugin = $info['plugin'];
		$this->url    = $info['url'];
		$this->rating = $info['rating'];
		// Display on the site
		add_shortcode( $this->plugin['shortcode'], array( $this, 'shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'shortcode_scripts' ) );

	}

	public function shortcode( $atts ) {
		extract( shortcode_atts( array( 'id' => "" ), $atts ) );
		global $wpdb;
		$table  = $wpdb->prefix . $this->plugin['prefix'];
		$sSQL   = $wpdb->prepare( "select * from $table WHERE id = %d", $id );
		$result = $wpdb->get_row( $sSQL );
		if ( ! empty( $result ) ) {

			$form = $result->form;

			$form = preg_replace( '#<div class="action-elements">(.*?)</div>#s', ' ', $form );
			$form = str_replace( ' ui-sortable-handle', '', $form );
			$form = str_replace( 'has-result', 'has-result is-hidden', $form );
			$form = str_replace( 'has-required', 'required', $form );

			$content = '<form action="' . esc_url( get_permalink() ) . '" name="formbox" class="formbox" id="calculator_' . absint( $id ) . '">';
			$content .= $form;
			$content .= '</form>';

			wp_enqueue_script( $this->plugin['slug'] , plugin_dir_url( __FILE__ ). 'assets/js/script.js', array());

			$data = 'function calculator_' . $id . '(x){ let y = []; '.wp_specialchars_decode( $result->formula, ENT_QUOTES ).' return y;}';
			$script_packer  = __NAMESPACE__ . '\\JavaScriptPacker';
			$packer         = new $script_packer( $data, 'Normal', true, false );
			$packed         = $packer->pack();

			wp_add_inline_script( $this->plugin['slug'], $packed );

			do_action('cb_shortcode_style', $id);

			return $content;
		}

	}

	function shortcode_scripts() {
		global $post;
		if ( has_shortcode( $post->post_content, $this->plugin['shortcode'] ) ) {

			$slug    = $this->plugin['slug'];
			$version = $this->plugin['version'];

			$url_style = plugin_dir_url( __FILE__ ) . 'assets/css/style-min.css';
			wp_enqueue_style( $slug, $url_style, null, $version );
		}
	}

}