<?php
/**
 * Plugin main page
 *
 * @package     CalcHub
 * @subpackage  Admin/Main_page
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$current_tab = ( isset( $_REQUEST["tab"] ) ) ? sanitize_text_field( $_REQUEST["tab"] ) : 'list';

$tabs_arr = array(
	'list'       => esc_attr__( 'Calculators', 'calculator-builder' ),
	'settings'   => esc_attr__( 'Create Calculator', 'calculator-builder' ),
	'tools'      => esc_attr__( 'Import & Export Calculators', 'calculator-builder' ),
	'support'    => esc_attr__( 'Send Support Ticket', 'calculator-builder' ),
	'extensions' => esc_attr__( 'Extensions', 'calculator-builder' ),
);

$tabs = apply_filters( 'calchub_tab_menu', $tabs_arr );

$idea_url = admin_url('admin.php?page='.CALCHUB_PLUGIN_URL.'&tab=support&type=idea');
$support_url = admin_url('admin.php?page='.CALCHUB_PLUGIN_URL.'&tab=support');
?>
    <div id="calchub-notices">
		<?php do_action( 'calchub_admin_info_notices' ); ?>
    </div>
    <div class="calchub-header">
        <div class="calchub-header-wrapper">
            <h1 class="calchub-heading-inline">
                <img src="<?php echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/logo.png" alt="">
                <span class="calchub-heading-separator"></span>
                <span><?php
					if ( isset($_REQUEST['act']) && $_REQUEST['act'] === 'update' ) {
						esc_attr_e( 'Update Calculator' );
					} else {
						echo esc_attr( $tabs[ $current_tab ] );
					}
					?></span>
            </h1>
			<?php if ( $current_tab === 'list' ||  $current_tab === 'settings' ) : ?>
                <a href="?page=<?php echo esc_attr( CALCHUB_PLUGIN_SLUG ); ?>&tab=settings"
                   class="button is-info is-outlined">
					<?php esc_html_e( 'Add New', 'calculator-builder' ); ?>
                </a>
			<?php endif; ?>
        </div>
        <div class="calchub-links">
            <a href="?page=<?php echo esc_attr( CALCHUB_PLUGIN_SLUG ); ?>&tab=extensions" class="calchub-link">
	            <span class="dashicons dashicons-admin-plugins"></span><span>Extensions</span></a>
	        <a href="https://calchub.xyz/documentation/" target="_blank" class="calchub-link"><span class="dashicons dashicons-book-alt"></span><span>Docs</span></a>
            <a href="https://calchub.xyz" class="calchub-link" target="_blank">
	            <span class="dashicons dashicons-admin-links"></span><span>Examples</span></a>
            <a href="https://wordpress.org/support/plugin/calculator-builder/reviews/" class="calchub-link" target="_blank">
	            <span class="dashicons dashicons-star-filled"></span><span>Reviews</span></a>
	        <a rel="me" href="https://mastodon.social/@dmtlo" class="calchub-link" target="_blank">
	        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M433 179.11c0-97.2-63.71-125.7-63.71-125.7-62.52-28.7-228.56-28.4-290.48 0 0 0-63.72 28.5-63.72 125.7 0 115.7-6.6 259.4 105.63 289.1 40.51 10.7 75.32 13 103.33 11.4 50.81-2.8 79.32-18.1 79.32-18.1l-1.7-36.9s-36.31 11.4-77.12 10.1c-40.41-1.4-83-4.4-89.63-54a102.54 102.54 0 0 1-.9-13.9c85.63 20.9 158.65 9.1 178.75 6.7 56.12-6.7 105-41.3 111.23-72.9 9.8-49.8 9-121.5 9-121.5zm-75.12 125.2h-46.63v-114.2c0-49.7-64-51.6-64 6.9v62.5h-46.33V197c0-58.5-64-56.6-64-6.9v114.2H90.19c0-122.1-5.2-147.9 18.41-175 25.9-28.9 79.82-30.8 103.83 6.1l11.6 19.5 11.6-19.5c24.11-37.1 78.12-34.8 103.83-6.1 23.71 27.3 18.4 53 18.4 175z"/></svg>
		        <span>Follow me</span>
	        </a>
        </div>

    </div>

    <hr class="wp-header-end">

    <div class="wrap">
		<?php
		$current_tab = array_key_exists( $current_tab, $tabs ) ? 'page-' . $current_tab : $current_tab;
		$file        = apply_filters( CALCHUB_PLUGIN_SLUG . '_menu_file', $current_tab );
		include_once( $file . '.php' );
		?>
    </div>
    <input type="hidden" id="calchub-navigation" value="<?php echo esc_attr( CALCHUB_PLUGIN_SLUG ); ?>">
<?php
