@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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

@section('css')
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
