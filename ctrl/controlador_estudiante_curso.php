<?php
require_once '../modelo/estudiante_curso.entidad.php';
require_once '../modelo/estudiante_curso.model.php';

// Logica
$alm = new Estudiante_curso();
$model = new  Estudiante_cursoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idestudiante_curso',       $_REQUEST['idestudiante_curso']);
			$alm->__SET('estado',                   $_REQUEST['estado']);
			$alm->__SET('estudiante_idestudiante',  $_REQUEST['estudiante_idestudiante']);
			$alm->__SET('curso_idcurso',            $_REQUEST['curso_idcurso']);
			

			$model->ActualizarEstudiante_curso($alm);
			//header('Location: controlador_estudianteCurso.php');
			break;

		case 'registrar':
			$alm->__SET('idestudiante_curso',       $_REQUEST['idestudiante_curso']);
            $alm->__SET('estado',                   $_REQUEST['estado']);
            $alm->__SET('estudiante_idestudiante',  $_REQUEST['estudiante_idestudiante']);
            $alm->__SET('curso_idcurso',            $_REQUEST['curso_idcurso']);

			$model->RegistrarEstudiante_curso($alm);
			//header('Location: controlador_estudianteCurso.php');
			break;

		case 'eliminar':
			$model->EliminarEstudiante_curso($_REQUEST['idestudiante_curso']);
			//header('Location: controlador_estudianteCurso.php');
			break;

                    case 'editar':
                   
                    $arra=array();                
                    foreach ( $model->ObtenerEstudiante_curso($_REQUEST['idestudiante_curso']) as $r):
                        
                        $idestudiante=$r->__GET('estudiante_idestudiante');
                        $idcurso=$r->__GET('curso_idcurso');
                        $estudiante=$model->cargar_valor_comboestudiante($idestudiante, 0);
                        $curso=$model->cargar_valor_combocurso($idcurso, 0);
                        
                        if($r->__GET('estado')==="1"){ 
                        $estado="<option value='1' selected>Cursando".
                            "<option value='2'>Terminado"; 
                         }else{ 
                             $estado="<option value='1'>Cursando".
                            "<option value='2' selected>Terminado";
                         }
                        
                      
                                    
                    //Ojo el utf8_decode para asegurarse de que los datos se codifique ne UTF8
                    $arra=array("idestudiante_curso"=>$r->__GET('idestudiante_curso'),"estado"=>$estado,"idestudiante"=>$estudiante,"idcurso"=>$curso,"curso_idcurso"=>$idcurso);
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
                    $i=1;
                    $stm="<table class='centered striped'><thead><tr><th>#</th><th >Nombre del estudiante</th><th>Curso</th><th>Estado</th><th>Opciones</th></tr></thead><tbody>";
                    
                    foreach( $model->ListarEstudiante_curso() as $r):
                        $idestudiante=$r->__GET('estudiante_idestudiante');
                        $idcurso=$r->__GET('curso_idcurso');
                        $estudiante=$model->cargar_valor_comboestudiante($idestudiante, 1);
                        $curso=$model->cargar_valor_combocurso($idcurso, 1);
                        $estado="";
                        if($r->__GET('estado')=="1"){
                            $estado="Cursando";

                        }else {
                            $estado="Terminado";

                        }
                        $stm.="<tr><td>".$i."</td>".$estudiante."".$curso."<td>".$estado."</td><td>
                    

                    <a type='button' class='waves-effect waves-light btn-floating  blue accent-4 modal-trigger ' id='btn_editar_estudiante_curso'  href='#ventana_estudiante_curso' onclick=javascript:modificar_estudiante_curso(".$r->__GET('idestudiante_curso').")  ><i class='material-icons center'>mode_edit</i></a>

                    <a type='button' class='waves-effect waves-light btn-floating  red accent-4' id='btn_eliminar_estudiante_curso' href='javascript:eliminar_estudiante_curso(".$r->__GET('idestudiante_curso').")'><i class='material-icons center'>delete</i></a>
        	
                </td></tr>";
                    $i++;

                    endforeach;
                    $stm.="</tbody></table>";
                    echo utf8_decode($stm);


                break;
                
                case 'listar_estudiantes':
                    $i=1;
                    $cont=0;
                    $stm="<table class='bordered centered'><thead><tr><th >Nombre</th><th>Curso</th><th>Estado</th><th>Opciones</th></tr></thead><tbody>";
                    
                    foreach( $model->Obtener_lista_estudiantes($_REQUEST['curso_idcurso']) as $r):
                        $idestudiante=$r->__GET('estudiante_idestudiante');
                        $idcurso=$r->__GET('curso_idcurso');
                        $estudiante=$model->cargar_valor_comboestudiante($idestudiante, 1);
                        $curso=$model->cargar_valor_combocurso($idcurso, 1);
                        $estado="";
                        if($r->__GET('estado')=="1"){
                            $estado="Cursando";

                        }else {
                            $estado="Terminado";

                        }
                        $cont++;
                        $stm.="<tr>".$estudiante."".$curso."<td>".$estado."</td><td>


                            <a href='#ventana_estudiante_curso2' onclick=javascript:modificar_estudiante_curso2(".$r->__GET('idestudiante_curso').");javascript:cargar_curso_input(".$r->__GET('curso_idcurso')."); class='btn-floating  modal-trigger' id='btn_editar_estudiante_curso2'><i class='material-icons'>mode_edit</i></a>

                            <a href='javascript:eliminar_estudiante_curso2(".$r->__GET('idestudiante_curso').", ".$r->__GET('curso_idcurso').")' class='btn-floating' id='btn_eliminar_estudiante_curso2' ><i class='material-icons'>delete</i></a>


                    
        	
                </td></tr>";
                    $i++;

                    endforeach;
                    $stm.="</tbody></table><p> Total estudiantes: ".$cont."</p>";
                    echo utf8_decode($stm);

                    
                    break;
                    
        
                case 'cargar_listbox':
                    
                        $tabla = $_POST['tabla'];
                        $op=$_POST['op'];
                        $metodo=$_POST['metodo'];


                        switch($tabla)
                        {

                                case 'estudiante_curso':

                                    if ($op==1 || $op==3){
                                    $arreglo=$model->obtenercombo_estudiantes();

                                        if (count($arreglo) > 0) {
                                             if($metodo=="editar"){
                                        $strCadena = "<option disabled>Seleccionar estudiante</option>";

                                    }else{
                                         $strCadena = "<option disabled selected>Seleccionar estudiante </option>";

                                    }

                                            foreach ($arreglo as $item){

                                            $strCadena .= "<option value='".$item->idestudiante."'>".$item->nombre." ".$item->apellido."</option>";
                                            }
                                            }
                                        else {
                                        $strCadena = false;
                                        }
                                           echo utf8_encode($strCadena); 

                                    }else if($op==2){
                                        $arreglo=$model->obtenercombo_cursos();

                                        if (count($arreglo) > 0) {
                                             if($metodo=="editar"){
                                                $strCadena = "<option disabled>Seleccionar curso</option>";

                                             }else{
                                                 $strCadena = "<option disabled selected>Seleccionar curso</option>";

                                            }
                                            foreach ($arreglo as $item){

                                            $strCadena .= "<option value='".$item->idcurso."'>".$item->nombre."</option>";
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

