<div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('backend/assets/calendar/main.min.js') }}"></script>

        <script>
            
        
            document.addEventListener('livewire:load', function() {
                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendar.Draggable;
                var calendarEl = document.getElementById('calendar');
                var checkbox = document.getElementById('drop-remove');
                var data = @this.events;
                var calendar = new Calendar(calendarEl, {
                    events: JSON.parse(data),
                    dateClick(info) {
                        var title = prompt('أدخل عنوان الحدث');
                        var date = new Date(info.dateStr);
                        if (title != null && title != '') {
                            calendar.addEvent({
                                title: title,
                                date: date,
                                allDay: true
                            });
                            var eventAdd = {
                                title: title,
                                date: date
                            };
                            @this.addevent(eventAdd);
                            alert('Great. Now, update your database...');
                            document.location.reload();
                        } else {
                            alert('يجب أدخال عنوان الحدث');
                        }
                    },
                    //   initialView: 'timeGridWeek',
                    display: 'background',
                    editable: true,
                    selectable: true,
                    displayEventTime: false,
                    droppable: true, // this allows things to be dropped onto the calendar
                    drop: function(info) {
                        // is the "remove after drop" checkbox checked?
                        if (checkbox.checked) {
                            // if so, remove the element from the "Draggable Events" list
                            info.draggedEl.parentNode.removeChild(info.draggedEl);
                        }
                    },
                    eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
                    loading: function(isLoading) {
                        if (!isLoading) {
                            // Reset custom events
                            this.getEvents().forEach(function(e) {
                                if (e.source === null) {
                                    e.remove();
                                }
                            });
                        }
                    }
                });
                calendar.render();
                @this.on(`refreshCalendar`, () => {
                    calendar.refetchEvents()
                });
            });

            window.onload = function() {
                $('.fc-toolbar.fc-header-toolbar').addClass('row col-12 col-lg-12');
            };
        
            // add the responsive classes when navigating with calendar buttons
            $(document).on('click', '.fc-button', function(e) {
                $('.fc-toolbar.fc-header-toolbar').addClass('row col-12 col-lg-12');
            });
        </script>

        <link rel="stylesheet" href="{{ asset('backend/assets/calendar/main.min.css') }}">
    @endpush
</div>
