<?php
/**
 * Add new Element
 *
 * @package     WP_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once( 'settings/database.php' );

$url_form = admin_url() . 'admin.php?page=' . esc_attr( $this->plugin['slug'] );

?>

    <form action="<?php echo esc_url( $url_form ); ?>" method="post" name="post" class="wow-plugin" id="wow-plugin">
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-1">
                <div id="post-body-content" style="position: relative;">
                    <div id="titlediv" class="is-b-margin">
                        <div id="titlewrap">
                            <label class="screen-reader-text" id="title-prompt-text" for="title">
								<?php esc_attr_e( 'Enter title here', 'calculator-builder' ); ?>
                            </label>
                            <div class="field has-addons">
                                <div class="control is-expanded">
                                    <input class="input is-radiusless is-info" type="text"
                                           placeholder="<?php esc_attr_e( 'Register an item name', 'calculator-builder' ); ?>"
                                           value="<?php echo esc_attr( $title ); ?>" name="title" autocomplete="off">
                                </div>
                                <div class="control">
                                    <button class="button button-primary button-large is-size-6 is-radiusless"
                                            id="submit">
                                        <span><?php echo esc_attr( $btn ); ?></span>
                                        <span class="icon is-small has-text-white">
                                        &#10004;
                                    </span>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="live-preview">
                        <h3><span class="dashicons dashicons-admin-customizer"></span>
                            Builder </h3>
                        <div class="toggle-preview">
                            <span class="plus is-hidden"><i class="dashicons dashicons-arrow-down-alt2"></i></span>
                            <span class="minus"><i class="dashicons dashicons-arrow-up-alt2"></i></span>
                        </div>
                        <div class="live-builder">
                            <div class="columns">
                                <div class="column has-action-btn"></div>
                                <div class="column">
                                    <div class="formbox"
                                         id="calculator"><?php $this->sanitize_form( $form ); ?></div>
                                </div>
                                <div class="column has-variable-btn">
                                    <div class="variables-wrapper" id="variables"></div>
                                </div>
                            </div>

                        </div>
                        <div class="builder-button">
                            <a class="btn-add-new-field" href="#field-number">
                                <span class="dashicons dashicons-plus"></span>
                            </a>
                        </div>
                    </div>

                </div>

                <div id="postbox-container-2" class="postbox-container">
                    <div id="postoptions" class="postbox ">
						<?php include_once 'settings/tabs.php'; ?>
                    </div>
                </div>
            </div>
        </div>
        <!--  main param for adding in database-->
        <input type="hidden" name="tool_id" value="<?php echo absint( $tool_id ); ?>" id="tool_id"/>
        <input type="hidden" name="add" id="add_action" value="<?php echo absint( $add_action ); ?>"/>
        <input type="hidden" name="id" value="<?php echo absint( $id ); ?>"/>
        <input type="hidden" name="data" value="<?php echo esc_attr( $data ); ?>"/>
        <input type="hidden" name="page" value="<?php echo esc_attr( $this->plugin['slug'] ); ?>"/>
        <input type="hidden" name="prefix" value="<?php echo esc_attr( $this->plugin['prefix'] ); ?>" id="prefix"/>
		<?php wp_nonce_field( $this->plugin['slug'] . '_action', $this->plugin['slug'] . '_nonce' ); ?>
    </form>

<?php

include_once( 'settings/fields-options.php' );
