<?php
/**
 * Class for custom sanitize
 *
 * @package     CalcHub
 * @author      CalcHub.xyz <yoda@calchub.xyz>
 * @license     GNU Public License
 * @version     1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class CalcHub_Sanitize {

	public function param( $value ) {
		return wp_unslash( sanitize_text_field( $value ) );
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
			'textarea' => array(
				'name'         => true,
				'id'           => true,
				'class'        => true,
				'readonly'     => true,
				'has-required' => true,
				'hidden'       => true,
			),
			'button'   => array(
				'type'  => true,
				'class' => true,
			),
			'hr'       => array(
				'style' => true,
			),
			'sup' => [],
			'sub' => [],

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