@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Aceptar Términos y Condiciones') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('monedero.crear') }}">
                        @csrf

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terminos" name="terminos">
                                <label class="form-check-label" for="terminos">
                                    {!! 'Acepto los Términos y Condiciones de Heladeria Flor de Azahar para la creacion de mi monedero virtual.<br>1°El valor de mi monedero no sera redimible a pesos<br>2°El monedero sera unico e intransferible' !!}
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="btn-continuar" disabled>
                            {{ __('Continuar') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // Habilitar o deshabilitar el botón de continuar según si se ha marcado el checkbox
    document.getElementById('terminos').addEventListener('change', function() {
        document.getElementById('btn-continuar').disabled = !this.checked;
    });
</script>
@endsection
