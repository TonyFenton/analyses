function Matrix() {

    this.addItem = function (button) {
        var cell = button.closest('.matrix-cell');
        var newItem = cell.find('.prototype-item').clone(true, true);
        newItem.removeClass('prototype-item').addClass('matrix-item');
        cell.find('li:last').before(newItem);
        // newItem.hide().show(200);
        newItem.find('input').focus();
    };

    this.removeItem = function (button) {
        var item = button.closest('li');
        // item.hide(200, function () {
        //     item.remove();
        // });
        item.remove();
    };

    this.updateItemsNames = function () {
        $('.matrix-cell').each(function () {
            var prototypeInputName = $(this).find('.prototype-item input').attr('name');
            var i = 0;
            $(this).find('.matrix-item input').each(function () {
                $(this).attr('name', prototypeInputName.replace('__name__', i));
                i++;
            });
        });
    };

    this.turnOnPreviewMode = function () {
        this.matrix.find('.alert').remove();
        $('.remove-button').removeClass('icon-cancel').addClass('icon-dot');
        this.addButtons.hide();
        this.matrix.find("input").css({
            'background-color': 'transparent',
            'border': 0,
            'box-shadow': 'none',
            'padding-left': 0,
            'padding-right': 0
        }).prop("readonly", true);
        this.matrix.find('button').prop('disabled', true);
    };

    this.turnOffPreviewMode = function () {
        $('.remove-button').removeClass('icon-dot').addClass('icon-cancel');
        this.addButtons.show();
        this.matrix.find("input").css({
            'background-color': '',
            'border': '',
            'box-shadow': '',
            'padding-left': '',
            'padding-right': ''
        }).prop("readonly", false);
        this.matrix.find('button').prop('disabled', false);
    };

    this.form = $('#matrix-form');
    this.matrix = $('#matrix');
    this.addButtons = this.matrix.find('.add-button');
    this.removeButtons = this.matrix.find('.remove-button');

    /* Constructor */

    var thisObj = this;

    var viewModeCheckbox = $('#preview-mode');
    viewModeCheckbox.on('change', function () {
        if (this.checked) {
            thisObj.turnOnPreviewMode();
        } else {
            thisObj.turnOffPreviewMode();
        }
    });
}