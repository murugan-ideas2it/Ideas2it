/*
 * Simple Wp Sitemap admin js
 */

jQuery(function ($) {
    'use strict';

    var form = $('#simple-wp-sitemap-form'),
        orderList = $('#sitemap-display-order'),
        premiumInput = $('#upgradeField'),
        premiumForm = $('#simpleWpHiddenForm'),
        tab = location.search[location.search.length - 1];


    // Changes an item in order menu
    function changeOrderItem (node) {
        var li = node.parent(), elem, val;

        if (node.hasClass('sitemap-up') && li.prev().get(0)) {
            li.prev().before(li);

        } else if (node.hasClass('sitemap-down') && li.next().get(0)) {
            li.next().after(li);
        }
    };

    // Sets hidden fields values and submits the form to save changes
    function submitForm () {
        var inputs = orderList.find('input[data-name]');

        orderList.find('input[type=hidden]').each(function (i) {
            $(this).val((i + 1) + '-|-' + inputs.eq(i).val());
        });

        form.attr('action', form.attr('action') + '&tab=' + (parseInt(form.tabs('option', 'active')) + 1));
        form.get(0).submit();
    };

    // Submits form to upgrade plugin to premium
    function upgrade () {
        if (premiumInput.val()) {
            premiumForm.append($('<input type="hidden" name="upgrade_to_premium">').val(premiumInput.val()));
            premiumForm.submit();
        }
    };

    // Restores default order options
    function restoreDefaultOrder () {
        var sections = ['Home', 'Posts', 'Pages', 'Other', 'Categories', 'Tags', 'Authors'],
            html = '';

        $.each(sections, function (i, section) {
            html += '<li><input type="text" class="swp-name" data-name="' + section.toLowerCase() + '" value="' + section + '">' +
                '<span class="sitemap-down" title="move down"></span><span class="sitemap-up" title="move up"></span>' +
                '<input type="hidden" name="simple_wp_' + section.toLowerCase() + '_n" value="' + (i + 1) + '"></li>';
        });
        orderList.html(html);

        $('#simple_wp_order_by').val('');
        $('#simple_wp_last_updated').val('');
    };

    // Binds all events
    function bindEvents () {
        orderList.on('click', function (e) {
            changeOrderItem($(e.target));
        });

        form.on('submit', function (e) {
            e.preventDefault();
            submitForm();
        });

        $('#sitemap-defaults').on('click', restoreDefaultOrder);
        $('#upgradeToPremium').on('click', upgrade);

        premiumInput.on('keypress', function (e) {
            if (e.which === 13) {
                e.preventDefault();
                upgrade();
            }
        });
    };


    form.tabs({
        active: /\d/.test(tab) ? parseInt(tab) - 1 : 0
    });

    bindEvents();
});
