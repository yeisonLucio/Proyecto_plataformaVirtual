<?php

require_once 'global.php';     //carga archivo de variables globales
require_once 'depurador.php';   // carga archivo de control de depuracion
// Setea una clase cuyo objetivo es ser la interface al modleo de datos, en este caso una base de datos
// mysql
require_once("../modelo/conexion.controller.php");
$sql = $_POST['sql'];

function retornarObjeto($sql) 
{
    depurar_sentencia("retornarObjeto","<br>SQL : ",$sql); 
    $conc = new conexion_mysql();
    $conc->conectar();
	//Se agrega esto para asegurar el cotejamiento a UTF8
	$acentos = $conc->query("SET NAMES 'utf8'");
    $arreglo = $conc->consulta_objetos($sql);
    $tempo="<br>gettype de arreglo: ".gettype($arreglo);
    depurar_sentencia("retornarObjeto",$tempo,'');
	
    if (count($arreglo) > 0) {
	///////////////////////////////////////////////////////////////////////////////////////////////////
	// Observa que se retorna codificado JSON, porque ese el tipo que maneja el script interface.js  //
	// en los llamados aqui en php, en necesario usar json_decode($arreglo)                          //
	///////////////////////////////////////////////////////////////////////////////////////////////////
	    $tempo="entr&eacute; por el TRUE, retorno el arreglo en JSON con ".count($arreglo)." filas";
	    depurar_sentencia("retornarObjeto",$tempo,"");
	    //return json_encode($arreglo);
		return json_encode($arreglo);
    } else {
	    depurar_sentencia("retornarObjeto","entr&eacute; por el FALSE, retorno false","");
        //return false;
		echo false;
    }
}

echo json_encode(retornarObjeto($sql));
	
	
?>