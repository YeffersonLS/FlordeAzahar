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
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price * $item->quantity }}</td>
                    <td>
                        <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                        <a href="#" class="btn btn-primary btn-sm">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Subtotal</td>
                    <td>{{ Cart::subtotal() }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">Envío</td>
                    <td>{{ Cart::shipping() }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">Total</td>
                    <td>{{ Cart::total() }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">Proceder al pago</a>
    @else
        <p class="text-center">Tu carrito está vacío.</p>
    @endif
</div>
@endsection

@section('js')

@endsection
