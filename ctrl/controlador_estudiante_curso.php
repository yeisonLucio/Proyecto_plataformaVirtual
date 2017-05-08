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
                    $arra=array("idestudiante_curso"=>$r->__GET('idestudiante_curso'),"estado"=>$estado,"idestudiante"=>$estudiante,"idcurso"=>$curso );
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
                    $stm="<table class='table table-hover table-responsive'><thead><tr class='active'><th>#</th><th >Nombre del estudiante</th><th>Curso</th><th>Estado</th><th>Opciones</th></tr></thead><tbody>";
                    
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
                    <button type='button' class='btn btn-primary' id='btn_editar_estudiante_curso'  href='#ventana_estudiante_curso' onclick=javascript:modificar_estudiante_curso(".$r->__GET('idestudiante_curso').")  data-toggle='modal' >
                        <span class='sr-only'>Editar </span> <span class='glyphicon glyphicon-pencil'></span></button>
                    <a type='button' class='btn btn-danger' id='btn_eliminar_estudiante_curso' href='javascript:eliminar_estudiante_curso(".$r->__GET('idestudiante_curso').")'>
                        <span class='sr-only'>Eliminar </span><span class='glyphicon glyphicon-remove'></span></a>
        	
                </td></tr>";
                    $i++;

                    endforeach;
                    $stm.="</tbody></table>";
                    echo utf8_decode($stm);


                break;
        
                case 'cargar_listbox':
                    
                        $tabla = $_POST['tabla'];
                        $op=$_POST['op'];


                        switch($tabla)
                        {

                                case 'estudiante_curso':

                                    if ($op==1){
                                    $arreglo=$model->obtenercombo_estudiantes();

                                        if (count($arreglo) > 0) {
                                        $strCadena = " <option>--Seleccionar estudiante--</option>";
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
                                        $strCadena = " <option>--Seleccionar curso--</option>";
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

