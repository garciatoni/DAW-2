<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Comentario;
use App\Models\Like;
use App\Models\Muro;   //MODELO
use App\Events\NewMensajeNotification;
use App\Events\MuroEvent;  //EVENTO
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["user_id"] = Auth::user()->id; 
        $data['user_name'] = Auth::user()->name; 

        $mensajes = DB::table('muro')->orderBy('id', 'desc')->get(); //mirarme esto !!!!!!!!!!!!
        $data["mensajes"]=$mensajes;
        
        $comentarios = DB::table('comentarios')->orderBy('id', 'desc')->get();
        $data["comentarios"]=$comentarios;

        $users=DB::table('users')->orderBy('id')->get();
        $data["users"]=$users;

        $privados = DB::table('mensajes')->get();
        $data["privados"] = $privados;


        $likes = DB::table('likes')->get();
        $data["likes"] =  $likes;
    

        //Retrieving Models, LARABEL DOCUMENTATION
        // use App\Models\Flight;
        // foreach (Flight::all() as $flight) {
        //     echo $flight->name;
        // }


        return view('home', $data);
    }

    public function send(Request $request){ 
        $mensaje = new Muro;
        $mensaje->user=Auth::user()->name;

        if ($request->file('file')) {
            $imagePath = $request->file('file');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('file')->storeAs(Auth::user()->id, $imageName, 'public');


            $mensaje->imagen=$path;
        }
        
        // $todo =$request->all();
        // if ($file -> $request->file('imagen')){
        // }
        // $imagen = $request->file('imagen');
        // $nombreImagen = $imagen->getClientOriginalName();
        // // $imagen->move(public_path().'/images/' ,$nombreImagen);
        // $path = $request->file('imagen')->storeAs('uploads', $nombreImagen, 'public');



        $mensaje->mensaje=$request->mensaje;

        $mensaje->save();


        
        event(new MuroEvent($mensaje));

    }

    public function comentario(Request $request)
    {   
        $comentario = new Comentario;
        $comentario->user=Auth::user()->name;
        $comentario->mensaje=$request->mensaje;
        $comentario->id_publicacion=$request->id;
        $comentario->save();
        // event(new MuroEvent($mensaje));
        return $comentario;
    }

    public function like(Request $request)
    {   

        $userId = Auth::user()->id;
        $likeId = $request->id_publicacion;

        $like = DB::table('likes')->where('user_id', '=', $userId)->where('id_publicacion', '=', $likeId)->get();
        if(count($like) >= 1){
            $like = DB::table('likes')->where('user_id', '=', $userId)->where('id_publicacion', '=', $likeId)->delete();
        }else{
            $like = new Like;
            $like->user_id=Auth::user()->id;
            $like->id_publicacion=$request->id_publicacion;
            $like->save();
            return $like;
        }


    }

    public function sendPrivate(Request $request){   
        $mensaje = new Mensaje;
        $mensaje->from=Auth::user()->id;
        $mensaje->to=$request->to;
        $mensaje->mensaje=$request->mensaje;
        $mensaje->save();

        event(new NewMensajeNotification($mensaje));
        return $mensaje;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
