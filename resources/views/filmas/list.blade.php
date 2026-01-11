@extends('layout')
@section('content')
    <h1 class="page-title gradient-text">{{ $title }}</h1>
    
    @if (count($items) > 0)
        <div class="table-modern">
            <table class="table">
                <thead class="table-header">
                    <tr>
                        <th class="table-th">ID</th>
                        <th class="table-th">Nosaukums</th>
                        <th class="table-th">Režisors</th>
                        <th class="table-th">Gads</th>
                        <th class="table-th">Cena</th>
                        <th class="table-th">Statuss</th>
                        <th class="table-th">Darbības</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach($items as $filmas)
                    <tr class="table-row">
                        <td class="table-td">{{ $filmas->id }}</td>
                        <td class="table-td film-name">{{ $filmas->name }}</td>
                        <td class="table-td">{{ $filmas->rezisors->name ?? '<span class="text-muted">Nav režisora</span>'}}</td>
                        <td class="table-td">{{ $filmas->year }}</td>
                        <td class="table-td price-cell">&euro; {{ number_format($filmas->price, 2, '.') }}</td>
                        <td class="table-td status-cell">{!! $filmas->display ? '<span class="status-active">&#x2714;</span>' : '<span class="status-inactive">&#x274C;</span>' !!}</td>
                        <td class="table-td actions-cell">
                            <div class="actions-wrapper">
                                <a href="/filmas/update/{{ $filmas->id }}"
                                   class="btn-orange action-btn">
                                    Labot
                                </a>
                                <form method="post"
                                      action="/filmas/delete/{{ $filmas->id }}"
                                      class="delete-form">
                                    @csrf
                                    <button type="submit" 
                                            class="btn-orange action-btn delete-btn"
                                            onclick="return confirm('Dzēst filmu?')">
                                            Dzēst
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <p class="empty-text">Nav atrasts neviens ieraksts</p>
        </div>
    @endif
    
    <div class="add-button-container">
        <a href="/filmas/create" class="btn-orange add-button">Pievienot jaunu filmu</a>
    </div>
@endsection