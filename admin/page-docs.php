<?php

/**
 * Documentation Page
 *
 * @package     Wow_Plugin
 * @subpackage  Admin/Main_page
 * @author      Dmytro Lobov <helper@wow-company.com>
 * @license     GNU Public License
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>


<div class="wrap about__container">

    <div class="about__section">
        <h2 class="aligncenter">Documentation</h2>
    </div>

    <div class="about__section">
        <h3>Installation</h3>
        <ul>
            <li>Installation option 1: Find and install this plugin in the Plugins -&gt; Add new section of your
                wp-admin
            </li>
            <li>Installation option 2: Download the zip file, then upload the plugin via the wp-admin in the Plugins -&gt;
                Add new section. Or unzip the archive and upload the folder to the plugins directory
                /wp-content/plugins/ via ftp
            </li>
            <li>Press Activate when you have installed the plugin via dashboard or press Activate in the in the Plugins
                list
            </li>
            <li>Go to Calculator Builder section that will appear in your main menu on the left</li>
            <li>Click Add new to create your first countdown</li>
            <li>Build calculator</li>
            <li>Click Save</li>
            <li>Copy and paste the shortcode, such as <code class="has-text-danger">[Calculator id=1]</code> to where
                you want the countdown to
                appear.
            </li>
            <li>If you want it to appear everywhere on your site, you can insert it for example in your header.php, like
                this: <code class="has-text-danger">&lt;?php echo do_shortcode('[Calculator id=1]');?&gt;</code></li>
        </ul>
    </div>

    <div class="about__section">
        <h3>Type of the Fields</h3>
        <ul>
            <li><strong>Number</strong> – a control for entering a number. Displays a spinner and adds default
                validation when supported. Displays a numeric keypad in some devices with dynamic keypads.
            </li>
            <li><strong>Select</strong> – element represents a control that provides a menu of options</li>
            <li><strong>Radio</strong> – a radio button, allowing a single value to be selected out of multiple choices
                with the same name value.
            </li>
            <li><strong>Checkbox</strong> – a check box allowing single values to be selected/deselected.</li>
            <li><strong>Number &amp; Select</strong> – inserts two fields Number and Select</li>
            <li><strong>Buttons</strong> – set the buttons for Calculate and Reset data in the calculator form</li>
            <li><strong>Result</strong> – set the field with result. This field readonly.</li>
            <li><strong>Title</strong> – add only title for form.</li>
            <li><strong>Separator</strong> – add line into the form.</li>
            <li><strong>Spacer</strong> – add empty space in form.</li>
        </ul>
    </div>

    <div class="about__section">
        <h3>Attributes for Number</h3>
        <ul>
            <li><strong>max</strong> – Maximum value (numeric types);</li>
            <li><strong>min</strong> – Minimum value (numeric types);</li>
            <li><strong>step</strong> – Incremental values that are valid (numeric types);</li>
            <li><strong>value</strong> – The initial value of the control.</li>
            <li><strong>Addon</strong> – you can specify the units to be entered in the field. For example $ or px.</li>
            <li><strong>Title</strong> – name of the field. You can left empty.</li>
            <li><strong>Required</strong> – a value is required for calculate</li>
        </ul>
    </div>

    <div class="about__section">
        <h3>Attributes for Select, Radio and Checkbox</h3>
        <ul>
            <li><strong>Title</strong> – name of the field. You can left empty.</li>
            <li><strong>Options</strong> – value and option/label for field. This attribute is filled in as name =
                values on a new line. Also you can selected the option by *. For, Example: Name Option = 73 *
            </li>
        </ul>
    </div>

    <div class="about__section">
        <h3>Attributes for Button</h3>
        <ul>
            <li>Title – name of the field. You can left empty.</li>
            <li>Button Calculate – text for button for calculate form.</li>
            <li>Button Reset – text for button for reset form</li>
        </ul>
    </div>

    <div class="about__section">
        <h3>Attributes for Result</h3>
        <ul>
            <li>Title – name of the field. You can left empty.</li>
            <li>Addon – specify the units for field. For example $ or px. You can left empty.</li>
        </ul>
    </div>

    <div class="about__section ">
        <h3>Actions</h3>
        <p>
            Each field has 3 actions:

        </p>
        <ul>
            <li>Title – name of the field. You can left empty.</li>
            <li>Addon – specify the units for field. For example $ or px. You can left empty.</li>
        </ul>
    </div>

    <div class="about__section">
        <h3>EQUATION / FORMULA</h3>
        <p>To calculate the result, you must use the variables in the Formula field</p>
        <ul>
            <li>Variable x[] – the variable is used for the field that takes part in the calculation</li>
            <li> Variable y[] – variable for displaying the result</li>
        </ul>

        <pre class="has-background-grey-lighter">

        y[1] = x[1] + x[2];

        y[1] = x[1] - x[2];

        y[1] = x[1] * x[2];

        y[1] = x[1] / x[2];

        </pre>

    </div>

    <div class="about__section">
        <h3>Formula with additional variables</h3>
        <p>You can use the additional variables in the formula field for to facilitate writing the formula and
            displaying the result. For Example, Formula Monthly payment for Loan:</p>

        <pre class="has-background-grey-lighter">

        let r = x[2] / 1200;
        let A = x[1];
        let N = x[3];

        let result = ( r * A ) / ( 1 - Math.pow((1+r), -N));
        y[1] = roundVal(result, 2);

        </pre>

        <p>
            <a href="https://www.w3schools.com/js/js_variables.asp" target="_blank">Read more about variables</a>
        </p>

    </div>

    <div class="about__section">
        <h3>Function <code class="has-text-danger">roundVal()</code></h3>
        <p>
            <code class="has-text-danger">roundVal(val, decimals)</code> – function for rounding a number. The first
            parameter (val) is the number to be rounded, the second parameter (decimals) is the number of numbers after
            the decimal point. </p>
        <h4>Example</h4>
        <pre class="has-background-grey-lighter">

        y[1] = roundVal( 3.1415926535, 0 ); // result 3

        y[2] = roundVal( 3.1415926535, 1 ); // result 3.1

        y[3] = roundVal( 3.1415926535, 2 ); // result 3.14

        y[4] = roundVal( 3.1415926535, 4 ); // result 3.1415

        </pre>
    </div>

    <div class="about__section">

        <h3>Сonditional formula</h3>

        <p>You can use complex structures to calculate the results. the ability to use the following comparison
            operators:</p>

        <ul>
            <li>< less</li>
            <li>> more</li>
            <li>== equal</li>
        </ul>

        <h4>For Example:</h4>

        <pre class="has-background-grey-lighter">

        if( x[1] < 100 ) {

        y[1] = x[2] * 2;

        } else if ( x[1] < 200 ) {

        y[1] = x[2] * 3;

        } else {

        y[1] = x[2] * 4;

        }

        </pre>
    </div>

    <div class="about__section">
        <h3>Start video for create a calculator</h3>
        <p><iframe loading="lazy" title="WordPress plugin Calculator Builder" width="640" height="360" src="https://www.youtube.com/embed/EGjO6k3JGU0?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></p>
    </div>

