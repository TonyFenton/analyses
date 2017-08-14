"use strict";

function Translator() {

    this.getLocale = function () {
        return 'en';
    };

    this.trans = function (id, param) {
        switch (id) {
            case 'required_field':
                return 'Please fill out this field.';
            case 'matrix.confirm_delete':
                return 'Are you sure you want to delete "'+ param + '" analysis?';
            default:
                return 'Translation not found';
        }
    };
}