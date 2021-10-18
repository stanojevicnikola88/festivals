<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFestivalRequest;
use App\Http\Requests\UpdateFestivalRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventUser;
use App\Services\ImageUploaderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

//    public function store(StoreFestivalRequest $request): RedirectResponse
//    {
//        $validated = $request->validated();
//
//        $featuredImage = $request['featured_image'];
//        $featuredImage->move(public_path('uploads'), $featuredImage->getClientOriginalName());
//
//        Event::create($validated);
//
//        return redirect()->route('admin.events.index')->with('success', 'Novi festival je uspešno kreiran.');
//    }

    public function store(StoreFestivalRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if(array_key_exists('featured_image', $validated)) {
            $uploadService = new ImageUploaderService;
            $uploadService->imageUpload($request['featured_image'], false);
            $validated['featured_image'] = $validated['featured_image']->getClientOriginalName();
        }

        Event::create($validated);

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

//    public function update(UpdateFestivalRequest $request): RedirectResponse
//    {
//        $event = Event::findOrFail($request['id']);
//
//        $validated = $request->validated();
//
//        if(array_key_exists('featured_image', $validated)) {
//            $old_photo = $event->featured_image;
//            $file_path = public_path('uploads') . $old_photo;
//
//            if(File::exists($file_path)) {
//                unlink($file_path);
//            }
//
//            $validated['featured_image']->move(public_path('uploads'), $validated['featured_image']->getClientOriginalName());
//            $validated['featured_image'] = $validated['featured_image']->getClientOriginalName();
//        }
//
//        $event->update($validated);
//
//        return redirect()->route('admin.events.index')->with('success', 'Podaci su uspešno izmenjeni.');
//    }

    public function update(UpdateFestivalRequest $request): RedirectResponse
    {
        $event = Event::findOrFail($request['id']);

        $validated = $request->validated();

        if(array_key_exists('featured_image', $validated)) {
            (new ImageUploaderService())->imageUpload($request['featured_image'], true);
            $validated['featured_image'] = $validated['featured_image']->getClientOriginalName();
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Podaci su uspešno izmenjeni.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Event::destroy($request['id']);

        return back()->with('success', 'Festival je uspešno obrisan.');
    }
}
