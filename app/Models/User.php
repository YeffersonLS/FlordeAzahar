<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'sys01usuarios';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'sys01id';
    protected $fillable = [
        'sys01name',
        'sys01middlename',
        'sys01lastname',
        'sys01secondsurname',
        'sys01phonenumber',
        'sys01active',
        'sys01nit',
        'sys01fullname',
        'sys01email',
        'password',
        'sys01admin'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static $titles = ['Nombre', 'Telefono', 'Correo', 'Permiso', 'Acciones'];

    public static function getTitles()
    {
        return static::$titles;
    }

    public static function getDatatable(Request $request)
    {
        $sql =User::select('sys01id', 'sys01fullname', 'sys01phonenumber', 'sys01email', 'sys01admin' )
        ->orderBy('sys01id', 'desc')
        ;

        return Datatables::eloquent($sql)
        ->editColumn('sys01admin', '<span @if($sys01admin) class="badge bg-success">SI @else class="badge bg-danger">No @endif</span>')
        ->addColumn('Acciones','
        <div class="text-center">
            <a href="{{ route("admin.user.destroy", $sys01id) }}" class="btn btn-success btn-xs"><i class="fa fa-user-plus"></i></a>
            <button class="btn btn-danger btn-xs" title="Borrar" data-toggle="modal" data-target="#myModal_{!!$sys01id!!}"><i class="fa fa-trash" ></i></button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal_{!!$sys01id!!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <form id="formdelete_{{ $sys01id }}" action="{{ route("admin.user.destroy", $sys01id) }}" method="POST">
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
            ->removeColumn('sys01id')
            ->removeColumn('t01usuario')
            ->removeColumn('t01categoria')
            ->skipTotalRecords()
            ->make(false)
        ;
    }
}
