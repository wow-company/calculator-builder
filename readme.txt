=== Calculator Builder ===
Contributors: calchub, Wpcalc, lobov
Donate link: https://calchub.xyz
Tags: calculator, calculator builder, online calculator, calculator maker, calculate
Requires at least: 5.0
Tested up to: 6.1
Requires PHP: 7.4
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple way to create an online calculator

== Description ==
Introducing the **Calculator Builder WordPress plugin** - the ultimate WordPress plugin that allows you to create **online calculators for any calculation**. You can also add style to your calculator and customize it the way you want. Calculator Builder is a great plugin to have awesome and easy-to-use calculators. It has powerful tools to create an **intuitive calculator** and to use them for different purposes. Display any type of calculator on your website to make it more engaging and user-friendly, such as health and financial ones. The Calculator Builder plugin provides you with elements such as checkboxes, radio buttons, numbers, and dropdowns. It has an amazing set of features that will help you create the online calculator you want very **quickly and effectively**.

### Features
* **Intuitive interface** - the Calculator Builder plugin has a very intuitive interface and is very engaging. You can create a calculator that perfectly matches your website design, and is **highly customizable**.
* **Easy to use** - another important feature of the Calculator Builder WordPress plugin is that it is super easy to use. With its well-designed interface and structure, you can easily understand how to create calculators even if you are not a developer and **don’t have coding skills**. However, complex calculators will still require JavaScript skills.
* **Unlimited items to use for calculators** - Calculator Builder provides you with unlimited items to include in your individual calculator. This is also a great feature as not many **calculator builders** provide you with lots of items.
* **User-friendly** - Sometimes different types of calculators can look confusing, for instance, Financial Calculators.  can look confusing. Many users pay attention to the user-friendly aspect of calculators. The **Calculator Builder plugin** provides you with a great user experience as it is made to make the calculation process easier and quicker.
* **Highly customizable** - CalcHub extension helps you to easily **design the calculator** the way you want. This will help you to brand your website by making the calculator an inseparable part of it.
* **Live builder** - Լive builder allows you to see the calculator created. This will save you time during the process of creation.
* **Usage of Vanilla JS**: without using the jQuery library
* **Export/Import tool** - Calculator Builder allows you to export and import calculator data
* **Field types** such as “Title”, “Separator”, “Spacer”, “Textarea”, and “Input”

### Use Cases

#### 1 Finance calculators

Do you write a blog? Own a car dealership? Or are otherwise involved in **financial services**? Then you should consider adding the Calculator Builder plugin to your website which will easily **carry out financial calculations** and ease the processes concerning any aspect of your finances.

You can do the following types of **financial calculations**:

