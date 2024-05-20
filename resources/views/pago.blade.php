@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Confirma tu forma de Pago</h1>

            <form action="{{ route('payPost.cart') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="t14tipopago">Forma de Pago:</label>
                    <select name="t14tipopago" id="t14tipopago" class="form-control">
                        <option value="efectivo">Efectivo</option>
                        <option value="transferencia">Transferencia Bancaria</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="t14direccion">Dirección de Envío:</label>
                    <textarea name="t14direccion" id="t14direccion" class="form-control" rows="3"></textarea>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Confirmar Pedido</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
    alert('holra');
</script>
@endsection
