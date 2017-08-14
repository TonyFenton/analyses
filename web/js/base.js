"use strict";

var translator = new Translator();

$(function () {
    /* Replace invalid message on element with attr required="required" */
    $('input[required="required"]').on('invalid', function () {
        if ($(this).val() === '') {
            this.setCustomValidity(translator.trans('required_field'));
        }
        this.setCustomValidity('');
    });
});