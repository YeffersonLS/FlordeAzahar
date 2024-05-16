@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Carrito de compras</h1>

    @if ($check)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->t04nombre }}</td>
                    <td>{{ $item->t04precio }}</td>
                    <td>{{ $item->t12cantidad }}</td>
                    <td>{{ $item->t04precio * $item->t12cantidad }}</td>
                    <td>
                        <form action="{{ route('cart.delete') }}" method="POST">
                            @csrf
                            <input type="text" class="form-control" id="t12producto" name="t12producto" value="{{ $item->t12producto }}" hidden >
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trahs"></i> Eliminar</button>
                        </form>
                        {{-- <a href="#" class="btn btn-primary btn-sm">Editar</a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                {{-- <tr>
                    <td colspan="3">Subtotal</td>
                    <td>1</td>
                    <td></td>
                </tr> --}}
                {{-- <tr>
                    <td colspan="3">Envío</td>
                    <td>1</td>
                    <td></td>
                </tr> --}}
                <tr>
                    <td colspan="3">Total</td>
                    <td>{{ $total }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <a href="#" class="btn btn-success btn-lg">Proceder al pago</a>
    @else
        <p class="text-center">Tu carrito está vacío.</p>
    @endif
</div>
@endsection

@section('js')

@endsection
