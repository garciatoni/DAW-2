
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Formulario</title>
</head>



<body>
    <form enctype="multipart/form-data" action="{{route('resultado')}}" method="POST" id="form" name="formulario">
        @csrf

        <div>
            <label>Nombre</label> 
            <input type="text" name="nombre"/>

            <label>Correo</label> 
            <input type="email" name="correo"/>

            <label>NIF</label> 
            <input type="text" name="nif"/><br>

			<label>Fichero</label>
			<input type="file" name="fichero"/><br>

			<label>Imagen</label>
			<input type="file" name="image"/>
        </div>

        <div>
            <button id="mysubmit" type="submit">Submit</button>
        </div>
    </form>

    @if ($errors->any())
    <div>
        <ul>

                <li>{{$errors}}</li>

        </ul>
    </div>
        
    @endif
</body>
</html>