<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="lightbox" id="field-number">

    <div class="lightbox-content p-4">
        <a href="#" class="lightbox-close"><span class="dashicons dashicons-no-alt"></span> </a>

        <div class="lightbox-title"><?php esc_html_e( 'Add Field', 'calculator-builder' ); ?></div>
        <form action="" id="form-params" data-field-index="">
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label"><?php esc_html_e( 'Field type', 'calculator-builder' ); ?></label>
                        <div class="control">
                            <div class="select is-link">
                                <select name="type">
                                    <option value="1"><?php esc_attr_e( 'Number', 'calculator-builder' ); ?></option>
                                    <option value="2"><?php esc_attr_e( 'Select', 'calculator-builder' ); ?></option>
                                    <option value="3"><?php esc_attr_e( 'Radio', 'calculator-builder' ); ?></option>
                                    <option value="4"><?php esc_attr_e( 'Checkbox', 'calculator-builder' ); ?></option>
                                    <option value="5"><?php esc_attr_e( 'Number + Select', 'calculator-builder' ); ?></option>
                                    <option value="6"><?php esc_attr_e( 'Buttons', 'calculator-builder' ); ?></option>
                                    <option value="7"><?php esc_attr_e( 'Result', 'calculator-builder' ); ?></option>
                                    <option value="8"><?php esc_attr_e( 'Title', 'calculator-builder' ); ?></option>
                                    <option value="9"><?php esc_attr_e( 'Separator', 'calculator-builder' ); ?></option>
                                    <option value="10"><?php esc_attr_e( 'Spacer', 'calculator-builder' ); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column type-number">
                    <div class="field">
                        <label class="label"><?php esc_html_e( 'Required', 'calculator-builder' ); ?></label>
                        <div class="control">
                            <div class="select is-link">
                                <select name="required">
                                    <option value="1"><?php esc_attr_e( 'Yes', 'calculator-builder' ); ?></option>
                                    <option value="2"><?php esc_attr_e( 'No', 'calculator-builder' ); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="columns">
                <div class="column field-title">
                    <div class="field">
                        <label class="label"><?php esc_html_e( 'Title', 'calculator-builder' ); ?></label>
                        <div class="control">
                            <input class="input is-link" name="title" type="text" placeholder="Enter title"
                                   autocomplete="off" value="Label">
                        </div>
                    </div>
                </div>
                <div class="column type-number type-result">
                    <div class="field">
                        <label class="label"><?php esc_html_e( 'Addon', 'calculator-builder' ); ?></label>
                        <div class="field has-addons">

                            <div class="control is-expanded">
                                <input class="input is-link" name="addon" type="text" placeholder="Enter addon"
                                       autocomplete="off">
                            </div>
                            <div class="control">
                                <div class="select is-link">
                                    <select name="addon_pos">
                                        <option value="right"><?php esc_attr_e( 'right', 'calculator-builder' ); ?></option>
                                        <option value="left"><?php esc_attr_e( 'left', 'calculator-builder' ); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns type-number">
                <div class="column">
                    <div class="field has-addons">
                        <div class="control">
                            <span class="button is-size-6 is-link"><?php esc_html_e( 'value', 'calculator-builder' ); ?></span>
                        </div>
                        <div class="control is-expanded">
                            <input class="input is-link" name="value" type="text"
                                   placeholder="<?php esc_attr_e( 'Enter max or left empty', 'calculator-builder' ); ?>"
                                   autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="column type-number">
                    <div class="field has-addons">
                        <div class="control">
                            <span class="button is-size-6 is-link"><?php esc_html_e( 'step', 'calculator-builder' ); ?></span>
                        </div>
                        <div class="control is-expanded">
                            <input class="input is-link" name="step" type="text"
                                   placeholder="<?php esc_attr_e( 'Enter max or left empty', 'calculator-builder' ); ?>"
                                   value="0.01" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns type-number">
                <div class="column">
                    <div class="field has-addons">
                        <div class="control">
                            <span class="button is-size-6 is-link"><?php esc_html_e( 'min', 'calculator-builder' ); ?></span>
                        </div>
                        <div class="control is-expanded">
                            <input class="input is-link" name="min" type="text"
                                   placeholder="<?php esc_attr_e( 'Enter max or left empty', 'calculator-builder' ); ?>"
                                   autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field has-addons">
                        <div class="control">
                            <span class="button is-size-6 is-link"><?php esc_html_e( 'max', 'calculator-builder' ); ?></span>
                        </div>
                        <div class="control is-expanded">
                            <input class="input is-link" type="text" name="max"
                                   placeholder="<?php esc_attr_e( 'Enter max or left empty', 'calculator-builder' ); ?>"
                                   autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns type-textarea is-hidden">
                <div class="column">
                    <div class="field">
                        <label class="label"><?php esc_html_e( 'Options', 'calculator-builder' ); ?></label>
                        <div class="control">
                            <textarea class="textarea is-link" name="options"
                                      placeholder="<?php esc_attr_e( 'name = value', 'calculator-builder' ); ?>"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns type-buttons is-hidden">
                <div class="column">
                    <div class="field">
                        <label class="label"><?php esc_html_e( 'Button Calculate', 'calculator-builder' ); ?></label>
                        <div class="control">
                            <input class="input is-link" type="text" placeholder="Enter text"
                                   value="<?php esc_attr_e( 'Calculate', 'calculator-builder' ); ?>" name="calculate">
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label class="label"><?php esc_html_e( 'Button Reset', 'calculator-builder' ); ?></label>
                        <div class="control">
                            <input class="input is-link" name="reset" type="text" placeholder="Enter text"
                                   value="<?php esc_attr_e( 'Reset', 'calculator-builder' ); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns type-title is-hidden">
                <div class="column">
                    <div class="field">
                        <label class="label"><?php esc_html_e( 'Font Size', 'calculator-builder' ); ?></label>
                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <input class="input is-link" type="number" name="titleSize" value="18"
                                       autocomplete="off">
                            </div>
                            <div class="control">
                                <span class="button is-size-6 is-link"><?php esc_html_e( 'px', 'calculator-builder' ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="field">
                        <label class="label"><?php esc_html_e( 'Font Weight', 'calculator-builder' ); ?></label>
                        <div class="control is-expanded">
                            <div class="select is-link">
                                <select name="titleWeight">
                                    <option value="bold"><?php esc_html_e( 'Bold', 'calculator-builder' ); ?></option>
                                    <option value="normal"><?php esc_html_e( 'Normal', 'calculator-builder' ); ?></option>
                                    <option value="lighter"><?php esc_html_e( 'Lighter', 'calculator-builder' ); ?></option>
                                    <option value="bolder"><?php esc_html_e( 'Bolder', 'calculator-builder' ); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="columns type-spacer is-hidden">

                <div class="column is-4">
                    <div class="field">
                        <label class="label"><?php esc_html_e( 'Height', 'calculator-builder' ); ?></label>
                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <input class="input is-link" type="number" name="spacerHeight" value="16" min="1"
                                       autocomplete="off">
                            </div>
                            <div class="control">
                                <span class="button is-size-6 is-link"><?php esc_html_e( 'px', 'calculator-builder' ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="columns">
                <div class="column has-text-centered">
                    <button class="button-add button is-success is-radiusless"
                            name="add-field"><?php esc_html_e( 'Add Field', 'calculator-builder' ); ?></button>
                    <button class="button-update button is-success is-hidden is-radiusless"
                            name="update-field"><?php esc_html_e( 'Update Field', 'calculator-builder' ); ?></button>
                </div>
            </div>

        </form>
    </div>

</div>

