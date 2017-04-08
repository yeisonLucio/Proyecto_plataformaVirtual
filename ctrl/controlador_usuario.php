<?php
require_once '../modelo/usuario.entidad.php';
require_once '../modelo/usuario.model.php';

// Logica
$alm = new Usuario();
$model = new UsuarioModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('idusuario',                 $_REQUEST['idusuario']);
			$alm->__SET('nombreUsuario',             $_REQUEST['nombreUsuario']);
			$alm->__SET('contrasena',                $_REQUEST['contrasena']);
			$alm->__SET('tipoUsuario',               $_REQUEST['tipoUsuario']);
			

			$model->Actualizar($alm);
			header('Location: controlador_usuario.php');
			break;

		case 'registrar':
			$alm->__SET('idusuario',                 $_REQUEST['idusuario']);
			$alm->__SET('nombreUsuario',             $_REQUEST['nombreUsuario']);
			$alm->__SET('contrasena',                $_REQUEST['contrasena']);
			$alm->__SET('tipoUsuario',               $_REQUEST['tipoUsuario']);
			
			
			$model->Registrar($alm);
			header('Location: controlador_usuario.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['idusuario']);
			header('Location: controlador_usuario.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['idusuario']);
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
    	         <h1>USUARIO</h1>
              </td>
           </table>
        </div>
        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $alm->idusuario > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idusuario" value="<?php echo $alm->__GET('idusuario'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">nombreUsuario</th>
                            <td><input type="text" name="nombreUsuario" value="<?php echo $alm->__GET('nombreUsuario'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">contraseña</th>
                            <td><input type="text" name="contrasena" value="<?php echo $alm->__GET('contrasena'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">TipoUsuario</th>
                            <td>
                                <select name="tipoUsuario" style="width:100%;">
                                    <option value="estudiante" <?php echo $alm->__GET('tipoUsuario') == 1 ? 'selected' : ''; ?>>Estudiante</option>
                                    <option value="docente" <?php echo $alm->__GET('tipoUsuario') == 2 ? 'selected' : ''; ?>>Docente</option>
                                </select>
                            </td>
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
                            <th style="text-align:left;">nombreUsuario</th>
                            <th style="text-align:left;">contraseña</th>
							<th style="text-align:left;">tipoUsuario</th>
                            
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombreUsuario'); ?></td>
                            <td><?php echo $r->__GET('contrasena'); ?></td>
							<td><?php echo $r->__GET('tipoUsuario'); ?></td>
                            
                            <td>
                                <a href="?action=editar&idusuario=<?php echo $r->idusuario; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idusuario=<?php echo $r->idusuario; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>