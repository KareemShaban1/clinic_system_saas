<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div id='calendar-container' wire:ignore>
          <div id='calendar'></div>
        </div>
      </div>
       
      @push('scripts')
          {{-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script> --}}
          <script src="{{ URL::asset('assets/calendar/main.min.js') }}"></script>

           
          <script>
              document.addEventListener('livewire:load', function() {
                  var Calendar = FullCalendar.Calendar;
                  var Draggable = FullCalendar.Draggable;
                  var calendarEl = document.getElementById('calendar');
                  var checkbox = document.getElementById('drop-remove');
                  var data =   @this.events;
                  var calendar = new Calendar(calendarEl, {
                  events: JSON.parse(data),
                  dateClick(info)  {
                     var title = prompt('أدخل عنوان الحدث');
                     var date = new Date(info.dateStr);
                     if(title != null && title != ''){
                       calendar.addEvent({
                          title: title,
                          start: date,
                          allDay: true
                        });
                       var eventAdd = {title: title,start: date};
                       @this.addevent(eventAdd);
                       alert('Great. Now, update your database...');
                       document.location.reload();
                     }else{
                      alert('يجب أدخال عنوان الحدث');
                     }
                  },
                //   initialView: 'timeGridWeek',
                  display:'background',
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
                              this.getEvents().forEach(function(e){
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
          </script>
          {{-- <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' /> --}}
          <link rel="stylesheet" href="{{ URL::asset('assets/calendar/main.min.css') }}"  >
      @endpush
</div>
