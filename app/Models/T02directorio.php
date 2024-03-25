<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class T02directorio extends Model
{
    use HasFactory;

    protected $table = 't02directorios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 't02id';
    protected $fillable = [
        't02nombre',
        't02grupo',
        't02image_path',
        't02slug'
    ];

    protected static $titles = ['Nombre', 'Grupo', 'Imagen', 'Acciones'];

    public static function getTitles()
    {
        return static::$titles;
    }

    public static function getDatatable(Request $request)
    {
        $sql =T02directorio::select('t02id', 't02nombre', 't02grupo', 't02image_path')
        ->orderBy('t02id', 'desc')
        ;

        return Datatables::eloquent($sql)
        ->addColumn('Acciones','
        <div class="text-center">
            <a href="{!! url(\'admin/category/\'.$t02id.\'/edit\') !!}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
            <button class="btn btn-danger btn-xs" title="Borrar" data-toggle="modal" data-target="#myModal_{!!$t02id!!}"><i class="fa fa-trash" ></i></button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal_{!!$t02id!!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <form id="formdelete_{{ $t02id }}" action="{{ route("admin.category.destroy", $t02id) }}" method="POST">
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
            ->removeColumn('t02id')
            ->removeColumn('t01usuario')
            ->removeColumn('t01categoria')
            ->skipTotalRecords()
            ->make(false)
        ;
    }

}
