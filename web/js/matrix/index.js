"use strict";

$(function () {

    var matrix = new Matrix();

    matrix.addButtons.on('click', function () {
        matrix.addItem($(this));
    });
    matrix.removeButtons.on('click', function () {
        matrix.removeItem($(this));
    });
});