"use strict";

$(function () {

    var matrix = new Matrix();
    matrix.sortable();

    matrix.addButtons.on('click', function () {
        var lastItem = $(this).closest('.matrix-cell').find('li').last();
        matrix.addItem(lastItem, function () {
        });
    });

    matrix.removeButtons.on('click', function () {
        matrix.removeItem($(this).closest('li'), function () {
        });
    });

    $('#preview-mode').on('change', function () {
        if (this.checked) {
            matrix.turnOnPreviewMode();
        } else {
            matrix.turnOffPreviewMode();
        }
    });

    matrix.itemsInputs.on('keydown', function (event) {
        if (event.which === 13) { // the enter key code
            event.preventDefault();
            var item = $('.matrix-item .focus').parent();
            matrix.addItem(item, function () {
            });
        }
    });
});