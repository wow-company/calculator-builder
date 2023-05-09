'use strict';

document.addEventListener('DOMContentLoaded', function () {


    jQuery('#calculator').sortable({
        appendTo: document.body,
        cursor: 'move',
        update: function (event, ui) {
            Field.setAttributes();
            Variables.start();
            Field.removeTagStyle();
        },
    });

    const calcBuild = document.getElementById('calculator');
    const box = document.querySelector('#field-number');

    const elements = {
        calc: calcBuild,
        box: box,
        boxTitle: box.querySelector('.lightbox-title'),
        boxClose: box.querySelector('.lightbox-close'),
        form: box.querySelector('#form-params'),
        fieldType: box.querySelector('#form-type'),
        fields: {
            input: box.querySelector('.field-type-input'),
            required: box.querySelector('.type-required'),
            result: box.querySelector('.field-type-result'),
            title: box.querySelector('.field-title'),
            addon: box.querySelector('.field-addon'),
            number: box.querySelector('.fields-number'),
            options: box.querySelector('.fields-options'),
            button: box.querySelector('.fields-button'),
            font: box.querySelector('.fields-font'),
            spacer: box.querySelector('.fields-spacer'),
            holder: box.querySelector('.field-holder'),

        },
    };

    class Variables {

        static start() {
            Variables.createXY();
            Variables.createLabel();
            Variables.createFields();
            Variables.createFieldsets();
            Variables.createAlerts();

        }

        static createXY() {
            const fields = document.querySelectorAll('#calculator .formbox__field');

            let variables = '';
            let result = 1;
            if (fields.length < 1) {
                return;
            }
            for (let i = 1; i <= fields.length; i++) {
                if (fields[i - 1].classList.contains('is-result')) {
                    variables += '<span class="variable is-result">y[' + result + ']</span>';
                    result++;
                } else {
                    variables += '<span class="variable">x[' + i + ']</span>';
                }
            }

            document.getElementById('variables').innerHTML = variables;
            document.getElementById('variables-bottom').innerHTML = variables;
            document.querySelector('.variables-bottom').classList.remove('is-hidden');
            const vars = document.querySelectorAll('#variables .variable');
            Variables.hover(vars, fields);
            const varsBottom = document.querySelectorAll('#variables-bottom .variable');
            Variables.hover(varsBottom, fields);
        }

        static createLabel() {
            const labels = document.querySelectorAll('#calculator .formbox__title');
            let label = '';
            if (labels.length < 1) {
                return;
            }
            for (let i = 1; i <= labels.length; i++) {
                label += '<span class="calc-label">label[' + i + ']</span>';
            }

            document.getElementById('calc-label-bottom').innerHTML = label;
            document.querySelector('.calc-label-bottom').classList.remove('is-hidden');
            let vars = document.querySelectorAll('#calc-label-bottom .calc-label');
            Variables.hover(vars, labels);
        }

        static createFields() {
            const fieldAll = document.querySelectorAll('#calculator [name^="formbox-field-"], #calculator button');
            let fieldsEl = '';

            if (fieldAll.length < 1) {
                return;
            }
            for (let i = 1; i <= fieldAll.length; i++) {
                fieldsEl += '<span class="calc-field">field[' + i + ']</span>';
            }

            document.getElementById('calc-field-bottom').innerHTML = fieldsEl;
            document.querySelector('.calc-field-bottom').classList.remove('is-hidden');
            const vars = document.querySelectorAll('#calc-field-bottom .calc-field');
            Variables.hover(vars, fieldAll);

        }

        static createFieldsets() {

            const fieldsets = document.querySelectorAll('#calculator fieldset');
            let fieldset = '';

            if (fieldsets.length < 1) {
                return;
            }

            for (let i = 1; i <= fieldsets.length; i++) {
                fieldset += '<span class="calc-fieldset">fieldset[' + i + ']</span>';
            }

            document.getElementById('calc-fieldset-bottom').innerHTML = fieldset;
            document.querySelector('.calc-fieldset-bottom').classList.remove('is-hidden');
            const vars = document.querySelectorAll('#calc-fieldset-bottom .calc-fieldset');
            Variables.hover(vars, fieldsets);
        }

        static createAlerts() {
            const fieldsets = document.querySelector('#calculator fieldset.has-alert');
            let fieldset = '';
            if(fieldsets) {
                fieldset += '<span class="variable calc-alert">calcAlert = "";</span>';
            }

            document.getElementById('calc-alert-bottom').innerHTML = fieldset;
        }

        static hover(variables, fields) {

            variables.forEach((el, index) => {
                el.addEventListener('mouseover', () => {
                    fields[index].style.boxShadow = '0 0 10px 5px red';
                });
            });

            variables.forEach((el, index) => {
                el.addEventListener('mouseout', () => {
                    fields[index].style.boxShadow = 'none';
                });
            });
        }


    }

    class Field {
        constructor(elements) {
        }

        run() {
            elements.form.addEventListener('submit', this.create);
        }

        create(event) {
            event.preventDefault();

            const param = Field.getParams(this);
            const classes = param.extraClasses;
            const class_group = (param.type === 'number-select') ? ' has-group' : '';
            const class_result = (param.type === 'result') ? ' has-result' : '';
            const class_alert = (param.type === 'alert') ? ' has-alert' : '';
            let content = '';

            if (param.type === 'title') {
                content += Field.title(param);
            } else if (param.type === 'separator') {
                content += Field.separator(param);
            } else if (param.type === 'spacer') {
                content += Field.spacer(param);
            } else {

                content += `<div class="formbox__title">${param.title}</div>`;
                content += `<div class="formbox__body${class_group}">`;

                switch (param.type) {
                    case 'number':
                        content += Field.number(param);
                        break;
                    case 'select':
                        content += Field.select(param);
                        break;
                    case 'radio':
                        content += Field.radio(param);
                        break;
                    case 'checkbox':
                        content += Field.checkbox(param);
                        break;
                    case 'number-select':
                        content += Field.number(param);
                        content += Field.select(param);
                        break;
                    case 'buttons':
                        content += Field.button(param);
                        break;
                    case 'result':
                        content += Field.result(param);
                        break;
                    case 'textarea':
                        content += Field.textarea(param);
                        break;
                    case 'input':
                        content += Field.input(param);
                        break;
                    case 'range':
                        content += Field.range(param);
                        break;
                    case 'alert':
                        content += Field.alert(param);
                        break;

                }

                content += '</div>';

            }

            content += `<div class="action-elements">
                <span class="delete">&times;</span>
                <a href="#field-number" class="edit">&#9998;</a>
              </div>`;


            let dataVal = elements.form.getAttribute('data-field-index');

            if (dataVal === '') {
                let out = `<fieldset class="formbox__container${class_result}${class_alert} ${classes}">${content}</fieldset>`;
                elements.calc.insertAdjacentHTML('beforeend', out);
            } else {
                dataVal = Number(dataVal);
                let allContainer = document.querySelectorAll('.formbox__container');

                allContainer[dataVal].className = '';
                allContainer[dataVal].classList.add('formbox__container', 'ui-sortable-handle');
                if (class_result !== '') {
                    allContainer[dataVal].classList.add(class_result.trim());
                }
                if(class_alert !== '') {
                    allContainer[dataVal].classList.add(class_alert.trim());
                }
                let extraClasses = classes.split(' ');
                if (extraClasses.length > 0) {
                    for (let i = 0; i < extraClasses.length; i++) {
                        if (extraClasses[i] !== '') {
                            allContainer[dataVal].classList.add(extraClasses[i].trim());
                        }
                    }
                }
                allContainer[dataVal].innerHTML = content;
            }
            elements.boxClose.click();
            Field.setAttributes();
            Variables.start();
        }

        static title(param) {
            let content = '';
            const size = (param.titleSize !== '') ? 'font-size:' + param.titleSize + 'px;' : '';
            const weight = (param.titleWeight !== '') ? 'font-weight:' + param.titleWeight + ';' : '';
            content += `<div class="formbox__title is-title-only" style="${size}${weight}">${param.title}</div>`;
            return content;
        }

        static separator(param) {
            return '<hr/>';
        }

        static spacer(param) {
            const height = (param.spacerHeight !== '') ? 'height:' + param.spacerHeight + 'px;' : '';
            return `<div class="formbox__title is-spaсe" style="${height}"></div>`;
        }

        static number(param) {
            const step = (param.step !== '') ? ' step="' + param.step + '"' : '';
            const min = (param.min !== '') ? ' min="' + param.min + '"' : '';
            const max = (param.max !== '') ? ' max="' + param.max + '"' : '';
            const required = (param.required === '1') ? ' has-required' : '';
            const placeholder = (param.placeholder !== '') ? ' placeholder="' + param.placeholder + '"' : '';
            const option = `value="${param.value}"${step}${min}${max}${required}${placeholder}`;
            const has_addon = (param.addon !== '') ? ' has-addon is-' + param.addon_pos : '';
            let content = `<div class="formbox__field${has_addon}">`;
            if (param.addon !== '') {
                content += `<span class="formbox__field-addon">${param.addon}</span>`;
            }
            content += `<label class="formbox__field-lable">${param.title}</label>`;
            content += `<input type="number" class="formbox__field-input" ${option}>`;
            content += '</div>';

            return content;
        }

        static select(param) {
            let content = '<div class="formbox__field">';
            content += `<label class="formbox__field-lable">${param.title}</label>`;
            content += '<select class="formbox__field-select">';
            if (param.options) {
                let arr = param.options.split('\n');
                for (let i = 0; i < arr.length; i++) {
                    let option = Field.getOptions(arr[i]);
                    if (option !== '') {
                        let selSelected = (option.selected !== '') ? ' selected="selected"' : '';
                        content += '<option value="' + option.val + '"' + selSelected + '>' + option.name + '</option>';
                    }
                }
            }
            content += '</select></div>';
            return content;
        }

        static radio(param) {
            let content = '<div class="formbox__field">';
            if (param.options) {
                let arr = param.options.split('\n');
                for (let i = 0; i < arr.length; i++) {
                    let option = Field.getOptions(arr[i]);
                    if (option !== '') {
                        let checked = (option.selected === ' selected') ? ' checked="checked"' : '';
                        content += '<div class="formbox__field-radio">';
                        content += '<input type="radio" value="' + option.val + '"' + checked + '>';
                        content += '<label>' + option.name + '</label>';
                        content += '</div>';
                    }
                }
            }
            content += '</div>';
            return content;
        }

        static checkbox(param) {
            let content = '';
            if (param.options) {
                let arr = param.options.split('\n');
                for (let i = 0; i < arr.length; i++) {
                    let option = Field.getOptions(arr[i]);
                    if (option !== '') {
                        let checked = (option.selected === ' selected') ? ' checked="checked"' : '';
                        content += '<div class="formbox__field">';
                        content += '<div class="formbox__field-checkbox">';
                        content += '<input type="checkbox" value="' + option.val + '"' + checked + '>';
                        content += '<label>' + option.name + '</label>';
                        content += '</div>';
                        content += '</div>';
                    }
                }
            }

            return content;
        }

        static button(param) {
            let content = '<div class="formbox__btn">';
            content += `<button class="formbox__btn-calc">${param.calculate}</button>`;
            content += `<button type="reset" class="formbox__btn-reset">${param.reset}</button>`;
            content += '</div>';
            return content;
        }

        static result(param) {

            if (param.result_field === '1') {

                const has_addon = (param.addon !== '') ? ' has-addon is-' + param.addon_pos : '';

                let content = `<div class="formbox__field is-result${has_addon}">`;
                if (param.addon !== '') {
                    content += `<span class="formbox__field-addon">${param.addon}</span>`;
                }
                content += `<label class="formbox__field-lable">${param.title}</label>`;
                content += `<input type="text" class="formbox__field-result" readonly>`;
                content += '</div>';
                return content;
            } else if (param.result_field === '2') {
                let content = `<div class="formbox__field is-result">`;
                content += `<label class="formbox__field-lable">${param.title}</label>`;
                content += `<textarea class="formbox__field-result" readonly></textarea>`;
                content += '</div>';
                return content;
            } else {
                let content = `<div class="formbox__field is-result">`;
                content += `<label class="formbox__field-lable">${param.title}</label>`;
                content += `<textarea class="formbox__field-result" readonly hidden></textarea>`;
                content += `<div class="formbox__htmlBlock-result"></div>`;
                content += '</div>';
                return content;
            }
        }

        static textarea(param) {
            const required = (param.required === '1') ? ' has-required' : ''
            const placeholder = (param.placeholder !== '') ? ' placeholder="' + param.placeholder + '"' : '';
            let content = `<div class="formbox__field">`;
            content += `<label class="formbox__field-lable">${param.title}</label>`;
            content += `<textarea class="formbox__field-textarea" ${required}${placeholder}></textarea>`;
            content += '</div>';
            return content;
        }

        static input(param) {
            const required = (param.required === '1') ? ' has-required' : ''
            const placeholder = (param.placeholder !== '') ? ' placeholder="' + param.placeholder + '"' : '';
            let content = `<div class="formbox__field">`;
            content += `<label class="formbox__field-lable">${param.title}</label>`;
            content += `<input type="${param.input_field_type}" class="formbox__field-text" ${required}${placeholder}>`;
            content += '</div>';
            return content;
        }

        static range(param) {
            const step = (param.step !== '') ? ' step="' + param.step + '"' : '';
            const min = (param.min !== '') ? ' min="' + param.min + '"' : '';
            const max = (param.max !== '') ? ' max="' + param.max + '"' : '';
            const option = `value="${param.value}"${step}${min}${max}`;
            let content = `<div class="formbox__field">`;
            content += `<label class="formbox__field-lable">${param.title}</label>`;
            const marker_id = Field.getRandomInt(10, 1000);
            let marker = (param.options) ? ' list="markers_' + marker_id + '"' : '';
            content += `<input type="range" class="formbox__field-range" ${option}${marker}>`;
            if (param.options) {
                content += `<datalist id="markers_${marker_id}" class="field-range-text">`;
                let arr = param.options.split('\n');
                for (let i = 0; i < arr.length; i++) {
                    let option = Field.getOptions(arr[i]);
                    if (option !== '') {
                        content += `<option value="${option.val}" label="${option.name}">${option.name}</option>`;
                    }
                }
                content += '</datalist>';
            }
            content += '</div>';

            return content;
        }

        static alert(param) {
            let content = '<div class="formbox__field-alert">';
            content += '</div>';
            return content;
        }

        static getParams(form) {
            const data = new FormData(form);
            let params = {};
            for (let pair of data.entries()) {
                params[pair[0]] = pair[1];
            }

            return params;
        }

        static getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        static setAttributes() {
            const fields = document.querySelectorAll('.formbox__field');

            fields.forEach((field, index, array) => {
                let radioFields = field.querySelectorAll('.formbox__field-radio');
                let order = index + 1;
                if (radioFields.length > 0) {
                    radioFields.forEach((field, index) => {
                        let radio = field.querySelector('input');
                        radio.setAttribute('name', 'formbox-field-' + order);
                        radio.setAttribute('id', 'formbox-field-' + order + '_' + (index + 1));
                        field.querySelector('label').setAttribute('for', 'formbox-field-' + order + '_' + (index + 1));
                    });
                } else {
                    let selectField = field.querySelector('select');
                    let inputField = field.querySelector('input');
                    let textareaField = field.querySelector('textarea');
                    let labelField = field.querySelector('label');
                    if (selectField) {
                        selectField.setAttribute('name', 'formbox-field-' + order);
                        selectField.setAttribute('id', 'formbox-field-' + order);
                    }
                    if (inputField) {
                        inputField.setAttribute('name', 'formbox-field-' + order);
                        inputField.setAttribute('id', 'formbox-field-' + order);
                    }
                    if (labelField) {
                        labelField.setAttribute('for', 'formbox-field-' + order);
                    }
                    if (textareaField) {
                        textareaField.setAttribute('name', 'formbox-field-' + order);
                        textareaField.setAttribute('id', 'formbox-field-' + order);
                    }
                }

            });

        }

        static removeTagStyle() {
            const containers = document.querySelectorAll('.formbox__container');
            containers.forEach(container => {
                container.removeAttribute('style');
            });
        }

        static getOptions(pars) {
            let option = {};
            let elem = pars.split(' = ');
            if (elem.length < 2) return '';
            option['name'] = elem[0].toString().trim();
            option ['selected'] = (String(elem[1]).includes('*')) ? ' selected' : '';
            option ['val'] = parseFloat(elem[1]) || 0;
            return option;
        }
    }

    class Actions {

        constructor(elements) {
            this.start();
        }

        start() {
            document.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('delete')) {
                    Actions.removeField(e.target);
                } else if (e.target && e.target.classList.contains('edit')) {
                    e.preventDefault();
                    Actions.updateField(e.target);
                } else if (e.target && e.target.classList.contains('variable') ||
                    e.target.classList.contains('variable', 'is-result') ||
                    e.target.classList.contains('operator') || e.target.classList.contains('calc-fieldset') ||
                    e.target.classList.contains('calc-field') || e.target.classList.contains('calc-label')) {
                    Actions.insertTextAtCursor(e.target.innerText);
                }
            });
        }

        static removeField(element) {
            const parent = element.closest('.formbox__container');
            parent.remove();
            Field.setAttributes();
            Variables.start();
        }

        static insertTextAtCursor(text) {
            const editor = document.querySelector('.CodeMirror').CodeMirror;
            const doc = editor.getDoc();
            const cursor = doc.getCursor();
            doc.replaceRange(text, cursor);
            editor.focus();
        }

        static updateField(element) {
            elements.box.showModal();
            const parent = element.closest('.formbox__container');
            let allContainer = document.querySelectorAll('.formbox__container');
            allContainer.forEach((container, index) => {
                if (container === parent) {
                    Actions.getParam(container, index);
                }
            });
        }

        static getParam(container, index) {
            let type;

            elements.form.setAttribute('data-field-index', index);
            elements.form.classList.add('is-field-update');
            elements.boxTitle.innerText = 'Update Field';

            if (container.classList.contains('has-result')) {
                type = 'result';
            } else if(container.classList.contains('has-alert')) {
                type = 'alert';
            } else if (container.querySelector('.has-group')) {
                type = 'number-select';
            } else if (container.querySelector('input[type="number"]')) {
                type = 'number';
            } else if (container.querySelector('input[type="range"]')) {
                type = 'range';
            } else if (container.querySelector('select')) {
                type = 'select';
            } else if (container.querySelector('.formbox__field-checkbox')) {
                type = 'checkbox';
            } else if (container.querySelector('.formbox__field-radio')) {
                type = 'radio';
            } else if (container.querySelector('.is-title-only')) {
                type = 'title';
            } else if (container.querySelector('hr')) {
                type = 'separator';
            } else if (container.querySelector('.is-spaсe')) {
                type = 'spacer';
            } else if (container.querySelector('textarea')) {
                type = 'textarea';
            } else if (container.querySelector('.formbox__field-text')) {
                type = 'input';
                let inputType = container.querySelector('.formbox__field input').getAttribute('type');

                if (inputType) {
                    elements.form.querySelector('[name="input_field_type"]').value = inputType;
                }
            } else {
                type = 'buttons';
            }

            let title = container.querySelector('.formbox__title').innerHTML;
            let val = container.querySelector('.formbox__field input[type="number"]');
            val = (val) ? val.value : '';
            let addon = container.querySelector('.formbox__field-addon');
            addon = (addon) ? addon.innerHTML : '';
            let addon_pos = 'right';

            let step = container.querySelector('.formbox__field input[type="number"]');
            step = (step) ? step.getAttribute('step') : '';

            let min = container.querySelector('.formbox__field input[type="number"]');
            min = (min) ? min.getAttribute('min') : '';

            let max = container.querySelector('.formbox__field input[type="number"]');
            max = (max) ? max.getAttribute('max') : '';

            let options = '';

            if (type === 'range') {

                let rangeVal = container.querySelector('.formbox__field input[type="range"]');
                val = (rangeVal) ? rangeVal.value : '';

                let rangeStep = container.querySelector('.formbox__field input[type="range"]');
                step = (rangeStep) ? rangeStep.getAttribute('step') : '';

                let rangeMin = container.querySelector('.formbox__field input[type="range"]');
                min = (rangeMin) ? rangeMin.getAttribute('min') : '';

                let rangeMax = container.querySelector('.formbox__field input[type="range"]');
                max = (rangeMax) ? rangeMax.getAttribute('max') : '';

                const rangeList = container.querySelector('datalist');
                if (rangeList) {
                    const rangeOption = rangeList.querySelectorAll('option');
                    if (rangeOption.length > 0) {
                        for (let i = 0; i < rangeOption.length; i++) {
                            options += rangeOption[i].text + ' = ' + rangeOption[i].value + '\n';
                        }
                    }
                }

            }

            let placeholder;
            if (type === 'number' || type === 'number-select') {
                placeholder = container.querySelector('.formbox__field input[type="number"]');
            } else if (type === 'textarea') {
                placeholder = container.querySelector('.formbox__field textarea');
            } else if (type === 'input') {
                placeholder = container.querySelector('.formbox__field input');
            }

            if (placeholder && placeholder.hasAttribute('placeholder')) {
                elements.form.querySelector('[name="placeholder"]').value = placeholder.getAttribute('placeholder');
            } else {
                elements.form.querySelector('[name="placeholder"]').value = '';
            }


            if (type === 'number' || type === 'number-select') {

                let required = container.querySelector('.formbox__field input[type="number"]');
                if (required) {
                    elements.form.querySelector('[name="required"]').checked = required.hasAttribute('has-required');
                }
            }

            if (type === 'input') {
                let required = container.querySelector('.formbox__field input');
                if (required) {
                    elements.form.querySelector('[name="required"]').checked = required.hasAttribute('has-required');
                }
            }

            if (type === 'textarea') {
                let required = container.querySelector('.formbox__field textarea');
                if (required) {
                    elements.form.querySelector('[name="required"]').checked = required.hasAttribute('has-required');
                }
            }


            let calc = container.querySelector('.formbox__btn-calc');
            calc = (calc) ? calc.innerText : '';

            let reset = container.querySelector('.formbox__btn-reset');
            reset = (reset) ? reset.innerText : '';


            const checkbox = container.querySelectorAll('.formbox__field-checkbox, .formbox__field-radio');

            if (0 < checkbox.length) {
                checkbox.forEach(el => {
                    let check_val, check_selected, check_label;
                    check_val = el.querySelector('input').value || 0;
                    check_selected = el.querySelector('input').getAttribute('checked') || '';
                    check_label = el.querySelector('label').innerText || '';
                    let checked = (check_selected !== '') ? '*' : '';
                    options += check_label + ' = ' + check_val + checked + '\n';
                });
            }

            const select = container.querySelector('select');
            if (select) {
                if (select.length > 0) {
                    for (let i = 0; i < select.length; i++) {
                        let check_selected = select[i].getAttribute('selected') || '';
                        let checked = (check_selected !== '') ? '*' : '';
                        options += select[i].text + ' = ' + select[i].value + checked + '\n';
                    }
                }
            }

            const has_addon = container.querySelector('.formbox__field.has-addon');
            if (has_addon && has_addon.classList.contains('is-left')) {
                addon_pos = 'left';
            }

            elements.form.querySelector('[name="type"]').value = type;

            const changeType = new Builder(elements);
            changeType.changeFieldsType();

            elements.form.querySelector('[name="title"]').value = title;
            elements.form.querySelector('[name="addon"]').value = addon;
            elements.form.querySelector('[name="addon_pos"]').value = addon_pos;
            elements.form.querySelector('[name="value"]').value = val;
            elements.form.querySelector('[name="step"]').value = step;
            elements.form.querySelector('[name="min"]').value = min;
            elements.form.querySelector('[name="max"]').value = max;
            elements.form.querySelector('[name="options"]').value = options;
            elements.form.querySelector('[name="calculate"]').value = calc;
            elements.form.querySelector('[name="reset"]').value = reset;

            let extraClasses = '';
            const classes = container.classList;
            if (classes.length > 0) {
                for (let i = 0; i < classes.length; i++) {
                    if (classes[i] !== 'formbox__container' && classes[i] !== 'ui-sortable-handle' && classes[i] !== 'has-result' && classes[i] !== 'has-alert') {
                        extraClasses += classes[i];
                        extraClasses += ' ';
                    }
                }
            }

            elements.form.querySelector('[name="extraClasses"]').value = extraClasses;

        }


    }

    new Actions(elements);

    class Builder {

        constructor(elements) {
            this.run();
            Variables.start();
        }

        run() {
            this.changeFieldsType();
            elements.fieldType.addEventListener('change', this.changeFieldsType);
            document.querySelector('.btn-add-new-field').addEventListener('click', this.changeBox);
            elements.boxClose.addEventListener('click', this.closeBox);

            const fields = new Field(elements);
            fields.run();
        }

        // Hide/Show the Element in dependence field type
        changeFieldsType() {
            const el = elements;
            const els = el.fields;
            Builder.hideElements(els.input, els.required, els.result, els.title, els.addon, els.number, els.options, els.button, els.font, els.spacer, els.holder);

            const type = el.fieldType.value;


            switch (type) {
                case 'number':
                    Builder.showElements(els.required, els.title, els.addon, els.number, els.holder);
                    break;
                case 'select':
                case 'radio':
                case 'checkbox':
                    Builder.showElements(els.title, els.options);
                    break;
                case 'number-select':
                    Builder.showElements(els.required, els.title, els.addon, els.number, els.options, els.holder);
                    break;
                case 'buttons':
                    Builder.showElements(els.title, els.button);
                    break;
                case 'result':
                    Builder.showElements(els.result, els.title, els.addon);
                    break;
                case 'title':
                    Builder.showElements(els.title, els.font);
                    break;
                case 'spacer':
                    Builder.showElements(els.spacer);
                    break;
                case 'textarea':
                    Builder.showElements(els.title, els.holder, els.required);
                    break;
                case 'input':
                    Builder.showElements(els.required, els.title, els.input, els.holder);
                    break;
                case 'range':
                    Builder.showElements(els.title, els.number, els.options);
                    break;
                case 'alert':
                    Builder.showElements(els.title);
                    break;
            }

        }

        changeBox(e) {
            e.preventDefault();
            elements.form.classList.remove('is-field-update');
            elements.boxTitle.innerText = 'Add Field';
            elements.form.setAttribute('data-field-index', '');
            elements.box.showModal();
        }

        closeBox(e) {
            e.preventDefault();
            elements.box.close();
        }

        // Show Elements
        static showElements(...elements) {
            for (let element of elements) {
                element.classList.remove('is-hidden');
            }
        }

        // Hide Elements
        static hideElements(...elements) {
            for (let element of elements) {
                element.classList.add('is-hidden');
            }
        }

    }

    new Builder(elements);


});

