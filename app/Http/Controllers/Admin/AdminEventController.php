<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::with(['country', 'city'])->get();

        return view('admin.events.index', [
            'events' => $events,
        ]);
    }

    public function create()
    {
        $countries = Country::all();
        $cities = City::all();

        return view('admin.events.create', [
            'countries' => $countries,
            'cities' => $cities
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $event = Event::create([
            'title' => $request['title'],
            'start' => $request['start'],
            'end' => $request['end'],
            'country_id' => $request['country_id'],
            'city_id' => $request['city_id'],
            'address' => $request['address'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'featured_image' => $request['featured_image'],
            'description' => $request['description']
        ]);

        return redirect()->route('events.index');
    }
}
