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
			//header('Location: controlador_curso.php');
			break;

		case 'eliminar':
			$model->EliminarCurso($_REQUEST['idcurso']);
			//header('Location: controlador_curso.php');
			break;

		case 'editar':
			$alm = $model->ObtenerCurso($_REQUEST['idcurso']);
			break;
                    
                case 'listar':
                foreach( $model->ListarCurso() as $r):
                  $stm=$stm."<li id='listar'><h3>".$r->__GET('nombre')."</h3><p>".
                                       $r->__GET('descripcion')."</p><p>".
                                       $r->__GET('docente_iddocente')."</p><li>";
                         
                endforeach;
                echo 'respuesta',$stm;
                            
               
                break;
	}
}



?>
