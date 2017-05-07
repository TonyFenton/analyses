function Cell(cell) {

    this.cell = cell;

    this.list = this.cell.find('.swot-list');

    this.hiddenItem = this.list.find('li:first');

    /* construct */
    var thisObj = this;
    this.cell.find('.add-button').on('click', function () {
        thisObj.addItem();
    });
    this.list.find('.remove-button').on('click', function () {
        thisObj.removeItem($(this));
    });

    this.addItem = function () {
        var item = this.createItem();

        item.find('.remove-button').on('click', function () {
            thisObj.removeItem($(this));
        });

        this.list.append(item);
        item.hide().show(300);
        item.find('input').focus();

    };

    this.createItem = function () {
        var item = this.hiddenItem.clone();
        item.removeClass('display-none');
        return item;
    };

    this.removeItem = function (button) {
        var item = button.closest('li');
        item.hide(300, function () {
            item.remove();
        });
    }


}