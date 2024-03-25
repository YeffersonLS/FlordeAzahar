<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class T09venta extends Model
{
    use HasFactory;

    protected $table = 't09ventas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 't09id';
    protected $fillable = [
        't09usuario',
        't09cliente',
        't09valor',
        't09cupon',
        't09cuponvalor',
        't09detallemonedero',
        't09pagos',
        't09baucher'
    ];

    protected static $titles = ['Consecutivo', 'Cliente', 'Valor','Acciones'];

    public static function getTitles()
    {
        return static::$titles;
    }

    public static function getDatatable(Request $request)
    {
        $sql =T09venta::select('t09id', 't09cliente', 'u.sys01fullname','t09valor' )
        ->leftJoin('sys01usuarios as u', 'u.sys01id', '=', 't09cliente')
        ->orderBy('t09id', 'desc')
        ;

        return Datatables::eloquent($sql)
        ->addColumn('Acciones','
        <div class="text-center">
            <a href="{!! url(\'admin/blogs/\'.$t09id.\'/edit\') !!}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
            <button class="btn btn-danger btn-xs" title="Borrar" data-toggle="modal" data-target="#myModal_{!!$t09id!!}"><i class="fa fa-trash" ></i></button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal_{!!$t09id!!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Eliminación de registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </button>
            </div>
            <div class="modal-body">
            ¿Esta seguro de eliminar el registro?
            </div>
            <div class="modal-footer">
                <form id="formdelete_{{ $t09id }}" action="{{ route("admin.blogs.destroy", $t09id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Borrar Definitivamente</button>
                </form>
            </div>
            </div>
        </div>
        </div>
    ')
            ->escapeColumns(['Acciones'])
            ->removeColumn('t09id')
            ->removeColumn('t09cliente')
            ->skipTotalRecords()
            ->make(false)
        ;
    }

}
