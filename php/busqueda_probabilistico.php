<?php


/**
* clase para calcular una busqueda vectorial a partir de cantidad de filas, columnas y un arreglo con datos de frecuencia 
*/

class busqueda_probabilistico {

	private $fila;
	private $columna;
	private $arreglo = array();
	private $files_total ;
	private $salto;


   	public function busqueda_probabilistico($fila, $columna, $arreglo, $files_total) {
       	$this->fila = $fila;
       	$this->columna = $columna;
       	$this->arreglo = $arreglo;
       	$this->files_total = $files_total;
       	$this->salto = count($this->arreglo)/$this->fila;
       	$this->incertidumbre();
       	//print_r($this->arreglo);
   	}


   	public function prueba() {
       	return $this->arreglo;
   	}


   	public function incertidumbre(){
   		//echo (($this->columna*100)/$this->files_total)/100;
   		$contador = 0;
   		$s_i = 0;
   		for ($i=0; $i<count($this->arreglo); $i++) { 
   			if($this->arreglo[$i] != 0){
   				$s_i = $s_i+$this->arreglo[$i];
   				$contador++;   			}
   		}
   		$inc = ($s_i/$contador)/$this->columna;
   		return $inc;
   	}


   	public function suma_HFrecuencia(){
		for ($i=0; $i<count($this->arreglo); $i=$i+$this->salto) {
			$suma = 0;
			for ($j=0; $j<$this->columna; $j++) { 
				$suma = $suma+$this->arreglo[$i+$j];
			}
			$suma_horizontal[] = $suma;
		}
		//echo "<br> Suma suma_HFrecuencia : ";
       	//print_r($suma_horizontal);
		return $suma_horizontal;
   	}


	public function repeticiones_float(){
   		$inc = $this->incertidumbre();

   		$aux = 0;
   		$sh = $this->suma_HFrecuencia();

		for ($i=0; $i<count($this->arreglo); $i=$i+$this->salto) {
			for ($j=0; $j<$this->columna; $j++) {
				if($this->arreglo[$i+$j] != 0){
					$frec_float[] = log10($inc/(1-$inc))+log10((1-($sh[$aux]/$this->files_total))/($sh[$aux]/$this->files_total));
				}else
					$frec_float[] = 0;
			}
			$aux++;
		}
	
		//echo "<br> Frecuencias float debe ser 3 items: ";
       	//print_r($frec_float);
		return $frec_float;

   	}



   	public function suma_VFrecuencia(){
   		$rf = $this->repeticiones_float();
   		
   		for ($i=0; $i<$this->columna; $i++) {
			$suma = 0;
			for ($j=0; $j<count($this->arreglo); $j=$j+$this->salto) {
				$suma = $suma+$rf[$i+$j];
			}
			$suma_vertical[] = $suma;
		}
		//echo "<br> Salida de sumatoria floats: ";
       	//print_r($suma_vertical);
		return $suma_vertical;
   	}



} 
?>