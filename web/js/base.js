var translator = new Translator();

/* Replace invalid message on element with attr required="required" */
$('[required="required"]').on('invalid', function () {
    this.setCustomValidity(translator.trans('required_field'));
});