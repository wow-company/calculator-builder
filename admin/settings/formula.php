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
        <div class="operators mt-5">

            <div class="operators-line tags">
                <span class="operator tag">=</span>
                <span class="operator tag">+</span>
                <span class="operator tag">-</span>
                <span class="operator tag">/</span>
                <span class="operator tag">*</span>
                <span class="operator tag">roundVal()</span>

            </div>
            <div class="operators-line tags">
                <span class="operator tag">Math.pow()</span>
                <span class="operator tag">Math.sqrt()</span>
                <span class="operator tag">Math.ceil()</span>
                <span class="operator tag">Math.round()</span>
                <span class="operator tag">Math.random()</span>
                <span class="operator tag">Math.max()</span>
                <span class="operator tag">Math.min()</span>
            </div>

            <div class="operators-line tags">
                <span class="operator tag">Math.E</span>
                <span class="operator tag">Math.LN2</span>
                <span class="operator tag">Math.LN10</span>
                <span class="operator tag">Math.LOG2E</span>
                <span class="operator tag">Math.LOG10E</span>
                <span class="operator tag">Math.PI</span>
                <span class="operator tag">Math.SQRT1_2</span>
                <span class="operator tag">Math.SQRT2</span>
            </div>

            <div class="operators-line tags">
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
            </div>

        </div>
	</div>
</div>

<div class="columns">
    <div class="column">
        <textarea class="textarea" name="formula" id="formula" cols="30" rows="10"><?php echo esc_attr( $formula ); ?></textarea>
    </div>
</div>