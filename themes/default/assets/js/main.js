
$(document).ready(function() {

    $('.slider-widget').init_slider();


    if ( $('.services').size() ) {
        var services_block = $($('.services'));
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
        $('.loadCollectives', services_block).click(function(e) {
            loader.show();
            $.ajax({
                url: $(this).attr('href'),
                success: function(data) {
                    $('.content', scroller).html(data);
                    scroll.update();
                    scroller.scrollTop(0);
                    loader.hide();
                },
                error: function() {
//                    loader.hide();
                }
            });
            return false;
        });
    }
});


$.fn.init_slider = function() {
    return this.each(function() {
        var $widget = $(this);
        var jssor_container = $('.jssor_container', $widget);
        var jssorOptions = {
            $AutoPlay: true,
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $ChanceToShow: 2
            }
        };
        var jssor_slider = new $JssorSlider$(jssor_container.attr('id'), jssorOptions);
        jssor_slider.$On($JssorSlider$.$EVT_PARK, function(slideIndex, fromIndex) {
            animateFeed(slideIndex, fromIndex);
        });
        var animateFeed = function(slideIndex, fromIndex) {
            console.log(slideIndex, fromIndex);
        }
    });
}
