@extends('layouts.app')

@section('content')
<div class="container">



<form enctype="multipart/form-data" action="{{ url('/pelicula') }}" method="post">
    @csrf
<h1>FORMULARIO DE CREACION!</h1>
@include('pelicula.formulario', ['modo'=>'Añadir'])

</form>

{{-- @extends('layouts.app') --}}

@endsection


</div>