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
                    <th>Location</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->event_name }}</td>
                        <td>{{ optional($event->start_time)->format('F j, Y H:i') }}</td>
                        <td>{{ $event->location }}</td>
                        <td>
                            <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-primary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
