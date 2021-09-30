@extends('app')

@section('content')

    <div class="container">
        <h1 class="h3 my-3">Pregled festivala</h1>
        <div class="card">
            <div class="card-body">
                @if($event->featured_image)
                    <img class="card-img-top object-fit cover-image" src="{{ asset('/uploads/'.$event->featured_image) }}" alt="{{$event->featured_image}}">
                @endif
                <h2>{{$event->title}}</h2>
                <p>{{$event->start}} - {{$event->end}}</p>
                <p>{{$event->country->title}} / {{$event->city->title}} / {{$event->address}}</p>
                <p>{{$event->description}}</p>
            </div>
            <div class="card-footer">
                <button data-toggle="modal" data-target="#attendModal" class="btn btn-danger float-right"><i class="fas fa-plus fa-sm"></i> Prijavi se!</button>
            </div>
        </div>
        <div class="float-right my-3">
            <a href="{{route('event.index')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Povratak na listu festivala</a>
        </div>
    </div>

@endsection

@section('modals')

    <!-- ATTEND MODAL -->
    <div class="modal fade" id="attendModal" tabindex="-1" role="dialog" aria-labelledby="attendModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="attendModalTitle">Prijavi se za festival</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('event.subscribe')}}">
                    @csrf
                    <input name="event_id" type="hidden" value="{{$event->id}}" />
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="first_name">Ime:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Prezime:</label>
                            <input type="text" name="last_name" id="last_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                        <button type="submit" class="btn btn-success">Potvrdi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
