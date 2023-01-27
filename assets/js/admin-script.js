'use strick';

(function ($) {
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
    $('#calchub-form').on('submit', function (event) {
        event.preventDefault();
        setFormula();
        let dataform = $(this).serialize();
        let form = $('#calculator').html();
        let data = 'action=calchub_save_calc&' + dataform + '&form=' + form;
        $('#submit').addClass('is-loading');
        setTimeout(function () {
            $.post(ajaxurl, data, function (response) {
                if (response.status == 'OK') {
                    $('#calchub-notices').hide();
                    $('#calchub-notices').html('<div class="calchub-notices"><div class="calchub-notices-wrapper"><h3>' + response.message + '</h3></div></div>')
                    $('#calchub-notices').slideDown('400', 'swing', function () {
                        setTimeout(function () {
                            $('#calchub-notices').slideUp();
                        }, 2000);
                    });
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
    $('#tab li').on('click', function () {
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


    $('.toggle-preview').on('click', function () {
        $('.live-builder, .toggle-preview .plus, .toggle-preview .minus').toggleClass('is-hidden');
    });

    //region Accordion
    $('.accordion-title').on('click', function () {
        $('.accordion-title').removeClass('active');
        $('.accordion-content').slideUp('normal');
        if ($(this).next().is(':hidden') == true) {
            $(this).addClass('active');
            $(this).next().slideDown('normal');
        }
    });
    $('.accordion-content').hide();
    //endregion


    $('#calc-copy-action').on('click', function (){
        const copyText = document.getElementById("calc-shortcode");

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("Copied the shortcode: " + copyText.value);
    });

  $('#includeFiles').sortable();
  $('#addButton').on('click', function(e) {
    e.preventDefault();
    const item = `
        <div class="columns is-centered">
                <div class="column is-half-desktop">
                    <div class="field has-addons has-addons-right">
                        <div class="control">
                            <div class="select">
                                <select name="param[include][]">
                                    <option value="css">css</option>
                                    <option value="js">js</option>
                                </select>
                            </div>
                        </div>
                        <div class="control is-expanded">
                            <input type="text" class="input" name="param[include_file][]"
                                   value="" placeholder="URL to file">
                        </div>
                    </div>
                </div>
                <div class="column is-one-quarter">
                    <div class="buttons">
                        <span class="button is-danger is-outlined is-normal button-delete-item">
                            Delete
                        </span>
                        <span class="button is-normal button-sorted">
                            Sort
                        </span>
                    </div>

                </div>
            </div>
        `;
    $(item).appendTo('#includeFiles');
    $('#includeFiles').sortable();
  });

  $(document).on('click', '.button-delete-item', function() {
    this.closest('.columns').remove();
  });

})(jQuery);


