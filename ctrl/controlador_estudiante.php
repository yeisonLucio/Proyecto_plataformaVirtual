<?php
require_once '../modelo/estudiante.entidad.php';
require_once '../modelo/estudiante.model.php';

// Logica
$alm = new Estudiante();
$model = new EstudianteModel();
function cambiaf_a_normal($fecha){
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
    return $lafecha;
}
function cambiaf_a_mysql($fecha){
    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
    return $lafecha;
}

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idestudiante',              $_REQUEST['idestudiante']);
			$alm->__SET('nombre',                    $_REQUEST['nombre']);
			$alm->__SET('apellido',                  $_REQUEST['apellido']);
			$alm->__SET('correo',                    $_REQUEST['correo']);
			$alm->__SET('fechaNacimiento', cambiaf_a_mysql($_REQUEST['fechaNacimiento']));
			$alm->__SET('sexo',                      $_REQUEST['sexo']);
			$alm->__SET('estado',                    $_REQUEST['estado']);
			$alm->__SET('usuario_idusuario',         $_REQUEST['usuario_idusuario']);
			

			$model->ActualizarEstudiante($alm);
			//header('Location: controlador_estudiante.php');
			break;

		case 'registrar':
			$alm->__SET('idestudiante',              $_REQUEST['idestudiante']);
			$alm->__SET('nombre',                    $_REQUEST['nombre']);
			$alm->__SET('apellido',                  $_REQUEST['apellido']);
			$alm->__SET('correo',                    $_REQUEST['correo']);
			$alm->__SET('fechaNacimiento', cambiaf_a_mysql($_REQUEST['fechaNacimiento']));
			$alm->__SET('sexo',                      $_REQUEST['sexo']);
			$alm->__SET('estado',                    $_REQUEST['estado']);
			$alm->__SET('usuario_idusuario',         $_REQUEST['usuario_idusuario']);
			
			
			$model->RegistrarEstudiante($alm);
			//header('Location: controlador_estudiante.php');
			break;

		case 'eliminar':
			$model->EliminarEstudiante($_REQUEST['idestudiante']);
			//header('Location: controlador_estudiante.php');
			break;

		case 'editar':
                    $arra=array();       
                   
                    foreach ( $model->ObtenerEstudiante($_REQUEST['idestudiante']) as $r):
                         if($r->__GET('sexo')==="1"){ 
                        $sexo="<option value='1' selected>Masculino".
                            "<option value='2'>Femenino"; 
                         }else{ 
                             $sexo="<option value='1'>Masculino".
                            "<option value='2' selected>Femenino";
                         }
                         
                     if($r->__GET('estado')==="1"){ 
                            $estado="<option value='1' selected>Retirado".
                            "<option value='2'>Activo".
                             "<option value='3'>Egresado";
                     }else if($r->__GET('estado')==="2"){
                            $estado="<option value='1'>Retirado".
                            "<option value='2' selected>Activo".
                            "<option value='3'>Egresado";
                     }else{
                        $estado="<option value='1'>Retirado".
                            "<option value='2'>Activo".
                            "<option value='3' selected>Egresado";
                     }
                    
                    $arra=array("idestudiante"=>$r->__GET('idestudiante'),
                                "nombre"=>$r->__GET('nombre'),
                                "apellido"=>$r->__GET('apellido'),
                                "correo"=>$r->__GET('correo'),
                                "fechaNacimiento"=> cambiaf_a_normal($r->__GET('fechaNacimiento')),
                                "sexo"=>$sexo,
                                "estado"=>$estado,
                                "idusuario"=>$r->__GET('usuario_idusuario')
                                );
                    
                    
                    endforeach;
                        
                       echo json_encode($arra); 
			break;
                        
                case 'listar':
                    $i=1;
                    $stm="<table class='table table-responsive table-hover'><thead><tr class='active'><th>#</th><th >Nombre</th><th>Apellido</th><th>Correo</th><th>Fecha de nacimiento</th><th>Sexo</th><th>Estado</th><th>id usuario</th><th>Opciones</th></tr></thead><tbody>";
            foreach( $model->ListarEstudiante() as $r):
                $fecha=cambiaf_a_normal($r->__GET('fechaNacimiento'));
            $sexo="";
                if($r->__GET('sexo')=="1"){
                    $sexo="Masculino";
                    
                }else{
                    $sexo="Femenino";
                }
                $estado="";
                if($r->__GET('estado')=="2"){
                    $estado="Activo";
                    
                }else if($r->__GET('estado')=="1"){
                    $estado="Retirado";
                    
                }else{
                    $estado="Egresado";
                }
                
            
                        
                        
                        $stm.="<tr><td>".$i."</td><td>".$r->__GET('nombre')."</td><td>".$r->__GET('apellido')."</td><td>".$r->__GET('correo')."</td>
                            <td>".$fecha."</td><td>".$sexo."</td><td>".$estado."</td><td>".$r->__GET('usuario_idusuario')."</td><td>
                
                    <button type='button' class='btn btn-primary' id='btn_editar_estudiante'  href='#ventana_estudiante' onclick=javascript:modificar_estudiante(".$r->__GET('idestudiante').")  data-toggle='modal' >
                        <span class='sr-only'>Editar </span> <span class='glyphicon glyphicon-pencil'></span></button>
                    <a type='button' class='btn btn-danger' id='btn_eliminar_estudiante' href='javascript:eliminar_estudiante(".$r->__GET('idestudiante').")'>
                        <span class='sr-only'>Eliminar </span><span class='glyphicon glyphicon-remove'></span></a>
        	
                </td></tr>";
                    $i++;

                    endforeach;
                    $stm.="</tbody></table>";
            
 
            echo utf8_decode($stm);
                            
               
        break;
	}
}

