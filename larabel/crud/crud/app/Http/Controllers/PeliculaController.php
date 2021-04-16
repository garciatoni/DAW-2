<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['peliculas']=Pelicula::all();
        return view('pelicula.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelicula.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validacion=[
                'Nombre'=>'required',
                'Genero'=>'required',
                'Duracion'=>'required | integer',
                'Estreno'=>'required | integer',
                'Nacionalidad'=>'required',
                'Director'=>'required',
                // 'Imagen'=>'required',
        ];
        $mensajeError=[
            'required'=>'Debes añadir un/a :attribute ',
            'integer'=>'Debes añadir un numero.'
        ];

        $datosPelicula = request()->except('_token');
        $this->validate($request, $validacion, $mensajeError);

            if($request->hasFile('Imagen')){

                $imagen = $request -> file('Imagen');
                $imageName = 'Imagen'.'.'.$imagen->getClientOriginalExtension();
                $datosPelicula['Imagen']=$request->file('Imagen')->storeAs('public', $imageName);

            }

        Pelicula::insert($datosPelicula);

        return redirect('pelicula')->with('mensaje','Pelicula añadida correctamente!! ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function show(Pelicula $pelicula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $pelicula=Pelicula::find($id);
        return view('pelicula.edit', compact('pelicula'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validacion=[
            'Nombre'=>'required',
            'Genero'=>'required',
            'Duracion'=>'required | integer',
            'Estreno'=>'required | integer',
            'Nacionalidad'=>'required',
            'Director'=>'required',
            // 'Imagen'=>'required',
        ];
        $mensajeError=[
            'required'=>'Debes añadir un/a :attribute ',
            'integer'=>'Debes añadir un numero.'
        ];
        $datosPelicula = request()->except(['_token','_method']);
 
        $this->validate($request, $validacion, $mensajeError);


        Pelicula::where('id','=',$id)->update($datosPelicula);

        $pelicula=Pelicula::find($id);
        return view('pelicula.edit', compact('pelicula'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pelicula::find($id)->delete();
 
        return redirect('pelicula')->with('mensaje','Pelicula eliminada');
    }
}
