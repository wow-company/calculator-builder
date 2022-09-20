<?php
/**
 * Notification content
 *
 * @package     Wow_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>


<div class="columns">
    <div class="column">
        <div class="operators">
            <div class="operators-line is-hidden variables-bottom">
                <h4><?php esc_html_e('Variables', 'calculator-builder');?>:</h4>
                <div id="variables-bottom"></div>
            </div>

            <div class="operators-line tags">
                <span class="operator tag">=</span>
                <span class="operator tag">+</span>
                <span class="operator tag">-</span>
                <span class="operator tag">/</span>
                <span class="operator tag">*</span>
                <span class="operator tag">roundVal()</span>
                <span class="operator tag">alert('')</span>

            </div>
            <details open>
                <summary
                        style="cursor: pointer;" class="title"><?php esc_html_e( 'Comparison and Conditions', 'calculator-builder' ); ?></summary>
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
	                <?php esc_html_e( 'Read more about', 'calculator-builder' ); ?>:
                    <a href="https://www.w3schools.com/js/js_comparisons.asp" target="_blank">
	                    <?php esc_html_e( 'Comparison', 'calculator-builder' ); ?>
                    </a>,
                    <a href="https://www.w3schools.com/js/js_if_else.asp" target="_blank">
		                <?php esc_html_e( 'Conditional', 'calculator-builder' ); ?>
                    </a>
                </p>

            </details>
            <details>
                <summary
                        style="cursor: pointer;"><?php esc_html_e( 'Math Static properties', 'calculator-builder' ); ?></summary>
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
                    <a href="https://www.w3schools.com/js/js_math.asp" target="_blank"><?php esc_html_e( 'Read more about', 'calculator-builder' ); ?></a>
                </p>

            </details>

            <details>
                <summary
                        style="cursor: pointer;"><?php esc_html_e( 'Math Static methods', 'calculator-builder' ); ?></summary>
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
                    <a href="https://www.w3schools.com/js/js_math.asp" target="_blank"><?php esc_html_e( 'Read more about', 'calculator-builder' ); ?></a>
                </p>
            </details>

        </div>
    </div>
</div>

<div class="columns">
    <div class="column">
        <textarea class="textarea" name="formula" id="formula" cols="30"
                  rows="20"><?php echo wp_specialchars_decode( $formula ); ?></textarea>
    </div>
</div>

<div class="columns">
    <div class="column">
        <?php
            $obfuscation = isset($param['obfuscation']) ? $param['obfuscation'] : '';
        ?>
        <label><input type="checkbox" name="param[obfuscation]" <?php checked( '1', $obfuscation ); ?> value="1"> <?php esc_html_e( 'Obfuscation', 'calculator-builder' ); ?></label>
    </div>
</div>