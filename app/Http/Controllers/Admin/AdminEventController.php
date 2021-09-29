<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::with(['country', 'city'])->get();

        return view('admin.events.index', [
            'events' => $events,
        ]);
    }
}
