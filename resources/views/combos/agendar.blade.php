@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 style="  font-weight: bold">Agendar {{ $combo->t10nombre }}</h2>
        <h3> Contactanos si tienes dudas escribenos al Whatsapp <a href="https://wa.link/2sgb9s">229 667 4807</a></h3>
        <form action="/agendarPost" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" id="t11combo" name="t11combo" value="{{ $combo->t10id }}" hidden >
            </div>
            <div class="mb-3">
                <label for="t11nombre" class="form-label">Nombre de la persona a Entregar</label>
                <input type="text" class="form-control" id="t11nombre" name="t11nombre" placeholder="Ingresa tu nombre" required>
            </div>
            <div class="mb-3">
                <label for="t11numero" class="form-label">Telefono de la persona a Entregar</label>
                <input type="number" class="form-control" id="t11numero" name="t11numero" placeholder="Ingresa el Telefono" required>
            </div>
            <div class="col-md-2">
                <label for="t11hora">Hora de entrega</label>
                <select id="t11hora" name="t11hora" class="form-control">
                    @foreach($horas as $hora)
                        <option value="{{ $hora }}">{{ $hora }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="t11direccion" class="form-label">Direccion</label>
                <textarea class="form-control" id="t11direccion" name="t11direccion" rows="3" placeholder="Escribe la direccion de entrega" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
@endsection

@section('js')
@endsection
