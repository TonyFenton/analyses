"use strict";

function Theme() {

    this.setCookie = function (name, value) {
        var expires = new Date(new Date().setFullYear(new Date().getFullYear() + 1)).toUTCString();
        document.cookie = name + '=' + value + '; expires=' + expires + ';';
    };

    this.matrixType = $('#matrix-form').attr('name');
    this.matrix = $('#matrix');
    this.select = $('#theme-select');
    this.current = this.select.val();

    /* Constructor */

    console.log(this.matrixType);

    var theme = this;

    this.select.on('change', function () {
        theme.matrix.removeClass(theme.current);
        theme.current = $(this).val();
        theme.matrix.addClass(theme.current);
        theme.setCookie(theme.matrixType + '_theme', theme.current);
    });
}