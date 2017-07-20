var translator = new Translator();

/* Replace invalid message on element with attr required="required" */
$('input[required="required"]').on('invalid', function () {
    if ($(this).val() === '') {
        this.setCustomValidity(translator.trans('required_field'));
    } else {
        this.setCustomValidity('');
    }
});