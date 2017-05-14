function Translator() {

    this.trans = function (id, param) {
        switch (id) {
            case 'capital_sth':
                return 'Sth';
            default:
                return 'Translation not found';
        }
    }
}