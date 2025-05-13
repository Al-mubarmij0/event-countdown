@extends('layouts.app') <!-- Replace this with your actual master layout -->

@section('content')
    <div class="text-center py-5">
        <h4 class="fw-bold">Welcome, {{ Auth::user()->name }}! 👋</h4>
        <p class="text-muted mb-0">Here's a quick overview of your activities and upcoming events.</p>
    </div>

    {{-- 📈 Summary Statistics --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow h-100">
                <div class="card-body border-start border-4 border-primary">
                    <h6 class="text-muted">Total Events Attending</h6>
                    <h3 class="fw-bold text-primary">{{ $attendingCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow h-100">
                <div class="card-body border-start border-4 border-success">
                    <h6 class="text-muted">Events You Created</h6>
                    <h3 class="fw-bold text-success">{{ $createdCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow h-100">
                <div class="card-body border-start border-4 border-warning">
                    <h6 class="text-muted">Upcoming Events</h6>
                    <h3 class="fw-bold text-warning">{{ $events->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- 📅 Upcoming Events List --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-white border-bottom-0">
            <h5 class="mb-0">Upcoming Events</h5>
        </div>
        <div class="card-body">
            @if ($events->isEmpty())
                <p class="text-muted">You don't have any upcoming events.</p>
                <a href="{{ route('events.create') }}" class="btn btn-primary">
                    <i class="bi bi-calendar-plus me-1"></i> Add Event
                </a>
            @else
                <ul class="list-group list-group-flush">
                    @foreach ($events->take(5) as $event)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="fw-bold mb-1">{{ $event->event_name }}</h6>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ \Carbon\Carbon::parse($event->start_time)->format('M d, Y h:i A') }}<br>
                                    <i class="bi bi-geo-alt me-1"></i>
                                    {{ $event->location }}
                                </small>
                            </div>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-secondary">
                                View →
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- 🔗 Quick Links --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom-0">
            <h5 class="mb-0">Quick Links</h5>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('events.my') }}" class="btn btn-outline-dark">
                    <i class="bi bi-person-lines-fill me-1"></i> My Events
                </a>
                <a href="{{ route('events.create') }}" class="btn btn-outline-primary">
                    <i class="bi bi-plus-circle me-1"></i> Create Event
                </a>
                <a href="{{ route('events.calendar') }}" class="btn btn-outline-success">
                    <i class="bi bi-calendar-event me-1"></i> Events Calendar
                </a>
            </div>
        </div>
    </div>
@endsection
