function Matrix() {

    this.matrix = $('#matrix');
    this.uniqueInt = 0;

    /* construct */
    var thisObj = this;
    this.matrix.find('.add-button').on('click', function () {
        thisObj.addItem($(this));
    });
    $('.remove-button').on('click', function () {
        thisObj.removeItem($(this));
    });
    $('form').on('submit', function () {
     //   $('.prototype-item').remove(); nie działa przy cofnięciu albo powrocie
        $('.m-cell').each(function () {
            var i = 0;
            $(this).find('.matrix-item input').each(function () {
                $(this).attr('name', $(this).attr('name').replace('__name__', i));
                i++;
            });
        });
    });


    this.addItem = function (button) {
        var cell = button.closest('.m-cell');
        var newItem = cell.find('.prototype-item').clone();
        newItem.removeClass('prototype-item').addClass('matrix-item');

        newItem.find('.remove-button').on('click', function () {
            thisObj.removeItem($(this));
        });
        cell.find('ul').append(newItem);
        //newItem.hide().show(200);
        newItem.find('input').focus();
    };

    this.removeItem = function (button) {
        var item = button.closest('li');
        // item.hide(200, function () {
        //     item.remove();
        // });
        item.remove();
    };

    // this.getUniqueInt = function () {
    //     var int = this.uniqueInt;
    //     this.uniqueInt++;
    //     return int;
    // }

}