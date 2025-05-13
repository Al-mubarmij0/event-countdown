<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // List all events
    public function index()
    {
        $events = Event::orderBy('event_date', 'asc')->get();
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
            'name' => 'required',
            'description' => 'required',
            'event_date' => 'required|date',
        ]);

        // Add the authenticated user_id to the event before saving
        $request->merge(['user_id' => auth()->id()]);

        Event::create($request->all());
        return redirect()->route('events.index');
    }

    // Show event details
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    // Display the events created by the authenticated user
    public function myEvents()
    {
        // Retrieve the events for the authenticated user
        $events = auth()->user()->events;  // Assuming you have a relationship set up

        return view('events.my', compact('events'));
    }
}
