<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // List all events
    public function index()
    {
        $events = Event::orderBy('start_time', 'asc')->get();
        return view('events.index', compact('events'));
    }

    // Show the create event form
    public function create()
    {
        return view('events.create');
    }

    // Store a newly created event
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date|before_or_equal:end_time',
            'end_time' => 'required|date|after_or_equal:start_time',
            'location' => 'required|string|max:255',
        ]);

        Event::create([
            'event_name'  => $request->event_name,
            'description' => $request->description,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'location'    => $request->location,
            'created_by'  => auth()->id(),
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    // Show event details
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    // Display the events created by the authenticated user
    public function myEvents()
    {
        $events = Event::where('created_by', auth()->id())->orderBy('start_time', 'asc')->get();
        return view('events.my', compact('events'));
    }

    // Get all events for calendar display
    public function getCalendarEvents()
    {
        $events = Event::all();
        
        // Format events to fit the calendar data structure
        $calendarEvents = $events->map(function ($event) {
            return [
                'title' => $event->event_name,
                'start' => $event->start_time->toIso8601String(),
                'end' => $event->end_time->toIso8601String(),
                'description' => $event->description,
            ];
        });

        return response()->json($calendarEvents);
    }
}
