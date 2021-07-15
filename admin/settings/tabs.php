<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Tabs menu for Settings
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

$tab_elements = array(
	'formula' => esc_attr__( 'Formula', 'calculator-builder' ),
);


$i           = '1';
echo '<div class="tabs is-centered" id="tab"><ul>';
foreach ( $tab_elements as $key => $val ) {
	$active = ( $i == 1 ) ? 'is-active' : '';
	echo '<li class="' . esc_attr( $active ) . ' is-marginless" data-tab="' . absint( $i ) . '"><a>' . esc_html( $val ) . '</a></li>';
	$i ++;
}
echo '</ul></div>';

echo '<div id="tab-content" class="inside">';
$i = '1';
foreach ( $tab_elements as $key => $val ) {
	$active = ( $i == 1 ) ? 'is-active' : '';
	echo '<div class="' . esc_attr( $active ) . ' tab-content" data-content="' . absint( $i ) . '">';

	switch ( $key ) {
		case 'style':
			include( 'style.php' );
			break;
		default:
			include( 'formula.php' );
			break;
	}
	echo '</div>';
	$i ++;
}
echo '</div>';