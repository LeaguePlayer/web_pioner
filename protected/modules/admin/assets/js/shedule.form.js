
$(document).ready(function() {
    var localOptions = {
            buttonText: {
                today: 'Сегодня',
                month: 'Месяц',
                day: 'День',
                week: 'Неделя'
            },
            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            monthNamesShort: ['Янв','Фев','Мар','Фпр','Май','Июн','Июл','Авг','Сент','Окт','Ноя','Дек'],
            dayNames: ['Воскресенье','Понедельник','Вторник','Среда','Четверг','Пятница','Суббота'],
            dayNamesShort: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб']
        },
        shedule = $('#shedule'),
        addEventModal = $('#addEventModal'),
        editEventModal = $('#editEventModal'),
        startInput = $('input.event-start', addEventModal),
        endInput = $('input.event-end', addEventModal),
        titleInput = $('input.event-title', addEventModal),
        teachersSelect = $('select.event-teachers', addEventModal),
        jsonEventsText = $('#CollectiveShedule_json_events'),
        events = jsonEventsText.val() ? $.parseJSON(jsonEventsText.val()) : [];


    startInput.add(endInput).add($('input.event-start', editEventModal)).add($('input.event-end', editEventModal)).timepicker({
        minuteStep: 30,
        showMeridian: false
    });

    teachersSelect.select2();

    addEventModal.on('show', function(e) {
        var self = $(this),
            start = self.data('start'),
            end = self.data('end'),
            allDay = self.data('allDay');
        startInput.timepicker('setTime', start);
        endInput.timepicker('setTime', end);
    });


    addEventModal.on('hide', function(e) {
        shedule.fullCalendar('unselect');
        titleInput.val('');
    });


    function saveEvents()
    {
        var _events = [];
        for ( var i = 0; i < events.length; i++ ) {
            var event = {
                id: events[i].id,
                title: events[i].title,
                allDay: events[i].allDay,
                start: events[i].start,
                end: events[i].end,
                repeat: events[i].repeat,
                teachers: events[i].teachers
            }
            event.start.setHours(event.start.getHours() - event.start.getTimezoneOffset() / 60);
            event.end.setHours(event.end.getHours() - event.end.getTimezoneOffset() / 60);
            _events.push(event);
            jsonEventsText.val( JSON.stringify(_events) );
        }
    }


    $('.event-save', addEventModal).click(function(e) {
        var selected = teachersSelect.select2('data');
        var teachers = [];
        for ( var i = 0; i < selected.length; i++ ) {
            teachers.push({
                id: selected[i].id,
                name: selected[i].text
            });
        }
        var event = {
            id: events.length + 1,
            title: titleInput.val() + '<br>',
            allDay: addEventModal.data('allDay'),
            start: addEventModal.data('start'),
            end: addEventModal.data('end'),
            repeat: $('input.period:checked').val(),
            teachers: teachers
        };
        events.push(event);
        shedule.fullCalendar('refetchEvents');
        shedule.fullCalendar('rerenderEvents');
        addEventModal.modal('hide');
        saveEvents();
        return false;
    });


    $('.btn.delete', editEventModal).click(function(e) {

    });


    shedule.fullCalendar($.extend({
        events: function(start, end, callback) {
            callback(events);
        },
        firstDay: 1,
        selectable: true,
        selectHelper: true,
        unselectAuto: false,
        select: function(start, end, allDay) {
            if ( allDay ) {
                shedule.fullCalendar('unselect');
                return ;
            }
            addEventModal.data({start: start, end: end, allDay: allDay}).modal('show');
        },
        eventClick: function( event, jsEvent, view ) {
            $('input.event-start', editEventModal).timepicker('setTime', event.start);
            $('input.event-end', editEventModal).timepicker('setTime', event.end);
            $('input.event-title', editEventModal).val(event.title);
            $('input[value='+event.repeat+'].period', editEventModal).prop('checked', true);
            editEventModal.modal('show');
        },
        eventRender: function (event, element) {
            var title = '<b>'+event.title+'</b><br>';
            var teachers = [];
            for ( var i = 0; i < event.teachers.length; i++ ) {
                teachers.push(event.teachers[i].name);
            }
            title += teachers.join(', ');
            element.find('.fc-event-title').html(title);
        },
        editable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'agendaWeek',
        axisFormat: 'H',
        minTime: 7,
        maxTime: 22
    }, localOptions));



//    shedule.fullCalendar( 'addEventSource',
//        function(start, end, callback) {
//            var _evevens = [],
//                loop,
//                i;
//            for (loop = start.getTime();
//                 loop <= end.getTime();
//                 loop = loop + (24 * 60 * 60 * 1000)) {
//
//                var test_date = new Date(loop);
//
//                for ( i = 0; i < events.length; i++ ) {
//                    var _ev = events[i];
//                    switch ( _ev.repeat ) {
//                        case 'every_day':
//                            console.log( _ev );
//                            break;
//                    }
//                }
//            }
//            callback( events );
//        }
//    );
});
