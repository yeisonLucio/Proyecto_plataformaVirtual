<?php
require_once 'curso.entidad.php';
require_once 'curso.model.php';

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
			header('Location: controlador_curso.php');
			break;

		case 'registrar':
			$alm->__SET('idcurso',              $_REQUEST['idcurso']);
			$alm->__SET('docente_iddocente',    $_REQUEST['docente_iddocente']);
			$alm->__SET('nombre',        		$_REQUEST['nombre']);
			$alm->__SET('descripcion',           $_REQUEST['descripcion']);

			$model->RegistrarCurso($alm);
			header('Location: controlador_curso.php');
			break;

		case 'eliminar':
			$model->EliminarCurso($_REQUEST['idcurso']);
			header('Location: controlador_curso.php');
			break;

		case 'editar':
			$alm = $model->ObtenerCurso($_REQUEST['idcurso']);
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
    	         <h1>CURSO</h1>
              </td>
           </table>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->idcurso > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idcurso" value="<?php echo $alm->__GET('idcurso'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">id docente</th>
                            <td><input type="text" name="docente_iddocente" value="<?php echo $alm->__GET('docente_iddocente'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $alm->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                       
                        <tr>
                            <th style="text-align:left;">descripcion</th>
                            <td><input type="text" name="descripcion" value="<?php echo $alm->__GET('descripcion'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">id docente</th>
                            <th style="text-align:left;">nombre</th>
                            <th style="text-align:left;">descripcion</th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->ListarCurso() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('docente_iddocente'); ?></td>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('descripcion'); ?></td>
                            <td>
                                <a href="?action=editar&idcurso=<?php echo $r->idcurso; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idcurso=<?php echo $r->idcurso; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>