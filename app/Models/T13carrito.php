<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class T13carrito extends Model
{
    use HasFactory;

    protected $table = 't13carritos';

    protected $primaryKey = 't13id';

    public $fillable = [
        't13cliente',
        't13sessionid'
    ];

    public function cartItems(): HasMany
    {
        return $this->hasMany(T12carritoItem::class, 't12carrito');
    }
}
