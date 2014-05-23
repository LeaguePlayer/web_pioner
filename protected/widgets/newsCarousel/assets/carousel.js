!function($) {

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

}(jQuery);