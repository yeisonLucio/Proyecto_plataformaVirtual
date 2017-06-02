<?php

require_once '../modelo/curso.entidad.php';
require_once '../modelo/curso.model.php';

// Logica
$alm = new Curso();
$model = new CursoModel();



if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idcurso',              $_REQUEST['idcurso']);
			$alm->__SET('docente_iddocente',    $_REQUEST['docente_iddocente']);
			$alm->__SET('nombre',        		$_REQUEST['nombre']);
			$alm->__SET('descripcion',           $_REQUEST['descripcion']);
			

			$model->ActualizarCurso($alm);
			//header('Location: controlador_curso.php');
			break;

		case 'registrar':
			$alm->__SET('idcurso',              $_REQUEST['idcurso']);
			$alm->__SET('docente_iddocente',    $_REQUEST['docente_iddocente']);
			$alm->__SET('nombre',        		$_REQUEST['nombre']);
			$alm->__SET('descripcion',           $_REQUEST['descripcion']);
                        
			$model->RegistrarCurso($alm);
			
                        
			break;

		case 'eliminar':
                        
			$model->EliminarCurso($_REQUEST['idcurso']);
			//header('Location: controlador_curso.php');
			break;

		case 'editar':
                   
                    $arra=array();                
                    foreach ( $model->ObtenerCurso($_REQUEST['idcurso']) as $r):
                        
                        $docente=$r->__GET('docente_iddocente');
                        $combo=$model->cargar_valor($docente,0);
                      
                                    
                    //Ojo el utf8_decode para asegurarse de que los datos se codifique ne UTF8
                    $arra=array("idcurso"=>$r->__GET('idcurso'),"nombre"=>$r->__GET('nombre'),"descripcion"=>$r->__GET('descripcion'),"iddocente"=>$combo );
                    /*
                    $cliente=array('Id'=>       utf8_encode($r->__GET('Id')), 
                                    'Nombre'=>  utf8_encode($r->__GET('Nombre')),
                                    'Apellido'=>utf8_encode($r->__GET('Apellido')),
                                    'Sexo'=>$sex,
                                    'FechaNacimiento'=>  utf8_encode($r->__GET('FechaNacimiento'))
                                    );
                     * */
                    
                    endforeach;
                        
                       echo json_encode($arra);       

                break;
                
                
                    
        case 'listar':
        $stm='';
            $i=0;
           
            foreach( $model->ListarCurso() as $r):
               $iddocente=$r->__GET('docente_iddocente');
                $docente=$model->cargar_valor($iddocente, 1);
                $i++;
                $aux="estudiante_curso";
                $i2=$r->__GET('idcurso');
            $stm=$stm."<li id='item'>
                <div class='pull-right'>
                
                    <button type='button' class='btn btn-primary' id='btn_editar_curso'  href='#ventana_curso' onclick=javascript:modificar_curso(".$r->__GET('idcurso').")  data-toggle='modal' >
                        <span class='sr-only'>Editar </span> <span class='glyphicon glyphicon-pencil'></span></button>
                    <a type='button' class='btn btn-danger' id='btn_eliminar_curso' href='javascript:eliminar_curso(".$r->__GET('idcurso').")'>
                        <span class='sr-only'>Eliminar </span><span class='glyphicon glyphicon-remove'></span></a>
        	
                </div>
                   <div id='texto'> <a href='#demo_".$i."'  ><h3> Curso: ".$r->__GET('nombre')."</h3></a><p>Descripcion: ".
                           $r->__GET('descripcion')."</p><p class='hidden'>".
                           $r->__GET('docente_iddocente')."</p>".$docente."<div id='demo_".$i."' >"
                    . "<div> <a id='btn_agregar_estudiante_curso2'href='#ventana_agregar_estudiante' onclick=javascript:llenar_combo_tablas('estudiante_curso',3);javascript:cargar_curso_input(".$r->__GET('idcurso').");  class='btn btn-success ' data-toggle='modal' ><span class='glyphicon glyphicon-plus'></span> Agregar estudiante</a>"
                    . "</div><a href='#' data-toggle='collapse' data-target='#lista_estudiantes".$i2."' id='mostrar_estudiantes' onclick=javascript:listar_estudiantes(".$r->__GET('idcurso').")>estudiantes registrados</a></div><div class='collapse' id='lista_estudiantes".$i2."' > Lorem ipsum dolor text....</div></li>"
                    . "</div>";
                    
                        
            
            endforeach;
            echo utf8_decode($stm);
                            
               
        break;
        
       case 'cargar_listbox':
				$tabla = $_POST['tabla'];
                                $op=$_POST['op'];
                               
                            
				switch($tabla)
				{
					
                                        case 'curso':
                                           
                                            if($op==1){
                                                $arreglo=$model->obtenercombo();

                                                    if (count($arreglo) > 0) {
                                                    $strCadena = " <option>--Seleccionar docente--</option>";
                                                        foreach ($arreglo as $item){

                                                        $strCadena .= "<option value='".$item->iddocente."'>".$item->nombre." ".$item->apellido."</option>";
                                                        }
                                                        }
                                                    else {
                                                    $strCadena = false;
                                                    }
                                                       echo utf8_encode($strCadena); 
                                            
                                            }
                                            break;
                                       
                                        
				}
				
				break;
	}
}



?>
