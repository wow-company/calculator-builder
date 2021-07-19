<?php


/**
 * Notification script generation
 *
 * @package     WP_Plugin
 * @copyright   Copyright (c) 2018, Dmytro Lobov
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$script = "
'use strict';

const calc = document.querySelectorAll('.formbox');

calc.forEach((form) => {
  let btn_calc = form.querySelector('.formbox__btn-calc');
  btn_calc.addEventListener('click', {handleEvent: calculate, form: form});
  form.addEventListener('reset', calcReset);
  form.addEventListener('change', {handleEvent: calculate, form: form});
});


function calculate(event) {
  event.preventDefault();

  const fields = this.form.querySelectorAll('[name^=\"formbox-field-\"]');
  
  for (let i = 0; i < fields.length; i++) {
    if (fields[i].hasAttribute('required')) {
      if (fields[i].value == '') {
        fields[i].focus({preventScroll: false});
        return false;
      }
    }
  }
  
  let x = [];

  for (let i = 0; i < fields.length; i++) {
    let element = fields[i].getAttribute('name');
    let el = element.split('-');
    x[el[2]] = 0;
  }

  const formData = new FormData(this.form);
  for (let pair of formData.entries()) {
    let element = pair[0];
    let el = element.split('-');
    x[el[2]] = parseFloat(pair[1]);
  }

  const results = this.form.querySelectorAll('.formbox__field-result');

  let y = [];
";

$script .= wp_specialchars_decode($formula, ENT_QUOTES);

$script .= "
for (let i = 1; i < y.length; i++) {
    let key = i - 1;
    results[key].value = y[i];
    toggleResults(this.form, 'remove');
  }

}

function toggleResults(form, action) {
  let results = form.querySelectorAll('.formbox__container.has-result');
  if (results) {
    results.forEach((el) => {
      if (action === 'remove') {
        el.classList.remove('is-hidden');
      } else {
        el.classList.add('is-hidden');
      }
    });
  }
}

function calcReset() {
  toggleResults(this, 'add');
}

function roundVal(val, decima = '2') {
  let decimal = Math.pow(10, parseInt(decima));
  return Math.round(val * decimal) / decimal;
}
";