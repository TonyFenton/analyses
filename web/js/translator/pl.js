function Translator() {

    this.trans = function (id, param) {
        switch (id) {
            case 'capital_sth':
                return 'Coś';
            default:
                return 'Tłumaczenie nie zostało znalezione';
        }
    }
}