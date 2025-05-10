<!-- resources/views/events/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upcoming Events</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->event_date->format('F j, Y, g:i a') }}</td>
                    <td><a href="{{ route('events.show', $event) }}" class="btn btn-primary">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
