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


The calculator has variables for calculating and results:

* x[] - uses for calculate
* y[] - uses for results

### Equation / Formula Format For Calculated

```
y[1] = x[1] + x[2];

y[1] = x[1] - x[2];

y[1] = x[1] * x[2];

y[1] = x[1] / x[2];
```

Also you can round the result uses the function roundVal(val, decimal), where:

* val = value or expression;
* decimal = a number of simbols after comma/dot

For Example, rounding expression to 2 decimal places
```
y[1] = roundVal( x[1] / x[2], 2);
```

You can use complex structures to calculate the results.

```
if( x[1] < 100 ) {
	y[1] = x[2] * 2;
} else if ( x[1] < 200 ) {
	y[1] = x[2] * 3;
} else {
	y[1] = x[2] * 4;
}
```

To improve the plugin's functions and add new functions, write to us on the support [forum](https://wordpress.org/support/plugin/calculator-builder/) or send requests on the [github](https://github.com/wow-company/calculator-builder/issues).

Project on github [https://github.com/wow-company/calculator-builder/](https://github.com/wow-company/calculator-builder/issues)