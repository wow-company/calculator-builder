<?php
/**
 * Formula TextArea
 *
 * @package     CALCHUB
 * @subpackage  CALCHUB/Admin_Class
 * @author      Dmytro Lobov <yoda@calchub.xyz>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<div class="columns can-toggle">
	<div class="column is-6">
		<div class="operators">
			<div class="operators-line is-hidden variables-bottom">
				<h4><?php
					esc_html_e( 'Variables', 'calculator-builder' ); ?>:</h4>
				<div id="variables-bottom"></div><div id="calc-alert-bottom"></div>
			</div>

			<div class="operators-line tags">
				<span class="operator tag">=</span>
				<span class="operator tag">+</span>
				<span class="operator tag">-</span>
				<span class="operator tag">/</span>
				<span class="operator tag">*</span>
				<span class="operator tag">.round(2)</span>
				<span class="operator tag">alert('')</span>

			</div>
			<details open>
				<summary style="cursor: pointer;" class="title"><?php
					esc_html_e( 'Comparison and Conditions', 'calculator-builder' ); ?></summary>
				<p class="operators-line tags">
					<span class="operator tag">if(){}</span>
					<span class="operator tag">else if(){}</span>
					<span class="operator tag">else{}</span>
					<span class="operator tag">&gt;=</span>
					<span class="operator tag"><=</span>
					<span class="operator tag">==</span>
					<span class="operator tag">&&</span>
					<span class="operator tag">||</span>
				</p>

				<p>
					<?php
					esc_html_e( 'Read more about', 'calculator-builder' ); ?>:
					<a href="https://www.w3schools.com/js/js_comparisons.asp" target="_blank">
						<?php
						esc_html_e( 'Comparison', 'calculator-builder' ); ?>
					</a>,
					<a href="https://www.w3schools.com/js/js_if_else.asp" target="_blank">
						<?php
						esc_html_e( 'Conditional', 'calculator-builder' ); ?>
					</a>
				</p>

			</details>
			<details>
				<summary style="cursor: pointer;"><?php
					esc_html_e( 'Math Static properties', 'calculator-builder' ); ?></summary>
				<p class="operators-line tags">
					<span class="operator tag">Math.E</span>
					<span class="operator tag">Math.LN2</span>
					<span class="operator tag">Math.LN10</span>
					<span class="operator tag">Math.LOG2E</span>
					<span class="operator tag">Math.LOG10E</span>
					<span class="operator tag">Math.PI</span>
					<span class="operator tag">Math.SQRT1_2</span>
					<span class="operator tag">Math.SQRT2</span>
				</p>

				<p>
					<a href="https://www.w3schools.com/js/js_math.asp" target="_blank"><?php
						esc_html_e( 'Read more about', 'calculator-builder' ); ?></a>
				</p>

			</details>

			<details>
				<summary style="cursor: pointer;"><?php
					esc_html_e( 'Math Static methods', 'calculator-builder' ); ?></summary>
				<p class="operators-line tags">
					<span class="operator tag">Math.pow()</span>
					<span class="operator tag">Math.sqrt()</span>
					<span class="operator tag">Math.ceil()</span>
					<span class="operator tag">Math.round()</span>
					<span class="operator tag">Math.random()</span>
					<span class="operator tag">Math.max()</span>
					<span class="operator tag">Math.min()</span>
				</p>


				<p class="operators-line tags">
					<span class="operator tag">Math.log()</span>
					<span class="operator tag">Math.abs()</span>
					<span class="operator tag">Math.acos()</span>
					<span class="operator tag">Math.asin()</span>
					<span class="operator tag">Math.atan()</span>
					<span class="operator tag">Math.atan2()</span>
					<span class="operator tag">Math.cos()</span>
					<span class="operator tag">Math.exp()</span>
					<span class="operator tag">Math.sin()</span>
					<span class="operator tag">Math.tan()</span>
					<span class="operator tag">Math.trunc()</span>
				</p>
				<p>
					<a href="https://www.w3schools.com/js/js_math.asp" target="_blank"><?php
						esc_html_e( 'Read more about', 'calculator-builder' ); ?></a>
				</p>
			</details>

		</div>
	</div>
	<div class="column is-6">
		<div class="operators-line is-hidden calc-fieldset-bottom">
			<details open>
				<summary style="cursor: pointer;"><?php
					esc_html_e( 'Fieldsets', 'calculator-builder' ); ?>:
				</summary>
				<div id="calc-fieldset-bottom"></div>
			</details>
		</div>
		<div class="operators-line is-hidden calc-label-bottom">
			<details open>
				<summary style="cursor: pointer;"><?php
					esc_html_e( 'Labels', 'calculator-builder' ); ?>:
				</summary>
				<div id="calc-label-bottom"></div>
			</details>
		</div>

		<div class="operators-line is-hidden calc-field-bottom">
			<details open>
				<summary style="cursor: pointer;"><?php
					esc_html_e( 'Fields', 'calculator-builder' ); ?>:
				</summary>
				<div id="calc-field-bottom"></div>
			</details>
		</div>
		<p class="operators-line tags">
			<span class="operator tag">.hide()</span>
			<span class="operator tag">.show()</span>
			<span class="operator tag">.addClass('')</span>
			<span class="operator tag">.removeClass('')</span>
			<span class="operator tag">.addAttr('name', 'value')</span>
			<span class="operator tag">.removeAttr('name')</span>
			<span class="operator tag">.text('text')</span>
			<span class="operator tag">.text('text')</span>
			<span class="operator tag">calc.alert('Error Massage')</span>
		</p>
		<p><a href="https://calchub.xyz/doc/variables-and-functions/" target="_blank">Read More</a></p>

	</div>
	<div class="is-toggle">
		<span class="plus is-hidden"><i class="dashicons dashicons-arrow-down-alt2"></i></span>
		<span class="minus"><i class="dashicons dashicons-arrow-up-alt2"></i></span>
	</div>
</div>

<div class="columns">
	<div class="column">
        <textarea class="textarea" name="formula" id="formula" cols="30" rows="20"><?php
	        echo wp_specialchars_decode( $formula ); ?></textarea>
	</div>
</div>

<div class="columns">
	<div class="column is-12">
		<details open>
			<summary style="cursor: pointer"><?php esc_html_e('Options', 'calculator-builder');?></summary>
            <p>
				<?php $obfuscation = isset( $param['obfuscation'] ) ? $param['obfuscation'] : ''; ?>
				<label class="checkbox">
					<input type="checkbox" name="param[obfuscation]" <?php checked( '1', $obfuscation ); ?> value="1">
					<?php esc_html_e( 'Obfuscation', 'calculator-builder' ); ?>
                </label>
            </p>
				<p>
					<?php $calc_load = isset( $param['calc_load'] ) ? $param['calc_load'] : ''; ?>
					<label class="checkbox">
						<input type="checkbox" name="param[calc_load]" <?php checked( '1', $calc_load ); ?> value="1">
						<?php esc_html_e( 'Make a calculation when loading the form', 'calculator-builder' ); ?>
					</label>
                </p>
				<p>
					<?php $calc_reset = isset( $param['calc_reset'] ) ? $param['calc_reset'] : ''; ?>
					<label class="checkbox">
						<input type="checkbox" name="param[calc_reset]" <?php checked( '1', $calc_reset ); ?> value="1">
						<?php esc_html_e( 'Hide fields of results when changing calculator parameters', 'calculator-builder' ); ?>
					</label>
                </p>
		</details>
	</div>
</div>
<?php
