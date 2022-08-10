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

$tab_elements = apply_filters( 'cb_filter_settings_tab_menu', array(
	'formula' => __( 'Formula', 'calculator-builder' ),
) );


echo '<div class="tabs is-centered" id="tab"><ul>';
foreach ( $tab_elements as $key => $val ) {
	$active = ( $key === 'formula' ) ? 'is-active' : '';
	echo '<li class="' . esc_attr( $active ) . ' is-marginless" data-tab="' . esc_attr( $key ) . '"><a>' . esc_html( $val ) . '</a></li>';
}
echo '</ul></div>';

echo '<div id="tab-content" class="inside">';
foreach ( $tab_elements as $key => $val ) {
	$active = ( $key === 'formula' ) ? 'is-active' : '';
	echo '<div class="' . esc_attr( $active ) . ' tab-content" data-content="' . esc_attr( $key ) . '">';
	$file = apply_filters( 'cb_filter_settings_tab_content', $key );
	include_once ( $file . '.php' );
	echo '</div>';
}
echo '</div>';