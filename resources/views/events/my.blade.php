<!-- resources/views/events/my.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Your Events</h1>

    @if($events->isEmpty())
        <p>You have no events.</p>
    @else
        <ul>
            @foreach($events as $event)
                <li>{{ $event->name }} - {{ $event->date }}</li>
            @endforeach
        </ul>
    @endif
@endsection
