function Translator() {

    this.trans = function (id, param) {
        switch (id) {
            case 'required_field':
                return 'Please fill out this field.';
            default:
                return 'Translation not found';
        }
    }
}