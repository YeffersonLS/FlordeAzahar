@extends('layouts.app')
@section('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pure/1.0.1/pure-min.css">
<style>
    label[for="quantity"] {
        font-size: 0.8rem; /* Reducir tamaño de fuente */
        margin-bottom: 0.5rem; /* Disminuir espaciado inferior */
        font-size: 13px;
    }

    input[type="number"] {
        border-radius: 5px; /* Redondear esquinas */
        border: none; /* Eliminar bordes */
        box-shadow: none; /* Eliminar sombras */
        width: 5rem; /* Ajustar ancho */
        padding: 0.5rem; /* Ajustar relleno */
        font-family: sans-serif; /* Fuente simple */
        font-size: 13px;
    }
</style>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($image->image_path) }}" alt="{{ $product->t02nombre }}" id="mainImage" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->t02nombre }}</h2>
            <p>{!! $product->t04descripcion !!}</p>
            <strong><p class="">Precio: ${{ $product->t04precio }}</p></strong>
            <div class="mt-3">
                @foreach ($images as $img)
                <img src="{{ asset($img->image_path) }}" alt="{{ $product->t02nombre }}" class="thumbnail" onclick="changeImage('{{ $img->image_path }}')" style="max-width: 100px; max-height: 100px;">
                @endforeach
            </div>
            <div class="mt-3">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="text" class="form-control" id="t04id" name="t04id" value="{{ $product->t04id }}" hidden >
                   <strong><label for="quantity">Cantidad:</label></strong>
                    <input type="number" name="quantity" id="quantity" min="1" value="1">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Agregar al carrito</button>
                </form>
                {{-- <button type="submit" id="guardar" class="btn btn-success"><i class="fa fa-save"></i> Añadir al carrito</button> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row product-carousel">
            @foreach ($relations as $relation)
            <div class="product-item">
                <div class="col-md-6 col-lg-3">
                    <div class="relation">
                        <a href="{{ route('product.show', ['t04slug' => $relation->t04slug]) }}">
                            <div class="card">
                                <img src="{{ asset($relation->image_path) }}" class="card-img-top" alt="{{ $relation->t02nombre }}">
                                <div class="card-info">
                                    <p class="subcategoria-relation">{{ $relation->t02nombre }}</p>
                                    <h5 class="card-title-relation">{{ $relation->t04nombre }}</h5>
                                    <p class="card-money-relation">{{ '$' . $relation->t04precio . ' MXN' }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection
@section('js')
<script>
    function changeImage(imagePath) {
        document.getElementById('mainImage').src = "{{ asset('') }}" + imagePath;
    };

</script>

@endsection
