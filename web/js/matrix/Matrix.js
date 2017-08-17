"use strict";

function Matrix() {

    this.addItem = function (afterItem, callback) {
        var ul = afterItem.closest('ul');
        var newItem = ul.find('.prototype-item').clone(true, true);
        newItem.removeClass('prototype-item').addClass('matrix-item');
        afterItem.after(newItem);
        newItem.hide().show(200, function () {
            newItem.find('input').focus();
            callback();
        });
    };

    this.removeItem = function (item, callback) {
        item.hide(200, function () {
            item.remove();
            callback();
        });
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
        if (!this.isPreviewMode) {
            this.matrix.find('.alert').remove();
            $('.remove-button').hide();
            this.addButtons.hide();
            this.matrix.find('input').css({
                'background-color': 'transparent',
                'border': 0,
                'box-shadow': 'none',
                'padding': 0
            }).prop("readonly", true);
            $('.matrix-item input').each(function () { // this way because html2canvas
                $(this).val(matrix.bullet + $(this).val());
                $(this).css('padding-left', '8px');
            });
            this.matrix.find('button').prop('disabled', true);
            this.isPreviewMode = true;
        }
    };

    this.turnOffPreviewMode = function () {
        if (this.isPreviewMode) {
            $('.remove-button').show();
            this.addButtons.show();
            this.matrix.find("input").css({
                'background-color': '',
                'border': '',
                'box-shadow': '',
                'padding': ''
            }).prop("readonly", false);
            $('.matrix-item input').each(function () {
                $(this).val($(this).val().replace(matrix.bullet, ''));
                $(this).css('padding-left', '');
            });
            this.matrix.find('button').prop('disabled', false);
            this.isPreviewMode = false;
        }
    };

    this.capture = function (type, callback) {
        this.previewMode.prop('checked', true).trigger('change');
        html2canvas(this.matrix, {
            onrendered: function (canvas) {
                $('input.canvas').val(canvas.toDataURL(type));
                callback();
            }
        });
    };

    /**
     * Makes lists sortable
     */
    this.sortable = function (stopCallback) {
        this.sortableInitiate(stopCallback);
        this.sortableOnMousedown();
        this.sortableOnMouseup();
    };

    this.sortableInitiate = function (stopCallback) {
        stopCallback = typeof stopCallback === 'undefined' ? function () {
        } : stopCallback;
        matrix.itemsLists.sortable({
            cancel: '',
            connectWith: '.matrix-items-list',
            placeholder: 'sortable-placeholder',
            containment: '#m-table',
            opacity: 0.95,
            stop: function () {
                matrix.itemsLists.sortable('disable');
                stopCallback();
            }
        }).sortable('disable');
    };

    this.sortableOnMousedown = function () {
        var enableSort = false;
        matrix.itemsInputs.on('mousedown', function (event) {
            if (!enableSort) {
                setTimeout(function (thisObj) {
                    matrix.itemsLists.sortable('enable');
                    enableSort = true;
                    thisObj.trigger(event);
                    enableSort = false;
                }, 10, $(this))
            }
        });
    };

    this.sortableOnMouseup = function () {
        matrix.itemsInputs.on('mouseup', function () {
            setTimeout(function () {
                matrix.itemsLists.sortable('disable');
            }, 15);
        });
    };

    this.form = $('#matrix-form');
    this.matrix = $('#matrix');
    this.addButtons = this.matrix.find('.add-button');
    this.removeButtons = this.matrix.find('.remove-button');
    this.itemsLists = $('.matrix-items-list');
    this.itemsInputs = this.itemsLists.find('input');
    this.bullet = '• ';
    this.previewMode = $('#preview-mode');
    this.isPreviewMode = this.previewMode.prop('checked');

    /* Constructor */

    var matrix = this;

    this.form.find('[type="submit"]').on('click', function () {
        $(this).attr("clicked", "true");
    });

    var isSubmit = false;
    this.form.on('submit', function (event) {
        if (!isSubmit) {
            event.preventDefault();
            matrix.updateItemsNames();
            var clicked = $('[clicked="true"]');
            var submit = function () {
                isSubmit = true;
                matrix.previewMode.prop('checked', false).trigger('change');
                clicked.click();
                isSubmit = false;
                clicked.removeAttr('clicked');
            };
            if (clicked.hasClass('jpg')) {
                matrix.capture("image/jpeg", submit);
            } else if (clicked.hasClass('png')) {
                matrix.capture("image/png", submit);
            } else {
                setTimeout(function () {
                    submit()
                }, 10);
            }
        }
    });

    this.itemsInputs.on('focus', function () {
        $(this).addClass('focus');
    });

    this.itemsInputs.on('blur', function () {
        $(this).removeClass('focus');
    });
}