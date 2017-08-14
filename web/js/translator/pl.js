"use strict";

function Translator() {

    this.getLocale = function () {
        return 'pl';
    };

    this.trans = function (id, param) {
        switch (id) {
            case 'required_field':
                return 'Wypełnij to pole.';
            case 'matrix.confirm_delete':
                return 'Na pewno chcesz usunąć analize "'+ param + '"?';
            default:
                return 'Tłumaczenie nie zostało znalezione';
        }
    }
}