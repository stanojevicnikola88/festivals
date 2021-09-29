@extends('admin.main')

@section('content')

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Naziv</th>
        <th scope="col">Datum/vreme početka</th>
        <th scope="col">Datum/vreme završetka</th>
        <th scope="col">Država</th>
        <th scope="col">Grad</th>
        <th scope="col">Adresa</th>
        <th scope="col">Koordinate na google mapi</th>
        <th scope="col">Slika</th>
        <th scope="col">Opis</th>
        <th scope="col">Vreme kreiranja</th>
        <th scope="col">Vreme izmene</th>
        <th scope="col">Akcije</th>
    </tr>
    </thead>
    <tbody>
    @foreach($events as $event)
        <tr>
            <td>{{$event->id}}</td>
            <td>{{$event->title}}</td>
            <td>{{$event->start}}</td>
            <td>{{$event->end}}</td>
            <td>{{$event->country->title}}</td>
            <td>{{$event->city->title}}</td>
            <td>{{$event->address}}</td>
            <td>{{$event->longitude}}, {{$event->latitude}}</td>
            <td>{{$event->featured_image}}</td>
            <td>{{$event->description}}</td>
            <td>{{$event->created_at}}</td>
            <td>{{$event->updated_at}}</td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-end">
    <a href="{{route('events.create')}}" class="btn btn-success"><i class="fas fa-plus fa-sm"></i> Dodaj novi festival</a>
</div>

@endsection
