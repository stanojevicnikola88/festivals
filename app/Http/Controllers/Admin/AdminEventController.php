<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::with(['country', 'city'])->paginate('10');

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
        $featuredImage = $request['featured_image'];
        $featuredImage->move(public_path('uploads'), $featuredImage->getClientOriginalName());

        Event::create([
            'title' => $request['title'],
            'start' => $request['start'],
            'end' => $request['end'],
            'country_id' => $request['country_id'],
            'city_id' => $request['city_id'],
            'address' => $request['address'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'featured_image' => $featuredImage->getClientOriginalName(),
            'description' => $request['description']
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Novi festival je uspešno kreiran.');
    }

    public function show($id)
    {
        $event = Event::where('id', $id)->with('users')->firstOrFail();

        $attendingUsersCount = EventUser::where('event_id', '=', $id)->count();

        return view('admin.events.show', [
            'event' => $event,
            'attendingUsersCount' => $attendingUsersCount
        ]);
    }

    public function edit($id)
    {
        $event = Event::where('id', $id)->firstOrFail();
        $countries = Country::all();
        $cities = City::all();

        return view('admin.events.edit', [
            'event' => $event,
            'countries' => $countries,
            'cities' => $cities
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $event = Event::findOrFail($request['id']);

        if($request['featured_image']) {
            $old_photo = $event->featured_image;
            $file_path = public_path('uploads') . $old_photo;

            if(File::exists($file_path)) {
                unlink($file_path);
            }

            $request['featured_image']->move(public_path('uploads'), $request['featured_image']->getClientOriginalName());
        }

        $event->update([
            'title' => $request['title'],
            'start' => $request['start'],
            'end' => $request['end'],
            'country_id' => $request['country_id'],
            'city_id' => $request['city_id'],
            'address' => $request['address'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'featured_image' => $request['featured_image'] ? $request['featured_image']->getClientOriginalName() : $event->featured_image,
            'description' => $request['description']
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Podaci su uspešno izmenjeni.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Event::destroy($request['id']);

        return back()->with('success', 'Festival je uspešno obrisan.');
    }
}
