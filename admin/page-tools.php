<?php
/**
 * Tools page
 *
 * @package     CalcHub
 * @subpackage  Admin/Tools
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
    <div class="wrap">
        <div class="postbox">
            <div class="inside">
                <h3>
					<?php
					esc_attr_e( 'Export Settings', 'calculator-builder' ); ?>
                </h3>

                <p>
					<?php
					printf( esc_attr__( 'Export the  settings for %s as a .json file. This allows you to easily import the configuration into another site.',
						'calculator-builder' ), '<b>CalcHub</b>' ); ?>
                </p>

                <form method="post" action="">
                    <p><input type="hidden" name="calchub_action" value="export_tool"/></p>
                    <p>
						<?php
						CALCHUB()->tools->display_tags(); ?>
                    </p>
                    <p>
						<?php
						wp_nonce_field( 'calchub_action', 'calchub_export_import' ); ?>

						<?php
						submit_button( __( 'Export', 'calculator-builder' ), 'secondary', 'submit', false ); ?>
                    </p>
                </form>
            </div>
        </div>

        <div class="postbox">
            <div class="inside">
                <h3><?php
					esc_attr_e( 'Import Settings', 'calculator-builder' ); ?></h3>

                <p>
					<?php
					printf( esc_attr__( 'Import the %s settings from a .json file. This file can be obtained by exporting the settings on another site using the form above.',
						'calculator-builder' ), '<b>CalcHub</b>    ' ); ?>
                </p>
                <form method="post" enctype="multipart/form-data" action="">
                    <p>
                        <input type="file" name="import_file"/>
                    </p>
                    <p>
                        <label>
                            <input type="checkbox" name="calchub_import_update" value="1">
							<?php
							esc_attr_e( 'Update item if item already exists.', 'calculator-builder' ); ?>
                        </label>
                    </p>

                    <p>
                        <input type="hidden" name="calchub_action" value="import_tool"/>
						<?php
						wp_nonce_field( 'calchub_action', 'calchub_export_import' ); ?>
						<?php
						submit_button( __( 'Import', 'calculator-builder' ), 'secondary', 'submit', false ); ?>
                    </p>
                </form>
            </div>
        </div>

    </div>
<?php
