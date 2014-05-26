!function($) {

    $.fn.init_carousel = function(options) {
        var settings = $.extend({
            autoPlay: true,
            navigation: false,
            pagination: false,
            singleItem: true,
            addClassActive: true
        }, options || {});

        return this.each(function() {
            var container = $(this);
            var image_carousel = $('.image-carousel', container);
            var caption_carousel = $('.caption-carousel', container);
            var imgOwl;
            var cptOwl;
            var prev = $('.prev', container);
            var next = $('.next', container);
            var carouselOptions = settings;

            if ( caption_carousel.length ) {
                caption_carousel.owlCarousel({
                    navigation: false,
                    pagination: false,
                    singleItem: true,
                    mouseDrag : false,
                    touchDrag : false
                });
                cptOwl = caption_carousel.data('owlCarousel');
                carouselOptions = $.extend(settings, {
                    afterMove: function() {
                        var active = $('.owl-item.active', image_carousel);
                        cptOwl.goTo(active.index());
                    }
                });
            }

            image_carousel.owlCarousel(carouselOptions);
            imgOwl = image_carousel.data('owlCarousel');

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

}(jQuery);