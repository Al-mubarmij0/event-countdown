@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upcoming Events</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Start Time</th>
                <th>Countdown</th>
                <th>Status</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->event_name }}</td>
                    <td>{{ optional($event->start_time)->format('F j, Y H:i') ?? 'Not specified' }}</td>
                    <td id="countdown-{{ $event->id }}">{{ $event->time_remaining }}</td>
                    <td id="status-{{ $event->id }}">{{ $event->status }}</td>
                    <td><a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @foreach($events as $event)
            const startTime{{ $event->id }} = new Date("{{ $event->start_time->toIso8601String() }}");
            const endTime{{ $event->id }} = new Date("{{ $event->end_time->toIso8601String() }}");
            const countdownElement{{ $event->id }} = document.getElementById("countdown-{{ $event->id }}");
            const statusElement{{ $event->id }} = document.getElementById("status-{{ $event->id }}");

            function updateCountdown{{ $event->id }}() {
                const now = new Date();

                if (now > endTime{{ $event->id }}) {
                    countdownElement{{ $event->id }}.innerText = "Event Ended";
                    statusElement{{ $event->id }}.innerText = "Ended";
                } else if (now >= startTime{{ $event->id }} && now <= endTime{{ $event->id }}) {
                    const timeLeft = endTime{{ $event->id }} - now;
                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                    countdownElement{{ $event->id }}.innerText = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                    statusElement{{ $event->id }}.innerText = "Ongoing";
                } else {
                    const timeLeft = startTime{{ $event->id }} - now;
                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                    countdownElement{{ $event->id }}.innerText = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                    statusElement{{ $event->id }}.innerText = "Upcoming";
                }
            }

            updateCountdown{{ $event->id }}();
            setInterval(updateCountdown{{ $event->id }}, 1000);
        @endforeach
    });
</script>

@endsection
