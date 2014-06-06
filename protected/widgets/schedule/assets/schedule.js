$(function() {

    var schedule = $('.schedule');
    var placesBlock = $('.places', schedule);
    var cabinetsBlock = $('.cabinets', schedule);
    var scheduleMap = $('.schedule-map', schedule);
    var eventsContainer = $('.events-container', schedule);
    var topOffset = 22; // отступ сверху (шапка)
    var leftOffset = scheduleMap.outerWidth() * 0.09; // 9 % от общей ширины таблицы
    var step = scheduleMap.outerWidth() * 0.13; // ширина ячейки
    var minuteHeight = 20 / 30;  // высота ячейки в пикселах, занимающей 1 минуту
    var timeBounds = [7 * 60, 21 * 60]; // граница времени в минутах
    var currentEventsData;

    var selectCabinet = function(cabinet) {
        eventsContainer.html('');
        for ( var weekDay in currentEventsData[cabinet] ) {
            var events = currentEventsData[cabinet][weekDay];
            var left = step * (weekDay - 1) + leftOffset - 2;
            var right = step * ( 7 - weekDay ) - 1;
            for ( var i = 0; i < events.length; i++ ) {
                var $ev = $('<div class="event"/>');
                var title = $('<span class="title" />').text(events[i].title);
                var period = $('<span class="period" />').text(events[i].start + ' - ' + events[i].end);
                var collective = $('<span class="collective" />').text(events[i].collective);
                var teachers = $('<span class="teachers" />').html(events[i].teachers.join('<br>'));

                // переводим время начала и конца в минуты
                var timeStart = events[i].start.split(':');
                var timeEnd = events[i].end.split(':');
                var start = parseInt(timeStart[0]) * 60 + parseInt(timeStart[1]);
                var end = parseInt(timeEnd[0]) * 60 + parseInt(timeEnd[1]);
                var top = (start - timeBounds[0]) * minuteHeight + topOffset - 2;
                var height = (end - start) * minuteHeight + 3;

                $ev.append(title).append(period).append(collective).append(teachers).css({
                    left: left,
                    right: right,
                    top: top,
                    height: height
                });

                eventsContainer.append($ev);
            }
        }
//        console.log($('a[rel='+cabinet+']', cabinetsBlock));
        $('a[rel='+cabinet+']', cabinetsBlock).addClass('active').siblings().removeClass('active');
    }

    var selectPlace = function(placeLink) {
        currentEventsData = placeLink.data('info');
        var firstCabinet;
        cabinetsBlock.html('');
        placeLink.addClass('active').siblings().removeClass('active');
        for ( var cabinet in currentEventsData ) {
            if ( !firstCabinet ) {
                firstCabinet = cabinet;
            }
            cabinetsBlock.append($('<a href="" rel="'+cabinet+'"/>').text(cabinet));
        }
        selectCabinet(firstCabinet);
    }

    placesBlock.on('click', '.change-place', function(e) {
        selectPlace($(this));
        return false;
    });

    cabinetsBlock.on('click', 'a', function(e) {
        selectCabinet($(this).attr('rel'));
        return false;
    });

    selectPlace($('.change-place', schedule).first());

});