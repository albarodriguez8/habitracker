<html>
<head>
	<title>Hábitos</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
	<h1>Hábitos</h1>
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

	<?php
	   $lectura = "SELECT * FROM habitos;";
	   $habitos = mysqli_query($conn, $lectura);
	   echo "Número de Hábitos: " . mysqli_num_rows($habitos) . "<br>";	   
	   while($hab = mysqli_fetch_array($habitos)){
	   	echo $hab['ID'] . " - " . $hab['Nombre'] . "<a href=\"habitos.php?borrar=" . $hab['ID'] . "\"><i class=\"fas fa-trash-alt\"></i><br></a>";
	   }
	?>
	<p>Si necesitas ayuda, lee <a href="https://google.es/" target=_blank>esto</a>
	<form name="habito" method="post" action="habitos.php">
	    <input type="text" id="name" name="nombre">
	    <button id="Guardar" type="submit">Guardar</button>
	</form>

</body>
</html>

