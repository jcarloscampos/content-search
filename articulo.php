<?php
	$file = '';
	$path = "./resources/";

	if(isset($_GET['file'])){
		$file = ($_GET['file']);
	}
	$titulo = explode(".txt", $file);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Buscador en tiempo real</title
	>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
</head>
<body>
	<div class="wrap">
		<div class="container">
			<div class="form center">
				<a href="javascript:history.back(1);">Volver atras</a>
			</div>
			<div id="resultados">
				<h1><?php echo strtoupper( $titulo[0]) ?></h1>
				<p><?php echo file_get_contents($path.$file) ?></p>
			</div>
			<div class="footer center">
				<p>Todos los derechos reservados</p>
			</div>
		</div>
	</div>
</body>
</html>