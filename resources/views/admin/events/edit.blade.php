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
                                <input type="text" class="form-control map-input" id="address-input" name="address" value="{{$event->address}}">
                            </div>
                            <div id="address-map-container" style="width:100%;height:400px; ">
                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description">Opis</label>
                                <textarea name="description" id="description" rows="3" class="form-control">{{$event->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control" id="address-latitude" name="latitude" value="{{$event->latitude}}">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control" id="address-longitude" name="longitude" value="{{$event->longitude}}">
                            </div>
                            @if($event->featured_image)
                                <div>Postojeća slika</div>
                                <img src="{{ asset('/uploads/'.$event->featured_image) }}" class="object-fit info-image" alt="{{$event->featured_image}}">
                            @endif
                            <div class="form-group">
                                <label for="featured_image">{{$event->featured_image ? 'Izmena slike' : 'Dodavanje slike'}}</label>
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

@section('scripts')
    @parent
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script>
        function initialize() {
            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
            const locationInputs = document.getElementsByClassName("map-input");

            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;
            for (let i = 0; i < locationInputs.length; i++) {

                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");
                const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;

                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 13
                });
                const marker = new google.maps.Marker({
                    map: map,
                    position: {lat: latitude, lng: longitude},
                });

                marker.setVisible(isEdit);

                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;
                autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
            }

            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    geocoder.geocode({'placeId': place.place_id}, function (results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            setLocationCoordinates(autocomplete.key, lat, lng);
                        }
                    });

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                });
            }
        }

        function setLocationCoordinates(key, lat, lng) {
            const latitudeField = document.getElementById(key + "-" + "latitude");
            const longitudeField = document.getElementById(key + "-" + "longitude");
            latitudeField.value = lat;
            longitudeField.value = lng;
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
@endsection
