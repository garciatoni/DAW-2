
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>Formulario</title>
	</head>



	<body>

		<!--Menú de Login-->
		<form enctype="multipart/form-data" action="{{route('tuPerfil')}}" method="POST" id="form" name="formulario">
			@csrf

			<div>
				<label>Nombre</label> 
				<input type="text" name="nombre"/>
			</div>
			<div>
				<label>Mail</label> 
				<input type="email" name="correo"/>
			</div>
			<div>
				<button id="mysubmit" type="submit">Submit</button>
			</div>

		</form>
	</body>
</html>