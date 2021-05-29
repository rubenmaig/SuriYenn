<?php
include "../controllers/conexionController.php";

if (!$conexion) {
	die("Conexion fallida " . mysqli_connect_error($conn));
}

$sql = "SELECT * FROM leaderboard ORDER BY puntos DESC LIMIT 5";
$result = mysqli_query($conexion, $sql);
while ($rows = mysqli_fetch_array($result)) {
	echo $rows['nombre'] . "|" . $rows['puntos']. "|";
}

mysqli_close($conexion);

?>
