<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventUserController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => null,
        ]);

        $user->events()->attach($request['event_id']);

        return redirect()->route('event.index')->with('success', 'Uspešno ste se prijavili za festival!');
    }
}
