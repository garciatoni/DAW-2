<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Pelicula
 * @package App\Models
 * @version February 3, 2021, 1:36 pm UTC
 *
 * @property string $Nombre
 * @property string $Director
 * @property string $Genero
 */
class Pelicula extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'peliculas';
    public $timestamps = false;

    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'Nombre',
        'Director',
        'Genero'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'Nombre' => 'string',
        'Director' => 'string',
        'Genero' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Nombre' => 'required|string|max:1000',
        'Director' => 'required|string|max:1000',
        'Genero' => 'required|string|max:1000'
    ];

    
}
