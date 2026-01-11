@extends('layout')
@section('content')
    <h1>{{ $title }}</h1>
    @if (count($items) > 0)
        <table class="table table-sm table-hover table-striped">
            <thead class="thead-light">
                <tr>
                <th>ID</th>
                <th>Nosaukums</th>
                <th>Režisors</th>
                <th>Gads</th>
                <th>Cena</th>
                <th>Attēlot</th>
                <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $filmas)
                <tr>
                    <td>{{ $filmas->id }}</td>
                    <td>{{ $filmas->name }}</td>
                    <td>{{ $filmas->rezisors->name ?? 'Nav režisora'}}</td>
                    <td>{{ $filmas->year }}</td>
                    <td>&euro; {{ number_format($filmas->price, 2, '.') }}</td>
                    <td>{!! $filmas->display ? '&#x2714;' : '&#x274C;' !!}</td>
                    <td>
                        <a
                        href="/filmas/update/{{ $filmas->id }}"
                        class="btn btn-outline-primary btn-sm"
                        >Labot</a> /
                        <form
                        method="post"
                        action="/filmas/delete/{{ $filmas->id }}"
                        class="d-inline deletion-form">
                            @csrf
                            <button
                            type="submit"
                            class="btn btn-outline-danger btn-sm"
                            >Dzēst</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nav atrasts neviens ieraksts</p>
    @endif
    <a href="/filmas/create" class="btn btn-primary">Pievienot jaunu</a>
@endsection