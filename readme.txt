=== Calculator Builder ===
Contributors: Wpcalc
Donate link: https://wow-estore.com/
Tags: calculator, calculator builder, online calculator, calculator maker, calculate
Requires at least: 5.0
Tested up to: 6.0
Requires PHP: 5.6
Stable tag: 0.3.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple way to create an online calculator

== Description ==
A simple tool to create an online calculator. You can create simple calculators for any kind of calculation.

All calculators on the site [CalcHub](https://calchub.xyz/) are created using this plugin.

= Quick Start video =

How to use and create a new popup with Popup Box plugin for WordPress.

https://youtu.be/EGjO6k3JGU0

= Calculator Elements: =
* Number
* Dropdown
* Radio Button
* Checkbox

= Main features =
* Unlimited items: no limited to the number of calculators;
* Live builder;
* Vanilla JS: without using jQuery library;


= Type of the Fields =

* Number - a control for entering a number. Displays a spinner and adds default validation when supported. Displays a numeric keypad in some devices with dynamic keypads.
* Select - element represents a control that provides a menu of options
* Radio - a radio button, allowing a single value to be selected out of multiple choices with the same name value.
* Checkbox - a check box allowing single values to be selected/deselected.
* Number & Select - inserts two fields Number and Select
* Buttons - set the buttons for Calculate and Reset data in the calculator form
* Result - set the field with result. This field readonly.


= EQUATION / FORMULA =

To calculate the result, you must use the variables in the Formula field

* Variable x[] - the variable is used for the field that takes part in the calculation
* Variable y[] - variable for displaying the result

`
y[1] = x[1] + x[2];

y[1] = x[1] - x[2];

y[1] = x[1] * x[2];

y[1] = x[1] / x[2];
`

= Formula with additional variables =
You can use the additional variables in the formula field for to facilitate writing the formula and displaying the result.

For Example, Formula Monthly payment for Loan:

`
let r = x[2] / 1200;
let A = x[1];
let N = x[3];

let result = ( r * A ) / ( 1 - Math.pow((1+r), -N));
y[1] = roundVal(result, 2);
`

roundVal(val, decimals) - function for rounding a number. The first parameter (val) is the number to be rounded, the second parameter (decimals) is the number of numbers after the decimal point.

= Сonditional formula =
You can use complex structures to calculate the results.
the ability to use the following comparison operators:
* <  less
* >  more
* ==  equal

For Example:

`
if( x[1] < 100 ) {
    y[1] = x[2] * 2;
} else if ( x[1] < 200 ) {
    y[1] = x[2] * 3;
} else {
    y[1] = x[2] * 4;
}
`

To improve the plugin's functions and add new functions, write to us on the support [forum](https://wordpress.org/support/plugin/calculator-builder/) or send requests on the [github](https://github.com/wow-company/calculator-builder/issues).

Project on GitHub [https://github.com/wow-company/calculator-builder/](https://github.com/wow-company/calculator-builder/issues)


= Support =
Search for answers and ask your questions at [forum](https://wordpress.org/support/plugin/calculator-builder/) or send requests on the [github](https://github.com/wow-company/calculator-builder/issues)


== Installation ==
* Installation option 1: Find and install this plugin in the `Plugins` -> `Add new` section of your `wp-admin`
* Installation option 2: Download the zip file, then upload the plugin via the wp-admin in the `Plugins` -> `Add new` section. Or unzip the archive and upload the folder to the plugins directory `/wp-content/plugins/` via ftp
* Press `Activate` when you have installed the plugin via dashboard or press `Activate` in the in the `Plugins` list 
* Go to `Calculator Builder` section that will appear in your main menu on the left
* Click `Add new` to create your first countdown
* Build calculator
* Click Save
* Copy and paste the shortcode, such as [Calculator id=1] to where you want the countdown to appear.
* If you want it to appear everywhere on your site, you can insert it for example in your `header.php`, like this: `<?php echo do_shortcode('[CCalculator id=1]');?>`

== Screenshots ==
1. Loan Monthly payment Calculator
2. Set the field into the calculator form
3. Visual calculator builder in dashboard
4. Formula field


== Changelog ==
= 0.3.1 =
Added: the ability to add more than one calculator per page
Improvement: the work of scripts on the page


= 0.3 =
Added: New fields: Title, Separator
Added: function for Export/Import calculators
Added: Documentation page
Added: Changelog page
Fixed: saving calculators with conditional symbols


= 0.2 =
* Updated: file for translate .po
* Added: link to Documantation

= 0.1 =
* Initial release