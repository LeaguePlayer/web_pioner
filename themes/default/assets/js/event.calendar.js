
$(document).ready(function() {

    var calendar = $('#calendar');
    var chooseDateInput;
    var previewBlock = $('.event-preview');
    var loader = $('.loader-orange', previewBlock);
    var xhr;
    var baron;

    var loadItems = function(date, callback) {

        $.get('/event/loadCalendarItems', {
            date: date
        }, callback);
    }

    calendar.fullCalendar({
        events: {
            url: '/event/feed',
            type: 'GET',
//            cache: true
        },
        header: {
            left: '',
            center: 'prev title next',
            right: ''
        },
        viewRender: function(view, element) {
            loader.hide();
            var leftHeaderBlock = $('.fc-header-left', calendar);
            if ( !chooseDateInput ) {
                chooseDateInput = $('<input type="text" class="choose_date" />');
                leftHeaderBlock.append(chooseDateInput);
                chooseDateInput.wrap('<div class="input-group" />').parent().append('<span class="append"><i class="icon-calendar"></i></span>');
                $.getJSON('/event/getEnabledDays', function(enabledDates) {
                    chooseDateInput.datepicker({
                        onSelect: function ( dateText, inst ) {
                            chooseDateInput.focusout();
                            calendar.fullCalendar('gotoDate', moment(dateText, 'DD.MM.YYYY'));
                            loader.hide();
                            loadItems(dateText, function(data) {
                                $('.content', previewBlock).html(data);
                                baron.update();
                                $('.scroller', previewBlock).scrollTo(0);
                                loader.hide();
                            });
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

            }
            chooseDateInput.datepicker('setDate', calendar.fullCalendar('getDate').format('DD.MM.YYYY'));
        },
        dayRender: function( date, cell ) {
        },
        eventRender: function(event, element) {
            var inner = $('.fc-event-inner', element).html('');
            var newEvent = $('<img rel="'+event.number+'" src="'+event.photo+'" height="75"/>');
            inner.append(newEvent);
            element.attr('group', event.start.get('month')+'-'+event.start.get('date'));
            element.addClass('n-'+event.number);
        },
        eventAfterRender: function( event, element, view ) {
            var group = event.start.get('month')+'-'+event.start.get('date');
            var groupEvents = $('.fc-event-container .fc-event[group='+group+']', calendar);
            var top = 100000;
            for ( var i = 0; i < groupEvents.size(); i++ ) {
                var t = parseFloat($(groupEvents[i]).css('top'));
                if ( t < top ) {
                    top = t;
                }
            }
            var width = ( element.width() + 0.5 ) / event.full_count;

            element.css({
                width: width,
                left: parseFloat(element.css('left')) + width * event.number,
                top: top
            });
        },
        eventClick: function( event, jsEvent, view ) {
            loader.show();
            loadItems(event.start.format('DD-MM-YYYY'), function(data) {
                $('.content', previewBlock).html(data);
                baron.update();
                loader.hide();
                $('.scroller', previewBlock).scrollTo('#event-' + event.id, 500);
            });
        }
    });

    baron = $('.scroller', previewBlock)
        .height( previewBlock.closest('.col-sidebar').prev().height() )
        .baron({bar: '.scroller__bar'});

});