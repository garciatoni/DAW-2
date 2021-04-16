<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/982045aa7f.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script id="functions" user-name='{{ $user_name}}' user-id="{{ $user_id }}" src="{{ asset('js/functions.js') }}" defer></script>
</head>
<body class="font-sans antialiased">

    <div class="sticky-top">
    @include('layouts.navigation')
    </div>
    <div class="min-h-screen bg-gray-100 m-0 p-0">
        <div class="row container-fluid">
            <div class="form-group col-6 offset-3 mt-3">
                <form action="{{route('enviar')}}" enctype="multipart/form-data" method="post" id="formularioFoto">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="mensaje" id="mensaje" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" id="send" type="submit">Enviar</button>
                        </div>
                    </div>
                    <input type="file" id="imagen" name="file">
                </form>
            </div>
        </div>
        <div class="row container-fluid m-0 p-0">

            <div class="col-2 bg-white mt-2 mb-2 container border-right "  id="users">
                @foreach ($users as $user)
                    @if ($user->id != $user_id)
                        {{-- elimino de la lista el propio usuario --}}
                        <div class="rounded-right border m-1 mt-3 p-2 d-flex align-items-center">
                        <button id="user{{$user->id}}" value="{{$user->id}}" class="p-0 m-0 font-weight-bold col botonChatPrivado row">{{$user->name}}
                            <span class="m-0 ml-auto bg-danger px-2 rounded-circle" id="notificacion{{$user->id}}" value="0"></span>
                        </button>
                        </div>
                    @endif
                    @endforeach
            </div>
            <div id="chat" class="col-7 mt-2 pt-3 pb-2 bg-white">
                <div>@foreach ($likes as $like)
                    @endforeach
                </div>
                @foreach ($mensajes as $mensaje)
                    <div class="bg-gray-100 border container rounded mb-2">
                        <p class="font-weight-bold pt-2">{{$mensaje->user}}:</p>
                        <p class="">{{$mensaje->mensaje}}</p>
                        @if ($mensaje->imagen != null)
                        <img class="pb-3" src='https://dawjavi.insjoaquimmir.cat/agarcia/M07/larabel/facebook/storage/app/public/{{$mensaje->imagen}}' alt="">
                        @endif
                        <div class="border-top container justify-content-center row m-0">
                                <button id="meGusta" value="{{$mensaje->id}}" class="row justify-content-center align-items-center mr-2 col-6 p-2">
                                    @foreach($likes as $like)
                                    @if($like->user_id == $user_id && $like->id_publicacion == $mensaje->id)
                                        <i class="fas fa-heart fa-2x" id="corazon{{$mensaje->id}}"></i>
                                    @endif  
                                    @endforeach
                                    <p class="m-0 pl-1">Me gusta</p>
                                </button>
                            <button id="mostrarComentarios" class="row justify-content-center align-items-center ml-2 col-6 p-2">
                                <i class="fas fa-comment-dots fa-1x" id="{{$mensaje->id}}"></i>  
                                <p class="m-0 pl-1">Comenta</p>
                            </button>
                        </div>
                        <div id="comentarios" class="border-top" style="display: none">

                            <form action="{{route('comentario')}}" method="post">
                                @csrf
                                <div class="input-group mt-3 mb-3">
                                    <input type="text" class="form-control" placeholder="Escribe tu comentario" name="comentario" id="comentario{{$mensaje->id}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="sendComentario" value="{{$mensaje->id}}" type="button">Enviar</button>
                                    </div>
                                </div>
                            </form>
                            <div id="caja{{$mensaje->id}}">
                            @foreach ($comentarios as $comentario)
                                @if ($comentario->id_publicacion == $mensaje->id)
                                    <div class="col border mt-2 mb-2 bg-white">
                                        <p class="m-0 font-weight-bold ">{{$comentario->user}}</p>      
                                        <p class="m-0">{{$comentario->mensaje}}</p>      
                                    </div>
                                @endif
                            @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="bonito" class="col-3 bg-white mt-2 mb-2 border-left">
                @foreach ($users as $user)
                    @if ($user->id != $user_id)
                    <div id='divChatPrivado{{$user->id}}'style="display: none">
                        <div class="">
                            <div id="chatPrivado" class="text-center mt-3 p-2 border font-weight-bold fixed-right">Chat privado con {{$user->name}}</div>
                            <div class="border" id="mensajesPrivados{{$user->id}}" value="{{$user->name}}" style="height: 650px;width: 100%;overflow-y: scroll;">
                                @foreach ($privados as $privado)
                                    @if ($privado->from == $user->id && $privado->to == $user_id)
                                        <div class="row m-0 p-0"><p class="text-left pl-2">{{$privado->mensaje}}</p></div>
                                    @elseif ($privado->from == $user_id && $privado->to == $user->id)
                                        <div class="row m-0 p-0 justify-content-end"><p class="text-right pr-2">{{$privado->mensaje}}</p><i class="fas fa-check"></i></div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="form-group">
                                <form action="{{route('enviarPrivado')}}" method="post">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control mensajePrivado" name="mensajePrivado" id="mensajePrivado{{$user->id}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" id="sendPrivado" type="button">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="wispering{{$user->id}}">
                            </div>

                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

        </div>
    </div>
</body>
</html>

