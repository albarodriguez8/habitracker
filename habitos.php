<html>
<head>
	<title>Hábitos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
	
	<?php
	include './database.php';

	  // Crear nuevo habito (resposta del POST)
	   if(isset($_POST["nombre"])){
		$insert = "INSERT INTO habitos (Nombre) VALUES ('" . $_POST["nombre"] . "');";
		$result = mysqli_query($conn, $insert);
		echo $result;		
		echo "<p>Hábito" . $_POST["nombre"] . " creado</p>";
	   }

	  // Borrar hábito (respuesta al GET con parametros)
	  if (isset($_REQUEST["borrar"])) {
		$delete = "DELETE FROM habitos WHERE ID=" . $_REQUEST["borrar"] . ";";
		$result = mysqli_query($conn, $delete);
		echo $result;
		echo "Hábito borrado";
	  }
	?>

		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="#">Habit Tracker</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
			  <li class="nav-item">
			    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			  </li>
			  <li class="nav-item active">
			    <a class="nav-link" href="#">Hábitos</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="registro.php">Registro</a>
			  </li>
			</ul>
		  </div>
		</nav>
			<td></td>
	  	</thead>
		<h3>Hábitos</h3>
	<?php
	   $lectura = "SELECT * FROM habitos;";
	   $habitos = mysqli_query($conn, $lectura);

	   if (mysqli_num_rows($habitos) > 0) {	
		echo "<ul class=\"list-group\">";
	   	while($hab = mysqli_fetch_array($habitos)){
	   		echo "<li class=\"list-group-item\">" . $hab['Nombre'] . " <a href=\"habitos.php?borrar=" . $hab['ID'] . "\"><i class=\"fas fa-trash-alt\" style =\"color: red;\"></i></a></li>";
	   	}
		echo "</ul>";
	   } else {
		echo "Aun no se creo ningun habito";
	}

	?>
	<p>Si necesitas ayuda, lee <a href="https://google.es/" target=_blank>esto</a>
	<form name="habito" method="post" action="habitos.php">
	    <input type="text" id="name" name="nombre">
	    <button type="submit" class="btn btn-info">Guardar</button>
	</form>

</body>
</html>

