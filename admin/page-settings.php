<?php
/**
 * Add/Edit Calculator
 *
 * @package     CalcHub
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Set variables
$settings = CALCHUB()->db->get_settings();
foreach ( $settings as $key => $value ) {
	$$key = $value;
}

$url_form = admin_url() . 'admin.php?page=' . CALCHUB_PLUGIN_SLUG;
?>
    <form action="<?php
	echo esc_url( $url_form ); ?>" method="post" name="post" class="wow-plugin" id="calchub-form">
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-1">
                <div id="post-body-content" style="position: relative;">
                    <div id="titlediv" class="is-b-margin">
                        <div id="titlewrap">
                            <label class="screen-reader-text" id="title-prompt-text" for="title">
								<?php
								esc_html_e( 'Enter title here', 'calculator-builder' ); ?>
                            </label>
                            <div class="field has-addons">
                                <div class="control is-expanded">
                                    <input class="input is-radiusless is-link" type="text" placeholder="<?php
									esc_attr_e( 'Register an item name', 'calculator-builder' ); ?>" value="<?php
									echo esc_attr( $title ); ?>" name="title" autocomplete="off">
                                </div>
                                <div class="control">
                                    <button class="button is-link button-large is-size-6 is-radiusless" id="submit">
                                        <span><?php
	                                        echo esc_html( $btn ); ?></span>
                                        <span class="icon is-small has-text-white">
                                        &#10004;
                                    </span>
                                    </button>
                                </div>
                            </div>

                            <div class="calchub-meta-field">

                                <div class="field has-addons">
                                    <div class="control">
                                    <span class="button is-small is-info" style="cursor: default">
                                        <?php
                                        esc_html_e( 'Tag', 'calculator-builder' ); ?>
                                    </span>
                                    </div>
                                    <div class="control">
                                        <input list="calc-tags" class="input is-small is-info calc-tags " name="tag"
                                               type="text" value="<?php
										echo esc_attr( $tag ); ?>" autocomplete="off">
                                        <datalist id="calc-tags">
											<?php
											$this->get_calc_tags(); ?>
                                        </datalist>

                                    </div>
                                </div>

                                <div class="field has-addons">
                                    <div class="control">
                                    <span class="button is-small is-dark" id="calc-copy-action">
                                        <?php
                                        esc_html_e( 'Shortcode', 'calculator-builder' ); ?>
                                    </span>
                                    </div>
                                    <div class="control">
                                        <input class="input is-small is-dark" type="text" readonly
                                               value="[Calculator id='<?php
										       echo absint( $tool_id ); ?>']" id="calc-shortcode">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="live-preview">
                        <h3><span class="dashicons dashicons-admin-customizer"></span>
							<?php
							esc_html_e( 'Builder', 'calculator-builder' ); ?>
                        </h3>
                        <div class="toggle-preview">
                            <span class="plus is-hidden"><i class="dashicons dashicons-arrow-down-alt2"></i></span>
                            <span class="minus"><i class="dashicons dashicons-arrow-up-alt2"></i></span>
                        </div>
                        <div class="live-builder">
                            <div class="columns">
                                <div class="column has-action-btn"></div>
                                <div class="column">
                                    <div class="formbox" id="calculator"><?php
										CALCHUB()->sanitize->form( $form ); ?></div>
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

                        <div class="tabs is-centered" id="tab">
                            <ul>
								<?php
								$tab_elements = apply_filters( 'calchub_filter_settings_tab_menu', array(
									'formula' => __( 'Formula', 'calculator-builder' ),
								) );
								foreach ( $tab_elements as $key => $val ) {
									$active = ( $key === 'formula' ) ? 'is-active' : '';
									echo '<li class="' . esc_attr( $active ) . ' is-marginless" data-tab="' . esc_attr( $key ) . '"><a>' . esc_html( $val ) . '</a></li>';
								}
								?>
                            </ul>
                        </div>
                        <div id="tab-content" class="inside">
							<?php
							foreach ( $tab_elements as $key => $val ) {
								$active = ( $key === 'formula' ) ? 'is-active' : '';
								echo '<div class="' . esc_attr( $active ) . ' tab-content" data-content="' . esc_attr( $key ) . '">';
								$file = apply_filters( 'calchub_filter_settings_tab_content', $key );
								include_once( $file . '.php' );
								echo '</div>';
							}
							?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  main param for adding in database-->
        <input type="hidden" name="tool_id" value="<?php
		echo absint( $tool_id ); ?>" id="tool_id"/>
        <input type="hidden" name="add" id="add_action" value="<?php
		echo absint( $add_action ); ?>"/>
        <input type="hidden" name="id" value="<?php
		echo absint( $id ); ?>"/>
        <input type="hidden" name="param[time]" value="<?php
		echo time(); ?>"/>
		<?php
		wp_nonce_field( 'calchub_save_action', 'calculator_save' ); ?>
    </form>

<?php
include_once( 'fields-options.php' );
