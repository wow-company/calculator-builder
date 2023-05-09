<?php
/**
 * Fields options
 *
 * Popup with the fields. Add to the form
 *
 * @package     CALCHUB
 * @subpackage  Admin/Fields
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<dialog class="lightbox" id="field-number">

	<div class="lightbox-content">

		<a href="#" class="lightbox-close"><span class="dashicons dashicons-no-alt"></span> </a>

		<form action="" id="form-params" data-field-index="">

			<div class="columns lightbox-header">
				<div class="column">
					<div class="field is-horizontal">
						<div class="field-label is-normal">
							<div class="lightbox-title" id="lightbox-header"><?php esc_html_e( 'Add Field', 'calculator-builder' ); ?></div>
							<label class="type-required">
								<input type="checkbox" checked name="required"
								       value="1"><?php esc_html_e( 'Required', 'calculator-builder' ); ?>
							</label>
						</div>
						<div class="field-body">
							<div class="field">
								<div class="control">
									<div class="select is-link">
										<select name="type" id="form-type">
											<option value="number">
												<?php esc_attr_e( 'Number', 'calculator-builder' ); ?>
											</option>
											<option value="select">
												<?php esc_attr_e( 'Select', 'calculator-builder' ); ?>
											</option>
											<option value="radio">
												<?php esc_attr_e( 'Radio', 'calculator-builder' ); ?>
											</option>
											<option value="checkbox">
												<?php esc_attr_e( 'Checkbox', 'calculator-builder' ); ?></option>
											<option value="number-select">
												<?php esc_attr_e( 'Number + Select', 'calculator-builder' ); ?>
											</option>
											<option value="buttons">
												<?php esc_attr_e( 'Buttons', 'calculator-builder' ); ?>
											</option>
											<option value="result">
												<?php esc_attr_e( 'Result', 'calculator-builder' ); ?>
											</option>
											<option value="title">
												<?php esc_attr_e( 'Title', 'calculator-builder' ); ?>
											</option>
											<option value="separator">
												<?php esc_attr_e( 'Separator', 'calculator-builder' ); ?>
											</option>
											<option value="spacer">
												<?php esc_attr_e( 'Spacer', 'calculator-builder' ); ?>
											</option>
											<option value="textarea">
												<?php esc_attr_e( 'Textarea', 'calculator-builder' ); ?>
											</option>
											<option value="input">
												<?php esc_attr_e( 'Input', 'calculator-builder' ); ?>
											</option>
											<option value="range">
												<?php esc_attr_e( 'Range', 'calculator-builder' ); ?>
											</option>
											<option value="alert">
												<?php esc_attr_e( 'Alert', 'calculator-builder' ); ?>
											</option>
										</select>
									</div>
								</div>
							</div>

							<div class="field field-type-input">
								<div class="control">
									<div class="select is-link">
										<select name="input_field_type">
											<option
												value="text"><?php esc_attr_e( 'Text', 'calculator-builder' ); ?></option>
											<option
												value="email"><?php esc_attr_e( 'Email', 'calculator-builder' ); ?></option>
											<option
												value="date"><?php esc_attr_e( 'Date', 'calculator-builder' ); ?></option>
											<option
												value="datetime"><?php esc_attr_e( 'DateTime', 'calculator-builder' ); ?></option>
											<option
												value="month"><?php esc_attr_e( 'Month', 'calculator-builder' ); ?></option>
											<option
												value="time"><?php esc_attr_e( 'Time', 'calculator-builder' ); ?></option>
											<option
												value="week"><?php esc_attr_e( 'Week', 'calculator-builder' ); ?></option>
										</select>
									</div>
								</div>
							</div>

							<div class="field field-type-result">
								<div class="control">
									<div class="select is-link">
										<select name="result_field">
											<option
												value="1"><?php esc_attr_e( 'Field', 'calculator-builder' ); ?></option>
											<option
												value="2"><?php esc_attr_e( 'Textarea', 'calculator-builder' ); ?></option>
											<option
												value="3"><?php esc_attr_e( 'HTML block', 'calculator-builder' ); ?></option>
										</select>
									</div>
								</div>
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
							       autocomplete="off" value="">
						</div>
					</div>
				</div>
				<div class="column field-addon">
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
										<option
											value="right"><?php esc_attr_e( 'right', 'calculator-builder' ); ?></option>
										<option
											value="left"><?php esc_attr_e( 'left', 'calculator-builder' ); ?></option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="fields-number">
				<div class="columns">
					<div class="column field-value">
						<div class="field has-addons">
							<div class="control">
								<span
									class="button is-size-6 is-link"><?php esc_html_e( 'value', 'calculator-builder' ); ?></span>
							</div>
							<div class="control is-expanded">
								<input class="input is-link" name="value" type="text"
								       placeholder="<?php esc_attr_e( 'Enter max or left empty', 'calculator-builder' ); ?>"
								       autocomplete="off">
							</div>
						</div>
					</div>
					<div class="column field-step">
						<div class="field has-addons">
							<div class="control">
								<span
									class="button is-size-6 is-link"><?php esc_html_e( 'step', 'calculator-builder' ); ?></span>
							</div>
							<div class="control is-expanded">
								<input class="input is-link" name="step" type="text"
								       placeholder="<?php esc_attr_e( 'Enter max or left empty', 'calculator-builder' ); ?>"
								       value="0.01" autocomplete="off">
							</div>
						</div>
					</div>
				</div>

				<div class="columns">
					<div class="column">
						<div class="field has-addons">
							<div class="control">
								<span
									class="button is-size-6 is-link"><?php esc_html_e( 'min', 'calculator-builder' ); ?></span>
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
								<span
									class="button is-size-6 is-link"><?php esc_html_e( 'max', 'calculator-builder' ); ?></span>
							</div>
							<div class="control is-expanded">
								<input class="input is-link" type="text" name="max"
								       placeholder="<?php esc_attr_e( 'Enter max or left empty', 'calculator-builder' ); ?>"
								       autocomplete="off">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="columns field-holder">
				<div class="column">
					<div class="field has-addons">
						<div class="control">
								<span class="button is-size-6 is-link">
									<?php esc_html_e( 'placeholder', 'calculator-builder' ); ?>
								</span>
						</div>
						<div class="control is-expanded">
							<input class="input is-link" type="text" name="placeholder" autocomplete="off">
						</div>
					</div>
				</div>
			</div>

			<div class="columns fields-options">
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

			<div class="columns fields-button">
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

			<div class="columns fields-font">
				<div class="column">
					<div class="field">
						<label class="label"><?php esc_html_e( 'Font Size', 'calculator-builder' ); ?></label>
						<div class="field has-addons">
							<div class="control is-expanded">
								<input class="input is-link" type="number" name="titleSize" value="18"
								       autocomplete="off">
							</div>
							<div class="control">
								<span
									class="button is-size-6 is-link"><?php esc_html_e( 'px', 'calculator-builder' ); ?></span>
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
									<option
										value="normal"><?php esc_html_e( 'Normal', 'calculator-builder' ); ?></option>
									<option
										value="lighter"><?php esc_html_e( 'Lighter', 'calculator-builder' ); ?></option>
									<option
										value="bolder"><?php esc_html_e( 'Bolder', 'calculator-builder' ); ?></option>
								</select>
							</div>
						</div>
					</div>
				</div>

			</div>


			<div class="columns fields-spacer">

				<div class="column is-4">
					<div class="field">
						<label class="label"><?php esc_html_e( 'Height', 'calculator-builder' ); ?></label>
						<div class="field has-addons">
							<div class="control is-expanded">
								<input class="input is-link" type="number" name="spacerHeight" value="16" min="1"
								       autocomplete="off">
							</div>
							<div class="control">
								<span
									class="button is-size-6 is-link"><?php esc_html_e( 'px', 'calculator-builder' ); ?></span>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="columns">
				<div class="column">
					<div class="field">
						<label class="label"><?php esc_html_e( 'Extra class', 'calculator-builder' ); ?></label>
						<div class="field has-addons">
							<div class="control is-expanded">
								<input class="input is-link" type="text" name="extraClasses" value=""
								       autocomplete="off">
								<p class="help is-link">You can use class is-vertical - for show fields in column</p>
							</div>
						</div>

					</div>
				</div>

			</div>

			<div class="columns">
				<div class="column has-text-centered">
					<?php submit_button( '', 'primary', 'submit', false ); ?>
				</div>
			</div>
		</form>
	</div>
</dialog>

