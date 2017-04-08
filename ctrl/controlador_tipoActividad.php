<?php
require_once 'tipo_actividad.entidad.php';
require_once 'tipo_actividad.model.php';

// Logica
$tipoAc = new TipoActividad();
$model = new TipoActividadModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$tipoAc->__SET('idtipo_actividad',                 $_REQUEST['idtipo_actividad']);
			$tipoAc->__SET('nombre',                           $_REQUEST['nombre']);
			$tipoAc->__SET('descripcion',                      $_REQUEST['descripcion']);
			
			$model->ActualizarTipoActividad($tipoAc);
			header('Location: controlador_tipoActividad.php');
			break;

		case 'registrar':
			
			$tipoAc->__SET('nombre',                           $_REQUEST['nombre']);
			$tipoAc->__SET('descripcion',                      $_REQUEST['descripcion']);

			$model->RegistrarTipoActividad($tipoAc);
			header('Location: controlador_tipoActividad.php');
			break;

		case 'eliminar':
			$model->EliminarTipoActividad($_REQUEST['idtipo_actividad']);
			header('Location: controlador_tipoActividad.php');
			break;

		case 'editar':
			$tipoAc = $model->ObtenerTipoActividad($_REQUEST['idtipo_actividad']);
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
    	         <h1>TIPO ACTIVIDAD</h1>
              </td>
           </table>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $tipoAc->idtipo_actividad > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idtipo_actividad" value="<?php echo $tipoAc->__GET('idtipo_actividad'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $tipoAc->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Descripcion</th>
                            <td><input type="text" name="descripcion" value="<?php echo $tipoAc->__GET('descripcion'); ?>" style="width:100%;" /></td>
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
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->ListarTipoActividad() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('descripcion'); ?></td>
                            <td>
                                <a href="?action=editar&idtipo_actividad=<?php echo $r->idtipo_actividad; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idtipo_actividad=<?php echo $r->idtipo_actividad; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>