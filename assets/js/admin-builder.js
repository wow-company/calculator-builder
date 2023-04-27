'use strict';

const Calc_Builder = function() {

  jQuery('#calculator').sortable({
    appendTo: document.body,
    cursor: 'move',
    update: function(event, ui) {
      createVariables();
      setFieldsAttributes();
      removeTagStyle();
    },
  });

  function removeTagStyle() {
    const containers = document.querySelectorAll('.formbox__container');
    containers.forEach(container => {
      container.removeAttribute('style');
    });
  }

  const $formType = document.querySelector('#form-params [name="type"]');
  const $resultType = document.querySelector('#form-params [name="result_field"]');
  const $typeText = document.querySelectorAll('.type-input-field');
  const $fieldTitle = document.querySelectorAll('.field-title');
  const $typeTitle = document.querySelectorAll('.type-title');
  const $typeSeparator = document.querySelectorAll('.type-separator');
  const $typeSpace = document.querySelectorAll('.type-spacer');
  const $typeNumber = document.querySelectorAll('.type-number');
  const $typeRequired = document.querySelectorAll('.type-required');

  const $typeResult = document.querySelectorAll('.type-result');
  const $typeTextarea = document.querySelectorAll('.type-textarea');
  const $typeResultField = document.querySelectorAll('.type-result-field');
  const $typeButtons = document.querySelectorAll('.type-buttons');
  const $formParam = document.getElementById('form-params');
  const $actionLightbox = document.querySelector('.btn-add-new-field');
  const $lightboxTitle = document.querySelector('#field-number .lightbox-title');
  const $lightboxClose = document.querySelector('#field-number .lightbox-close');

  $actionLightbox.addEventListener('click', () => {
    $formParam.classList.remove('is-field-update');
    $lightboxTitle.innerText = 'Add Field';
    $formParam.querySelector('.button-add').classList.remove('is-hidden');
    $formParam.querySelector('.button-update').classList.add('is-hidden');
    $formParam.setAttribute('data-field-index', '');
  });

  createVariables();

  document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('delete')) {
      removeField(e.target);
    } else if (e.target && e.target.classList.contains('edit')) {
      setFieldUpdate(e.target);
    } else if (e.target && e.target.classList.contains('variable') ||
        e.target.classList.contains('variable', 'is-result') ||
        e.target.classList.contains('operator') || e.target.classList.contains('calc-fieldset') ||
        e.target.classList.contains('calc-field') || e.target.classList.contains('calc-label')) {
      insertTextAtCursor(e.target.innerText);
    }
  });

  function removeField(element) {
    const parent = element.closest('.formbox__container');
    parent.remove();
    setFieldsAttributes();
    createVariables();

  }

  function setFieldUpdate(element) {
    const parent = element.closest('.formbox__container');
    let allContainer = document.querySelectorAll('.formbox__container');
    allContainer.forEach((container, index) => {
      if (container === parent) {
        getContainerParam(container, index);
      }
    });
  }

  function getContainerParam(container, index) {
    let type;

    $formParam.setAttribute('data-field-index', index);
    $formParam.classList.add('is-field-update');

    $lightboxTitle.innerText = 'Update Field';
    // console.log(container);
    if (container.classList.contains('has-result')) {
      type = '7';
    } else if (container.querySelector('.has-group')) {
      type = '5';
    } else if (container.querySelector('input[type="number"]')) {
      type = '1';
    } else if (container.querySelector('select')) {
      type = '2';
    } else if (container.querySelector('.formbox__field-checkbox')) {
      type = '4';
    } else if (container.querySelector('.formbox__field-radio')) {
      type = '3';
    } else if (container.querySelector('.is-title-only')) {
      type = '8';
    } else if (container.querySelector('hr')) {
      type = '9';
    } else if (container.querySelector('.is-spaсe')) {
      type = '10';
    } else if (container.querySelector('textarea')) {
      type = '11';
    } else if (container.querySelector('.formbox__field-text')) {
      type = '12';
      let inputType = container.querySelector('.formbox__field input').getAttribute('type');

      if (inputType) {
        $formParam.querySelector('[name="input_field_type"]').value = inputType;
      }
    } else {
      type = '6';
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

    let required = ''
    if(type === '1') {
      required = container.querySelector('.formbox__field input[type="number"]');
    } else if(type === '12') {
      required = container.querySelector('.formbox__field input');
    }



    required = (required) ? required.getAttribute('has-required') : '';

    if (required == '') {
      $formParam.querySelector('[name="required"]').value = '1';
    } else {
      $formParam.querySelector('[name="required"]').value = '2';
    }

    let calc = container.querySelector('.formbox__btn-calc');
    calc = (calc) ? calc.innerText : '';

    let reset = container.querySelector('.formbox__btn-reset');
    reset = (reset) ? reset.innerText : '';

    let options = '';

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

    $formParam.querySelector('.button-add').classList.add('is-hidden');
    $formParam.querySelector('.button-update').classList.remove('is-hidden');

    formType(type);

    $formParam.querySelector('[name="type"]').value = type;
    $formParam.querySelector('[name="title"]').value = title;
    $formParam.querySelector('[name="addon"]').value = addon;
    $formParam.querySelector('[name="addon_pos"]').value = addon_pos;
    $formParam.querySelector('[name="value"]').value = val;
    $formParam.querySelector('[name="step"]').value = step;
    $formParam.querySelector('[name="min"]').value = min;
    $formParam.querySelector('[name="max"]').value = max;
    $formParam.querySelector('[name="options"]').value = options;
    $formParam.querySelector('[name="calculate"]').value = calc;
    $formParam.querySelector('[name="reset"]').value = reset;

    let extraClasses = '';
    const classes = container.classList;
    if (classes.length > 0) {
      for (let i = 0; i < classes.length; i++) {
        if (classes[i] !== 'formbox__container' && classes[i] !== 'ui-sortable-handle' && classes[i] !== 'has-result') {
          extraClasses += classes[i];
          extraClasses += ' ';
        }
      }
    }

    $formParam.querySelector('[name="extraClasses"]').value = extraClasses;

  }

  function insertTextAtCursor(text) {
    const editor = document.querySelector('.CodeMirror').CodeMirror;
    const doc = editor.getDoc();
    const cursor = doc.getCursor();
    doc.replaceRange(text, cursor);
    editor.focus();
    // editor.setCursor(editor.lineCount(), 0);
  }

  const $form = document.getElementById('calculator');

  $formParam.addEventListener('submit', addField);

  function addField(e) {
    e.preventDefault();

    const param = getParams(this);
    const class_group = (param.type === '5') ? ' has-group' : '';
    const class_result = (param.type === '7') ? ' has-result' : '';

    let content = '';

    if (param.type === '8') {
      content += titleField(param);
    } else if (param.type === '9') {
      content += separatorField(param);
    } else if (param.type === '10') {
      content += spacerField(param);
    } else {

      content += `<div class="formbox__title">${param.title}</div>`;
      content += `<div class="formbox__body${class_group}">`;

      switch (param.type) {
        case '1':
          content += numberField(param);
          break;
        case '2':
          content += selectField(param);
          break;
        case '3':
          content += radioField(param);
          break;
        case '4':
          content += checkboxField(param);
          break;
        case '5':
          content += numberField(param);
          content += selectField(param);
          break;
        case '6':
          content += buttonField(param);
          break;
        case '7':
          content += resultField(param);
          break;
        case '11':
          content += textareaField(param);
          break;
        case '12':
          content += textField(param);
          break;

      }

      content += '</div>';
    }

    content += `<div class="action-elements">
                    <span class="delete">&times;</span>
                    <a href="#field-number" class="edit">&#9998;</a>
                    </div>`;

    const classes = param.extraClasses;

    let dataVal = $formParam.getAttribute('data-field-index');
    if (dataVal === '') {
      let out = `<fieldset class="formbox__container${class_result} ${classes}">${content}</fieldset>`;
      $form.insertAdjacentHTML('beforeend', out);
    } else {
      dataVal = Number(dataVal);
      let allContainer = document.querySelectorAll('.formbox__container');

      allContainer[dataVal].className = '';
      allContainer[dataVal].classList.add('formbox__container', 'ui-sortable-handle');
      if (class_result !== '') {
        allContainer[dataVal].classList.add(class_result.trim());
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
      $lightboxClose.click();

    }

    setFieldsAttributes();
    createVariables();
  }

  function createVariables() {
    const fields = document.querySelectorAll('#calculator .formbox__field');

    let variables = '';
    let result = 1;
    if (fields.length < 1) return;
    for (let i = 1; i <= fields.length; i++) {
      if (fields[i - 1].classList.contains('is-result')) {
        variables += '<span class="variable is-result">y[' + result + ']</span>';
        result++;
      } else {
        variables += '<span class="variable">x[' + i + ']</span>';
      }
    }

    const fieldAll = document.querySelectorAll('#calculator [name^="formbox-field-"], #calculator button');
    let fieldsEl = '';

    for (let i = 1; i <= fieldAll.length; i++) {
      fieldsEl += '<span class="calc-field">field[' + i + ']</span>';
    }

    const labels = document.querySelectorAll('#calculator .formbox__title');
    let label = '';

    for (let i = 1; i <= labels.length; i++) {
      label += '<span class="calc-label">label[' + i + ']</span>';
    }

    document.getElementById('calc-label-bottom').innerHTML = label;
    document.querySelector('.calc-label-bottom').classList.remove('is-hidden');
    labelHoverBottom();

    document.getElementById('variables').innerHTML = variables;
    document.getElementById('variables-bottom').innerHTML = variables;
    document.querySelector('.variables-bottom').classList.remove('is-hidden');
    variableHover();
    variableHoverBottom();

    document.getElementById('calc-field-bottom').innerHTML = fieldsEl;
    document.querySelector('.calc-field-bottom').classList.remove('is-hidden');
    fieldHoverBottom();

    const fieldsets = document.querySelectorAll('#calculator fieldset');

    let fieldset = '';
    for (let i = 1; i <= fieldsets.length; i++) {
      fieldset += '<span class="calc-fieldset">fieldset[' + i + ']</span>';
    }

    document.getElementById('calc-fieldset-bottom').innerHTML = fieldset;
    document.querySelector('.calc-fieldset-bottom').classList.remove('is-hidden');
    fieldsetHoverBottom();

  }

  function variableHover() {
    let variables = document.querySelectorAll('#variables .variable');
    let fields = document.querySelectorAll('.formbox__field');
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

    variables.forEach(el => {
      el.addEventListener('click', () => {
      });
    });

  }

  function variableHoverBottom() {
    let variables = document.querySelectorAll('#variables-bottom .variable');
    let fields = document.querySelectorAll('.formbox__field');
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

  function fieldsetHoverBottom() {
    let variables = document.querySelectorAll('#calc-fieldset-bottom .calc-fieldset');
    let fields = document.querySelectorAll('#calculator fieldset');
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

  function fieldHoverBottom() {
    let variables = document.querySelectorAll('#calc-field-bottom .calc-field');
    let fields = document.querySelectorAll('#calculator [name^="formbox-field-"], #calculator button');
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

  function labelHoverBottom() {
    let variables = document.querySelectorAll('#calc-label-bottom .calc-label');
    let fields = document.querySelectorAll('#calculator .formbox__title');
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

  function setFieldsAttributes() {
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

  function textField(param) {
    const required = (param.required == '1') ? ' has-required' : ''
    let content = `<div class="formbox__field">`;
    content += `<label class="formbox__field-lable">${param.title}</label>`;
    content += `<input type="${param.input_field_type}" class="formbox__field-text" ${required}>`;
    content += '</div>';
    return content;
  }

  function textareaField(param) {
    let content = `<div class="formbox__field">`;
    content += `<label class="formbox__field-lable">${param.title}</label>`;
    content += `<textarea class="formbox__field-textarea" has-required></textarea>`;
    content += '</div>';
    return content;
  }

  function titleField(param) {
    let content = '';
    const size = (param.titleSize != '') ? 'font-size:' + param.titleSize + 'px;' : '';
    const weight = (param.titleWeight != '') ? 'font-weight:' + param.titleWeight + ';' : '';
    content += `<div class="formbox__title is-title-only" style="${size}${weight}">${param.title}</div>`;
    return content;
  }

  function separatorField() {
    return '<hr/>';
  }

  function spacerField(param) {
    const height = (param.spacerHeight != '') ? 'height:' + param.spacerHeight + 'px;' : '';
    const content = `<div class="formbox__title is-spaсe" style="${height}"></div>`;
    return content;
  }

  function numberField(param) {
    const step = (param.step != '') ? ' step="' + param.step + '"' : '';
    const min = (param.min != '') ? ' min="' + param.min + '"' : '';
    const max = (param.max != '') ? ' max="' + param.max + '"' : '';
    const required = (param.required == '1') ? ' has-required' : '';
    const option = `value="${param.value}"${step}${min}${max}${required}`;

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

  function selectField(param) {
    let content = '<div class="formbox__field">';
    content += `<label class="formbox__field-lable">${param.title}</label>`;
    content += '<select class="formbox__field-select">';
    if (param.options) {
      let arr = param.options.split('\n');
      for (let i = 0; i < arr.length; i++) {
        let option = getOptions(arr[i]);
        if (option !== '') {
          let selSelected = (option.selected !== '') ? ' selected="selected"' : '';
          content += '<option value="' + option.val + '"' + selSelected + '>' + option.name + '</option>';
        }
      }
    }
    content += '</select></div>';
    return content;

  }

  function getOptions(pars) {
    let option = new Object();
    let elem = pars.split(' = ');
    if (elem.length < 2) return '';
    option['name'] = elem[0].toString().trim();
    option ['selected'] = (String(elem[1]).includes('*')) ? ' selected' : '';
    option ['val'] = parseFloat(elem[1]) || 0;
    return option;
  }

  function radioField(param) {
    let content = '<div class="formbox__field">';
    if (param.options) {
      let arr = param.options.split('\n');
      for (let i = 0; i < arr.length; i++) {
        let option = getOptions(arr[i]);
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

  function checkboxField(param) {
    let content = '';
    if (param.options) {
      let arr = param.options.split('\n');
      for (let i = 0; i < arr.length; i++) {
        let option = getOptions(arr[i]);
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

  function buttonField(param) {
    let content = '<div class="formbox__btn">';
    content += `<button class="formbox__btn-calc">${param.calculate}</button>`;
    content += `<button type="reset" class="formbox__btn-reset">${param.reset}</button>`;
    content += '</div>';
    return content;

  }

  function resultField(param) {

    if (param.result_field == 1) {

      const has_addon = (param.addon !== '') ? ' has-addon is-' + param.addon_pos : '';

      let content = `<div class="formbox__field is-result${has_addon}">`;
      if (param.addon !== '') {
        content += `<span class="formbox__field-addon">${param.addon}</span>`;
      }
      content += `<label class="formbox__field-lable">${param.title}</label>`;
      content += `<input type="text" class="formbox__field-result" readonly>`;
      content += '</div>';
      return content;
    } else if (param.result_field == 2) {
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

  function getParams(form) {

    const data = new FormData(form);

    let params = new Object();
    for (let pair of data.entries()) {
      params[pair[0]] = pair[1];
    }

    return params;

  }

  $resultType.addEventListener('change', resultType);

  function resultType(typeVal) {
    let type;
    if (typeof typeVal === 'object') {
      type = this.value;
    } else {
      type = $resultType.value;
    }

    if ($formType.value != 7) {
      return false;
    }

    const addonBLock = document.querySelector('#form-params .result-type-1');

    switch (type) {
      case '1':
        addonBLock.classList.remove('is-hidden');
        break;
      case '2':
        addonBLock.classList.add('is-hidden');
        break;
      case '3':
        addonBLock.classList.add('is-hidden');
        break;

    }

  }

  $formType.addEventListener('change', formType);

  function formType(typeVal) {
    let type;
    if (typeof typeVal === 'object') {
      type = this.value;
    } else {
      type = typeVal;
    }

    switch (type) {
      case '1':
        toogleNumber('show');
        toogleTextarea('hide');
        toogleButtons('hide');
        toogleFieldTitle('show');
        toogleTypeTitle('hide');
        toogleTypeSeparator('hide');
        toogleTypeSpace('hide');
        toogleResultField('hide');
        toogleTypeText('hide');
        toogleTypeRequired('show');
        break;
      case '2':
      case '3':
      case '4':
        toogleNumber('hide');
        toogleTextarea('show');
        toogleButtons('hide');
        toogleFieldTitle('show');
        toogleTypeTitle('hide');
        toogleTypeSeparator('hide');
        toogleTypeSpace('hide');
        toogleResultField('hide');
        toogleTypeText('hide');
        toogleTypeRequired('hide');
        break;
      case '5':
        toogleNumber('show');
        toogleTextarea('show');
        toogleButtons('hide');
        toogleFieldTitle('show');
        toogleTypeTitle('hide');
        toogleTypeSeparator('hide');
        toogleTypeSpace('hide');
        toogleResultField('hide');
        toogleTypeText('hide');
        toogleTypeRequired('hide');
        break;
      case '6':
        toogleNumber('hide');
        toogleTextarea('hide');
        toogleButtons('show');
        toogleFieldTitle('show');
        toogleTypeTitle('hide');
        toogleTypeSeparator('hide');
        toogleTypeSpace('hide');
        toogleResultField('hide');
        toogleTypeText('hide');
        toogleTypeText('hide');
        toogleTypeRequired('hide');
        break;
      case '7':
        toogleNumber('hide');
        toogleTextarea('hide');
        toogleButtons('hide');
        toogleResult('show');
        toogleFieldTitle('show');
        toogleTypeTitle('hide');
        toogleTypeSeparator('hide');
        toogleTypeSpace('hide');
        toogleResultField('show');
        toogleTypeText('hide');
        toogleTypeRequired('hide');
        resultType();
        break;
      case '8':
        toogleNumber('hide');
        toogleTextarea('hide');
        toogleButtons('hide');
        toogleResult('hide');
        toogleFieldTitle('show');
        toogleTypeTitle('show');
        toogleTypeTitle('show');
        toogleTypeSeparator('hide');
        toogleTypeSpace('hide');
        toogleResultField('hide');
        toogleTypeText('hide');
        toogleTypeRequired('hide');
        break;
      case '9':
        toogleNumber('hide');
        toogleTextarea('hide');
        toogleButtons('hide');
        toogleResult('hide');
        toogleFieldTitle('hide');
        toogleTypeTitle('hide');
        toogleTypeTitle('hide');
        toogleTypeSeparator('show');
        toogleTypeSpace('hide');
        toogleResultField('hide');
        toogleTypeText('hide');
        toogleTypeRequired('hide');
        break;
      case '10':
        toogleNumber('hide');
        toogleTextarea('hide');
        toogleButtons('hide');
        toogleResult('hide');
        toogleFieldTitle('hide');
        toogleTypeTitle('hide');
        toogleTypeTitle('hide');
        toogleTypeSeparator('hide');
        toogleTypeSpace('show');
        toogleResultField('hide');
        toogleTypeText('hide');
        toogleTypeRequired('hide');
        break;
      case '11':
        toogleNumber('hide');
        toogleTextarea('hide');
        toogleButtons('hide');
        toogleFieldTitle('show');
        toogleTypeTitle('hide');
        toogleTypeSeparator('hide');
        toogleTypeSpace('hide');
        toogleResultField('hide');
        toogleTypeText('hide');
        toogleTypeRequired('hide');
        break;
      case '12':
        toogleNumber('hide');
        toogleTextarea('hide');
        toogleButtons('hide');
        toogleFieldTitle('show');
        toogleTypeTitle('hide');
        toogleTypeSeparator('hide');
        toogleTypeSpace('hide');
        toogleResultField('hide');
        toogleTypeText('show');
        toogleTypeRequired('show');
        break;

    }

  }


  function toogleTypeRequired(action) {
    if (action === 'show') {
      $typeRequired.forEach(el => {
        el.classList.remove('is-hidden');
      });

    } else {
      $typeRequired.forEach(el => {
        el.classList.add('is-hidden');
      });
    }
  }

  function toogleTypeText(action) {
    if (action === 'show') {
      $typeText.forEach(el => {
        el.classList.remove('is-hidden');
      });

    } else {
      $typeText.forEach(el => {
        el.classList.add('is-hidden');
      });
    }
  }

  function toogleTypeTitle(action) {
    if (action === 'show') {
      $typeTitle.forEach(el => {
        el.classList.remove('is-hidden');
      });

    } else {
      $typeTitle.forEach(el => {
        el.classList.add('is-hidden');
      });
    }
  }

  function toogleTypeSeparator(action) {
    if (action === 'show') {
      $typeSeparator.forEach(el => {
        el.classList.remove('is-hidden');
      });

    } else {
      $typeSeparator.forEach(el => {
        el.classList.add('is-hidden');
      });
    }
  }

  function toogleTypeSpace(action) {
    if (action === 'show') {
      $typeSpace.forEach(el => {
        el.classList.remove('is-hidden');
      });

    } else {
      $typeSpace.forEach(el => {
        el.classList.add('is-hidden');
      });
    }
  }

  function toogleFieldTitle(action) {
    if (action === 'show') {
      $fieldTitle.forEach(el => {
        el.classList.remove('is-hidden');
      });

    } else {
      $fieldTitle.forEach(el => {
        el.classList.add('is-hidden');
      });
    }
  }

  function toogleNumber(action) {
    if (action === 'show') {
      $typeNumber.forEach(el => {
        el.classList.remove('is-hidden');
      });

    } else {
      $typeNumber.forEach(el => {
        el.classList.add('is-hidden');
      });
    }
  }

  function toogleResult(action) {
    if (action === 'show') {
      $typeResult.forEach(el => {
        el.classList.remove('is-hidden');
      });

    } else {
      $typeResult.forEach(el => {
        el.classList.add('is-hidden');
      });
    }
  }

  function toogleTextarea(action) {
    if (action === 'show') {
      $typeTextarea.forEach(el => {
        el.classList.remove('is-hidden');
      });

    } else {
      $typeTextarea.forEach(el => {
        el.classList.add('is-hidden');
      });
    }
  }

  function toogleResultField(action) {
    if (action === 'show') {
      $typeResultField.forEach(el => {
        el.classList.remove('is-hidden');
      });

    } else {
      $typeResultField.forEach(el => {
        el.classList.add('is-hidden');
      });
    }
  }

  function toogleButtons(action) {
    if (action === 'show') {
      $typeButtons.forEach(el => {
        el.classList.remove('is-hidden');
      });

    } else {
      $typeButtons.forEach(el => {
        el.classList.add('is-hidden');
      });
    }
  }

};

new Calc_Builder();