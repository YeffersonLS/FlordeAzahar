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
                <form action="{{ route('admin.combos.update', ['combo' => $registro->t10id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                @else
                <form action="{{ route('admin.combos.store') }}" method="POST">
                    @csrf
                @endif



                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="productos">Productos</label>
                            <select id="productos" name="productos[]" class="form-control chosen-select" multiple>
                                @foreach($productos as $productName => $productId )
                                <option value="{{ $productId }}" {{ in_array($productName, $productos_relacionados ?? []) ? 'selected' : '' }}>
                                    {{ $productName }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="t10vencimiento">Fecha de Vencimiento</label>
                            <input type="date" id="t10vencimiento" name="t10vencimiento" class="form-control" value="{{ $registro->t10vencimiento }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="t10valor">Valor</label>
                            <input id="t10valor" name="t10valor" type="number" class="form-control" value="{{ $registro->t10valor }}" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="card-body">
                            <div class="col-md-12">
                                <label for="image">Agrega la imagen Insignia al Combo</label><br>
                                <input id="image" type="file" name="image[]" accept="image/*">
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


                    <div class="row form-group">
                        <div class="col-md-12 text-center">
                            <a href="{!! url('admin/combos') !!}" class="btn btn-warning"><i class="fa fa-reply"></i> Cancelar</a>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.chosen-select').chosen();

        $("#guardar").click(function(){
            $("#btnSubmit").click();
        });
    });
</script>
@stop
