<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePeliculaRequest;
use App\Http\Requests\UpdatePeliculaRequest;
use App\Repositories\PeliculaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PeliculaController extends AppBaseController
{
    /** @var  PeliculaRepository */
    private $peliculaRepository;

    public function __construct(PeliculaRepository $peliculaRepo)
    {
        $this->peliculaRepository = $peliculaRepo;
    }

    /**
     * Display a listing of the Pelicula.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $peliculas = $this->peliculaRepository->all();

        return view('peliculas.index')
            ->with('peliculas', $peliculas);
    }

    /**
     * Show the form for creating a new Pelicula.
     *
     * @return Response
     */
    public function create()
    {
        return view('peliculas.create');
    }

    /**
     * Store a newly created Pelicula in storage.
     *
     * @param CreatePeliculaRequest $request
     *
     * @return Response
     */
    public function store(CreatePeliculaRequest $request)
    {
        $input = $request->all();

        $pelicula = $this->peliculaRepository->create($input);

        Flash::success('Pelicula saved successfully.');

        return redirect(route('peliculas.index'));
    }

    /**
     * Display the specified Pelicula.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pelicula = $this->peliculaRepository->find($id);

        if (empty($pelicula)) {
            Flash::error('Pelicula not found');

            return redirect(route('peliculas.index'));
        }

        return view('peliculas.show')->with('pelicula', $pelicula);
    }

    /**
     * Show the form for editing the specified Pelicula.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pelicula = $this->peliculaRepository->find($id);

        if (empty($pelicula)) {
            Flash::error('Pelicula not found');

            return redirect(route('peliculas.index'));
        }

        return view('peliculas.edit')->with('pelicula', $pelicula);
    }

    /**
     * Update the specified Pelicula in storage.
     *
     * @param int $id
     * @param UpdatePeliculaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePeliculaRequest $request)
    {
        $pelicula = $this->peliculaRepository->find($id);

        if (empty($pelicula)) {
            Flash::error('Pelicula not found');

            return redirect(route('peliculas.index'));
        }

        $pelicula = $this->peliculaRepository->update($request->all(), $id);

        Flash::success('Pelicula updated successfully.');

        return redirect(route('peliculas.index'));
    }

    /**
     * Remove the specified Pelicula from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pelicula = $this->peliculaRepository->find($id);

        if (empty($pelicula)) {
            Flash::error('Pelicula not found');

            return redirect(route('peliculas.index'));
        }

        $this->peliculaRepository->delete($id);

        Flash::success('Pelicula deleted successfully.');

        return redirect(route('peliculas.index'));
    }
}
