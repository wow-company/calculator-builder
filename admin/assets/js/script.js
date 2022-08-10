/* ========= INFORMATION ============================
	- author:    Dmytro Lobov
	- url:       https://wow-estore.com
	- email:     i@lobov.dev
==================================================== */

'use strick';

(function($) {

  const formuls = document.getElementById('formula');

  const editorSettings = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};

  const codemirror_gen =
      {
        'indentUnit': 2,
        'indentWithTabs': true,
        'inputStyle': 'contenteditable',
        'lineNumbers': true,
        'lineWrapping': true,
        'styleActiveLine': true,
        'continueComments': true,
        'extraKeys': {
          'Ctrl-Space': 'autocomplete',
          'Ctrl-\/': 'toggleComment',
          'Cmd-\/': 'toggleComment',
          'Alt-F': 'findPersistent',
          'Ctrl-F': 'findPersistent',
          'Cmd-F': 'findPersistent',
        },
        'direction': 'ltr',
        'gutters': ['CodeMirror-lint-markers'],
        'lint': true,
        'autoCloseBrackets': true,
        'autoCloseTags': true,
        'matchTags': {
          'bothTags': true,
        },
        'tabSize': 2,

      };

  let codemirror_el =
      {

        'boss': true,
        'curly': true,
        'eqeqeq': true,
        'eqnull': true,
        'es3': true,
        'expr': true,
        'immed': true,
        'noarg': true,
        'nonbsp': true,
        'onevar': true,
        'quotmark': 'single',
        'trailing': true,
        'undef': true,
        'unused': true,
        'browser': true,
        'globals': {
          '_': false,
          'Backbone': false,
          'jQuery': true,
          'JSON': false,
          'wp': false,
        },
        'mode': 'javascript',
      };

  editorSettings.codemirror = _.extend(
      {},
      editorSettings.codemirror,
      codemirror_gen,
      codemirror_el,
  );

  const editor = wp.codeEditor.initialize(formuls, editorSettings);

  //region Send Form
  $('#wow-plugin').on('submit', function(event) {
    event.preventDefault();
    setFormula();
    let dataform = $(this).serialize();
    let form = $('#calculator').html();

    let prefix = $('#prefix').val();
    let data = 'action=' + prefix + '_item_save&' + dataform + '&form=' + form;
    $('#submit').addClass('is-loading');
    setTimeout(function() {
      $.post(ajaxurl, data, function(response) {
        if (response.status == 'OK') {
          $('#wow-message').addClass('notice notice-success is-dismissible').html('<p>' + response.message + '</p>');
          $('#add_action').val(2);
          let tool_id = $('#tool_id').val();
          $('.nav-tab.nav-tab-active').text('Update #' + tool_id);
        }
        $('#submit').removeClass('is-loading');
      });
    }, 500);
  });

  //endregion

  function setFormula() {
    const content = editor.codemirror.getValue();
    jQuery('#formula').val(content);
  }

  //region Tabs
  $('#tab li').on('click', function() {
    let tab = $(this).data('tab');
    $('#tab li').removeClass('is-active');
    $(this).addClass('is-active');
    $('#tab-content .tab-content').removeClass('is-active').css('display', 'none');
    $('[data-content="' + tab + '"]').addClass('is-active').css('display', '');
  });

  const tabContents = document.querySelectorAll('.tab-content');

  if (tabContents.length > 0) {
    tabContents.forEach((tab) => {
      if (!tab.classList.contains('is-active')) {
        tab.style = 'display:none';
      }
    });
  }
//endregion



  $('.toggle-preview').on('click', function() {
    $('.live-builder, .toggle-preview .plus, .toggle-preview .minus').toggleClass('is-hidden');
  });

  //region Accordion
  $('.accordion-title').on('click', function() {
    $('.accordion-title').removeClass('active');
    $('.accordion-content').slideUp('normal');
    if ($(this).next().is(':hidden') == true) {
      $(this).addClass('active');
      $(this).next().slideDown('normal');
    }
  });
  $('.accordion-content').hide();
  //endregion

  //region Save item
  $(document).on('click', '.wow-plugin-message .notice-dismiss', function() {
    $.ajax({
      url: ajaxurl, data: {
        action: 'wow_plugin_message',
      },
    });
  });
  //endregion

})(jQuery);


