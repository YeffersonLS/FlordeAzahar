<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class T05postProductos extends Model
{

    use HasFactory;

    protected $table = 't05postproductos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 't05id';
    protected $fillable = [
        't05producto',
        't05post',
    ];

    protected static $titles = ['Nombre', 'Categoria', 'Publicado', 'Acciones'];

    public static function getTitles()
    {
        return static::$titles;
    }

    public function producto()
    {
        return $this->belongsTo(T04productos::class, 't05producto');
    }

    public static function getDatatable(Request $request)
    {
        $sql =T05postProductos::select('t05id', 't05producto', 'p.t04nombre', 'p.t04categoria', 'c.t02nombre', 'b.t01activo', 'b.t01postproducto' )
        ->leftJoin('t04productos as p', 'p.t04id', '=', 't05producto')
        ->leftJoin('t01blogs as b', 'b.t05id', '=', 't01postproducto')
        ->leftJoin('t02directorios as c', 'c.t02id', '=', 't04categoria')
        ->orderBy('t04id', 'desc')
        ;

        return Datatables::eloquent($sql)
        ->addColumn('Acciones','
        <div class="text-center">
            <a href="{!! url(\'admin/products/\'.$t04id.\'/edit\') !!}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
            <button class="btn btn-danger btn-xs" title="Borrar" data-toggle="modal" data-target="#myModal_{!!$t04id!!}"><i class="fa fa-trash" ></i></button>
        </div>
        </div>
    ')
            ->escapeColumns(['Acciones'])
            ->removeColumn('t05id')
            ->removeColumn('t01postproducto')
            ->removeColumn('t04categoria')
            ->removeColumn('t05producto')
            ->skipTotalRecords()
            ->make(false)
        ;
    }
}
