<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Libro
 * @package App\Models
 * @version February 3, 2021, 4:34 pm UTC
 *
 * @property string $nombre
 * @property string $editorial
 * @property string $genero
 */
class Libro extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'libros';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'editorial',
        'genero'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'editorial' => 'string',
        'genero' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:100',
        'editorial' => 'required|string|max:100',
        'genero' => 'required|string|max:100'
    ];

    
}
