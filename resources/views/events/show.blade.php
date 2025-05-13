@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $event->event_name }}</h1>
    <p>{{ $event->description }}</p>
    <p>Start Time: {{ optional($event->start_time)->format('F j, Y H:i') ?? 'Not specified' }}</p>
    <p>End Time: {{ optional($event->end_time)->format('F j, Y H:i') ?? 'Not specified' }}</p>
    <p>Location: {{ $event->location ?? 'Not specified' }}</p>
</div>
@endsection
