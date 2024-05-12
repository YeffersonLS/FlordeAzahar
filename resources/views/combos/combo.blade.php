@extends('layouts.app')

@section('css')
<style>
    .mt-3 {
        margin-top: 15px;
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: pink;
        color: black;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
        cursor: pointer;
        border: 2px black solid;

    }

    .button:hover {
        background-color: white;
        color: black;

    }
</style>
@endsection
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
            <div class="mt-4">
                <a id="agendar" href="{{ auth()->check() ? route('agendar', ['id' => $combo->t10id]) : route('register') }}" class="button">Agenda tu combo</a>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function changeImage(imagePath) {
        document.getElementById('mainImage').src = "{{ asset('') }}" + imagePath;
    }

    $(document).ready(function() {
        $("#agendar").click(function(event) {
            if ($(this).attr("href") === 'register') {
                console.log('entro');
                alert("Necesita estar registrado o logeado para poder Agendar tu combo");
            }
        });
    });

</script>

@endsection
