<?php


/**
* clase para calcular una busqueda vectorial a partir de cantidad de filas, columnas y un arreglo con datos de frecuencia 
*/

class busqueda_vectorial {

   private $fila;
   private $columna;
   private $arreglo = array();
   private $salto;


   public function busqueda_vectorial($fila, $columna, $arreglo) {
       $this->fila = $fila;
       $this->columna = $columna;
       $this->arreglo = $arreglo;
       $this->salto = count($this->arreglo)/$this->fila;
   }


   public function prueba() {
       return $this->arreglo;
   }


   	public function suma_HFrecuencia(){
		for ($i=0; $i<count($this->arreglo); $i=$i+$this->salto) {
			$suma = 0;
			for ($j=0; $j<$this->columna; $j++) { 
				$suma = $suma+$this->arreglo[$i+$j];
			}
			$suma_horizontal[] = $suma;
		}
		return $suma_horizontal;
   	}



   	public function repeticiones_float(){
   		$aux = 0;
   		$sh = $this->suma_HFrecuencia();
		for ($i=0; $i<count($this->arreglo); $i=$i+$this->salto) {
			for ($j=0; $j<$this->columna; $j++) {
				if($this->arreglo[$i+$j] != 0){
					$frec_float[] = $sh[$aux]*(log10($this->columna/$this->arreglo[$i+$j]));
				}else
					$frec_float[] = 0;
			}
			$aux++;
		}
		return $frec_float;
   	}



   	public function suma_VFrecuencia(){
   		$rf = $this->repeticiones_float();
   		for ($i=0; $i<$this->columna; $i++) {
			$suma = 0;
			for ($j=0; $j<count($this->arreglo); $j=$j+$this->salto) {
				//$suma = $suma+abs($rf[$i+$j]);
				$suma = $suma+$rf[$i+$j];
			}
			$suma_vertical[] = $suma;
		}
		echo "<br>BUSQUEDA POR METODO VECTORIAL<br>";
		return $suma_vertical;
   	}





} 
?>