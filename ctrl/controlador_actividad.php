<?php
require_once "modelo/activida.entidad.php";
require_once "modelo/actividad.model.php";

// Logica
$actividad = new Actividad();
$model = new ActividadModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$actividad->__SET('idactividades',                     $_REQUEST['idactividades']);
			$actividad->__SET('nombre',                            $_REQUEST['nombre']);
			$actividad->__SET('descripcion',                       $_REQUEST['descripcion']);
			$actividad->__SET('tipo_actividad_idtipo_actividad',   $_REQUEST['tipo_actividad_idtipo_actividad']);
			$actividad->__SET('docente_iddocente',                 $_REQUEST['docente_iddocente']);
			$actividad->__SET('curso_idcurso',                     $_REQUEST['curso_idcurso']);
			
			$model->ActualizarActividad($actividad);
			header('Location: controlador_actividad.php');
			break;

		case 'registrar':
			$actividad->__SET('idactividades',                     $_REQUEST['idactividades']);
			$actividad->__SET('nombre',                            $_REQUEST['nombre']);
			$actividad->__SET('descripcion',                       $_REQUEST['descripcion']);
			$actividad->__SET('tipo_actividad_idtipo_actividad',   $_REQUEST['tipo_actividad_idtipo_actividad']);
			$actividad->__SET('docente_iddocente',                 $_REQUEST['docente_iddocente']);
			$actividad->__SET('curso_idcurso',                     $_REQUEST['curso_idcurso']);
			
			$model->RegistrarActividad($actividad);
			header('Location: controlador_actividad.php');
			break;

		case 'eliminar':
			$model->EliminarActividad($_REQUEST['idactividades']);
			header('Location: controlador_actividad.php');
			break;

		case 'editar':
			$actividad = $model->ObtenerActividades($_REQUEST['idactividades']);
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
    	         <h1>ACTIVIDAD</h1>
              </td>
           </table>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $actividad->idactividades > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idactividades" value="<?php echo $actividad->__GET('idactividades'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $actividad->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Descripcion</th>
                            <td><input type="text" name="descripcion" value="<?php echo $actividad->__GET('descripcion'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Tipo actividad</th>
                            <td><input type="text" name="tipo_actividad_idtipo_actividad" value="<?php echo $actividad->__GET('tipo_actividad_idtipo_actividad'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Docente</th>
                            <td><input type="text" name="docente_iddocente" value="<?php echo $actividad->__GET('docente_iddocente'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Curso</th>
                            <td><input type="text" name="curso_idcurso" value="<?php echo $actividad->__GET('curso_idcurso'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Descripcion</th>
                            <th style="text-align:left;">Tipo actividad</th>
                            <th style="text-align:left;">Docente</th>
                            <th style="text-align:left;">Curso</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->ListarActividad() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('descripcion'); ?></td>
                            <td><?php echo $r->__GET('tipo_actividad_idtipo_actividad'); ?></td>
                            <td><?php echo $r->__GET('docente_iddocente'); ?></td>
                            <td><?php echo $r->__GET('curso_idcurso'); ?></td>
                            <td>
                                <a href="?action=editar&idactividades=<?php echo $r->idactividades; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idactividades=<?php echo $r->idactividades; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>