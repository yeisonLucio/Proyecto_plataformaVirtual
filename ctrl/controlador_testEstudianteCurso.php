<?php
require_once 'test_estudiante_curso.entidad.php';
require_once 'test_estudiante_curso.model.php';

// Logica
$alm = new Test_estudiante_curso();
$model = new Test_estudiante_cursoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idtes_estudiante_curso',                			 $_REQUEST['idtes_estudiante_curso']);
			$alm->__SET('docente_iddocente',             					 $_REQUEST['docente_iddocente']);
			$alm->__SET('calificacion',                						 $_REQUEST['calificacion']);
			$alm->__SET('test_idtest',             							 $_REQUEST['test_idtest']);
			$alm->__SET('estudiante_curso_idestudiante_curso',                $_REQUEST['estudiante_curso_idestudiante_curso']);

			$model->Actualizar($alm);
			header('Location: controlador_testEstudianteCurso.php');
			break;

		case 'registrar':
			$alm->__SET('idtes_estudiante_curso',                 			$_REQUEST['idtes_estudiante_curso']);
			$alm->__SET('docente_iddocente',            					$_REQUEST['docente_iddocente']);
			$alm->__SET('calificacion',              						$_REQUEST['calificacion']);
			$alm->__SET('test_idtest',               						$_REQUEST['test_idtest']);
			$alm->__SET('estudiante_curso_idestudiante_curso',               $_REQUEST['estudiante_curso_idestudiante_curso']);
			
			$model->Registrar($alm);
			header('Location: controlador_testEstudianteCurso.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['idtes_estudiante_curso']);
			header('Location: controlador_testEstudianteCurso.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['idtes_estudiante_curso']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>IECA</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">
        <div> 
        <table>
           <td>
           <a href="index.php"><img src = "https://cdn0.iconfinder.com/data/icons/essentials-9/128/__Home-64.png"></a>
              </td>
              <td>
    	         <h1>TEST ESTUDIANTE CURSO</h1>
              </td>
           </table>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->idtes_estudiante_curso > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idtes_estudiante_curso" value="<?php echo $alm->__GET('idtes_estudiante_curso'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">docente_iddocente</th>
                            <td><input type="text" name="docente_iddocente" value="<?php echo $alm->__GET('docente_iddocente'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">calificacion</th>
                            <td><input type="text" name="calificacion" value="<?php echo $alm->__GET('calificacion'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
							<th style="text-align:left;">test_idtest</th>
                            <td><input type="text" name="test_idtest" value="<?php echo $alm->__GET('test_idtest'); ?>" style="width:100%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">estudiante curso</th>
                            <td><input type="text" name="estudiante_curso_idestudiante_curso" value="<?php echo $alm->__GET('estudiante_curso_idestudiante_curso'); ?>" style="width:100%;" /></td>
                                           
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">docente_iddocente</th>
                            <th style="text-align:left;">calificacion</th>
							<th style="text-align:left;">test_idtest</th>
							<th style="text-align:left;">estudiante_curso_idestudiante_curso</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('docente_iddocente'); ?></td>
                            <td><?php echo $r->__GET('calificacion'); ?></td>
							<td><?php echo $r->__GET('test_idtest'); ?></td>
							<td><?php echo $r->__GET('estudiante_curso_idestudiante_curso'); ?></td>
                            
                            <td>
                                <a href="?action=editar&idtes_estudiante_curso=<?php echo $r->idtes_estudiante_curso; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idtes_estudiante_curso=<?php echo $r->idtes_estudiante_curso; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>