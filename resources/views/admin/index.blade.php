@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Panel De Control</h1>
@stop

@section('content')
    <p>Bienvenido al panel de control de Flor de Azahar.</p>
@stop

@section('css')
    @if (env('APP_ENV') == "local")
        <link rel="stylesheet" href="css/admin_custom.css">
    @else
        <link rel="stylesheet" href="public/css/admin_custom.css">
    @endif
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
