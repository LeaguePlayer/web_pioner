
!function($) {
    function pluralMonth(textDate) {
        var parts = textDate.split(' ');
        switch (parts[1]) {
            case 'Январь':
                parts[1] = 'января';
                break;
            case 'Февраль':
                parts[1] = 'февраля';
                break;
            case 'Март':
                parts[1] = 'марта';
                break;
            case 'Апрель':
                parts[1] = 'апреля';
                break;
            case 'Май':
                parts[1] = 'мая';
                break;
            case 'Июнь':
                parts[1] = 'июня';
                break;
            case 'Июль':
                parts[1] = 'июля';
                break;
            case 'Август':
                parts[1] = 'августа';
                break;
            case 'Сентябрь':
                parts[1] = 'сентября';
                break;
            case 'Октябрь':
                parts[1] = 'октября';
                break;
            case 'Ноябрь':
                parts[1] = 'ноября';
                break;
            case 'Декабрь':
                parts[1] = 'декабря';
                break;
        }
        return parts.join(' ');
    }


    $.fn.init_flip_calendar = function() {
        return this.each(function() {
            var container = $(this);
            var mainPage = $('.cover-main', container);
            var topPage = $('.cover-top', container).hide();
            var bottomPage = $('.cover-bottom', container);
            var datepicker = $('.calendar', mainPage);
            var topScroller = $('.scroller', topPage);
            var bottomScroller = $('.scroller', bottomPage);
            var topLoader = $('.loader', topPage);
            var bottomLoader = $('.loader', bottomPage);

            var topScroll = topScroller.baron({bar: '.scroller__bar'});
            var bottomScroll = bottomScroller.baron({bar: '.scroller__bar'});


            var loadNews = function() {
                topLoader.show();
                $('.content', bottomPage).html('');
                var date = datepicker.datepicker('getDate');
                //$('.ui-datepicker-title', topPage).text(date.getDate() + ' ' + $('.ui-datepicker-title', mainPage).text());
                $('.ui-datepicker-title', topPage).text( pluralMonth($.datepicker.formatDate('d MM yy', date)) );
                var month = (date.getMonth() + 1) + "";
                if ( month.length == 1 ) {
                    month = "0" + month;
                }
                var day = ""+date.getDate();
                if ( day.length == 1 ) {
                    day = "0" + day;
                }
                var date_public = [date.getFullYear(), month, day].join('-');
                $.get(topPage.data('url'), {date: date_public}, function(data) {
                    $('.content', topPage).html(data);
                    $('.fancybox', topPage).fancybox();
                    topScroll.update();
                    topScroller.scrollTop(0);
                    topLoader.hide();
                    var firstNews = $('.news-list a.title', topPage).first();
                    if ( firstNews.length ) {
                        var id = firstNews.attr('rel');
                        loadDescription(id);
                    }
                });
            }


            var loadDescription = function(id) {
                bottomLoader.show();
                $.get(bottomPage.data('url'), {id: id}, function(data) {
                    $('.content', bottomPage).html(data);
                    bottomScroll.update();
                    bottomScroller.scrollTop(0);
                    bottomLoader.hide();
                });
            }


            var closeCalendar = function() {
                topPage.flip({
                    direction: 'tb',
                    speed: 200,
                    color: '#fff',
                    onEnd: function() {
                        mainPage.show();
                        topPage.hide();
                    }
                });
            }


            topPage.on('click', '.news-list a.title', function(e) {
                var id = $(this).attr('rel');
                loadDescription(id);
                return false;
            });

            $.getJSON(datepicker.data('endates'), function(enabledDates) {
                datepicker.datepicker({
                    onSelect: function(dateText, inst) {
                        mainPage.flip({
                            direction: 'bt',
                            speed: 200,
                            color: '#fff',
                            onEnd: function() {
                                mainPage.hide();
                                topPage.show();
                                loadNews();
                            }
                        });

                        var containerTop = container.offset().top - 320;
                        if ( $(document).scrollTop() > containerTop ) {
                            $('body').scrollTo( containerTop, 300 );
                        }
                    },
                    beforeShowDay: function(date) {
                        var dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
                        if ($.inArray(dmy, enabledDates) == -1) {
                            return [false, "disable", "Нет мероприятий"];
                        } else {
                            return [true, ""];
                        }
                    }
                });
            });

            $('.ui-datepicker-prev', topPage).click(function(e) {
                var date = datepicker.datepicker('getDate');
                date.setTime( date.getTime() - (1000*60*60*24) );
                datepicker.datepicker('setDate', date);
                loadNews();
            });

            $('.ui-datepicker-next', topPage).click(function(e) {
                var date = datepicker.datepicker('getDate');
                date.setTime( date.getTime() + (1000*60*60*24) );
                datepicker.datepicker('setDate', date);
                loadNews();
            });

            $('.back', bottomPage).click(function(e) {
                closeCalendar();
                return false;
            });

//            $('.forward', mainPage).click(function(e) {
//                alert( datepicker.datepicker('getDate') );
//                return false;
//            });

//            $(document).on('click', function (e) {
//                if ( !$(e.target).closest(container).size() ) {
//                    closeCalendar();
//                }
//            });
        });
    }
}(jQuery)

