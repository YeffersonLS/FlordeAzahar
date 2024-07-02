@extends('adminlte::page')

@section('title'){!! $titulo !!}
@endsection

@section('content_header')
    <h1>{!! $titulo !!}</h1>
@stop

@section('content')
{!! $sub !!}
    <div class="col-md-5 align-self-left">
        <div class="d-flex justify-content-start align-items-center" style="margin-top: 50px;">
            {{-- @if (\Route::current()->uri == 'admin/blogs')
            <a href="{!! url('admin/blogs/create') !!}" class="btn btn-info d-none d-lg-block m-r-15"><i class="fa fa-plus-circle"></i>
                Crear Nuevo</a>
            @endif --}}
            @if (\Route::current()->uri != 'admin/user' && \Route::current()->uri != 'admin/products/images' && \Route::current()->uri != 'admin/products/recetas')
                <a href="{!! url(\Route::current()->uri.'/create') !!}" class="btn btn-info d-none d-lg-block m-r-15"><i class="fa fa-plus-circle"></i>
                Crear Nuevo</a>
            @endif
            @if (\Route::current()->uri == 'admin/products')
            <a href="{!! url('admin/products/excel') !!}" class="btn btn-info d-none d-lg-block m-r-15"><i class="fa fa-plus-circle"></i>
                 Descargar Excel</a>
            <a href="{!! url('admin/products/import') !!}" class="btn btn-info d-none d-lg-block m-r-15"><i class="fa fa-plus-circle"></i>
                Importar Precios</a>
            @endif

        </div>
    </div>
<div>
</br>
</div>
    <div class="row">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-header bg-primary">
                    <h4 class="m-b-0 m-t-0 text-white">Registros Encontrados</h4>
                </div>
                <div class="card-body">
                    @if (session('mensaje'))
                        <div class="alert alert-success alert-dismissable">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="dtable" class="display table table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    @foreach ($titulos as $k => $t)
                                        <th @if (isset($data)) class="{!! $data[$k] !!}" @endif>
                                            {!! $t !!}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    @foreach ($titulos as $t)
                                        <th>{!! $t !!}</th>
                                    @endforeach
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
<script>
    $('#dtable').DataTable({
        "language": {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
        },
        // dom: 'frtip',
        responsive: true,
        // "processing": true,
        // "serverSide": true,
        ajax: {
                    url: "{{ route('json.' .Route::current()->uri) }}",
        },
        buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
        ],
    });
</script>
@stop

