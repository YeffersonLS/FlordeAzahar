@extends('adminlte::page')

@section('title')
    {!! $titulo !!}
@endsection

@section('content_header')
    <h1>{!! $titulo !!}</h1>
@stop

@section('content')
    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissable">
            {{ session('mensaje') }}
        </div>
    @endif
<form action="{{ route('admin.sales.store') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Registrar Venta</h3>
        </div>
        <div class="card-body">
                <!-- Campos del formulario -->
                <div class="form-group">
                    <label for="t09cliente">Cliente</label>
                    <select class="form-control" id="t09cliente" name="t09cliente">
                        <option value="">Seleccione un Cliente</option> <!-- Opción por defecto -->
                        @foreach($clientes as $id => $nombre)
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="row form-group">
                    {{-- <div class="col-md-1">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
                    </div> --}}
                    <div class="col-md-10">
                        <label for="productos">Producto</label>
                        <select class="form-control" id="productos" name="productos">
                            <option value="">Seleccione algun producto</option>
                            @foreach ($productos as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn btn-info" style="margin-top:30px;" id="agregarProducto" type="button"><i class="fa fa-plus"></i> Agregar</button>
                    </div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="m-b-0 m-t-0 text-white">Productos</h4>
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="table-responsive">
                            <table class="table" id="preciosTbl">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="10%">Id</th>
                                        <th class="text-center" width="50%">Nombre</th>
                                        <th class="text-center" width="5%">Cant</th>
                                        <th class="text-center" width="10%">Vlr/Unit</th>
                                        {{-- <th class="text-center" width="10%">D(%)</th>
                                        <th class="text-center" width="20%">Desc ($)</th>
                                        <th class="text-center" width="5%">IVA (%)</th>
                                        <th class="text-center" width="10%">IVA ($)</th> --}}
                                        <th class="text-center" width="10%">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="precios">
                                    @if(strlen($registro->t09elementos)>10)
                                        @foreach(\App\Funciones::to_php_array($registro->t09elementos) as $ex)
                                            <?php
                                                $e=$ex;
                                                $p=\App\T04productos::find($e[0]);
                                                $class="";
                                                if(!is_null($p)){
                                                    if($p->t05categoria==$catMonturas)
                                                        $class="montura";
                                                    if($p->t05categoria==$catLentes)
                                                        $class="lente";
                                                }
                                                if(count($e)==8){
                                                    $e=[$ex[0],$ex[1],$ex[2],$ex[3],0,$ex[4],$ex[5],$ex[6],$ex[7]];
                                                    if(!is_null($p)){
                                                        if($p->t05categoria==$catMonturas){
                                                            $e[4]=$registro->t15descuento;
                                                        }elseif($p->t05categoria==$catLentes){
                                                            $e[4]=$registro->t15descuentolente;
                                                        }else{
                                                            $e[4]=$registro->t15descuentootro;
                                                        }
                                                    }
                                                }
                                            ?>
                                            {{-- <tr class="{!! $class !!}"> --}}
                                            <tr>
                                                <td>{!! $e[0] !!}</td>
                                                <td>{!! $e[1] !!}</td>
                                                <td class="number">{!! $e[2] !!}</td>
                                                <td class="precio">{!! $e[3] !!}</td>
                                                {{-- <td class="number">{!! $e[4] !!}</td>
                                                <td class="precio">{!! $e[5] !!}</td>
                                                <td class="number">{!! $e[6] !!}</td>
                                                <td>{!! $e[7] !!}</td> --}}
                                                <td>{!! $e[8] !!}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">Subtotal</th>
                                        <th class="text-right" id="tblSubtotal"></th>
                                    </tr>
                                    {{-- <tr>
                                        <th colspan="8" class="text-right">Bonos</th>
                                        <th class="text-right" id="tblBono"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="8" class="text-right">IVA</th>
                                        <th class="text-right" id="tblIva"></th>
                                    </tr> --}}
                                    <tr>
                                        <th colspan="4" class="text-right">Total</th>
                                        <th class="text-right" id="tblTotal"></th>
                                    </tr>
                                    {{-- <tr>
                                        <th colspan="8" class="text-right">Ajuste</th>
                                        <th class="text-right" id="tblDescuento"></th>
                                    </tr> --}}
                                    <tr>
                                        <th colspan="4" class="text-right">Total a Pagar</th>
                                        <th class="text-right" id="tblPagar"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-primary">
                <div class="card-header bg-primary">
                    <h4 class="m-b-0 m-t-0 text-white">Forma de Pago</h4>
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-md-8">
                            <label for="productos">Producto</label>
                        <select class="form-control" id="forma" name="productos">
                            {{-- <option value="">Seleccione la forma de pago</option> --}}
                            @foreach ($formas as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>

                            {{-- {!! Former::select("forma","Forma de Pago")->addClass("form-control")->options($formas) !!} --}}
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn btn-info" style="margin-top:30px;" id="agregarForma" type="button"><i class="fa fa-plus"></i> Agregar</button>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="table-responsive">
                            <table class="table" id="formasPagoTbl">
                                <thead>
                                    <tr>
                                        <th>Cod</th>
                                        <th>Forma de Pago</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody id="formasPago">
                                    @foreach($pagos as $p)
                                        <tr>
                                            <td>{!! $p->t18formapago !!}</td>
                                            <td>{!! $p->t01nombre !!}</td>
                                            <td class="precio">{!! \App\Funciones::formatMoney($p->t18valor) !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-12 bg-danger p-4 text-white font-weight-bold text-right" id="total" style="font-size:32px;">

                        </div>
                    </div>
                    {{-- <div class="row form-group">
                        <div class="table-responsive">
                            <table class="table" id="formasPagoAnteriorTbl">
                                <thead>
                                    <tr>
                                        <th colspan="2">Abonos Anteriores</th>
                                    </tr>
                                    <tr>
                                        <th>Forma de Pago</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody id="formasPagoAnterior">
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="t09baucher">Baucher</label>
                            <input type="text" class="form-control" id="t09baucher" name="t09baucher" placeholder="Baucher">
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <label for="t09bono">Bono</label>
                            <input type="text" class="form-control" id="t09bono" name="t09bono" placeholder="Bono">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="detalleBono">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <input type="hidden" name="t15bono" id="t15bono" value="{!! $registro->t15bono !!}">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-info btn-rounded" onclick="validarBono();">Validar Bono</button>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
     </div>
        <div class="row form-group">
            <div class="col-md-12 text-center">
                <a href="{!! url("admin/sales") !!}" class="btn btn-warning"><i class="fa fa-reply"></i> Cancelar</a>
                <button type="button" id="guardar" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                <button type="submit" id="btnSubmit" class="hidden"></button>
            </div>
        </div>
    </div>
    <input type="hidden" name="t09elementos" id="t09elementos">
    <input type="hidden" name="t09pagos" id="t09pagos">
</form>

@stop

@section('css')
    <!-- Estilos adicionales -->
@stop

@section('js')
    <!-- Scripts adicionales -->
    <script>
        var total=0;
        var totalPagos=0;
        $(document).ready(function(){
            $("#agregarProducto").click(function(){
                // console.log('entro');
                $.getJSON("{!! url('agregar-producto') !!}", {id: $("#productos").val()}, function(json){
                    if(json){
                        var clase='helado';
                        @if(Auth::user()->sys01id == 2)
                            var noedit='';
                        @else
                            var noedit='no-edit';
                        @endif
                        $("#precios").append("<tr class='"+clase+"'>" +
                            "<td tabindex='441' class='"+noedit+"'>"+json["t04id"]+"</td>" +
                            "<td tabindex='441' class='"+noedit+"'>"+json["t04nombre"]+"</td>" +
                            "<td tabindex='443' class='number'>1</td>" +
                            "<td tabindex='444' class='precio"+noedit+"'>"+"$"+json["t04precio"]+" MXN"+"</td>" +
                            // "<td tabindex='445' class='number descuento'>0</td>" +
                            // "<td tabindex='445' class='number "+noedit+"'>0</td>" +
                            // "<td tabindex='446' class='number"+noedit+"'>"+iva+"</td>" +
                            // "<td tabindex='447' class='"+noedit+"'>"+valoriva.formatMoney(0)+"</td>" +
                            "<td tabindex='444' class='precio"+noedit+"'>"+"$"+json["t04precio"]+" MXN"+"</td>" +
                            "</tr>");
                            actualizarTabla();
                    }
                });
            });

            function actualizarTabla(){
                var filas=$("#precios").find("tr");
                // console.log(filas);
                total=0;
                filas.each(function(i){
                    var vlr =numero($(this).children().eq(3).text());
                    // var cant=numero($(this).children().eq(2).text()); cantidad
                    // console.log(cant)
                    total+=numero($(this).children().eq(3).text());
                    // console.log(total);
                });
                var sub=total;
                $("#tblSubtotal").text(formatMoney(sub));
                $("#tblTotal").text(formatMoney(total));
                $("#tblPagar").text(formatMoney(total))
                $("#t09elementos").val(tableToJSONArray("preciosTbl"));
                var elemento = '';

            }

            function iniciarTablaPagos(){
                $("#formasPagoTbl").find('td').off();
                $('#formasPagoTbl')
                    // .editableTableWidget()
                    .find("td").change(function(){
                        var celda=$(this);
                        if(/precio/.test(celda.attr("class"))) {
                            celda.text(numero(celda.text()).formatMoney(0));
                            $("#t09pagos").val(tableToJSONArray("formasPagoTbl"));
                        }else if(/number/.test(celda.attr("class"))) {
                        }else {
                            return false;
                        }
                    });
                $("#t09pagos").val(tableToJSONArray("formasPagoTbl"));
            }

            $("#agregarForma").click(function(){
                var total=numero($("#tblPagar").text());
                var totalP=0;
                var filas =$("#formasPago").find("tr");
                filas.each(function(){
                    totalP+=numero($(this).children().eq(2).text());
                });
                console.log(totalP);

                $("#formasPago").append("<tr>" +
                    "<td>"+$("#forma").val()+"</td>" +
                    "<td>"+$("#forma").find("option:selected").text()+"</td>" +
                    "<td class='precio'>"+formatMoney((total-totalP))+"</td>" +
                    "</tr>");
                iniciarTablaPagos();
            });

            $("#guardar").click(function() {
                $necesidadBaucher = false;
                $("#formasPagoTbl tbody tr").each(function (index) {
                    $(this).children("td").each(function (index2) {
                            switch (index2) {
                                case 0:
                                    if($.inArray($(this).text(), ['19', '20', '21']) >= 0){
                                        if($('#t09baucher').val() == ""){
                                            $necesidadBaucher = true;
                                        }
                                    }
                                    break;
                            }
                    });
                });
                if($necesidadBaucher){
                    alert("La forma de pago seleccionada necesita ingresar baucher");
                }else{
                    $("#btnSubmit").click();
                }
            });
        });
    </script>
@stop
