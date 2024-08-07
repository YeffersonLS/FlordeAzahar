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
            <strong><p class="red">Precio: ${{ $product->t04precio }}</p></strong>
            <div class="mt-3">
                @foreach ($images as $img)
                <img src="{{ asset($img->image_path) }}" alt="{{ $product->t02nombre }}" class="thumbnail" onclick="changeImage('{{ $img->image_path }}')" style="max-width: 100px; max-height: 100px;">
                @endforeach
            </div>
            <div class="mt-3">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="text" class="form-control" id="t04id" name="t04id" value="{{ $product->t04id }}" hidden >
                    <label for="quantity">Cantidad:</label>
                    <input type="number" name="quantity" id="quantity" min="1" value="1">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Agregar al carrito</button>
                </form>


                {{-- <button type="submit" id="guardar" class="btn btn-success"><i class="fa fa-save"></i> Añadir al carrito</button> --}}
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
{{-- <script src="{{ asset('public/vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script> --}}
<script>
    function changeImage(imagePath) {
        document.getElementById('mainImage').src = "{{ asset('') }}" + imagePath;
    };

    // $(document).ready(function() {
    // $("#guardar").click(function() {
    //     const addToCartForm = document.querySelector('form[action="{{ route('cart.add') }}"]');

    //         addToCartForm.addEventListener('guardar', (event) => {
    //             event.preventDefault(); // Prevent default form submission

    //             const productId = document.getElementById('t04id').value;
    //             const quantity = document.getElementById('quantity').value;

    //             // Send the product ID and quantity to the controller using an AJAX request
    //             fetch('{{ route('cart.add') }}', {
    //                 method: 'POST',
    //                 headers: {
    //                     'Content-Type': 'application/json',
    //                     'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token for security
    //                 },
    //                 body: JSON.stringify({
    //                     product_id: productId,
    //                     quantity: quantity
    //                 })
    //             })
    //                 .then(response => response.json())
    //                 .then(data => {
    //                     // Handle the response from the controller (e.g., display a success message)
    //                     console.log('Producto añadido al carrito:', data);
    //                 })
    //                 .catch(error => {
    //                     console.error('Error al añadir al carrito:', error);
    //                 });
    //         });
    //     });
    // });
</script>

@endsection
