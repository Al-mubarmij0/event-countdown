@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upcoming Events</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Start Time</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->event_name }}</td>
                    <td>{{ optional($event->start_time)->format('F j, Y H:i') ?? 'Not specified' }}</td>
                    <td><a href="{{ route('events.show', $event) }}" class="btn btn-primary">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
