
$(document).ready(function() {

    $('.slider-widget').init_slider();


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

        $('a.fancybox', services_block).fancybox({
        });
        $('.loadCollectives', services_block).click(function(e) {
            loader.show();
            $.ajax({
                url: $(this).attr('href'),
                success: function(data) {
                    $('.content', scroller).html(data);
                    $('a.fancybox', scroller).fancybox();
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


    $('.carousel').init_carousel();

//    $(".photos").owlCarousel({navigation:true,singleItem:true,pagination:false,navigationText:[]});
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
        }
    });
}


$.fn.init_carousel = function() {
    return this.each(function() {
        var container = $(this);
        var image_carousel = $('.image-carousel', container);
        var caption_carousel = $('.caption-carousel', container);
        var imgOwl;
        var cptOwl;
        var prev = $('.prev', container);
        var next = $('.next', container);

        image_carousel.owlCarousel({
            navigation: false,
            pagination: false,
            singleItem: true,
            addClassActive: true,
            afterMove: function() {
                var active = $('.owl-item.active', image_carousel);
                cptOwl.goTo(active.index());
            }
        });

        caption_carousel.owlCarousel({
            navigation: false,
            pagination: false,
            singleItem: true,
            mouseDrag : false,
            touchDrag : false
        });

        imgOwl = image_carousel.data('owlCarousel');
        cptOwl = caption_carousel.data('owlCarousel');

        prev.on('click', function(e) {
            imgOwl.prev();
            return false;
        });

        next.on('click', function(e) {
            imgOwl.next();
            return false;
        });
    });
}

