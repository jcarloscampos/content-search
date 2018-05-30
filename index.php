<?php require_once('gestion/conexion.php') ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Buscador en tiempo real</title
	>
	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/ajax.js"></script>
	<script type="text/javascript" src="./js/bootstrap3-typeahead.min.js"></script>
	<link rel="stylesheet" href="./css/bootstrap.css">
	
	<link rel="stylesheet" href="./css/style.css">
</head>
<body>
	<div class="wrap">
		<div class="encabezado">
			<div class="container">
				<ul class="list-encabezado">
					<li><a class="active" href="">Web</a></li>
					<li><a href="">Imagenes</a></li>
					<li><a href="">Noticias</a></li>
					<li><a href="">Videos</a></li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="header-content">
				<div class="contenido" id="logo">
					<img src="images/browser.svg" width="200px" alt="Solquick" title="Solquick" />
					<div class="desc">
						<h1>Sol<span>quick</span></h1>
                		<p>El motor de busqueda hecho por humanos</p>
					</div>
				</div>
			</div>


			<form action="" method="POST" name="search-form" id="search-form">
				<div class="input-group mb-3">
				  	<input type="text" name="search" id="search" class="form-control" autocomplete="off" placeholder="Que deseas buscar?" aria-label="" aria-describedby="basic-addon1">
				  	<div class="input-group-prepend">
				    	<button class="btn btn-outline-secondary btn-buscar" type="submit">Buscar</button>
				 	 </div>
				</div>
			</form>
					
			<div id="resultados">
				
			</div>
		</div>
	</div>
</body>
<footer>
	<p class="center">Materia: Recuperacion de Informacion</p>
</footer>
</html>





<script>
$(document).ready(function(){
 
 $('#search').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"php/consulta_autocomplete.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
 
});
</script>
<!-- consulta_autocomplete.php -->