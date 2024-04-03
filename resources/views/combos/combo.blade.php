@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($image->image_path) }}" alt="{{ $combo->t10nombre }}" id="mainImage" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2>{{ $combo->t10nombre }}</h2>
            <p>{!! $combo->t10descripcion !!}</p>
            <p>Precio: ${{ $combo->t10valor }}</p>
             {{-- <form action="{{ route('cart.add', ['combo' => $combo->t04id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Agregar al carrito</button>
            </form> --}}
            <div class="mt-3">
                @foreach ($images as $img)
                <img src="{{ asset($img->image_path) }}" alt="{{ $combo->t02nombre }}" class="thumbnail" onclick="changeImage('{{ $img->image_path }}')" style="max-width: 100px; max-height: 100px;">
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
