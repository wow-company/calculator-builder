/* ========= INFORMATION ============================
	- author:    Dmytro Lobov
	- url:       https://wow-estore.com
	- email:     i@lobov.dev
==================================================== */

'use strick';

(function ($) {
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

    let navigation_id = $('#wow-navigation').val();

    $('#toplevel_page_' + navigation_id + ' li:nth-child(5) a').css({
        'color': '#00d1b2',
    });


    if (params['tab'] === 'support') {
        $('#toplevel_page_' + navigation_id + ' .wp-first-item').removeClass('current');
        $('#toplevel_page_' + navigation_id + ' li:nth-child(4)').addClass('current');
    } else if (params['tab'] === 'extension') {
        $('#toplevel_page_' + navigation_id + ' .wp-first-item').removeClass('current');
        $('#toplevel_page_' + navigation_id + ' li:nth-child(5)').addClass('current');
    } else if (params['tab'] === 'license') {
        $('#toplevel_page_' + navigation_id + ' .wp-first-item').removeClass('current');
        $('#toplevel_page_' + navigation_id + ' li:nth-child(5)').addClass('current');
    } else if (params['tab'] === 'settings' && params['act'] !== 'update') {
        $('#toplevel_page_' + navigation_id + ' .wp-first-item').removeClass('current');
        $('#toplevel_page_' + navigation_id + ' li:nth-child(3)').addClass('current');
    }
})(jQuery);