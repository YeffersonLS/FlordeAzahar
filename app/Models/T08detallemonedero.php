<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T08detallemonedero extends Model
{
    use HasFactory;

    protected $table = 't08detallemonederos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 't08id';
    protected $fillable = [
        't08venta',
        't08valor',
        't08monedero'
    ];

}
