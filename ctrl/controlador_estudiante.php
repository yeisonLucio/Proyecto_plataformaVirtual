<?php
require_once 'estudiante.entidad.php';
require_once 'estudiante.model.php';

// Logica
$alm = new Estudiante();
$model = new EstudianteModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idestudiante',              $_REQUEST['idestudiante']);
			$alm->__SET('nombre',                    $_REQUEST['nombre']);
			$alm->__SET('apellido',                  $_REQUEST['apellido']);
			$alm->__SET('correo',                    $_REQUEST['correo']);
			$alm->__SET('fechaNacimiento',           $_REQUEST['fechaNacimiento']);
			$alm->__SET('sexo',                      $_REQUEST['sexo']);
			$alm->__SET('estado',                    $_REQUEST['estado']);
			$alm->__SET('usuario_idusuario',         $_REQUEST['usuario_idusuario']);
			

			$model->ActualizarEstudiante($alm);
			header('Location: controlador_estudiante.php');
			break;

		case 'registrar':
			$alm->__SET('idestudiante',              $_REQUEST['idestudiante']);
			$alm->__SET('nombre',                    $_REQUEST['nombre']);
			$alm->__SET('apellido',                  $_REQUEST['apellido']);
			$alm->__SET('correo',                    $_REQUEST['correo']);
			$alm->__SET('fechaNacimiento',           $_REQUEST['fechaNacimiento']);
			$alm->__SET('sexo',                      $_REQUEST['sexo']);
			$alm->__SET('estado',                    $_REQUEST['estado']);
			$alm->__SET('usuario_idusuario',         $_REQUEST['usuario_idusuario']);
			
			
			$model->RegistrarEstudiante($alm);
			header('Location: controlador_estudiante.php');
			break;

		case 'eliminar':
			$model->EliminarEstudiante($_REQUEST['idestudiante']);
			header('Location: controlador_estudiante.php');
			break;

		case 'editar':
			$alm = $model->ObtenerEstudiante($_REQUEST['idestudiante']);
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
    	         <h1>ESTUDIANTE</h1>
              </td>
           </table>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->idestudiante > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idestudiante" value="<?php echo $alm->__GET('idestudiante'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $alm->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">apellido</th>
                            <td><input type="text" name="apellido" value="<?php echo $alm->__GET('apellido'); ?>" style="width:100%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">correo</th>
                            <td><input type="text" name="correo" value="<?php echo $alm->__GET('correo'); ?>" style="width:100%;" /></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">fecha de Nacimiento</th>
                            <td><input type="text" name="fechaNacimiento" value="<?php echo $alm->__GET('fechaNacimiento'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">sexo</th>
                            <td>
                                <select name="sexo" style="width:100%;">
                                    <option value="1" <?php echo $alm->__GET('sexo') == 1 ? 'selected' : ''; ?>>Masculino</option>
                                    <option value="2" <?php echo $alm->__GET('sexo') == 2 ? 'selected' : ''; ?>>Femenino</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <th style="text-align:left;">estado</th>
                            <td>
                                <select name="estado" style="width:100%;">
                                    <option value="1" <?php echo $alm->__GET('estado') == 1 ? 'selected' : ''; ?>>cursando</option>
                                    <option value="2" <?php echo $alm->__GET('estado') == 2 ? 'selected' : ''; ?>>terminado</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <th style="text-align:left;">id usuario</th>
                            <td><input type="text" name="usuario_idusuario" value="<?php echo $alm->__GET('usuario_idusuario'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">Apellido</th>
							<th style="text-align:left;">correo</th>
                            <th style="text-align:left;">fecha de Nacimiento</th>
                            <th style="text-align:left;">sexo</th>
                            <th style="text-align:left;">estado</th>
							<th style="text-align:left;">id usuario</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->ListarEstudiante() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('apellido'); ?></td>
							<td><?php echo $r->__GET('correo'); ?></td>
							<td><?php echo $r->__GET('fechaNacimiento'); ?></td>
                            <td><?php echo $r->__GET('sexo') == 1 ? 'H' : 'F'; ?></td>
							<td><?php echo $r->__GET('estado') == 1 ? 'C' : 'E'; ?></td>
							<td><?php echo $r->__GET('usuario_idusuario'); ?></td>
                            
                            <td>
                                <a href="?action=editar&idestudiante=<?php echo $r->idestudiante; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idestudiante=<?php echo $r->idestudiante; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>