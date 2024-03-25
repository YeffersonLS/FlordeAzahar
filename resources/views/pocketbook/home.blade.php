@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h2>Tu Monedero</h2>
    </div>

    <!-- Mostrar el nombre completo de la persona -->
    <div>
        <h3>Nombre: {{ Auth::user()->sys01fullname }}</h3>
    </div>

    <!-- Mostrar el valor del monedero -->
    <div class="monedero">
        <h3>Saldo en el monedero: {{ $total.' Mnx' }}</h3>
    </div>
    <!-- Tabla de cargos en el monedero -->
    <h4>Cargos en el monedero:</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($cargos))
            @foreach ($cargos as $cargo)
            <tr>
                <td>{{ $cargo->fecha }}</td>
                <td>{{ $cargo->descripcion }}</td>
                <td>{{ $cargo->monto }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection

@section('css')
@stop

@section('js')
@stop


