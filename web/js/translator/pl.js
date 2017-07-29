"use strict";

function Translator() {

    this.trans = function (id, param) {
        switch (id) {
            case 'required_field':
                return 'Wypełnij to pole.';
            default:
                return 'Tłumaczenie nie zostało znalezione';
        }
    }
}