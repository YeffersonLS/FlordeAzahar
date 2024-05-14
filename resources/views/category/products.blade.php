@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Catálogo de Productos</h2>
    <div class="row">
        <!-- Itera sobre tus productos y muestra cada uno de ellos -->
        @foreach ($products as $product)
        <div class="col-md-3">
            <div class="productos">
                <a href="{{ route('product.show', ['t04slug' => $product->t04slug])  }}"><!-- Enlace al detalle del producto -->
                    <div class="card">
                        <img src="{{ asset($product->image_path) }}" class="card-img-top" alt="{{ $product->t02nombre }}">
                        <div class="card-info">
                            <p class="subcategoria-productos">{{ $product->t02nombre }}</p>
                            <h5 class="card-title">{{ $product->t04nombre }}</h5>
                            <p class="card-money">{{ '$' . $product->t04precio . ' MXN' }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection
@section('js')

@endsection


