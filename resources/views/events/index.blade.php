@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            @foreach($events as $event)
                <div class="card m-3" style="width: 18rem;">
                    @if($event->featured_image)
                        <img class="card-img-top" src="{{ asset('/uploads/'.$event->featured_image) }}" alt="{{$event->featured_image}}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{$event->title}}</h5>
                        <p>{{$event->start}}</p>
                        <p>{{$event->end}}</p>
                        <p>{{$event->country->title}} / {{$event->city->title}} / {{$event->address}}</p>
                        <a href="{{route('event.show', $event->id)}}" class="btn btn-primary">Detaljnije...</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {!! $events->links() !!}
    </div>

@endsection
