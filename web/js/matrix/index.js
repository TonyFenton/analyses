"use strict";

$(function () {

    var matrix = new Matrix();

    matrix.addButtons.on('click', function () {
        matrix.addItem($(this));
    });
    matrix.removeButtons.on('click', function () {
        matrix.removeItem($(this));
    });
    matrix.form.on('submit', function () {
        matrix.updateItemsNames();

        // updateItemsNames test
        // $('.matrix-item input').each(function () {
        //     console.log($(this).attr('name'));
        //
        // });
        //
        // return false;
    });

});