<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class test extends Controller
{
    public function form(){
        return view('formulario');
    }
    public function principal(Request $request){
        $data['nombre']=$request->input('nombre');
        $data['correo']=$request->input('correo');
        return view('principal', $data);
    }


    public function formlogin(){
        return view('formulariologin');
    }
    public function muestra(Request $request){
        $validateData = $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email',
            'nif' => 'required',
            'fichero' => 'required',
            'image' => 'required',

        ]);
        
        $image = $request -> file('image');
        $imageName = 'image'.'.'.$image->getClientOriginalExtension();
        $data['imagen']=$request->file('image')->storeAs('public', $imageName);
    

        $data['nombre']=$request->input('nombre');
        $data['correo']=$request->input('correo');
        $data['nif']=$request->input('nif');
        $data['fichero']=$request->input('fichero');
        $data['imagen'] = $imageName;
        return view('muestralogin', $data);


    }
}
