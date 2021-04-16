

@if (count($errors)>0)
<div class="alert alert-danger" role="alert">
<ul>
    @foreach( $errors->all() as $error)
       <li>{{ $error }} </li> 
    @endforeach
</ul>
</div>
@endif



<input type="text" placeholder="Nombre" value="{{ isset($pelicula -> Nombre)?$pelicula -> Nombre:'' }}" name="Nombre"><br>
<input type="text" placeholder="Genero" value="{{ isset($pelicula -> Genero)?$pelicula -> Genero:'' }}" name="Genero"><br>
<input type="text" placeholder="Duracion" value="{{ isset($pelicula -> Duracion)?$pelicula -> Duracion:'' }}" name="Duracion"><br>
<input type="text" placeholder="Estreno" value="{{ isset($pelicula -> Estreno)?$pelicula -> Estreno:'' }}" name="Estreno"><br>
<input type="text" placeholder="Nacionalidad" value="{{ isset($pelicula -> Nacionalidad)?$pelicula -> Nacionalidad:'' }}" name="Nacionalidad"><br>
<input type="text" placeholder="Director" value="{{ isset($pelicula -> Director)?$pelicula -> Director:'' }}" name="Director"><br>

{{-- <input type="file" name="Imagen" value="{{ isset($pelicula -> Imagen)?$pelicula -> Imagen:'' }}" ><br> --}}
<input type="submit" value="{{ $modo }} pelicula">

<a href="{{ url('pelicula')}}">Atras...</a>