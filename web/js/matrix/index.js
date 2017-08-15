"use strict";

$(function () {

    var matrix = new Matrix();

    matrix.addButtons.on('click', function () {
        matrix.addItem($(this));
    });
    matrix.removeButtons.on('click', function () {
        matrix.removeItem($(this));
    });

    $('#preview-mode').on('change', function () {
        if (this.checked) {
            matrix.turnOnPreviewMode();
        } else {
            matrix.turnOffPreviewMode();
        }
    });
});