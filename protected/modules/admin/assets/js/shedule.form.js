
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
    };
    var shedule = $('#shedule');
    var eventFormModal = $('#eventFormModal');
    var editEventModal = $('#editEventModal');
    var jsonEventsText = $('#CollectiveShedule_json_events');
    var editingEvent;
    var events = jsonEventsText.val() ? $.parseJSON(jsonEventsText.val()) : [];
    for ( var i = 0; i < events.length; i++ ) {
        events[i].start = new Date(events[i].start);
        events[i].end = new Date(events[i].end);
    }


    $('input.event-start', eventFormModal).add($('input.event-end', eventFormModal)).add($('input.event-start', editEventModal)).add($('input.event-end', editEventModal)).timepicker({
        minuteStep: 30,
        showMeridian: false
    });

    $('select.event-teachers', eventFormModal).select2();
    $('select.event-teachers', editEventModal).select2();


    eventFormModal.on('show', function(e) {
        $('input.event-start', eventFormModal).timepicker('setTime', editingEvent.start);
        $('input.event-end', eventFormModal).timepicker('setTime', editingEvent.end);
        $('input.event-title', eventFormModal).val(editingEvent.title);
        $('input[value='+editingEvent.repeat+'].period', eventFormModal).prop('checked', true);
        var teachers = [];
        for ( var i = 0; i < editingEvent.teachers.length; i++ ) {
            teachers.push(editingEvent.teachers[i].id);
        }
        $('select.event-teachers', eventFormModal).select2('val', teachers);
    });


    eventFormModal.on('hide', function(e) {
        shedule.fullCalendar('unselect');
        $('input.event-title', eventFormModal).val('');
    });


    function saveEvents()
    {
        var _events = [];
        for ( var i = 0; i < events.length; i++ ) {
            var event = {
                id: events[i].id,
                title: events[i].title,
                allDay: events[i].allDay,
                start: new Date(events[i].start.getTime()),
                end: new Date(events[i].end.getTime()),
                repeat: events[i].repeat,
                teachers: events[i].teachers
            };
            _events.push(event);
        }
        jsonEventsText.val( JSON.stringify(_events) );
    }


    $('.event-save', eventFormModal).click(function(e) {
        var selectedTeachers = $('select.event-teachers', eventFormModal).select2('data');
        var teachers = [];
        for ( var i = 0; i < selectedTeachers.length; i++ ) {
            teachers.push({
                id: selectedTeachers[i].id,
                name: selectedTeachers[i].text
            });
        }
        editingEvent.title = $('input.event-title', eventFormModal).val();
        editingEvent.repeat = $('input.period:checked', eventFormModal).val();
        editingEvent.teachers = teachers;
        if ( !editingEvent.id ) { // is new event?
            editingEvent.id = events.length + 1;
            events.push(editingEvent);
        } else {
            for ( var i = 0; i < events.length; i++ ) {
                if ( editingEvent.id == events[i].id ) {
                    events[i] = editingEvent;
                    break;
                }
            }
        }

        shedule.fullCalendar('refetchEvents');
        shedule.fullCalendar('rerenderEvents');

        $('select.event-teachers', eventFormModal).select2('val', '');
        eventFormModal.modal('hide');
        return false;
    });


    $('.btn.delete', eventFormModal).click(function(e) {
        if ( !confirm('Удалить занятие «'+$('input.event-title', eventFormModal).val()+'»' ) ) {
            return false;
        }
        var id = editingEvent.id;
        var _events = [];
        for ( var i = 0; i < events.length; i++ ) {
            if ( id == events[i].id ) {
                continue;
            }
            events[i].id = i + 1;
            _events.push(events[i]);
        }
        events = _events;
        shedule.fullCalendar('refetchEvents');
        shedule.fullCalendar('rerenderEvents');
        eventFormModal.modal('hide');
        return false;
    });



    function moveEvent(event)
    {
        for ( var i = 0; i < events.length; i++ ) {
            if ( event.id == events[i].id ) {
                events[i].start = event.start;
                events[i].end = event.end;
                break;
            }
        }
    }



    shedule.fullCalendar($.extend({
        events: function(start, end, callback) {
            var _events = [],
                loop,
                i;
            for (loop = start.getTime();
                 loop <= end.getTime();
                 loop += (24 * 60 * 60 * 1000)) {

                var test_date = new Date(loop);

                for ( i = 0; i < events.length; i++ ) {
                    var _ev = events[i];
                    var visibleEvent = false;
                    switch ( _ev.repeat ) {
                        // repeat event every_day
                        case 'every_day':
                            visibleEvent = true;
                            break;
                        // repeat event every_week
                        case 'every_week':
                            visibleEvent = test_date.getDay() == _ev.start.getDay();
                            break;
                        // repeat event every_weekdays
                        case 'every_weekdays':
                            var current_day = test_date.getDay();
                            visibleEvent = current_day != 0 &&  current_day != 6;
                            break;
                        // no repeat
                        default:
                            visibleEvent = false;
                            var isCurrentDay = test_date.getFullYear() == _ev.start.getFullYear() &&
                                               test_date.getMonth() == _ev.start.getMonth() &&
                                               test_date.getDate() == _ev.start.getDate();
                            if ( isCurrentDay )
                                _events.push(_ev);
                    }

                    if ( visibleEvent ) {
                        var _ev_start = new Date(test_date.getTime());
                        _ev_start.setHours( _ev.start.getHours() );
                        _ev_start.setMinutes( _ev.start.getMinutes() );
                        var _ev_end = new Date(test_date.getTime());
                        _ev_end.setHours( _ev.end.getHours() );
                        _ev_end.setMinutes( _ev.end.getMinutes() );
                        _events.push({
                            id: _ev.id,
                            title: _ev.title,
                            start: _ev_start,
                            end: _ev_end,
                            teachers: _ev.teachers,
                            allDay: _ev.allDay,
                            repeat: _ev.repeat
                        });
                    }
                }
            }
            callback(_events);
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
            editingEvent = {
                title: '',
                start: start,
                end: end,
                allDay: allDay,
                repeat: 0,
                teachers: []
            };
            $('input.event-start', eventFormModal).timepicker('setTime', start);
            $('input.event-end', eventFormModal).timepicker('setTime', end);
            $('.modal-header h3', eventFormModal).text('Создание занятия');
            $('.btn.delete', eventFormModal).hide();
            eventFormModal.modal('show');
        },
        eventClick: function( event, jsEvent, view ) {
            editingEvent = event;
            $('.modal-header h3', eventFormModal).text('Редактирование занятия «' + event.title + '»');
            $('.btn.delete', eventFormModal).show();
            eventFormModal.modal('show');
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
        eventDrop: function( event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view ) {
            moveEvent(event);
        },
        eventResize: function( event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view ) {
            moveEvent(event);
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


    $('form').submit(function(e) {
        saveEvents();
    });
});
