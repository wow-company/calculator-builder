/*! ========= INFORMATION ============================
	- author:    CalcHub
	- url:       https://calchub.xyz
	- plugin:    https://wordpress.org/plugins/calculator-builder/
==================================================== */

'use strict';

const CalculatorBuilder = function () {

    const calc = document.querySelectorAll('.formbox');

    calc.forEach((form) => {
        let btn_calc = form.querySelector('.formbox__btn-calc');

        if (btn_calc) {
            btn_calc.addEventListener('click', {handleEvent: calculate, form: form});
        }
        const defaultForm = new FormData(form);
        form.addEventListener('reset', {handleEvent: calcReset, form: form, data: defaultForm});

        let calc_reset = form.querySelector('.calc-reset');
        if (calc_reset) {
            form.addEventListener('change', {handleEvent: hideResult, form: form});
        } else {
            form.addEventListener('change', {handleEvent: calculate, form: form});
        }


        let load_calc = form.querySelector('.calc-load');
        if (load_calc) {
            window.addEventListener('load', {handleEvent: calculate, form: form});
        }
        window.addEventListener('load', {handleEvent: conditions, form: form});

    });

    function getFieldsets(form) {
        let fieldset = [];
        const fieldsets = form.querySelectorAll('fieldset');
        for (let i = 0; i < fieldsets.length; i++) {
            let order = i + 1;
            fieldset[order] = fieldsets[i];
        }
        return fieldset;
    }

    function getLabels(form) {
        let label = [];
        const labels = form.querySelectorAll('.formbox__title');
        for (let i = 0; i < labels.length; i++) {
            let order = i + 1;
            label[order] = labels[i];
        }
        return label;
    }

    function getFields(form) {
        const fieldAll = form.querySelectorAll('[name^="formbox-field-"], button');
        let field = [];
        for (let i = 0; i < fieldAll.length; i++) {
            let order = i + 1;
            field[order] = fieldAll[i];
        }
        return field;
    }

    function getInputData(form, formData) {
        let input = [];

        const fields = form.querySelectorAll('[name^="formbox-field-"]');

        for (let pair of formData.entries()) {
            let element = pair[0];
            let el = element.split('-');
            input[el[2]] = parseFloat(pair[1]);
        }

        for (let i = 0; i < fields.length; i++) {
            if (fields[i].tagName.toLowerCase() === 'textarea') {
                let element = fields[i].getAttribute('name');
                let el = element.split('-');
                input[el[2]] = fields[i].value;
            }
            if (fields[i].tagName.toLowerCase() === 'input' && fields[i].getAttribute('type') !== 'number' &&
                fields[i].getAttribute('type') !== 'radio') {
                let element = fields[i].getAttribute('name');
                let el = element.split('-');
                input[el[2]] = fields[i].value;
            }

            if (fields[i].tagName.toLowerCase() === 'input' && fields[i].getAttribute('type') === 'checkbox') {
                let element = fields[i].getAttribute('name');
                let el = element.split('-');
                if (fields[i].checked) {
                    input[el[2]] = parseFloat(fields[i].value);
                } else {
                    input[el[2]] = 0;
                }

            }
        }

        return input;

    }

    function hideResult(form) {
        toggleResults(this.form, 'add');
    }

    function calculate(event) {
        event.preventDefault();

        const form = this.form;

        const label = getLabels(this.form);
        const fieldset = getFieldsets(this.form);
        const field = getFields(this.form);
        const formData = new FormData(this.form);
        let x = getInputData(this.form, formData);
        let y = window[this.form.id](x, fieldset, field, label, form);
        if (typeof y === 'string') {
            tooggleAlert(form, 'show', y);
            toggleResults(form, 'add');
            return false;
        }
        tooggleAlert(form, 'hide');

        const fields = this.form.querySelectorAll('[name^="formbox-field-"]');

        for (let i = 0; i < fields.length; i++) {
            if (fields[i].hasAttribute('required')) {
                if (fields[i].value === '') {
                    fields[i].focus({preventScroll: false});
                    return false;
                }
            }
        }

        const results = this.form.querySelectorAll('.formbox__field-result');

        for (let i = 1; i < y.length; i++) {

            let key = i - 1;
            let element = results[key];

            if (element.tagName.toLowerCase() === 'input' || element.tagName.toLowerCase() === 'textarea') {
                element.value = y[i];
            }

            if (element.tagName.toLowerCase() === 'textarea' && element.hasAttribute('hidden')) {
                element.nextElementSibling.innerHTML = y[i];
            }

            toggleResults(this.form, 'remove');
        }

    }

    function conditions(event) {
        event.preventDefault();
        const label = getLabels(this.form);
        const fieldset = getFieldsets(this.form);
        const field = getFields(this.form);
        const formData = new FormData(this.form);
        let x = getInputData(this.form, formData);
        window[this.form.id](x, fieldset, field, label);
    }

    function calcReset() {
        toggleResults(this.form, 'add');
        const label = getLabels(this.form);
        const fieldset = getFieldsets(this.form);
        const field = getFields(this.form);
        let x = getInputData(this.form, this.data);
        window[this.form.id](x, fieldset, field, label);
        tooggleAlert(this.form, 'hide');
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

    Element.prototype.hide = function () {
        this.classList.add('is-hidden');
    };

    Element.prototype.show = function () {
        this.classList.remove('is-hidden');
    };

    Element.prototype.addClass = function (cls) {
        this.classList.add(cls);
    };

    Element.prototype.removeClass = function (cls) {
        this.classList.remove(cls);
    };

    Element.prototype.addAttr = function (name, value) {
        name = (name) ? name : '';
        value = (value) ? value : '';
        this.setAttribute(name, value);
    };

    Element.prototype.removeAttr = function (name) {
        name = (name) ? name : '';
        this.removeAttribute(name);
    };

    Element.prototype.text = function (value) {
        value = (value) ? value : '';
        this.innerText = value;
    };

    Number.prototype.round = function (n = '2') {
        const decimal = Math.pow(10, parseInt(n));
        return Math.round(this * decimal) / decimal;
    };

    function tooggleAlert(form, action, value = '') {
        const fieldset = form.querySelector('.has-alert');
        if (action === 'hide' && fieldset) {
            fieldset.classList.add('is-hidden');
            const field = fieldset.querySelector('.formbox__field-alert');
            field.innerHTML = '';
        } else if (action === 'show' && fieldset) {
            const field = fieldset.querySelector('.formbox__field-alert');
            fieldset.classList.remove('is-hidden');
            field.innerHTML = value;
        }

    }

};

document.addEventListener('DOMContentLoaded', function () {
    new CalculatorBuilder();
});

const roundVal = (val, decima = '2') => {
    const decimal = Math.pow(10, parseInt(decima));
    return Math.round(val * decimal) / decimal;
};

function checkCalcVariable(y, alert) {
    if (alert !== '') {
        return alert;
    } else {
        return y;
    }
}