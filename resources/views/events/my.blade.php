@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Events</h1>

    @if($events->isEmpty())
        <p>You have not created any events.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Location</th>
                    <th>Countdown</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->event_name }}</td>
                        <td>{{ optional($event->start_time)->format('F j, Y H:i') }}</td>
                        <td>{{ optional($event->end_time)->format('F j, Y H:i') }}</td>
                        <td>{{ $event->location }}</td>
                        <td id="countdown-{{ $event->id }}">Calculating...</td>
                        <td id="status-{{ $event->id }}">Checking...</td>
                        <td>
                            <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @foreach($events as $event)
            const startTime{{ $event->id }} = new Date("{{ $event->start_time }}");
            const endTime{{ $event->id }} = new Date("{{ $event->end_time }}");
            const countdownEl{{ $event->id }} = document.getElementById("countdown-{{ $event->id }}");
            const statusEl{{ $event->id }} = document.getElementById("status-{{ $event->id }}");

            function updateCountdown{{ $event->id }}() {
                const now = new Date();

                if (now >= endTime{{ $event->id }}) {
                    countdownEl{{ $event->id }}.innerText = "Event Ended";
                    statusEl{{ $event->id }}.innerText = "Ended";
                } else if (now >= startTime{{ $event->id }}) {
                    countdownEl{{ $event->id }}.innerText = "Event Ongoing!";
                    statusEl{{ $event->id }}.innerText = "Ongoing";
                } else {
                    const diff = startTime{{ $event->id }} - now;
                    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                    countdownEl{{ $event->id }}.innerText = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                    statusEl{{ $event->id }}.innerText = "Upcoming";
                }
            }

            updateCountdown{{ $event->id }}();
            setInterval(updateCountdown{{ $event->id }}, 1000);
        @endforeach
    });
</script>
@endsection
