<?php
require_once 'tipo_material.entidad.php';
require_once 'tipo_material.model.php';

// Logica
$tipoM = new TipoMaterial();
$model = new TipoMaterialModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$tipoM->__SET('idtipo_material',                  $_REQUEST['idtipo_material']);
			$tipoM->__SET('nombre',                           $_REQUEST['nombre']);
						
			$model->ActualizarTipoMaterial($tipoM);
			header('controlador_tipoMaterial.php');
			break;

		case 'registrar':
			
			$tipoM->__SET('nombre',                           $_REQUEST['nombre']);

			$model->RegistrarTipoMaterial($tipoM);
			header('Location: controlador_tipoMaterial.php');
			break;

		case 'eliminar':
			$model->EliminarTipoMaterial($_REQUEST['idtipo_material']);
			header('Location: controlador_tipoMaterial.php');
			break;

		case 'editar':
			$tipoM = $model->ObtenerTipoMaterial($_REQUEST['idtipo_material']);
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
    	         <h1>TIPO MATERIAL</h1>
              </td>
           </table>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $tipoM->idtipo_material > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">                    
                    <input type="hidden" name="idtipo_material" value="<?php echo $tipoM->__GET('idtipo_material'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $tipoM->__GET('nombre'); ?>" style="width:100%;" /></td>
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
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->ListarTipoMaterial() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('Nombre'); ?></td>
                            <td>
                                <a href="?action=editar&idtipo_material=<?php echo $r->idtipo_material; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idtipo_material=<?php echo $r->idtipo_material; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>