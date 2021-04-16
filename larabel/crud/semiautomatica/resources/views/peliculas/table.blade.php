<div class="table-responsive">
    <table class="table" id="peliculas-table">
        <thead>
            <tr>
                <th>Nombre</th>
        <th>Director</th>
        <th>Genero</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($peliculas as $pelicula)
            <tr>
                <td>{{ $pelicula->Nombre }}</td>
            <td>{{ $pelicula->Director }}</td>
            <td>{{ $pelicula->Genero }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['peliculas.destroy', $pelicula->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('peliculas.show', [$pelicula->id]) }}" class='bg-success m-2'>
                            <p class="text-white">Mostrar</p>
                        </a>
                        <a href="{{ route('peliculas.edit', [$pelicula->id]) }}" class='bg-warning  m-2'>
                        <p class="text-white">Editar</p>
                        </a>
                        <a>
                        {!! Form::button('<p class="text-white">Borrrar</p>', ['type' => 'submit','class' => 'btn btn-danger m-2 btn-xs', 'onclick' => "return confirm('Estas segura/o?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
