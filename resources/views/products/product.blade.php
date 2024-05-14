@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form action="{{ route('cart.add') }}" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" id="t04id" name="t04id" value="{{ $product->t04id }}" hidden >
            </div>
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
            <div class="mt-3">
                <label for="quantity">Cantidad:</label>
                <input type="number" name="quantity" id="quantity" min="1" value="1">

                <button type="submit" id="guardar" class="btn btn-success"><i class="fa fa-save"></i> Añadir al carrito</button>
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

    $(document).ready(function() {
    $("#guardar").click(function(productoId, quantity){
        const addToCartForm = document.querySelector('form[action="{{ route('cart.add') }}"]');

        addToCartForm.addEventListener('submit', (event) => {
            event.preventDefault(); // Prevent default form submission

            const productId = document.getElementById('t04id').value;
            const quantity = document.getElementById('quantity').value;

            // Send the product ID and quantity to the controller using an AJAX request
            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token for security
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the controller (e.g., display a success message)
                    console.log('Producto añadido al carrito:', data);
                })
                .catch(error => {
                    console.error('Error al añadir al carrito:', error);
                });
        });
    });
});
</script>

@endsection
