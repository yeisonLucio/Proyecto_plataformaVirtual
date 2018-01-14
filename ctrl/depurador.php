<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function depurar_sentencia($funcion_origen,$texto,$valor)
{
  // La constante DEPURADOR está definida en logica.php, si se quiere que depure el valor se pone a 1
  // en caso contrario a 0
  if ( DEPURADOR==1 )
  {
	//Esta es la carpeta logs pero del usuario lologre.info
	//$archivo ="../logs/log_".$funcion_origen.".html";
	  $archivo ="../logs/log_".$funcion_origen.".html";
	  //if (file_exists($archivo)) unlink($archivo);
	  $puntero = @fopen($archivo, 'a+');
	  if(!$puntero)
      {	  
	     echo 'No se puede abrir el fichero.';
	  }
	  else
	  {
	    $cadtemp=$texto." ".$valor;
	    fwrite($puntero, $cadtemp, strlen($cadtemp));
		//Con esta sencilla linea tambien hago depuracion de lo que esta pasando en php, pero en la consola del navegador.
		// Ing. Martin Nieto, enero 18 de 2015.
        //echo "<script>console.log( '".$cadtemp."' );</script>";
		fclose($puntero);
	  }
  }
}
?>
