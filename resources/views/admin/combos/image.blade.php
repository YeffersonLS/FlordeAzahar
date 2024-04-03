<!-- Blade Template -->

@extends('adminlte::page')

@section('title', $titulo)

@section('content_header')
    <h1>{{ $titulo }}</h1>
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
                    <form action="{{ isset($editMode) ? route('admin.combos.imagesPost', ['product' => $registro->t10id]) : route('admin.combos.imagesPost') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($editMode))
                            @method('PUT')
                        @endif

                        <input type="hidden" id="t10id" name="t10id" class="form-control" value="{{ $registro->t10id }}">

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="t10nombre">Nombre del producto al que va a generar la receta</label>
                                <input type="text" id="t10nombre" name="t10nombre" class="form-control" value="{{ $registro->t10nombre }}" readonly>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <label for="images">Agrega Imágenes al Producto</label><br>
                                    <input id="images" type="file" name="images[]" accept="image/*" multiple>
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (isset($imagenes_relacionadas) && count($imagenes_relacionadas) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Imágenes relacionadas</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nombre de la Imagen</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($imagenes_relacionadas as $imagen)
                                                    <tr id="imagen-{{ $imagen->id }}">
                                                        <td>{{ $imagen->image_path }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-success btn-sm btn-ver-imagen" data-src="{{ asset($imagen->image_path) }}"><i class="fa fa-eye"></i></button>
                                                            <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                                                            <button type="button" class="btn btn-danger btn-sm eliminar-imagen" data-productoid="{{ $registro->t10id }}" data-imagenid="{{ $imagen->r05id }}" data-toggle="modal" data-target="#modalConfirmarEliminarImagen"><i class="fa fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row form-group">
                            <div class="col-md-12 text-center">
                                <a href="{{ url('admin/combos/images') }}" class="btn btn-warning"><i class="fa fa-reply"></i> Cancelar</a>
                                <button type="submit" id="guardar" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                                <input type="submit" id="btnSubmit" style="display: none;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalImagen" tabindex="-1" role="dialog" aria-labelledby="modalImagenLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImagenLabel">Vista Previa de la Imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="imagenModal" src="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalConfirmarEliminarImagen" tabindex="-1" role="dialog" aria-labelledby="modalConfirmarEliminarImagenLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConfirmarEliminarImagenLabel">Eliminar Imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta imagen?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnEliminarImagen">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Función para eliminar una imagen
        $('.eliminar-imagen').on('click', function() {
            var productoId = $(this).data('productoid');
            var imagenId = $(this).data('imagenid');
            $('#btnEliminarImagen').data('productoid', productoId);
            $('#btnEliminarImagen').data('imagenid', imagenId);
        });

        $('#btnEliminarImagen').on('click', function() {
            var productoId = $(this).data('productoid');
            var imagenId = $(this).data('imagenid');
            eliminarImagen(productoId, imagenId);
        });

        $('.btn-ver-imagen').click(function() {
            var imagenSrc = $(this).data('src');
            $('#imagenModal').attr('src', imagenSrc);
            $('#modalImagen').modal('show');
        });

        $("#guardar").click(function(){
            $("#btnSubmit").click();
        });

        function eliminarImagen(productoId, imagenId) {
            console.log(productoId);
            $.ajax({
                url: '/eliminar-combo/' + productoId + '/' + imagenId,
                type: 'GET',
                success: function(response) {
                    // Si la eliminación fue exitosa, actualiza la vista o realiza cualquier otra acción necesaria
                    if (response.success) {
                        // Eliminar la fila de la tabla que muestra la imagen eliminada
                        $('#imagen-' + imagenId).remove();
                        // Ocultar el modal de confirmación
                        $('#modalConfirmarEliminarImagen').modal('hide');
                        location.reload();
                    } else {
                        // Manejar el caso en el que la eliminación no fue exitosa
                        alert('Error al eliminar la imagen.');
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores de la petición AJAX
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>
@stop
