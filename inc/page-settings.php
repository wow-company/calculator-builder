<?php
/**
 * General Settings for Extansions
 *
 * @package     CalcHub
 * @subpackage  Inc/Page_Settings
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

defined( 'ABSPATH' ) || exit;

$tabs = apply_filters( 'calchub_settings_tab_menu', [] );

$current_tab = ( isset( $_REQUEST["calchub_page"] ) ) ? sanitize_text_field( $_REQUEST["calchub_page"] ) : array_key_first( $tabs );

echo '<div class="wrap">';
echo '<h2 class="nav-tab-wrapper">';
foreach ( $tabs as $tab => $name ) {
	$class = ( $tab === $current_tab ) ? ' nav-tab-active' : '';
	echo '<a class="nav-tab' . esc_attr( $class ) . '" href="?page=calchub&tab=calchub_settings&calchub_page=' .
	     esc_attr( $tab ) . '">' . esc_attr( $name ) . '</a>';
}
echo '</h2>';
$current_tab = array_key_exists( $current_tab, $tabs ) ? 'page-' . $current_tab : array_key_first( $tabs );
$file        = apply_filters( 'calchub_settings_menu_file', $current_tab );
if ( file_exists( $file ) ) {
	$options = get_option( 'calchub_settings' );
	echo '<form method="post" action="options.php">';
	settings_fields( 'calchub-settings-group' );
	do_settings_sections( 'calchub-settings-group' );
	include_once( $file );
	submit_button();
	echo '</form>';
}
echo '</div>';
