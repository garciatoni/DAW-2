<?php

namespace App\Repositories;

use App\Models\Libro;
use App\Repositories\BaseRepository;

/**
 * Class LibroRepository
 * @package App\Repositories
 * @version February 3, 2021, 4:34 pm UTC
*/

class LibroRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'editorial',
        'genero'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Libro::class;
    }
}
