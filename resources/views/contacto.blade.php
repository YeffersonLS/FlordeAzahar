@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Formulario de Contacto</h1>
    <p> ¡Estamos para ayudarte! Si tienes alguna pregunta sobre nuestro sitio o necesitas información adicional, no dudes en usar nuestro formulario de contacto. Ya sea que busques detalles sobre nuestros servicios, quieras hacer una solicitud específica, o necesites orientación en algo, nuestro equipo está listo para proporcionarte las respuestas y la ayuda que necesitas.    </p>
    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Mensaje</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
    </form>
</div>
@endsection
