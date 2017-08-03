"use strict";

$(function () {
    var matrix = new Matrix();
    var swot = new Swot();

    matrix.addButtons.on('click', function () {
        var row = $(this).closest('.matrix-row');
        matrix.addItem($(this));
        swot.resizeVerticalInput(row);
    });
    matrix.removeButtons.on('click', function () {
        var row = $(this).closest('.matrix-row');
        matrix.removeItem($(this));
        swot.resizeVerticalInput(row); // I can't use $(this) because I just remove button

    });

    $(window).on('resize', function () {
        swot.resizeTops();
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