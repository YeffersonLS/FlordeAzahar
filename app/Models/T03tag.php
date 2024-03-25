<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class T03tag extends Model
{
    use HasFactory;


    protected $table = 't03tag';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 't03id';
    protected $fillable = [
        't03nombre',
        't03tipo',
        't03usuario',
        't03slug',
        't03color'
    ];


    protected static $titles = ['Nombre', 'Realizo', 'TIpo', 'Acciones'];

    public static function getTitles()
    {
        return static::$titles;
    }

    public static function getDatatable(Request $request)
    {
        $sql =T03tag::select('t03id', 't03nombre', 'u.sys01fullname','t03tipo', 't03usuario' )
        ->leftJoin('sys01usuarios as u', 'u.sys01id', '=', 't03usuario')
        ->orderBy('t03id', 'desc')
        ;

        return Datatables::eloquent($sql)
        ->addColumn('Acciones','
        <div class="text-center">
            <a href="{!! url(\'admin/tags/\'.$t03id.\'/edit\') !!}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
            <button class="btn btn-danger btn-xs" title="Borrar" data-toggle="modal" data-target="#myModal_{!!$t03id!!}"><i class="fa fa-trash" ></i></button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal_{!!$t03id!!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <form id="formdelete_{{ $t03id }}" action="{{ route("admin.tags.destroy", $t03id) }}" method="POST">
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
            ->removeColumn('t03id')
            ->removeColumn('t03usuario')
            ->skipTotalRecords()
            ->make(false)
        ;
    }
}
