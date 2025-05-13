@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Event Calendar</h1>
    <div id="calendar"></div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                events: '/calendar-events', // Fetch events from the route you created
                editable: true,
                droppable: true,
                eventClick: function(info) {
                    alert('Event: ' + info.event.title + '\n' + info.event.extendedProps.description);
                }
            });
            calendar.render();
        });
    </script>
@endsection
