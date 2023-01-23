<?php
/**
 * Admin Notices Class
 *
 * @package     CalcHub
 * @subpackage  Admin/Notices
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class CalcHub_Notices {

	public function __construct() {
		add_action( 'calchub_admin_info_notices', [ $this, 'display_notices' ] );
		add_action( 'wp_ajax_calchub_hide_notice', [ $this, 'deactivate_notice' ] );
	}

	public function display_notices() {
		if ( ! empty( $_GET['tab'] ) && $_GET['tab'] === 'settings' ) {
			return false;
		}
		if ( get_option( 'calchub_notice_status' ) !== 'read' ) :
			?>
            <div class="calchub-notices">
                <div class="calchub-notices-wrapper">
                    <p class="ideas">
                        <i class="dashicons dashicons-megaphone has-text-danger is-r-margin"></i>We are constantly
                        trying to
                        improve the plugin and add more useful
                        features to it. Your support and your ideas for improving the plugin are very important to us.
                        <br/>
                        <i class="dashicons dashicons-star-filled has-text-warning is-r-margin"></i>If you like the
                        plugin,
                        please <a href="https://wordpress.org/support/plugin/calculator-builder/reviews/#new-post"
                                  target="_blank">leave a review</a> about it at
                        WordPress.org.<br/>
                    </p>
                    <span class="calchub-dismiss dashicons dashicons-no"></span>
                </div>
            </div>
		<?php
		endif;
	}

	public function deactivate_notice() {
		update_option( 'calchub_notice_status', 'read' );

		return [ 'status' => 'OK' ];
	}

}
