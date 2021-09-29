@extends('admin.main')

@section('content')

    <div class="container">
        <h1 class="h3 my-3">Prikaz prijavljenih osoba za festival ({{$attendingUsersCount}})</h1>
        <div class="card">
            <div class="card-body">
                <ol>
                    @foreach($event->users as $user)
                        <li>{{$user->first_name}} {{$user->last_name}} ({{$user->email}}) - {{$user->created_at}}</li>
                    @endforeach
                </ol>
            </div>
        </div>
        <div class="float-right mt-3">
            <a href="{{route('events.index')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Povratak na listu festivala</a>
        </div>
    </div>

@endsection
