"use strict";

function Theme() {

    this.setThemeCookie = function (matrixType, theme) {
        var expires = new Date(new Date().setFullYear(new Date().getFullYear() + 1)).toUTCString();
        document.cookie = matrixType + '_theme=' + theme + '; expires=' + expires + '; path=/;';
    };

    this.matrixType = $('#matrix-form').attr('name');
    this.matrix = $('#matrix');
    this.select = $('#theme-select');
    this.current = this.select.val();

    /* Constructor */

    var theme = this;

    theme.setThemeCookie(theme.matrixType, theme.current);

    this.select.on('change', function () {
        theme.matrix.removeClass(theme.current);
        theme.current = $(this).val();
        theme.matrix.addClass(theme.current);
        theme.setThemeCookie(theme.matrixType, theme.current);
    });
}