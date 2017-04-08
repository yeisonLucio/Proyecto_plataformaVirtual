<?php
require_once '../modelo/actividades_has_estudiante_curso.entidad.php';
require_once '../modelo/actividades_has_estudiante_curso.model.php';

// Logica
$alm = new Actividades_has_estudiante_curso();
$model = new Actividades_has_estudiante_cursoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idactividade_has_estudiante_curso',                 $_REQUEST['idactividade_has_estudiante_curso']);
			$alm->__SET('actividades_idactividades',          			     $_REQUEST['actividades_idactividades']);
			$alm->__SET('estudiante_curso_idestudiante_curso',               $_REQUEST['estudiante_curso_idestudiante_curso']);
						

			$model->Actualizar($alm);
			header('Location: controlador_actividadesHasEstudianteCurso.php');
			break;

		case 'registrar':
			$alm->__SET('idactividade_has_estudiante_curso',                 $_REQUEST['idactividade_has_estudiante_curso']);
			$alm->__SET('actividades_idactividades',            			 $_REQUEST['actividades_idactividades']);
			$alm->__SET('estudiante_curso_idestudiante_curso',               $_REQUEST['estudiante_curso_idestudiante_curso']);
			
			
			$model->Registrar($alm);
			header('Location: controlador_actividadesHasEstudianteCurso.php ');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['idactividade_has_estudiante_curso']);
			header('Location: controlador_actividadesHasEstudianteCurso.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['idactividade_has_estudiante_curso']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Actividades_has</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">
        <div> 
        <table>
           <td>
           <a href="index.php"><img src = "https://cdn0.iconfinder.com/data/icons/essentials-9/128/__Home-64.png"></a>
              </td>
              <td>
    	         <h1>ACTIVIDAD ESTUDIANTE CURSO</h1>
              </td>
           </table>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->idactividade_has_estudiante_curso > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idactividade_has_estudiante_curso" value="<?php echo $alm->__GET('idactividade_has_estudiante_curso'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">actividades_idactividades</th>
                            <td><input type="text" name="actividades_idactividades" value="<?php echo $alm->__GET('actividades_idactividades'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">estudiante_curso_idestudiante_curso</th>
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
                            <th style="text-align:left;">actividades_idactividades</th>
                            <th style="text-align:left;">estudiante_curso_idestudiante_curso</th>
							
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('actividades_idactividades'); ?></td>
                            <td><?php echo $r->__GET('estudiante_curso_idestudiante_curso'); ?></td>
							
                            
                            <td>
                                <a href="?action=editar&idactividade_has_estudiante_curso=<?php echo $r->idactividade_has_estudiante_curso; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idactividade_has_estudiante_curso=<?php echo $r->idactividade_has_estudiante_curso; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>