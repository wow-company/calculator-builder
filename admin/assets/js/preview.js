/* ========= INFORMATION ============================
	- author:    Dmytro Lobov
	- url:       https://wow-estore.com
==================================================== */

'use strict';

(function ($) {

    let content = jQuery('#popupBoxContent').val();
    $('.ds-popup-content').html(content);

    $('#postoptions').on('change', function () {
        builder();
    });

    $('#postoptions').on('keyup', function () {
        builder();
    });

    $(".wp-color-picker-field").wpColorPicker(
        'option',
        'change',
        function (event, ui) {
            builder();
        }
    );

    builder();

    function builder() {

        buildContent();
        buildPopup();
        buildOverlay();
        buildClose();

        let builder_height = $('.ds-popup-wrapper').outerHeight() + 100;
        $('.live-builder').css({
            'height': builder_height + 'px',
        });

    }

    $('#popupBoxContent').on('keydown', function () {
        let content = $('#popupBoxContent').val();
        $('.ds-popup-content').html(content);
        builder();
    });

    window.onload = function () {
        if (typeof window.parent.tinymce !== 'undefined') {
            tinymce.get('popupBoxContent').on('keyup', function (e) {
                let content = this.getContent();
                $('.ds-popup-content').html(content);
                builder();
            });
            tinymce.get('popupBoxContent').on('change', function (e) {
                let content = this.getContent();
                $('.ds-popup-content').html(content);
                builder();
            });
        }
    };

    function buildPopup() {
        let popup = $('#popup-wrapper');
        let location = $('#location').val();
        $(popup)
            .removeAttr('style')
            .removeAttr('class')
            .addClass('ds-popup-wrapper ' + location);


        if (jQuery('#background_img_checkbox').prop('checked')) {
            // alert("dd");
            let background_img = $('#background_img').val();
            let background = $('#background').val();
            $(popup).css({
                'background-color': background,
                'background-image': 'url(' + background_img + ')',
                'background-size': 'cover',
            });
        } else {
            let background = $('#background').val();
            $(popup).css({
                'background': background,
            });
        }

        let padding = $('#padding').val();
        let radius = $('#radius').val();

        $(popup).css({
            'padding': padding + 'px',
            'border-radius': radius + 'px',
        });

        let shadow = $('#shadow').val();
        let shadow_color = $('#shadow_color').val();

        if (jQuery('#shadow_checkbox').prop('checked')) {
            $(popup).css({
                'box-shadow': '0 0 ' + shadow + 'px ' + shadow_color,
            });
        }


        let width = $('#width').val();
        let width_unit = $('#width_unit').val();
        let height = $('#height').val();
        let height_unit = $('#height_unit').val();

        if (width_unit === 'auto') {
            $(popup).css({
                'width': $(popup).outerWidth() + 'px',
            });
        } else {
            $(popup).css({
                'width': width + width_unit,
            });
        }

        if (height_unit === 'auto') {
            $(popup).css({
                'height': $(popup).outerHeight() + 'px',
            });
        } else {
            $(popup).css({
                'height': height + height_unit,
            });
        }


        switch (location) {
            case "-center":
                $(popup).css({
                    'bottom': '0',
                    'right': '0',
                });
                break;
            case "-bottomCenter":
            case "-topCenter" :
                $(popup).css({
                    'right': '0',
                });
                break;
        }

        let top = $('#top').val();
        let bottom = $('#bottom').val();
        let left = $('#left').val();
        let right = $('#right').val();

        switch (location) {
            case '-topCenter':
                $(popup).css({'top': top + 'px',});
                break;
            case '-bottomCenter':
                $(popup).css({'bottom': bottom + 'px',});
                break;
            case '-left':
                $(popup).css({'left': left + 'px',});
                break;
            case '-right':
                $(popup).css({'right': right + 'px',});
                break;
            case '-topLeft':
                $(popup).css({'top': top + 'px',});
                $(popup).css({'left': left + 'px',});
                break;
            case '-bottomLeft':
                $(popup).css({'bottom': bottom + 'px',});
                $(popup).css({'left': left + 'px',});
                break;
            case '-topRight':
                $(popup).css({'top': top + 'px',});
                $(popup).css({'right': right + 'px',});
                break;
            case '-bottomRight':
                $(popup).css({'bottom': bottom + 'px',});
                $(popup).css({'right': right + 'px',});
                break;
        }


    }

    function buildContent() {
        let content = $('.ds-popup-content');
        $(content).removeAttr('style');
        let content_font = $('#content_font').val();
        let content_size = $('#content_size').val();
        let content_padding = $('#content_padding').val();

        $(content).css({
            'font-family': content_font,
            'font-size': content_size + 'px',
            'padding': content_padding + 'px',
        });

        let border_style = $('#border_style').val();
        let border_width = $('#border_width').val();
        let border_radius = $('#border_radius').val();
        let border_color = $('#border_color').val();

        if (border_style !== 'none') {
            $(content).css({
                'border-width': border_width + 'px',
                'border-style': border_style,
                'border-color': border_color,
            });
            if (border_radius !== 0) {
                $(content).css({
                    'border-radius': border_radius + 'px',
                })
            }
        }
    }

    function buildOverlay() {
        $('.ds-popup-overlay').remove();
        if (jQuery('#overlay_checkbox').prop('checked')) {
            $('#ds-popup').prepend('<div class="ds-popup-overlay"></div>');
            let overlay = $('#overlay').val();
            $('.ds-popup-overlay').css({
                'background': overlay,
            });
        }
    }

    function buildClose() {
        $('.ds-popup-close').remove();

        $('.ds-popup-wrapper').prepend('<div class="ds-popup-close"></div>');

        let close = $('#close').val();
        let close_size = $('#close_size').val();
        let close_text = $('#close_text').val();
        let close_location = $('#close_location').val();
        let close_place = $('#close_place').val();
        let close_color = $('#close_color').val();
        let close_background = $('#close_background').val();

        $('.ds-popup-close')
            .addClass(close)
            .addClass(close_location)
            .addClass(close_place)
            .attr('data-ds-close-text', close_text)
            .css({
                'font-size': close_size + 'px',
                'color': close_color,
            });
        if (close !== '-icon') {
            $('.ds-popup-close').css('background', close_background);
        }
        if (close !== '-text') {
            let box = parseInt(close_size) + 5;
            $('.ds-popup-close').css({
                'width': box + 'px',
                'height': box + 'px',
                'line-height': box + 'px',
            });
        }

    }

})(jQuery);




