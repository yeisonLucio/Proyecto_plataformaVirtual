<?php
// Esto se hace para capturar un llamado via Ajax, el cual es el que se està utilizando para la cargar de fotos al servidor
// la variable pedido se utiliza en subirFotos()
/*
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest' )
{ 
  $pedido=$_SERVER['HTTP_X_REQUESTED_WITH'];
  //depurar_sentencia("logica","<br>xmlhttprequest : ",$pedido); 
}
if (isset($_POST["usuario_login"]) && $_POST["accion"]=='logearse')
{
	setcookie("nombre_usuario",$_POST["usuario_login"], time()+3600 );
}

else
{
	depurar_sentencia("cookies","<br>valor de la cookie : ",$_COOKIE["txtIdentificacion"]); 
}
*/		
//session_start();  // OJO:  Requerido por la funcion de validar captcha

define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);
define ("DEPURADOR",1); // 1 si queremos depuracion, 0 si no queremos depuracion

define("ENHOSTING",0);  //1 si esta es la version de produccion, 0 si es la version de desarrollo, para conexion de base de datos
define("BASEDEDATOS","mydb");  //La base de datos de trabajo, que para el caso del inventario turistico es cmtc_invtur

require("menu.php");

date_default_timezone_set('America/Bogota');


function utf8_decode_seguro($texto)
{
 return (codificacion($texto)==ISO_8859_1) ? $texto : utf8_decode($texto);
}

function espanol($texto) //REPARAR CUALQUIER TEXTO A UTF-8
{
    $texto = htmlentities($texto , ENT_QUOTES); //No permite codigo HTML
    $texto = str_replace("\r","<br />",$texto); //Asignar codigo espacios
    $texto = utf8_encode($texto); //ENCODE A UTF-8
    $texto = iconv("ISO-8859-1" , "UTF-8", $texto); // Convierte ISO-8859-1 UTF-8
    return $texto;
}
 
/*************************************************************************************************************************************
 * Esta funcion permite crear cualquier combo (lista  desplegable independientemente de que tabla y campos sean *
 *************************************************************************************************************************************/ 
function crearComboGenerico($sql) {
    $conc = new conexion_mysql();
    $conc->conectar(BASEDEDATOS);
	//Se agrega esto para asegurar el cotejamiento a UTF8
	$acentos = $conc->query("SET NAMES 'utf8'");
    $arreglo = $conc->consulta_objetos($sql);
	
    if (count($arreglo) > 0) {
        $strCadena = " ";
        foreach ($arreglo as $item)
		{
		    $strCadena .= "<option value='".$item->iddocente."'>".$item->nombre." ".$item->apellido;
        }
    }
	else {
	   $strCadena = false;
	}
    echo $strCadena;	   
}

?>
