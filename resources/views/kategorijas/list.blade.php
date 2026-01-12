@extends('layout')
@section('content')
    <h1>{{ $title }}</h1>
    @if (count($items) > 0)
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
            <tr>
            <th>ID</td>
            <th>Vārds</td>
            <th>Apraksts</td>
            <th>Rediģēšana</td>
            </tr>
            </thead>
            <tbody>
                @foreach($items as $kategorijas)
                    <tr>
                        <td>{{ $kategorijas->id }}</td>
                        <td>{{ $kategorijas->name }}</td>
                        <td>{{ $kategorijas->description }}</td>
                        <td><a href="/kategorijas/update/{{ $kategorijas->id }}" class="btn-orange btn-sm">Labot</a>
                        <form action="/kategorijas/delete/{{ $kategorijas->id }}" method="post" class="deletionform d-inline">
                            @csrf
                            <button type="submit" class="btn-orange btn-sm">Dzēst</button>
                        </form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nav atrasts neviens ieraksts</p>
    @endif
    <a href="/kategorijas/create" class="btn btn-primary" style="margin-left: 40px">Izveidot jaunu</a>
@endsection