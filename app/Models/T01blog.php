<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class T01blog extends Model
{
    use HasFactory;

    protected $table = 't01blogs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 't01id';
    protected $fillable = [
        't01usuario',
        't01categoria',
        't01descripcion',
        't01contenido',
        't01nombre',
        't01tituloseo',
        't01metadescription',
        't01views',
        't01comments',
        't01slug',
        't01publicado',
        't01postproducto',
        't01producto',
        't01image_path'
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 't01slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 't01usuario');
    }

    public function category()
    {
        return $this->belongsTo(T02directorio::class, 't01categoria');
    }

    public function tags()
    {
        return $this->belongsToMany(T03tag::class, 'r01blog_tag', 'r01blog_id', 'r01tag_id');
    }

    protected static $titles = ['Titulo', 'Realizo', 'Views', 'Categoria', 'Acciones'];

    public static function getTitles()
    {
        return static::$titles;
    }

    public static function getDatatable(Request $request)
    {
        $sql =T01blog::select('t01id', 't01nombre', 'u.sys01fullname','t01views', 'd.t02nombre', 't01categoria', 't01usuario' )
        ->leftJoin('sys01usuarios as u', 'u.sys01id', '=', 't01usuario')
        ->leftJoin('t02directorios as d', 'd.t02id', '=', 't01categoria')
        ->orderBy('t01id', 'desc')
        ;

        return Datatables::eloquent($sql)
        ->addColumn('Acciones','
        <div class="text-center">
            <a href="{!! url(\'admin/blogs/\'.$t01id.\'/edit\') !!}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
            <button class="btn btn-danger btn-xs" title="Borrar" data-toggle="modal" data-target="#myModal_{!!$t01id!!}"><i class="fa fa-trash" ></i></button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal_{!!$t01id!!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <form id="formdelete_{{ $t01id }}" action="{{ route("admin.blogs.destroy", $t01id) }}" method="POST">
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
            ->removeColumn('t01id')
            ->removeColumn('t01usuario')
            ->removeColumn('t01categoria')
            ->skipTotalRecords()
            ->make(false)
        ;
    }
}
