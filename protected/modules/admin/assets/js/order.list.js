
$(function() {

    $('#order-grid').on('click', 'a.success', function(e) {
        $.post($(this).attr('href'), function(data) {
            $.fn.yiiGridView.update('order-grid');
        });
        return false;
    });

});