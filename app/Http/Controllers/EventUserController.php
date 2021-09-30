<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EventUserController extends Controller
{
    public function store(Request $request)
    {
        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => '',
            'is_admin' => 0
        ]);

        $user->events()->attach($request['event_id']);

        return redirect()->route('event.index');
    }
}