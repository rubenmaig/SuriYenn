<?php

$host = "eu-cdbr-west-03.cleardb.net";
$user = "b9404d1e6bfd9c";
$pass = "374f608f";
$db = "heroku_1301608c67913db";
//PREPARAR CONEXION
$cn = mysqli_connect($host, $user, $pass, $db);
//COMPROBAR CONEXION
if (isset($cn)) {
	//COMPROBAR QUE NO ESTEN VACIOS LOS CAMPOS
	if (!empty($_GET['nombre']) && !empty($_GET['puntos'])) {
		//COMPROBAR QUE EL PUNTAJE ES MENOR AL ACTUAL PUNTAJE
		$sql = "SELECT * FROM leaderboard WHERE nombre = '".$_GET['nombre']."' AND puntos < '".$_GET['puntos']."'";
		$result = mysqli_query($cn, $sql);
			//COMPROBAR SI EXISTEN PUNTAJE MENOR AL ACTUAL PUNTAJE
    		if (mysqli_num_rows($result) > 0) {
    			//ACTUALIZAR LOS PUNTAJES EXISTENTES
    			$sql = "UPDATE `leaderboard` SET `puntos`= '".$_GET['puntos']."' WHERE nombre = '".$_GET['nombre']."'";
    			$result = mysqli_query($cn, $sql);
    			if ($result) {
    				echo "Puntuación actualizada correctamente.";
    			} else {
    				echo "Ocurrió un error al actualizar la puntuación.";
    			}
			} else {
				//COMPROBAR SI EL PUNTAJE ES MAYOR O IGUAL AL ACTUAL PUNTAJE
				$sql = "SELECT * FROM leaderboard WHERE nombre = '".$_GET['nombre']."' AND puntos >= '".$_GET['puntos']."'";
				$result = mysqli_query($cn, $sql);
				//COMPROBAR SI NO EXISTE PUNTAJE MAYOR O IGUALES AL PUNTAJE ACTUAL
    			if (!mysqli_num_rows($result) > 0) {
				//INSERTAR EL PUNTAJE YA QUE NO EXISTE ALGUNO MAYOR
				$sql = "INSERT INTO `leaderboard` (`nombre`,`puntos`) VALUES ('".$_GET['nombre']."','".$_GET['puntos']."')";
				$result = mysqli_query($cn, $sql);
					if (isset($result)) {
						echo "Puntuación creada correctamente.";
					} else {
						echo "Ocurrió un error al guardar la puntuación.";
					}
				} else {
					echo "Existe una puntuación mayot, debes superarla para que se guarde tu puntuación.";
				}
			}
    } else {
		echo "Asegúrate de colocar correctamente ?nombre=NOMBRE&puntos=123 en el link.";
    }	
}

?>