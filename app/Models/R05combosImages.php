<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class R05combosImages extends Model
{
    use HasFactory;

    protected $table = 'r05combo_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'r05id';
    protected $fillable = [
        'r05combo',
        'image_path',
    ];
}
