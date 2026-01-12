@extends('layout')
@section('content')
    <h1>{{ $title }}</h1>
    @if (count($items) > 0)
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
            <tr>
            <th>ID</td>
            <th>Vārds</td>
            <th>&nbsp;</td>
            </tr>
            </thead>
            <tbody>
                @foreach($items as $rezisori)
                    <tr>
                        <td>{{ $rezisori->id }}</td>
                        <td>{{ $rezisori->name }}</td>
                        <td><a href="/rezisori/update/{{ $rezisori->id }}" class="btn-orange btn-sm">Labot</a>
                        <form action="/rezisori/delete/{{ $rezisori->id }}" method="post" class="deletionform d-inline">
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
    <a href="/rezisori/create" class="btn btn-primary" style="margin-left:40px">Izveidot jaunu</a>
@endsection