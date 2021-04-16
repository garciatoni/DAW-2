<div class="table-responsive">
    <table class="table" id="libros-table">
        <thead>
            <tr>
                <th>Nombre</th>
        <th>Editorial</th>
        <th>Genero</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($libros as $libro)
            <tr>
                <td>{{ $libro->nombre }}</td>
            <td>{{ $libro->editorial }}</td>
            <td>{{ $libro->genero }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['libros.destroy', $libro->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('libros.show', [$libro->id]) }}" class='bg-success m-2'>
                            <p class="text-white">Mostrar</p>
                        </a>
                        <a href="{{ route('libros.edit', [$libro->id]) }}" class='bg-warning m-2'>
                            <p class="text-white">Editar</p>
                        </a>
                        {!! Form::button('<p class="text-white">BORRAR</p>', ['type' => 'submit', 'class' => 'bg-danger m-2', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
