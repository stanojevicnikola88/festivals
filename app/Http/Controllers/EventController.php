<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['country', 'city'])->orderByDesc('created_at')->paginate('10');

        return view('events.index', [
            'events' => $events,
        ]);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view('events.show', [
            'event' => $event,
        ]);
    }
}
