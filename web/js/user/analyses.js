"use strict";

$(function () {
    bootbox.setDefaults({
        locale: translator.getLocale()
    });

    /* confirm the matrix delete */
    $('.delete-button').on('click', function (event) {
        event.preventDefault();
        var form = $(this).closest('form');
        var name = $(this).closest('tr').find('.matrix-name').text().trim();
        bootbox.confirm({
            message: translator.trans('matrix.confirm_delete', name),
            callback: function (result) {
                if (result) {
                    form.trigger('submit');
                } else {
                    $(this).modal('hide');
                }
            }
        });
    });
});