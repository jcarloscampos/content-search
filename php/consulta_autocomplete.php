<?php
	require_once('../gestion/conexion.php');
	
	$request = mysqli_real_escape_string($conexion, $_POST["query"]);
	$query = "
 	SELECT * FROM autocomplete WHERE name LIKE '".$request."%' ORDER BY visited DESC LIMIT 5";

	$result = mysqli_query($conexion, $query);

	$data = array();
	if(mysqli_num_rows($result) > 0){
 		while($row = mysqli_fetch_assoc($result)){
  			$data[] = $row["name"];
 		}
 		echo json_encode($data);
	}
?>