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
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.7.0/jszip-3.10.1/dt-1.13.10/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/datatables.min.css"
        rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.7.0/jszip-3.10.1/dt-1.13.10/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/datatables.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var oTable;
        $(document).ready(function() {
            oTable = $('#dtable').DataTable({
                dom: 'frtip',
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                },
                responsive: true,
                "processing": true,
                "serverSide": true,
                ajax: {
                    url: "{{ route('json.' .Route::current()->uri) }}",
                },
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
            });

            console.log('json.' + {!! json_encode(\Route::current()->uri) !!});
        });
    </script>
@stop

