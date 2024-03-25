<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class T04productos extends Model
{
    use HasFactory;

    protected $table = 't04productos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 't04id';
    protected $fillable = [
        't04nombre',
        't04presentacion',
        't04cantidad',  //gr
        't04usuario',
        't04activo',
        't04descripcion',
        't04sabor',
        't04categoria',
        't04preparacion',
        't04slug',
        't04precio'
    ];

    protected static $titles = ['Nombre', 'Categoria', 'Estado', 'Acciones'];

    public static function getTitles()
    {
        return static::$titles;
    }

    protected static $titlesImages = ['Nombre', 'Categoria', 'Fotos', 'Acciones'];

    public static function getTitlesImages()
    {
        return static::$titlesImages;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 't04usuario');
    }

    public function category()
    {
        return $this->belongsTo(T02directorio::class, 't04categoria');
    }

    public function tags()
    {
        return $this->belongsToMany(T03tag::class, 'r02products_tag', 'r02product_id', 'r02tag_id');
    }

    public function images()
    {
        return $this->hasMany(R03productsImages::class, 'r03product');
    }

    public static function getDatatable(Request $request)
    {
        $sql =T04productos::select('t04id', 't04nombre', 't04categoria', 'c.t02nombre', 't04activo' )
        ->leftJoin('t02directorios as c', 'c.t02id', '=', 't04categoria')
        ->orderBy('t04id', 'desc')
        ;

        return Datatables::eloquent($sql)
        ->addColumn('Acciones','
        <div class="text-center">
            <a href="{!! url(\'admin/products/\'.$t04id.\'/edit\') !!}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
            <button class="btn btn-danger btn-xs" title="Borrar" data-toggle="modal" data-target="#myModal_{!!$t04id!!}"><i class="fa fa-trash" ></i></button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal_{!!$t04id!!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <form id="formdelete_{{ $t04id }}" action="{{ route("admin.products.destroy", $t04id) }}" method="POST">
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
            ->removeColumn('t04id')
            ->removeColumn('t04categoria')
            ->skipTotalRecords()
            ->make(false)
        ;
    }


    public static function getDatatableRecetas(Request $request)
    {
        $sql =T04productos::select('t04id', 't04nombre', 't04categoria', 'c.t02nombre', 't04activo' )
        ->leftJoin('t02directorios as c', 'c.t02id', '=', 't04categoria')
        ->orderBy('t04id', 'desc')
        ;

        return Datatables::eloquent($sql)
        ->addColumn('Acciones','
        <div class="text-center">
            <a href="{!! url(\'admin/products/recetas/\'.$t04id) !!}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
            <a href="{!! url(\'admin/products/recetas/\'.$t04id.\'/crear\') !!}" class="btn btn-primary btn-xs"><i class="fa fa-eye-dropper"></i></a>
            {{--<button class="btn btn-danger btn-xs" title="Borrar" data-toggle="modal" data-target="#myModal_{!!$t04id!!}"><i class="fa fa-trash" ></i></button>--}}
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal_{!!$t04id!!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <form id="formdelete_{{ $t04id }}" action="{{ route("admin.products.destroy", $t04id) }}" method="POST">
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
            ->removeColumn('t04id')
            ->removeColumn('t04categoria')
            ->skipTotalRecords()
            ->make(false)
        ;
    }

    public static function getDatatableImages(Request $request)
    {
        $sql =T04productos::select('t04id', 't04nombre', 't04categoria', 'c.t02nombre', 't04activo' )
        ->leftJoin('t02directorios as c', 'c.t02id', '=', 't04categoria')
        ->orderBy('t04id', 'desc')
        ;

        return Datatables::eloquent($sql)
        ->addColumn('Acciones','
        <div class="text-center">
            <a href="{!! url(\'admin/products/images/\'.$t04id.\'/crear\') !!}" class="btn btn-info btn-xs"><i class="fa fa-images"></i></a>
            <button class="btn btn-danger btn-xs" title="Borrar" data-toggle="modal" data-target="#myModal_{!!$t04id!!}"><i class="fa fa-trash" ></i></button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal_{!!$t04id!!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <form id="formdelete_{{ $t04id }}" action="{{ route("admin.products.destroy", $t04id) }}" method="POST">
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
            ->removeColumn('t04id')
            ->removeColumn('t04categoria')
            ->skipTotalRecords()
            ->make(false)
        ;
    }
}
