=== Calculator Builder ===
Contributors: Wpcalc
Donate link: https://wow-estore.com/
Tags: calculator, calculator builder, online calculator, calculator maker, calculate
Requires at least: 5.0
Tested up to: 5.8
Requires PHP: 5.6
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple way to create an online calculator

== Description ==
A simple tool to create an online calculator. You can create simple calculators for any kind of calculation.

All calculators on the site [CalcHub](https://calchub.xyz/) are created using this plugin.

= Calculator Elements: =
* Number
* Dropdown
* Radio Button
* Checkbox


= Main features =
* Unlimited items: no limited to the number of calculators;
* Live builder;
* Vanilla JS: without using jQuery library;


The calculator has variables for calculating and results:

* x[] - uses for calculate
* y[] - uses for results

= Equation / Formula Format For Calculated =

`
y[1] = x[1] + x[2];

y[1] = x[1] - x[2];

y[1] = x[1] * x[2];

y[1] = x[1] / x[2];
`

Also you can round the result uses the function roundVal(val, decimal), where:

* val = value or expression;
* decimal = a number of simbols after comma/dot

For Example, rounding expression to 2 decimal places
`
y[1] = roundVal( x[1] / x[2], 2);
`

You can use complex structures to calculate the results.

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



== Changelog ==
= 0.1 =
* Initial release