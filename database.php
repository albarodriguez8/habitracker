<?php

	// Credenciales base de datos
	$servername = "localhost";
	$username = "alan";
 	$password = "turing";
	$database = "ENIGMA";

	// Crear Conexion MySql
	$conn = mysqli_connect($servername, $username, $password, $database);

	// Comprobar conexion, si falla mostrar error
 	if (!$conn) {
	  die('<p>Fallou a conexion con la base de dato: </p>' . mysqli_connect_error());
	}
 	  echo '<p>Conexion Ok!</p>';
?>

