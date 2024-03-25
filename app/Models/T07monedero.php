<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T07monedero extends Model
{
    use HasFactory;

    protected $table = 't07monederos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 't07id';
    protected $fillable = [
        't07usuario',
    ];

}
