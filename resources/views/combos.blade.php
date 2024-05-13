@extends('layouts.app')

@section('content')
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

            @endforeach
            <td>Contenido de la columna 1</td>
            <td>Contenido de la columna 2</td>
            <td>Contenido de la columna 3</td>
            <td>Contenido de la columna 4</td>
        </tr>
        <tr>
            </tr>
    </tbody>
</table>
@endsection
@section('js')

@endsection