* [Mortgage Calculator](https://calchub.xyz/mortgage-calculator/)
* [Credit card minimum payment](https://calchub.xyz/credit-card-minimum-payment/)
* [Loan amount](https://calchub.xyz/loan-amount/)
* [Interest rate](https://calchub.xyz/interest-rate/)
* [Loan monthly payment](https://calchub.xyz/loan-monthly-payment/)
* [And more!](https://calchub.xyz/category/finance/)

#### 2 Health calculators

Do you own **sports, diet, or health websites**? Are you involved in health-related services? If yes, then you should start using the Calculator Builder WordPress plugin as a **health-related calculator** to make your work easier.

* [Body Fat](https://calchub.xyz/body-fat/)
* [BAI and BMI](https://calchub.xyz/bai-and-bmi/)
* [Ideal Weight](https://calchub.xyz/ideal-weight/)
* [Lean body mass](https://calchub.xyz/lean-body-mass/)
* [Fat-Free Mass Index](https://calchub.xyz/fat-free-mass-index/)
* [And many more!](https://calchub.xyz/category/health/)

#### Examples online calculators

* [Beauty](https://calchub.xyz/category/beauty/):
    - [Appearance](https://calchub.xyz/category/beauty/appearance/)
    - [Food](https://calchub.xyz/category/beauty/food/)
    - [Pregnancy](https://calchub.xyz/category/beauty/pregnancy/)
* [Finance](https://calchub.xyz/category/finance/):
    - [Investment](https://calchub.xyz/category/finance/investment/)
    - [Loan](https://calchub.xyz/category/finance/loan/)
* [Medical](https://calchub.xyz/category/medical/)
    - [Cardiology](https://calchub.xyz/category/medical/cardiology/)
    - [Pharmacology](https://calchub.xyz/category/medical/pharmacology/)

### Elements

The calculator elements of WordPress Calculator Builder include the following:

* Radio Button
* Dropdown
* Checkbox
* Number
* Textarea
* Date
* Time

### Field Types

**Number** - a control used for numbers. When supported, it shows a spinner and applies to default validation. Some devices with dynamic keypads show a numeric keypad.
**Select** - the select element depicts a control with a menu of choices
**Radio**  - set the title and select a single value from multiple choices with the same name value -
**Checkbox** - select single values
**Number and Select** - insert Number and Select fields, set the title, choose the addon and write the preferred value
**Buttons** - write the title, and then set the “Calculate” and “Reset” buttons
**Result** - set the field containing the outcome. It is a read-only field.

### Formulas

**Comparison and Conditional Formula** - if(){}, else , if(){}, Else{}, >=, <=, ==, &&, ||
**Math Static Properties** - Math.E, Math.LN2, Math.LN10, Math.LOG2E, Math.LOG10E, Math.PI, Math.SQRT1_2, Math.SQRT2
**Math Static Methods** - Math.pow(), Math.sqrt(), Math.ceil(), Math.round(), Math.random(), Math.max(), Math.min(), Math.log(), Math.abs(), Math.acos(), Math.asin(), Math.atan(), Math.atan2(), Math.cos(), Math.exp(), Math.sin(), Math.tan(), Math.trunc()

### Video

How to Get Started with the WordPress Calculator Builder plugin

https://www.youtube.com/watch?v=EGjO6k3JGU0&t=2s

### Extensions

**[Calchub Style](https://calchub.xyz/downloads/calchub-style/)** - customize the calculator for each individual calculator.
**[CalcHub Counter](https://calchub.xyz/downloads/calchub-counter/)** - add the button likes and calculation counter to your calculators and you'll be able to track it easily.
**[CalcHub Print](https://calchub.xyz/downloads/calchub-print/)** - Easily add an online calculator print button as well as a copy URL button.
**[CalcHub WPCF7](https://calchub.xyz/downloads/calchub-wpcf7/)** - Integration WordPress plugin Contact Form 7 with Calculator Builder. Easily send the calculator result by email.

### EQUATION / FORMULA

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

roundVal(val, decimals) - function for rounding a number. The first parameter (val) is the number to be rounded, and the second parameter (decimals) is the number of numbers after the decimal point.

= Conditional formula =
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

### Support
If you have any questions concerning the plugin ask us at the [WordPress forum](https://wordpress.org/support/plugin/calculator-builder/) or send your requests to [GitHub](https://github.com/wow-company/calculator-builder/issues).

== Installation ==

**Option 1**
* Go to the WordPress dashboard
* Click “Add New” in the “Plugins” section
* Type the plugin name 'Calculator Builder' in the search line
* Find the plugin and activate

**Option 2**
* Download the ZIP file of the Calculator Builder
* Go to the “Plugins” section of the WordPress dashboard
* Upload the ZIP file
* Activate the “Calculator Builder” Plugin
* Build the calculator
* Click save
* Copy and Paste the shortcode of the calculator where you want it to be
* If you want it to appear everywhere on your site, you can insert it for example in your `header.php`, like this: `<?php echo do_shortcode('[Calculator id=1]');?>`

== Screenshots ==
1. Admin - calculators list
2. Admin - add fields to the calculator form
3. Admin - calculator builder live preview
4. Admin - add the formula for calculator
5. Frontend - calculator on frontend

== Changelog ==
= 1.3 =
* Added: possibility resize the form in admin
* Fixed: the radio field was omitted in variable field[]
* Fixed: checkbox value was sting. Change on number.
* Fixed: checkbox value get when the checkbox checked, other = 0;

= 1.2 =
* Added: includes JS and CSS files
* Added: support RTL
* Added: minification script and style


= 1.1 =
* Added: option for calculation when form load
* Added: variables: fieldset, label, field
* Added: custom functions: hide, show, addClass, removeClass

= 1.0 =
* Added: button 'New' in page created the calculator
* Changed: create calculator without the button 'Calculate'
* Fixed: selected current tag in filter
* Fixed: item count in List table

= 0.4.3 =
* Fixed: Obfuscation function

= 0.4.2 =
* Fixed: saving parameters in database

= 0.4.1 =
* Fixed: show calculator on page, custom post

= 0.4 =
* Added: New Fields type: Textarea and Input
* Added: new types to Result: HTML block and textarea
* Added: tag for calculator
* Added: function for copy shortcode
* Improvement: plugin admin style

= 0.3.5 =
* Fixed: function roundVal

= 0.3.4 =
* Fixed: minor bug

= 0.3.3 =
* Fixed: builder options 'addon' and 'required'
* Fixed: minor bug

= 0.3.2 =
* Added: option 'obfuscation';

= 0.3.1 =
* Added: the ability to add more than one calculator per page
* Improvement: the work of scripts on the page

= 0.3 =
* Added: New fields: Title, Separator
* Added: function for Export/Import calculators
* Added: Documentation page
* Added: Changelog page
* Fixed: saving calculators with conditional symbols

= 0.2 =
* Updated: file for translate .po
* Added: link to the Documantation

= 0.1 =
* Initial release