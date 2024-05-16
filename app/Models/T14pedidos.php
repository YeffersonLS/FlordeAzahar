<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T14pedidos extends Model
{
    use HasFactory;

    protected $table = 't14pedidos';

    protected $primaryKey = 't14id';


    public $fillable = [
        't14cliente',
        't14pago',
        't14direccion',
        't14tipopago'
    ];

}
