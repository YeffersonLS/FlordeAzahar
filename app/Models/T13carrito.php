<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class T13carrito extends Model
{
    use HasFactory;

    protected $table = 't13carritos';

    public $fillable = [
        't13cliente', // Opcional si se desea asociar el carrito al usuario
        't13sessionid' // Identificador de sesión para carritos de invitados
    ];

    public function cartItems(): HasMany
    {
        return $this->hasMany(T12carritoItem::class);
    }
}
