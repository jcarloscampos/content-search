<?php

$host = "localhost";
$user = "root";
$pass = "root";
$db = "buscador";

$conexion = new mysqli($host, $user, $pass, $db) or die("error".mysql_error($conexion));
// function getConnexion(){
// 	$mysqli = new mysqli($host, $user, $pass, $db);
// 	if($mysqli ->connect_errno) exit('Error en la conexion: '.$mysqli->connect_errno);
// 	$mysqli->set_charset('UTF8');

// 	return $mysqli;
// }
?>