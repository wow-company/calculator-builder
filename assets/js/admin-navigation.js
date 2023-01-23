'use strick';

(function ($) {

    $('.calc-copy-shortcode').on('click', function () {
        const copyText = $(this).closest('div.field').find('input')[0];

        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("Copied the shortcode: " + copyText.value);
    });

    $(document).on('click', '.calchub-dismiss', function () {
        const data = {
            action: 'calchub_hide_notice',
        };
        $.post(ajaxurl, data, function (response) {
            console.log(response);
            $('.calchub-notices').slideUp();
        })
    });


    let params = window
        .location
        .search
        .replace('?', '')
        .split('&')
        .reduce(
            function (p, e) {
                let a = e.split('=');
                p[decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                return p;
            },
            {}
        );

    let navigation_id = $('#calchub-navigation').val();

    if (params['tab'] === 'support') {
        $('#toplevel_page_' + navigation_id + ' .wp-first-item').removeClass('current');
        $('#toplevel_page_' + navigation_id + ' li:nth-child(5)').addClass('current');
    } else if (params['tab'] === 'tools') {
        $('#toplevel_page_' + navigation_id + ' .wp-first-item').removeClass('current');
        $('#toplevel_page_' + navigation_id + ' li:nth-child(4)').addClass('current');
    } else if (params['tab'] === 'extensions') {
        $('#toplevel_page_' + navigation_id + ' .wp-first-item').removeClass('current');
        $('#toplevel_page_' + navigation_id + ' li:nth-child(6)').addClass('current');
    } else if (params['tab'] === 'license') {
        $('#toplevel_page_' + navigation_id + ' .wp-first-item').removeClass('current');
        $('#toplevel_page_' + navigation_id + ' li:nth-child(5)').addClass('current');
    } else if (params['tab'] === 'settings' && params['act'] !== 'update') {
        $('#toplevel_page_' + navigation_id + ' .wp-first-item').removeClass('current');
        $('#toplevel_page_' + navigation_id + ' li:nth-child(3)').addClass('current');
    } else if (params['tab'] === 'calchub_settings') {
        $('#toplevel_page_' + navigation_id + ' .wp-first-item').removeClass('current');
        $('#toplevel_page_' + navigation_id + ' li:nth-child(7)').addClass('current');
    }

    $('#extensions-tab ul.tabs__caption').on('click', 'li:not(.is-active)', function() {
        $(this)
        .addClass('is-active').siblings().removeClass('is-active')
        .parents('.page-extensions').find('div.tabs__content').removeClass('is-active').eq($(this).index()).addClass('is-active');
    });

})(jQuery);