"use strict";

$(function () {
    var matrix = new Matrix();
    var swot = new Swot();
    new Theme();

    matrix.sortable(function () {
        swot.resizeVerticalInput($('#b-row'));
        swot.resizeVerticalInput($('#c-row'));
    });

    matrix.addButtons.on('click', function () {
        var row = $(this).closest('.matrix-row');
        var lastItem = $(this).closest('.matrix-cell').find('li').last();
        matrix.addItem(lastItem, function () {
            swot.resizeVerticalInput(row);
        });
    });

    matrix.removeButtons.on('click', function () {
        var row = $(this).closest('.matrix-row');
        matrix.removeItem($(this).closest('li'), function () {
            swot.resizeVerticalInput(row); // I can't use $(this) because I just remove button
        });
    });

    $('#preview-mode').on('change', function () {
        if (this.checked) {
            matrix.turnOnPreviewMode();
        } else {
            matrix.turnOffPreviewMode();
        }
        swot.resizeVerticalInput($('#b-row'));
        swot.resizeVerticalInput($('#c-row'));
    });

    $(window).on('resize', function () {
        swot.resizeTops();
    });

    var isEnterDown = false;
    matrix.itemsInputs.on('keydown', function (event) {
        if (event.which === 13) { // the enter key code
            event.preventDefault();
            if (!isEnterDown) {
                var item = $('.matrix-item .focus').parent();
                var row = item.closest('.matrix-row');
                matrix.addItem(item, function () {
                    swot.resizeVerticalInput(row);
                });
                isEnterDown = true;
            }
        }
    });

    matrix.itemsInputs.on('keyup', function (event) {
        if (event.which === 13) { // the enter key code
            isEnterDown = false;
        }
    });
});

function Swot() {

    this.resizeVerticalInput = function (row) {
        var maxHeight = 0;
        row.find('.matrix-cell').each(function () {
            var height = parseFloat($(this).css('height'));
            if (height > maxHeight) {
                maxHeight = height;
            }
        });
        var diff = maxHeight - this.minHeight;
        var verticalInput = row.find('input:first');
        verticalInput.css('width', this.verticalInputWidth + diff);
        verticalInput.css('top', this.verticalInputTop + diff);
    };

    this.resizeTops = function () {
        var width = this.verticalCell.width();
        this.a2Cell.height(width);
        this.a3Cell.height(width);
    };

    this.minHeight = parseFloat($('.matrix-cell').eq(3).css('min-height'));
    this.verticalCell = $('#b1-cell'); // or #c1-cell
    this.verticalInput = this.verticalCell.find('input');
    this.verticalInputWidth = parseFloat(this.verticalInput.css('width'));
    this.verticalInputTop = parseFloat(this.verticalInput.css('Top'));
    this.a2Cell = $('#a2-cell');
    this.a3Cell = $('#a3-cell');

    /* Constructor */

    this.resizeVerticalInput($('#b-row'));
    this.resizeVerticalInput($('#c-row'));

    this.resizeTops();
}