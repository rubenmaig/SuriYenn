<?php
//Parámetros de conexión
$usuario = "b9404d1e6bfd9c";
$contrasena = "374f608f";
$servidor = "eu-cdbr-west-03.cleardb.net";
$basededatos = "heroku_1301608c67913db";

//Realizar conexión
$conexion = mysqli_connect( $servidor, $usuario, "374f608f" );
mysqli_set_charset($conexion, "utf8");
//Comprobar si hay  errores
$conexion = mysqli_connect( $servidor, $usuario, "374f608f" ) or die ("No se ha podido conectar al servidor de Base de datos");
//Conectar a la base de datos
$db = mysqli_select_db( $conexion, $basededatos );
//Comprobar si hay errores
$db = mysqli_select_db( $conexion, $basededatos ) or die ( "No se ha podido conectar a la base de datos seleccionada");
?>
