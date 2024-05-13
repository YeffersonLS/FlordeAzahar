@extends('adminlte::page')

@section('title'){!! $titulo !!}
@endsection

@section('content_header')
{!! $titulo !!}
@stop

@section('content')
   @if (session('mensaje'))
    <div class="alert alert-success alert-dismissable">
        {{ session('mensaje') }}
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card border-primary">
            <div class="col-10">
                <form action="{{ route('admin.diary.update', ['id' => $registro->t11id]) }}" method="POST">
                    @csrf

                    <div class="col-md-4">
                        <label>Estado de Pago</label><br>
                        <input id="Activo" name="t11pago" type="radio" value="0" {{ $registro->t11pago === 0 ? 'checked' : '' }}> No pago<br>
                        <input id="Inactivo" name="t11pago" type="radio" value="1" {{ $registro->t11pago === 1 ? 'checked' : '' }}> Pago
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="t11combo" name="t11combo" value="{{ $registro->t11id }}" hidden >
                    </div>
                    <div class="mb-3">
                        <label for="t11nombre" class="form-label">Nombre de la persona a Entregar</label>
                        <input type="text" class="form-control" id="t11nombre" name="t11nombre" placeholder="Ingresa tu nombre" value="{{  $registro->t11nombre }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="t11numero" class="form-label">Telefono de la persona a Entregar</label>
                        <input type="number" class="form-control" id="t11numero" name="t11numero" placeholder="Ingresa el Telefono" value="{{  $registro->t11numero }}" required>
                    </div>
                    <div class="col-md-2">
                        <label for="t11hora">Hora de entrega</label>
                        <select id="t11hora" name="t11hora" class="form-control">
                            @foreach($horas as $hora)
                                <option value="{{ $hora }}">{{ $hora }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="t11direccion" class="form-label">Direccion</label>
                        <textarea class="form-control" id="t11direccion" name="t11direccion" rows="3" placeholder="Escribe la direccion de entrega" required> {{ $registro->t11direccion }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
@stop

@section('js')
{{-- <script src='fullcalendar/dist/index.global.js'></script> --}}
<script src="{{ asset('public/vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
<script type="text/javascript">


</script>
@stop
