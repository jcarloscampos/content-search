<?php
	$host = "localhost";
	$user = "root";
	$pass = "root";
	$db = "search";

	$conexion = new mysqli($host, $user, $pass, $db) or die("error".mysql_error($conexion));
	$conexion->set_charset("utf8");
?>