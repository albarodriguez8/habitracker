<html>
<head>
	<title>Registro</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
	<?php
 	    include './database.php';

	    // Crear nuevo registro (resposta a GET)
	    if ( isset($_REQUEST['crear']) ) {
		  $insertar = "INSERT INTO Registro (id_habito, dia, valor) VALUES (" . $_REQUEST['crear'] . ",'" . $_REQUEST['data'] . "',1);";
		  $result = mysqli_query($conn, $insertar);
		}

	    $lectura = "SELECT * FROM habitos ORDER BY Nombre;";
	    $habitos = mysqli_query($conn, $lectura);
	    $leeregistro = "SELECT * FROM Registro INNER JOIN habitos ON Registro.id_habito = habitos.ID WHERE Registro.dia >= CURDATE() - INTERVAL 6 DAY ORDER BY habitos.Nombre, Registro.dia;";
	    $valores = mysqli_query($conn, $leeregistro);

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
		  <li class="nav-item">
		    <a class="nav-link" href="habitos.php">Hábitos</a>
		  </li>
		  <li class="nav-item active">
		    <a class="nav-link" href="#">Registro</a>
		  </li>
		</ul>
	  </div>
	</nav>
	<table class="table table-bordered table-striped">
		<tr>
		<td></td>
	  </thead>
		<?php
		    $hoy = mktime(0,0,0);
			$datas = [];
		    for ($t=6; $t>=0; $t--) {
		    	echo "<td align=\"center\">" . date('j/n/Y', $hoy-$t*24*60*60) . "</td>";
				$datas[] = date('Y-m-d', $hoy-$t*24*60*60);
		    }
		?>
	   </tr>
	   <?php
			$valor = mysqli_fetch_array($valores);
			while ($hab = mysqli_fetch_array($habitos)) {
				echo "<tr><td>" . $hab['Nombre'] . "</td>";
				if ($valor['ID'] != $hab['ID']) {
					foreach ($datas as $data) {
						echo "<td align=\"center\"><a href=\"registro.php?crear=" . $hab['ID'] . "&data=" . $data . "\"><button type=\"button\" class=\"btn btn-light\"><i class=\"far fa-circle\"></i></button></a></td>";
					}
				} else {
					foreach ($datas as $data) {
						if (($valor['dia'] == $data) and ($valor['ID'] == $hab['ID'])) {
							if ($valor['valor'] == 0) {
								echo "<td><i class=\"fas fa-times-circle\"></i></td>";
							} else {
								echo "<td align=\"center\"><i class=\"fas fa-check-circle\" style=\"color: green;\"></i></td>";
							}
							$valor = mysqli_fetch_array($valores);
						} else {
							echo "<td align=\"center\"><a href=\"registro.php?crear=" . $hab['ID'] . "&data=" . $data . "\"><button type=\"button\" class=\"btn btn-light\"><i class=\"far fa-circle\"></i></button></a></td>";
						}
					}
				}
				echo "</tr>";
			}
		?>
	</table>
</body>
</html>

