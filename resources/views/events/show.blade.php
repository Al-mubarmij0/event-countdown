<!-- resources/views/events/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $event->name }}</h1>
    <p>{{ $event->description }}</p>
    <p>Date: {{ $event->event_date->format('F j, Y, g:i a') }}</p>
</div>
@endsection
