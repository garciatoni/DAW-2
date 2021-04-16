
@extends('layouts.app')

@section('content')
<div class="container">

    <table id="table" class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Nombre</th>
                <th>Genero</th>
                <th>Duracion</th>
                <th>Estreno</th>
                <th>Nacionalidad</th>
                <th>Director</th>
            </tr>
        </thead>
        <tbody>
            <a href="{{ url('pelicula/create')}}">Añadir pelicula</a>

            @if(Session::has('mensaje'))
            {{ Session::get('mensaje')}}
            @endif


    @foreach ($peliculas as $pelicula)
                <tr>
                    <td>{{ $pelicula -> Nombre }}</td>
                    <td>{{ $pelicula -> Genero }}</td>
                    <td>{{ $pelicula -> Duracion }}</td>
                    <td>{{ $pelicula -> Estreno }}</td>
                    <td>{{ $pelicula -> Nacionalidad }}</td>
                    <td>{{ $pelicula -> Director }}</td>
                    <td>

                        <a href="{{url('/pelicula/'.$pelicula->id.'/edit')}}">
                            Editar                         
                        </a>
                        

                        <form action="{{url('/pelicula/'.$pelicula->id)}}" method="post">
                            @csrf
                            {{ method_field('DELETE')}}
                            <input name="_method"  type="hidden" value="delete">
                            <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon
                                glyphicon-trash">Eliminar</span></button>
                        </form>
                    
                    </td>
                </tr>
    @endforeach
    
    </tbody>
    </table>
@endsection
</div>
