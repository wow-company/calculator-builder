<?php
/**
 * Class for custom sanitize
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

class CalcHub_Sanitize {

	public function param( $value ) {
		return sanitize_text_field( $value );
	}

	public function form( $string, $echo = true ): string {
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
				'label' => true,
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
				'placeholder'  => true,
				'list'         => true,
			),
			'textarea' => array(
				'name'         => true,
				'id'           => true,
				'class'        => true,
				'readonly'     => true,
				'has-required' => true,
				'hidden'       => true,
				'placeholder'  => true,
			),
			'button'   => array(
				'type'  => true,
				'class' => true,
			),
			'hr'       => array(
				'style' => true,
			),
			'sup'      => [],
			'sub'      => [],
			'datalist' => [
				'id'    => true,
				'class' => true,
			]

		);

		$out = wp_unslash( $string );

		if ( $echo ) {
			echo wp_kses( $out, $allowed_html );
		}

		return wp_kses( $out, $allowed_html );
	}

	public function formula( $value ) {
		$form = str_replace( [ '<', '>' ], [ '&lt;', '&gt;' ], $value );

		return wp_unslash( sanitize_textarea_field( $form ) );
	}

}