@extends('app')

@section('content')

    <div class="container">
        <h1 class="h3 my-3">Pregled festivala</h1>
        <div class="card">
            <div class="card-body">
                @if($event->featured_image)
                    <img class="card-img-top" src="{{ asset('/uploads/'.$event->featured_image) }}" alt="{{$event->featured_image}}">
                @endif
                <h2>{{$event->title}}</h2>
                <p>{{$event->start}} - {{$event->end}}</p>
                <p>{{$event->country->title}} / {{$event->city->title}} / {{$event->address}}</p>
                <p>{{$event->description}}</p>
            </div>
        </div>
        <div class="float-right my-3">
            <a href="{{route('event.index')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Povratak na listu festivala</a>
        </div>
    </div>

@endsection
