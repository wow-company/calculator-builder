'use strict';

document.addEventListener('DOMContentLoaded', function () {

    const calc = document.querySelectorAll('.formbox');

    calc.forEach((form) => {
        let btn_calc = form.querySelector('.formbox__btn-calc');
        btn_calc.addEventListener('click', {handleEvent: calculate, form: form});
        form.addEventListener('reset', calcReset);
        form.addEventListener('change', {handleEvent: calculate, form: form});
    });

    function calculate(event) {
        event.preventDefault();

        const fields = this.form.querySelectorAll('[name^="formbox-field-"]');

        for (let i = 0; i < fields.length; i++) {
            if (fields[i].hasAttribute('required')) {
                if (fields[i].value == '') {
                    fields[i].focus({preventScroll: false});
                    return false;
                }
            }
        }

        let x = [];

        const formData = new FormData(this.form);


        for (let pair of formData.entries()) {
            let element = pair[0];
            let el = element.split('-');
            x[el[2]] = parseFloat(pair[1])

        }

        for (let i = 0; i < fields.length; i++) {
            if (fields[i].tagName.toLowerCase() === 'textarea') {
                let element = fields[i].getAttribute('name');
                let el = element.split('-');
                x[el[2]] = fields[i].value;
            }
            if (fields[i].tagName.toLowerCase() === 'input' && fields[i].getAttribute('type') !== 'number' && fields[i].getAttribute('type') !== 'radio') {
                let element = fields[i].getAttribute('name');
                let el = element.split('-');
                x[el[2]] = fields[i].value;
            }
        }


        const results = this.form.querySelectorAll('.formbox__field-result');

        let y = window[this.form.id](x);

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

});

const roundVal = (val, decima = '2') => {
    const decimal = Math.pow(10, parseInt(decima));
    return Math.round(val * decimal) / decimal;
};

