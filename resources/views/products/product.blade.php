@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($image->image_path) }}" alt="{{ $product->t02nombre }}" id="mainImage" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->t02nombre }}</h2>
            <p>{!! $product->t04descripcion !!}</p>
            <p>Precio: ${{ $product->t04precio }}</p>
             {{-- <form action="{{ route('cart.add', ['product' => $product->t04id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Agregar al carrito</button>
            </form> --}}
            <div class="mt-3">
                @foreach ($images as $img)
                <img src="{{ asset($img->image_path) }}" alt="{{ $product->t02nombre }}" class="thumbnail" onclick="changeImage('{{ $img->image_path }}')" style="max-width: 100px; max-height: 100px;">
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    function changeImage(imagePath) {
        document.getElementById('mainImage').src = "{{ asset('') }}" + imagePath;
    }
</script>

@endsection
