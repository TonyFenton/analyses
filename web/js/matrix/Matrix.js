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

    this.form = $('#matrix-form');
    this.matrix = $('#matrix');
    this.addButtons = this.matrix.find('.add-button');
    this.removeButtons = this.matrix.find('.remove-button');
}