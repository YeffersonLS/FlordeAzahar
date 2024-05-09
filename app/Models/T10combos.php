<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class T10combos extends Model
{
    use HasFactory;

    protected $table = 't10combos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 't10id';
    protected $fillable = [
        't10usuario',
        't10nombre',
        't10vencimiento',
        't10valor',
        't10image',
        't10descripcion',
        't10slug'
    ];

    protected static $titles = ['Consecutivo', 'Fecha de Vencimiento', 'Valor','Acciones'];

    public static function getTitles()
    {
        return static::$titles;
    }

    public function products()
    {
        return $this->belongsToMany(T04productos::class, 'r04combo_product', 'r04combo_id', 'r04product_id');
    }

    public function images()
    {
        return $this->hasMany(R05combosImages::class, 'r05combo');
    }

    public static function getDatatable(Request $request)
    {
        $sql = T10combos::select('t10id', 't10vencimiento', 't10valor')
        ->orderBy('t10id', 'desc')
        ;

        return Datatables::eloquent($sql)
        ->addColumn('Acciones','
        <div class="text-center">
            <a href="{!! url(\'admin/combos/\'.$t10id.\'/edit\') !!}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
            <a href="{!! url(\'admin/combos/images/\'.$t10id.\'/crear\') !!}" class="btn btn-info btn-xs"><i class="fa fa-images"></i></a>
            <button class="btn btn-danger btn-xs" title="Borrar" data-toggle="modal" data-target="#myModal_{!!$t10id!!}"><i class="fa fa-trash" ></i></button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal_{!!$t10id!!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <form id="formdelete_{{ $t10id }}" action="{{ route("admin.combos.destroy", $t10id) }}" method="POST">
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
            ->skipTotalRecords()
            ->make(false)
        ;
    }

}
