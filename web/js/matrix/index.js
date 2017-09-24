"use strict";

$(function () {

    var matrix = new Matrix();
    new Theme();
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

    var isEnterDown = false;
    matrix.itemsInputs.on('keydown', function (event) {
        if (event.which === 13) { // the enter key code
            event.preventDefault();
            if (!isEnterDown) {
                var item = $(this).parent();
                matrix.addItem(item, function () {
                });
                isEnterDown = true;
            }
        }
    });

    matrix.itemsInputs.on('keyup', function (event) {
        if (event.which === 13) { // the enter key code
            isEnterDown = false;
        }
    });
});