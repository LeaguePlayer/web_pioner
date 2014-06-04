
$(document).ready(function() {

    if ( $('.services').size() ) {
        var services_block = $('.services');
        var height = 0;
        $('.block', services_block).each(function() {
            var _h = $(this).outerHeight();
            (_h > height) && (height = _h);
        });
        var scroller = $('.preview .scroller', services_block).height(height);
        var scroll = scroller.baron({
            bar: '.scroller__bar'
        });
        var loader = $('.loader', services_block);
        $('a.fancybox', services_block).fancybox();
        $('.loadCollectives', services_block).click(function(e) {
            $('.loadCollectives', services_block).removeClass('active');
            $(this).addClass('active');
            loader.show();
            $.ajax({
                url: $(this).attr('href'),
                success: function(data) {
                    $('.content', scroller).html(data);
                    $('a.fancybox', scroller).fancybox();
                    scroll.update();
                    scroller.scrollTop(0);
                    loader.hide();
                }
            });
            return false;
        });
    }

    if ( window.Gamma !== undefined ) {
        var GammaSettings = {
            // order is important!
            viewport : [{
                width : 0,
                columns : 4
            }],
            nextOnClickImage : true
        };
        Gamma.init( GammaSettings );
    }

    $("select").uniform();

    $(document).on('click', 'a.order', function() {
        var collective_id = $(this).attr('rel');
        $.fancybox.open('#order-form-modal', {
            autoSize: true,
            afterShow: function() {
                $('#Order_collective_id', this.inner).val(collective_id);
                $.uniform.update();
            }
        });
        return false;
    });
});

