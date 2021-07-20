# WordPress Plugin Calculator Builder

A simple way to create online calculator

## Description

A simple tool to create an online calculator. You can create simple calculators for any kind of calculation.

All calculators on the site [CalcHub](https://calchub.xyz/) are created using this plugin.

**Calculator Elements:**
* Number
* Dropdown
* Radio Button
* Checkbox

**Main features**
* Unlimited items: no limited to the number of calculators;
* Live builder;
* Vanilla JS: without using jQuery library;


Documentation Calculator Builder

## Installation

- Installation option 1: Find and install this plugin in the Plugins -> Add new section of your wp-admin
- Installation option 2: Download the zip file, then upload the plugin via the wp-admin in the Plugins -> Add new section. Or unzip the archive and upload the folder to the plugins directory /wp-content/plugins/ via ftp
- Press Activate when you have installed the plugin via dashboard or press Activate in the in the Plugins list
- Go to Calculator Builder section that will appear in your main menu on the left
- Click Add new to create your first countdown
- Build calculator
- Click Save
- Copy and paste the shortcode, such as [Calculator id=1] to where you want the countdown to appear.
- If you want it to appear everywhere on your site, you can insert it for example in your header.php, like this: <?php echo do_shortcode('[Calculator id=1]');?>

## Type of the Fields

- Number - a control for entering a number. Displays a spinner and adds default validation when supported. Displays a numeric keypad in some devices with dynamic keypads.
- Select - element represents a control that provides a menu of options
- Radio - a radio button, allowing a single value to be selected out of multiple choices with the same name value.
- Checkbox - a check box allowing single values to be selected/deselected.
- Number & Select - inserts two fields Number and Select
- Buttons - set the buttons for Calculate and Reset data in the calculator form
- Result - set the field with result. This field readonly.

For field Number, you can set the next attributes:

- max - Maximum value (numeric types);
- min - Minimum value (numeric types);
- step - Incremental values that are valid (numeric types);
- value - The initial value of the control.
- Addon - you can specify the units to be entered in the field. For example $ or px.
- Title - name of the field. You can left empty.
- Required - a value is required for calculate

For fields Select, Radio and Checkbox you can set the next attributes:
- Title - name of the field. You can left empty.
- Options - value and option/label for field. This attribute is filled in as name = values on a new line. Also you can selected the option by *. For, Example: Name Option = 73 *

Field Button:
- Title - name of the field. You can left empty.
- Button Calculate - text for button for calculate form.
- Button Reset - text for button for reset form

Field Result:
- Title - name of the field. You can left empty.
- Addon - specify the units for field. For example $ or px. You can left empty.

![](https://calchub.xyz/wp-content/uploads/2021/07/Field-type.gif)

## Actions
Each field has 3 actions:
- remove - removed selected field
- sorted - change the place of the field in the form
- update - update field content or field type

![](https://calchub.xyz/wp-content/uploads/2021/07/Field-Action.gif)

## EQUATION / FORMULA

To calculate the result, you must use the variables in the Formula field

- Variable x[] - the variable is used for the field that takes part in the calculation
- Variable y[] - variable for displaying the result

```
y[1] = x[1] + x[2];

y[1] = x[1] - x[2];

y[1] = x[1] * x[2];

y[1] = x[1] / x[2];
```

![](https://calchub.xyz/wp-content/uploads/2021/07/Formula.gif)

### Formula with additional variables
You can use the additional variables in the formula field for to facilitate writing the formula and displaying the result.
For Example, Formula Monthly payment for Loan:

```
let r = x[2] / 1200;
let A = x[1];
let N = x[3];

let result = ( r * A ) / ( 1 - Math.pow((1+r), -N));
y[1] = roundVal(result, 2);
```

roundVal(val, decimals) - function for rounding a number. The first parameter (val) is the number to be rounded, the second parameter (decimals) is the number of numbers after the decimal point.

![](https://calchub.xyz/wp-content/uploads/2021/07/Formula_2.gif)

### Сonditional formula
You can use complex structures to calculate the results.
the ability to use the following comparison operators:
- <  less
- &gt;&nbsp;  more
- ==  equal

For Example:
```
if( x[1] < 100 ) {
    y[1] = x[2] * 2;
} else if ( x[1] < 200 ) {
    y[1] = x[2] * 3;
} else {
    y[1] = x[2] * 4;
}
```

Start video for create a calculator for Loan monthly payment

[![Calculator Builder](https://res.cloudinary.com/marcomontalbano/image/upload/v1626777349/video_to_markdown/images/youtube--EGjO6k3JGU0-c05b58ac6eb4c4700831b2b3070cd403.jpg)](https://youtu.be/EGjO6k3JGU0 "Calculator Builder")

To improve the plugin's functions and add new functions, write to us on the support [forum](https://wordpress.org/support/plugin/calculator-builder/) or send requests on the [github](https://github.com/wow-company/calculator-builder/issues).

Project on github [https://github.com/wow-company/calculator-builder/](https://github.com/wow-company/calculator-builder/issues)