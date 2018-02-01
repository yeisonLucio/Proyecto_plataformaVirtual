<?php
require_once '../modelo/docente.entidad.php';
require_once '../modelo/docente.model.php';

// Logica
$alm = new Docente();
$model = new DocenteModel();

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
			$alm->__SET('iddocente',                 $_REQUEST['iddocente']);
			$alm->__SET('nombre',                    $_REQUEST['nombre']);
                        $alm->__SET('apellido',                  $_REQUEST['apellido']);
			$alm->__SET('correo',                    $_REQUEST['correo']);
			$alm->__SET('fechaNacimiento', cambiaf_a_mysql($_REQUEST['fechaNacimiento']));
			$alm->__SET('sexo',                      $_REQUEST['sexo']);
			$alm->__SET('licenciatura',              $_REQUEST['licenciatura']);
			$alm->__SET('usuario_idusuario',         $_REQUEST['usuario_idusuario']);
			

			$model->ActualizarDocente($alm);
			//header('Location: controlador_docente.php');
			break;

		case 'registrar':
                        
			$alm->__SET('iddocente',                 $_REQUEST['iddocente']);
			$alm->__SET('nombre',                    $_REQUEST['nombre']);
                        $alm->__SET('apellido',                  $_REQUEST['apellido']);
			$alm->__SET('correo',                    $_REQUEST['correo']);
			$alm->__SET('fechaNacimiento', cambiaf_a_mysql($_REQUEST['fechaNacimiento']));
			$alm->__SET('sexo',                      $_REQUEST['sexo']);
			$alm->__SET('licenciatura',              $_REQUEST['licenciatura']);
			$alm->__SET('usuario_idusuario',         $_REQUEST['usuario_idusuario']);
			
			$model->RegistrarDocente($alm);
			//header('Location: controlador_docente.php');
			break;

		case 'eliminar':
			$model->EliminarDocente($_REQUEST['iddocente']);
			//header('Location: controlador_docente.php');
			break;
                    
                   
                    
		case 'editar':
                   
                    $arra=array();       
                   
                    foreach ( $model->ObtenerDocente($_REQUEST['iddocente']) as $r):
                         if($r->__GET('sexo')==="1"){ 
                        $sexo="<option disabled>Sexo<option value='1' data-icon='../imagenes/male.png' class='left circle' selected>Hombre".
                            "<option value='2' data-icon='../imagenes/female.png' class='left circle'>Mujer"; 
                         }else{ 
                             $sexo="<option disabled>sexo<option value='1' data-icon='../imagenes/male.png' class='left circle' >Hombre".
                            "<option value='2' data-icon='../imagenes/female.png' class='left circle' selected>Mujer";
                         }
                    
                    $arra=array("iddocente"=>$r->__GET('iddocente'),
                                "nombre"=>$r->__GET('nombre'),
                                "apellido"=>$r->__GET('apellido'),
                                "correo"=>$r->__GET('correo'),
                                "fechaNacimiento"=> cambiaf_a_normal($r->__GET('fechaNacimiento')),
                                "sexo"=>$sexo,
                                "licenciatura"=>$r->__GET('licenciatura'),
                                "idusuario"=>$r->__GET('usuario_idusuario')
                                );
                    
                    
                    endforeach;
                        
                       echo json_encode($arra);       

                break;
                
                
                    
        case 'listar':
            $i=1;
            $stm="<table class='centered striped'><thead><tr><th>#</th><th >Nombre</th><th>Apellido</th><th>Correo</th><th>Fecha de nacimiento</th><th>Sexo</th><th>licenciatura</th><th>id usuario</th><th>Opciones</th></tr></thead><tbody>";
           
            foreach( $model->ListarDocente() as $r):
                
                $fecha=cambiaf_a_normal($r->__GET('fechaNacimiento'));
                
                
            $sexo="";
                if($r->__GET('sexo')=="1"){
                    $sexo="Masculino";
                    
                }else{
                    $sexo="Femenino";
                }
               
                        $stm.="<tr><td>".$i."</td><td>".$r->__GET('nombre')."</td><td>".$r->__GET('apellido')."</td><td>".$r->__GET('correo')."</td>
                            <td>".$fecha."</td><td>".$sexo."</td><td>".$r->__GET('licenciatura')."</td><td>".$r->__GET('usuario_idusuario')."</td><td>
                
                    <a type='button' class='waves-effect waves-light btn-floating  blue accent-4 modal-trigger ' id='btn_editar_docente'  href='#ventana_docente' onclick=javascript:modificar_docente(".$r->__GET('iddocente').")  ><i class='material-icons center'>mode_edit</i></a>

                    <a type='button' class='waves-effect waves-light btn-floating  red accent-4' id='btn_eliminar_docente' href='javascript:eliminar_docente(".$r->__GET('iddocente').")'><i class='material-icons center'>delete</i></a>
        	
                </td></tr>";
                    $i++;

                    endforeach;
                    $stm.="</tbody></table>";
                  
                    
            echo utf8_decode($stm);
                            
               
        break;
	}
}



