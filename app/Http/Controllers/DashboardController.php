<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch events for the homepage
        $events = Event::orderBy('start_time', 'asc')->get();

        // Calculate the number of events the user is attending
        $attendingCount = Auth::user()->eventsAttending()->count();

        // Calculate the number of events the user has created
        $createdCount = Auth::user()->eventsCreated()->count();

        return view('dashboard', compact('events', 'attendingCount', 'createdCount'));
    }
}

