<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T12carritoItem extends Model
{
    use HasFactory;


    protected $table = 't12carritoitems';

    protected $primaryKey = 't12id';
    public $fillable = [
        't12producto',
        't12cantidad',
        't12carrito',
        't12pedido',
        't12fechapedido',
        't12correo'
    ];

    public function product()
    {
        return $this->belongsTo(T04productos::class);
    }
}
