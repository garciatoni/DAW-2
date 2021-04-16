<!-- Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $libro->nombre }}</p>
</div>

<!-- Editorial Field -->
<div class="col-sm-12">
    {!! Form::label('editorial', 'Editorial:') !!}
    <p>{{ $libro->editorial }}</p>
</div>

<!-- Genero Field -->
<div class="col-sm-12">
    {!! Form::label('genero', 'Genero:') !!}
    <p>{{ $libro->genero }}</p>
</div>

