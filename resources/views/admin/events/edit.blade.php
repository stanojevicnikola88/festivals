@extends('admin.main')

@section('content')

    <div class="container">
        <h1 class="h3 my-3">Izmena podataka festivala</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.events.update', $event->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Naziv festivala</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$event->title}}">
                            </div>
                            <div class="form-group">
                                <label for="start">Datum/vreme početka događaja</label>
                                <input type="datetime-local" class="form-control" id="start" name="start" value="{{$event->date_start}}">
                            </div><div class="form-group">
                                <label for="end">Datum/vreme završetka događaja</label>
                                <input type="datetime-local" class="form-control" id="end" name="end" value="{{$event->date_end}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="country_id">Država</label>
                                <select name="country_id" id="country_id" class="form-control">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" {{$country->id == $event->country_id ? 'selected' : ''}}>{{$country->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city_id">Grad</label>
                                <select name="city_id" id="city_id" class="form-control">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}" {{$city->id == $event->city_id ? 'selected' : ''}}>{{$city->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Adresa</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$event->address}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description">Opis</label>
                                <textarea name="description" id="description" rows="3" class="form-control">{{$event->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{$event->latitude}}">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{$event->longitude}}">
                            </div>
                            <div class="form-group">
                                <label for="featured_image">Slika</label>
                                <input type="file" name="featured_image" class="form-control-file">
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <a href="{{route('admin.events.index')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Povratak na listu festivala</a>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Izmeni podatke</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
