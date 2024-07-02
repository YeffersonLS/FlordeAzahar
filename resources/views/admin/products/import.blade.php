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
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-header bg-primary">
                    <h4 class="m-b-0 m-t-0 text-white">Datos Básicos</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.importProductPost') }}" method="POST">
                        @csrf
                        <input type="file" name="file" accept=".xlsx, .xls">

                        <div class="row form-group">
                            <div class="col-md-12 text-center">
                                <a href="{!! url('admin/products') !!}" class="btn btn-warning"><i class="fa fa-reply"></i>Cancelar</a>
                                <button type="submit" id="guardar" class="btn btn-success"><i class="fa fa-save"></i>Guardar</button>
                                <input type="submit" id="btnSubmit" style="display: none;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="folder" id="folder">
@stop

@section('css')
@stop

@section('js')

@stop
