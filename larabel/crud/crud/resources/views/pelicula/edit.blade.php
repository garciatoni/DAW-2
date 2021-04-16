@extends('layouts.app')

@section('content')
<div class="container">


<form enctype="multipart/form-data" action="{{url('/pelicula/'.$pelicula->id)}}" method="post">
    @csrf

    {{ method_field('PATCH') }}
    <h1>FORMULARIO DE EDICION!</h1>
    @include('pelicula.formulario', ['modo'=>'Editar'])
    
</form>


@endsection
</div>

