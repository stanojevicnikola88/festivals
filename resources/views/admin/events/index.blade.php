@extends('admin.main')

@section('content')

    @include('admin.includes.alerts')

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
                <td><a href="{{route('admin.events.show', $event->id)}}">{{$event->title}}</a></td>
                <td>{{$event->start}}</td>
                <td>{{$event->end}}</td>
                <td>{{$event->country->title}}</td>
                <td>{{$event->city->title}}</td>
                <td>{{$event->address}}</td>
                <td>{{$event->longitude}}, {{$event->latitude}}</td>
                <td>
                    @if($event->featured_image)
                        <img src="{{ asset('/uploads/'.$event->featured_image) }}" class="object-fit table-image" alt="{{$event->featured_image}}">
                    @endif
                </td>
                <td>{{$event->description}}</td>
                <td>{{$event->created_at}}</td>
                <td>{{$event->updated_at}}</td>
                <td>
                    <a href="{{route('admin.events.edit', $event->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pen fa-sm"></i> Izmeni</a>
                    <form action="{{route('admin.events.destroy', $event->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger mt-3"><i class="fas fa-trash fa-sm"></i> Obriši</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
    {!! $events->links() !!}
    </div>

    <div class="d-flex justify-content-end">
        <a href="{{route('admin.events.create')}}" class="btn btn-success"><i class="fas fa-plus fa-sm"></i> Dodaj novi festival</a>
    </div>

@endsection
