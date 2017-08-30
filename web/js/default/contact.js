"use strict";

$(function () {
    var locale = translator.getLocale();
    if ('en' === locale) {
        locale = ''; // default value: en_US
    }
    tinymce.init({selector: 'textarea', plugins: 'code', language: locale});
});