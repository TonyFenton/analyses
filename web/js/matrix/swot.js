$(function () {
    var matrix = new Matrix();
    var swot = new Swot();

    matrix.addButtons.on('click', function () {
        var row = $(this).closest('.matrix-row');
        matrix.addItem($(this));
        swot.resizeFirstInput(row);
    });
    matrix.removeButtons.on('click', function () {
        var row = $(this).closest('.matrix-row');
        matrix.removeItem($(this));
        swot.resizeFirstInput(row); // I can't use $(this) because I just remove button

    });
    matrix.form.on('submit', function () {
        matrix.updateItemsNames();
    });
});

function Swot() {

    this.resizeFirstInput = function (row) {
        var maxHeight = 0;
        row.find('.matrix-cell').each(function () {
            var height = parseFloat($(this).css('height'));
            if (height > maxHeight) {
                maxHeight = height;
            }
        });
        var diff = maxHeight - this.minHeight;
        var firstInput = row.find('input:first');
        firstInput.css('width', this.firstInputWidth + diff);
        firstInput.css('top', this.firstInputTop + diff);
    };

    this.minHeight = parseFloat($('.matrix-cell').eq(3).css('min-height'));
    this.firstInput = $('#b1-cell input'); // or #c1-cell
    this.firstInputWidth = parseFloat(this.firstInput.css('width'));
    this.firstInputTop = parseFloat(this.firstInput.css('Top'));

    this.resizeFirstInput($('#b-row'));
    this.resizeFirstInput($('#c-row'));
}