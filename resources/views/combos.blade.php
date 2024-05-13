@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Combos Agendados</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Combo</th>
                <th>Hora de entrega</th>
                <th>Pago</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($query as $q )
                <td>{{ $q->t10nombre }}</td>
                <td>{{ $q->t11hora }}</td>
                <td>{{ $q->t11pago }}</td>
                <td>Acciones</td>
                @endforeach

            </tr>
            <tr>
                </tr>
        </tbody>
    </table>
</div>
@endsection
@section('js')

@endsection
