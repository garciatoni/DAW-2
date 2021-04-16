<!-- Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('Nombre', 'Nombre:') !!}
    <p>{{ $pelicula->Nombre }}</p>
</div>

<!-- Director Field -->
<div class="col-sm-12">
    {!! Form::label('Director', 'Director:') !!}
    <p>{{ $pelicula->Director }}</p>
</div>

<!-- Genero Field -->
<div class="col-sm-12">
    {!! Form::label('Genero', 'Genero:') !!}
    <p>{{ $pelicula->Genero }}</p>
</div>

