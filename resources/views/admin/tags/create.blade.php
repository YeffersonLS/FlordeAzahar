@extends('adminlte::page')

@section('title'){!! $titulo !!}
@endsection

@section('content_header')
{!! $titulo !!}
@stop

@section('content')
   @if (session('mensaje'))
    <div class="alert alert-success alert-dismissable">
        {{ session('mensaje') }}
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card border-primary">
            <div class="card-header bg-primary">
                <h4 class="m-b-0 m-t-0 text-white">Datos Básicos</h4>
            </div>
            <div class="card-body">
                @if (isset($editMode))
                <form action="{{ route('admin.tags.update', ['tag' => $registro->t03id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                @else
                <form action="{{ route('admin.tags.store') }}" method="POST">
                    @csrf
                @endif



                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="t03slug">Slug SEO</label>
                            <input id="t03slug" name="t03slug" class="form-control" value="{{ $registro->t03slug }}" required></input>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="t03nombre">Nombre/Título</label>
                            <input type="text" id="t03nombre" name="t03nombre" class="form-control" value="{{ $registro->t03nombre }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="t03tipo">Tipo</label>
                            <select id="t03tipo" name="t03tipo" class="form-control" required>
                                <option value="" {{ $registro->t03tipo == '' ? 'selected' : '' }}>Selecciona una opción</option>
                                <option value="BLOGS" {{ $registro->t03tipo == 'BLOGS' ? 'selected' : '' }}>BLOGS</option>
                                <option value="PRODUCTOS" {{ $registro->t03tipo == 'PRODUCTOS' ? 'selected' : '' }}>PRODUCTOS</option>
                                <!-- Agrega más opciones según sea necesario -->
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label for="t03color">Color de la Etiqueta</label>
                            <input id="t03color" name="t03color" value="{{ $registro->t03color }}" type="color">
                        </div>
                    </div>


                    {{-- <div class="row form-group">
                        <div class="col-md-12">
                            <label for="t03metadescription">Descripción SEO</label>
                            <textarea id="t03metadescription" name="t03metadescription" class="form-control" required>{!! $registro->t03metadescription !!}</textarea>
                        </div>
                    </div> --}}
{{--
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="t03descripcion">Descripción corta en la pagina</label>
                            <textarea id="t03descripcion" name="t03descripcion" class="form-control" required>{!! $registro->t03descripcion !!}</textarea>
                        </div>
                    </div> --}}

                    <div class="row form-group">
                        <div class="col-md-12 text-center">
                            <a href="{!! url('admin/tags') !!}" class="btn btn-warning"><i class="fa fa-reply"></i> Cancelar</a>
                            <button type="submit" id="guardar" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                            <input type="submit" id="btnSubmit" style="display: none;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@stop

@section('css')

@stop

@section('js')
@if (env('APP_ENV') == "local")
<script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
@else
<script src="{{ asset('public/vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
@endif<script type="text/javascript">
    $(document).ready(function() {
        $("#t03nombre").stringToSlug({
        setEvents: 'keyup keydown blur',
        getPut: '#t03slug',
        space: '-'
    });

        $("#guardar").click(function(){
            $("#btnSubmit").click();
        });
    });
</script>
@stop
