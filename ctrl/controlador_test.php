<?php

require_once '../modelo/test.entidad.php';
require_once '../modelo/test.modelo.php';

// Logica
$alm = new Test();
$model = new TestModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idtest',             			 $_REQUEST['idtest']);
			$alm->__SET('nombre',         			 	 $_REQUEST['nombre']);
			$alm->__SET('descripcion',       			 $_REQUEST['descripcion']);
			$alm->__SET('preguntas',          	    	 $_REQUEST['preguntas']);
			$alm->__SET('actividades_idactividades',	 $_REQUEST['actividades_idactividades']);

			$model->Actualizar($alm);
			header('Location: controlador_test.php');
			break;

		case 'registrar':
			$alm->__SET('nombre',        				 $_REQUEST['nombre']);
			$alm->__SET('descripcion',   				 $_REQUEST['descripcion']);
			$alm->__SET('preguntas',	  				 $_REQUEST['preguntas']);
			$alm->__SET('actividades_idactividades',     $_REQUEST['actividades_idactividades']);


			$model->Registrar($alm);
			header('Location: controlador_test.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['idtest']);
			header('Location: controlador_test.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['idtest']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>TEST MD</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">
        <div> 
        <table>
           <td>
           <a href="index.php"><img src = "https://cdn0.iconfinder.com/data/icons/essentials-9/128/__Home-64.png"></a>
              </td>
              <td>
    	         <h1>TEST</h1>
              </td>
           </table>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->idtest > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idtest" value="<?php echo $alm->__GET('idtest'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $alm->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">descripcion</th>
                            <td><input type="text" name="descripcion" value="<?php echo $alm->__GET('descripcion'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">preguntas</th>
                            <td><input type="text" name="preguntas" value="<?php echo $alm->__GET('preguntas'); ?>" style="width:100%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">actividades_idactividades</th>
                            <td><input type="text" name="actividades_idactividades" value="<?php echo $alm->__GET('actividades_idactividades'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">nombre</th>
                            <th style="text-align:left;">preguntas</th>
                            <th style="text-align:left;">descripcion</th>
                            <th style="text-align:left;">actividades_idactividades</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('preguntas'); ?></td>
                            <td><?php echo $r->__GET('descripcion'); ?></td>
                            <td><?php echo $r->__GET('actividades_idactividades'); ?></td>
                            <td>
                                <a href="?action=editar&idtest=<?php echo $r->idtest; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idtest=<?php echo $r->idtest; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>