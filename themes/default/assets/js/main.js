
$(document).ready(function() {

    $('.slider-widget').init_slider();
    $('.scroller').baron({
        bar: '.scroller__bar'
    });

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
