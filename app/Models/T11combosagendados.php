<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T11combosagendados extends Model
{
    use HasFactory;

    protected $table = 't11combosagendados';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 't11id';
    protected $fillable = [
        't11cliente',
        't11nombre',
        't11numero',
        't11direccion',
        't11hora',
        't11pago',
    ];

    protected static $titles = ['Nombre', 'Hora de entrega', 'Pago','Acciones'];

    public static function getTitles()
    {
        return static::$titles;
    }

}
