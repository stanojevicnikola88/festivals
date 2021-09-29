@extends('admin.main')

@section('content')

    <div class="container">
        <h1 class="h3 my-3">Dodavanje novog festivala</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{route('events.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Naziv festivala</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="start">Datum/vreme početka događaja</label>
                                <input type="datetime-local" class="form-control" id="start" name="start">
                            </div><div class="form-group">
                                <label for="end">Datum/vreme završetka događaja</label>
                                <input type="datetime-local" class="form-control" id="end" name="end">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="country_id">Država</label>
                                <select name="country_id" id="country_id" class="form-control">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city_id">Grad</label>
                                <select name="city_id" id="city_id" class="form-control">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Adresa</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description">Opis</label>
                                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude">
                            </div>
                            <div class="form-group">
                                <label for="featured_image">Slika</label>
                                <input type="file" name="featured_image" class="form-control-file">
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-share-square"></i> Dodaj festival</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
