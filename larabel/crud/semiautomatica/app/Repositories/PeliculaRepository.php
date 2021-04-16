<?php

namespace App\Repositories;

use App\Models\Pelicula;
use App\Repositories\BaseRepository;

/**
 * Class PeliculaRepository
 * @package App\Repositories
 * @version February 3, 2021, 1:36 pm UTC
*/

class PeliculaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'Nombre',
        'Director',
        'Genero'
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
        return Pelicula::class;
    }
}
