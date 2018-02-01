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
            $alm->__SET('docente_iddocente',    $_REQUEST['combo_curso']);
            $alm->__SET('nombre',               $_REQUEST['nombre_curso']);
            $alm->__SET('descripcion',          $_REQUEST['descripcion']);
            $imagen=$_FILES['imagen'];

            if($imagen["type"]=="image/jpg" OR $imagen["type"]=="image/jpeg" OR $imagen["type"]=="image/png"){
                $ext_imagen="";
                if($imagen["type"]=="image/jpg" OR $imagen["type"]=="image/jpeg"){
                    $ext_imagen=".jpg";
                }else{
                    $ext_imagen=".png";
                }

                $ruta="../imagenes/".md5($imagen["tmp_name"]).$ext_imagen;
                $alm->__SET('ruta_imagen', $ruta);
                
                if($model->ActualizarCurso($alm)==1){
                    move_uploaded_file($imagen["tmp_name"], $ruta);
                    echo "ruta_imagen_tmp: ".$_REQUEST['ruta_imagen_tmp'];
                    unlink($_REQUEST['ruta_imagen_tmp']);
                    echo "actualizado";
                }else{
                    echo "error_subir_imagen";
                }

            }else{
                echo "error_formato_invalido";

            }
            
			
			break;

		case 'registrar':
			//$alm->__SET('idcurso',              $_REQUEST['idcurso']);
			$alm->__SET('docente_iddocente',    $_REQUEST['combo_curso']);
			$alm->__SET('nombre',        		$_REQUEST['nombre_curso']);
			$alm->__SET('descripcion',          $_REQUEST['descripcion']);
            $imagen=$_FILES['imagen'];

            if($imagen["type"]=="image/jpg" OR $imagen["type"]=="image/jpeg" OR $imagen["type"]=="image/png"){
                $ext_imagen="";
                if($imagen["type"]=="image/jpg" OR $imagen["type"]=="image/jpeg"){
                    $ext_imagen=".jpg";
                }else{
                    $ext_imagen=".png";
                }

                $ruta="../imagenes/".md5($imagen["tmp_name"]).$ext_imagen;
                $alm->__SET('ruta_imagen', $ruta);
                
                if($model->RegistrarCurso($alm)==1){
                    move_uploaded_file($imagen["tmp_name"], $ruta);
                    echo "insertado";
                }else{
                    echo "error_subir_imagen";
                }

            }else{
                echo "error_formato_invalido";

            }
                        
			
			
                        
			break;

		case 'eliminar':
                        
			if($model->EliminarCurso($_REQUEST['idcurso'])==1){
               unlink($_REQUEST['ruta_imagen']);
               echo "eliminado";

            }else{
                echo "no_eliminado";
            }
			//header('Location: controlador_curso.php');
			break;

		case 'editar':
                   
                    $arra=array();                
                    foreach ( $model->ObtenerCurso($_REQUEST['idcurso']) as $r):
                        
                        $docente=$r->__GET('docente_iddocente');
                        $combo=$model->cargar_valor($docente,0);
                        $aux=$r->__GET('ruta_imagen');
                        $imagen="<img class='responsive-img' src='".$r->__GET('ruta_imagen')."'>";


                      
                                    
                    //Ojo el utf8_decode para asegurarse de que los datos se codifique ne UTF8
                    $arra=array("idcurso"=>$r->__GET('idcurso'),"nombre"=>$r->__GET('nombre'),"descripcion"=>$r->__GET('descripcion'),"iddocente"=>$combo, "ruta_imagen"=>$imagen, "ruta_imagen_tmp"=>$aux);
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
        $stm="";
            $i=0;
           
            foreach( $model->ListarCurso() as $r):
               $iddocente=$r->__GET('docente_iddocente');
                $docente=$model->cargar_valor($iddocente, 1);
                $i++;
                $aux="estudiante_curso";
                $i2=$r->__GET('idcurso');

                $stm=$stm." <div class='col s6 m6 l4'>
            <div >
                <div class='card horizontal' style='margin-bottom: 0;'>
                    
                        <div class='card-image'>
                            <img src='".$r->__GET('ruta_imagen')."'>
                        </div>

                        <div class='card-stacked'>
                            <div class='card-action ' style=' padding-top: 4px; padding-right: 8px; padding-bottom: 8px;'  >
                                <ul class='valign-wrapper right' style='margin: 0;'>
                                    <li style='margin-right: 2px;'>
                                        <a class='waves-effect waves-light modal-trigger btn-floating blue'  href='#ventana_curso' onclick=javascript:modificar_curso(".$r->__GET('idcurso').")><i class='material-icons'>mode_edit</i>
                                        </a>
                                    </li>    
                                    <li><a onclick=javascript:eliminar_curso(".$r->__GET('idcurso').",'".$r->__GET('ruta_imagen')."') class='btn-floating red'><i class='material-icons'>delete</i></a></li>
                                </ul>

                            </div>
                            <div class='card-content' style='padding-top: 0; padding-bottom: 15px; padding-left: 8px; padding-right: 8px;'>

                                <h5 style='margin:0;'>".$r->__GET('nombre')."</h5>
                                <p>".$r->__GET('descripcion')."</p>
                                <p class='hide'>".$r->__GET('docente_iddocente')."</p>
                                ".$docente."
                      

                            </div>
                            <div class='card-action' style='padding: 16px 0;'>
                                <a href='#ventana_estudiante_curso2' onclick=javascript:cargar_curso_input(".$r->__GET('idcurso').");javascript:vaciar_cajas_estudiante_curso2(); class='modal-trigger btn' >Agregar estudiante</a>

                            </div>
                        </div>
                </div>

            </div>
            <div id='estudiantes' style='margin-bottom:10px;' >
                    <ul class='collapsible' data-collapsible='accordion' style='margin: 0 0; '>
                        <li>
                            <div id='header' class='collapsible-header ' onclick=javascript:listar_estudiantes(".$r->__GET('idcurso').")><i class='material-icons'>expand_more</i>
                                <span>estudiantes registrados</span>
                                

                            </div>
                            <div class='collapsible-body'>
                                <div style='overflow-y: auto;  height: 200px; width: auto;' id='lista_estudiantes".$i2."'>
                                                              
                                </div>  
                            </div>
                            
                        </li>
                    </ul>
                </div>
           
        </div>";




            /*$stm=$stm."<li id='item'>
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
                    . "</div>";*/
                    
                        
            
            endforeach;
            echo utf8_decode($stm);
                            
               
        break;
        
       case 'cargar_listbox':
				$tabla = $_POST['tabla'];
                $op=$_POST['op'];
                $metodo=$_POST['metodo'];
                               
                            
				switch($tabla)
				{
					
                    case 'curso':
                       
                        if($op==1){
                            $arreglo=$model->obtenercombo();

                                if (count($arreglo) > 0) {
                                    if($metodo=="editar"){
                                        $strCadena = "<option disabled>Seleccionar docente</option>";

                                    }else{
                                         $strCadena = "<option disabled selected>Seleccionar docente</option>";

                                    }

                                
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
