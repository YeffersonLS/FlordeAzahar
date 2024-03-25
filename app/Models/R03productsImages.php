<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class R03productsImages extends Model
{
    use HasFactory;

    protected $table = 'r03products_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'r03id';
    protected $fillable = [
        'r03product',
        'image_path',
    ];

}
