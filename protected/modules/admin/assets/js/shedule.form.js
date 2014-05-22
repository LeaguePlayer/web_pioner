
jQuery.fn.sortElements = (function () {
    var sort = [].sort;
    return function (comparator, getSortable) {
        getSortable = getSortable ||
            function () {
                return this;
            };
        var placements = this.map(function () {
            var sortElement = getSortable.call(this),
                parentNode = sortElement.parentNode,
            // Since the element itself will change position, we have
            // to have some way of storing its original position in
            // the DOM. The easiest way is to have a 'flag' node:
                nextSibling = parentNode.insertBefore(
                    document.createTextNode(''), sortElement.nextSibling);
            return function () {
                if (parentNode === this) {
                    throw new Error("You can't sort elements if any one is a descendant of another.");
                }
                // Insert before flag:
                parentNode.insertBefore(this, nextSibling);
                // Remove flag:
                parentNode.removeChild(nextSibling);
            };
        });
        return sort.call(this, comparator).each(function (i) {
            placements[i].call(getSortable.call(this));
        });
    };
})();


$(document).ready(function() {

    bootbox.setDefaults({
        locale: 'ru',
        animate: false,
        closeButton: false,
        backdrop: true
    });

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
    var inputStartTime = $('input.event-start', eventFormModal);
    var inputEndTime = $('input.event-end', eventFormModal);
    // variable for ignore initialize timepickers
    var timepickersInitialized = false;
    var inputTeachers = $('select.event-teachers', eventFormModal);
    var jsonEventsText = $('#Place_json_schedule');
    var cabinetsBlock = $('.cabinets');
    var currentCabinetBlock = $('.current_cabinet_info', cabinetsBlock).hide();
    var currentCabinet;

    var editingEvent;
    var events = [];
    var eventsMap = jsonEventsText.val() ? $.parseJSON(jsonEventsText.val()) : {};
    var timepickerOptions = {
        minuteStep: 5,
        showMeridian: false,
        defaultTime: false
    };



    function initialize()
    {
        for ( var cabinet in eventsMap ) {
            if ( !currentCabinet ) {
                currentCabinet = cabinet;
            }
            var cab_events = eventsMap[cabinet];
            for ( var i = 0; i < eventsMap[cabinet].length; i++ ) {
                eventsMap[cabinet][i].start = new Date(eventsMap[cabinet][i].start);
                eventsMap[cabinet][i].end = new Date(eventsMap[cabinet][i].end);
            }
        }
        if ( currentCabinet ) {
            selectCabinet(currentCabinet);
        }
    }

    initialize();


    // Обработка изменения времени с помощью timepicker
    // Здесь editingEvent - текущее редактируемое событие
    function updateEventTime(tpEvent)
    {
        if ( !editingEvent.id ) {
            shedule.fullCalendar('select', editingEvent.start, editingEvent.end, editingEvent.allDay);
        } else {
            shedule.fullCalendar('renderEvent', editingEvent, true);
        }
    }


    inputStartTime.timepicker(timepickerOptions).on('changeTime.timepicker', function(e) {
        if ( !timepickersInitialized ) return true;
        editingEvent.start.setHours(e.time.hours);
        editingEvent.start.setMinutes(e.time.minutes);
        updateEventTime(e);
    });
    inputEndTime.timepicker(timepickerOptions).on('changeTime.timepicker', function(e) {
        if ( !timepickersInitialized ) return true;
        editingEvent.end.setHours(e.time.hours);
        editingEvent.end.setMinutes(e.time.minutes);
        updateEventTime(e);
    });

    inputTeachers.select2();

    eventFormModal.on('show', function(e) {
        timepickersInitialized = false;
        inputStartTime.timepicker('setTime', editingEvent.start);
        inputEndTime.timepicker('setTime', editingEvent.end);
        $('input.event-title', eventFormModal).val(editingEvent.title);
        $('input[value='+editingEvent.repeat+'].period', eventFormModal).prop('checked', true);
        var teachers = [];
        for ( var i = 0; i < editingEvent.teachers.length; i++ ) {
            teachers.push(editingEvent.teachers[i].id);
        }
        inputTeachers.select2('val', teachers);
        setTimeout(function() {timepickersInitialized = true;}, 1000);
    });


    eventFormModal.on('hide', function(e) {
        shedule.fullCalendar('unselect');
        $('input.event-title', eventFormModal).val('');
    });


    function saveEvents()
    {
        jsonEventsText.val( JSON.stringify(eventsMap) );
    }


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


    $('.event-save', eventFormModal).click(function(e) {
        var selectedTeachers = inputTeachers.select2('data');
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

        inputTeachers.select2('val', '');
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
        select: function(start, end, allDay, jsEvent) {
            if ( !currentCabinet ) {
                bootbox.alert('Не выбран кабинет!', function(result) {
                    shedule.fullCalendar('unselect');
                });
                return;
            }

            if ( !jsEvent ) {
                return ;
            }

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



    // Управление кабинетами
    function selectCabinet(rel) {
        currentCabinet = rel;
        $('.cabinet', cabinetsBlock).removeClass('btn-info');
        $('.cabinet[rel="'+currentCabinet+'"]', cabinetsBlock).addClass('btn-info');
        $('strong', currentCabinetBlock).text(currentCabinet);
        currentCabinetBlock.show();
        events = eventsMap[currentCabinet];
        shedule.fullCalendar('refetchEvents');
        shedule.fullCalendar('rerenderEvents');
    }

    function removeCabinet(rel) {
        var button = $('.cabinet[rel="'+rel+'"]', cabinetsBlock);

        var newSelected = button.prev();
        if ( !newSelected.length ) {
            newSelected = button.next();
        }
        button.remove();
        currentCabinet = null;
        currentCabinetBlock.hide();
        delete eventsMap[rel];

        if ( newSelected.length ) {
            selectCabinet(newSelected.attr('rel'));
        }
    }

    cabinetsBlock.on('click', 'a.cabinet', function(e) {
        selectCabinet($(this).attr('rel'));
        return false;
    });

    $('.add-cabinet', cabinetsBlock).click(function(e) {
        bootbox.prompt('Введите номер кабинета', function(result) {
            if ( !result || $('.cabinet[rel="'+result+'"]', cabinetsBlock).length ) {
                return;
            }
            var button = $('<a class="btn btn-mini cabinet" href="#" />').attr('rel', result).text(result);
            $('.buttons', cabinetsBlock).append(button);
            $('.cabinet', cabinetsBlock).sortElements(function(a, b) {
                return $(a).attr("rel") > $(b).attr("rel") ? 1 : -1;
            });
            eventsMap[result] = [];
            selectCabinet(result);
        });
        return false;
    });

    $('.delete-cabinet', cabinetsBlock).click(function(e) {
        if ( !currentCabinet ) {
            return false;
        }
        bootbox.confirm('Удалить кабинет «'+currentCabinet+'»', function(result) {
            if ( !result ) {
                return false;
            }
            removeCabinet(currentCabinet);
        });
        return false;
    });




    $('form').submit(function(e) {
        saveEvents();
    });
});
