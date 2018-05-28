<?php
	require_once('../gestion/conexion.php');
	require_once('busqueda_vectorial.php');
	require_once('busqueda_probabilistico.php');

	$files_array = array();
	$files_total_array = array();
	$repeticiones_array = array(); //cantidad de repeticiones de una palabra en un archivos


	sleep(.2);
	$search = '';


	if(isset($_POST['search'])){
		$search = strtolower($_POST['search']);
		main(query_define($search));
	}

    function main($query){
    	$tipo_busquda = "vectorial";
		global $files_array;
		global $repeticiones_array;
		global $files_total_array;
    	$path = "../resources/";



    	list_files_true(list_files_total($path), $query, $path);
    	list_repeticiones($files_array, $query, $path);
    	if($tipo_busquda == "vectorial"){
    		$b_vectorial = new busqueda_vectorial(count($query), count($files_array), $repeticiones_array);
			$resultado = array_combine($files_array, $b_vectorial->suma_VFrecuencia());
		}elseif($tipo_busquda == "probabilistico"){
			$b_probabilistico = new busqueda_probabilistico(count($query), count($files_array), $repeticiones_array, count($files_total_array));
			$resultado = array_combine($files_array, $b_probabilistico->suma_VFrecuencia());
			//echo "<br> FILES ARRAY: ";
			// print_r($files_array);
			// echo "<br> RESULTADO DE PROBABILISTICO: ";
			// print_r($b_probabilistico->suma_VFrecuencia());
			//echo "busquda probabilistico";
			//print_r($files_total_array);
		}else
			echo "Defina tipo de busqueda";

		arsort($resultado);
		//asort($resultado);
		mostrar($resultado, $path);

    }


    //fragmenta la consulta en terminos
	function query_define($search){
	    $query_full = explode("\n", $search);
	    foreach ($query_full as $palabra) {
	        $arg = explode(' ',$palabra); 
	    }
	    
	    //limitar que no entren cadenas vacias
	    for($i=0; $i<count($arg); $i++){
	        if($arg[$i] != ""){
	            $query_array[] = $arg[$i];
	        }
	    }
	    return $query_array;
    }



    //lista los archivos que se encuentran en un directorio
    function list_files_total($pt){
    	global $files_total_array;
	    $dir = dir($pt);
	    while (false !==($entry = $dir->read())){
	        if ($entry !=='.' && $entry !=='..'){
	            $file_contents[] = $entry;  
	        }
	    }
	    $dir->close();
	    $files_total_array = $file_contents;
	    //print_r($files_total_array);
	    //echo "<br>";
	    return $files_total_array;
	}

	function list_files_true($ft_array, $query_array, $path){
		global $files_array;
		$files_true = array();
		for ($i=0; $i<count($query_array) ; $i++) { 
			for ($j=0; $j <count($ft_array) ; $j++) {
				if(comparar($query_array[$i], $path.$ft_array[$j]))
					$files_true[] = $ft_array[$j];
			}
		}

		$aux = array_unique($files_true);
		foreach ($aux as $value) {
			$files_array[] = $value;
		}
		//echo "<br> files: ";
		//print_r($files_array);
	}

	function list_repeticiones($f_array, $query_array, $path){
		global $files_array;
		global $repeticiones_array;

		for ($i=0; $i<count($query_array) ; $i++) { 
			for ($j=0; $j <count($f_array) ; $j++) { 
				if(comparar($query_array[$i], $path.$f_array[$j])){
					$repeticiones_array[] = substr_count(file_get_contents($path.$f_array[$j]), $query_array[$i]);
				}else
					$repeticiones_array[] = 0;
			}
		}
	}



    function comparar($cadena, $file_path){
        $file_contents = file_get_contents($file_path);
        $formato = strtolower($file_contents);
        $coincidencia = strrpos($formato, $cadena);

        if ($coincidencia === false)
            return false;
        else
            return true;
    }


	function mostrar($arg, $path){
		echo "<h2>Resultados de la busqueda</h2>";
		foreach($arg as $clave=>$frec) {
			$titulo = explode(".txt", $clave);
			?>
				<div class="articulo">
					<a href="../articulo.php?file=<?php echo $clave ?>">
					<samp class="titulo"><?php echo $titulo[0] ?></samp>
					</a>
					<p class="url"><?php echo $path.$clave ?></p>
					<span class="contenido"><?php echo substr(file_get_contents($path.$clave), 0, 300) ?></span>
				</div>
			<?php
		}
	}

?>