<?php
require_once 'estudiante_curso.entidad.php';
require_once 'estudiante_curso.model.php';

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
			header('Location: controlador_estudianteCurso.php');
			break;

		case 'registrar':
			$alm->__SET('idestudiante_curso',       $_REQUEST['idestudiante_curso']);
            $alm->__SET('estado',                   $_REQUEST['estado']);
            $alm->__SET('estudiante_idestudiante',  $_REQUEST['estudiante_idestudiante']);
            $alm->__SET('curso_idcurso',            $_REQUEST['curso_idcurso']);

			$model->RegistrarEstudiante_curso($alm);
			header('Location: controlador_estudianteCurso.php');
			break;

		case 'eliminar':
			$model->EliminarEstudiante_curso($_REQUEST['idestudiante_curso']);
			header('Location: controlador_estudianteCurso.php');
			break;

		case 'editar':
			$alm = $model->ObtenerEstudiante_curso($_REQUEST['idestudiante_curso']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Anexsoft</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">
        <div> 
        <table>
           <td>
           <a href="index.php"><img src = "https://cdn0.iconfinder.com/data/icons/essentials-9/128/__Home-64.png"></a>
              </td>
              <td>
    	         <h1>ESTUDIANTE CURSO</h1>
              </td>
           </table>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->idestudiante_curso > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idestudiante_curso" value="<?php echo $alm->__GET('idestudiante_curso'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">estado</th>
                            <td><input type="text" name="estado" value="<?php echo $alm->__GET('estado'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">estudiante_idestudiante</th>
                            <td><input type="text" name="estudiante_idestudiante" value="<?php echo $alm->__GET('estudiante_idestudiante'); ?>" style="width:100%;" /></td>
                        </tr>
                        </tr>
                        <tr>
                            <th style="text-align:left;">curso_idcurso</th>
                            <td><input type="text" name="curso_idcurso" value="<?php echo $alm->__GET('curso_idcurso'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">Estado</th>
                            <th style="text-align:left;">estudiante_idestudiante</th>
                            <th style="text-align:left;">curso_id_curso</th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->ListarEstudiante_curso() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('estado'); ?></td>
                            <td><?php echo $r->__GET('estudiante_idestudiante'); ?></td>                           
                            <td><?php echo $r->__GET('curso_idcurso'); ?></td>
                            <td>
                                <a href="?action=editar&idestudiante_curso=<?php echo $r->idestudiante_curso; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idestudiante_curso=<?php echo $r->idestudiante_curso; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>