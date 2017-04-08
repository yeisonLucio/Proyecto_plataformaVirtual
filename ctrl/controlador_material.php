<?php
require_once '../modelo/materiales.entidad.php';
require_once '../modelo/materiales.model.php';

// Logica
$material = new Material();
$model = new MaterialesModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$material->__SET('idmateriales',                     $_REQUEST['idmateriales']);
			$material->__SET('nombre',                           $_REQUEST['nombre']);
			$material->__SET('descripcion',                      $_REQUEST['descripcion']);
			$material->__SET('curso_idcurso',                    $_REQUEST['curso_idcurso']);
			$material->__SET('tipo_material_idtipo_material',    $_REQUEST['tipo_material_idtipo_material']);
			$material->__SET('docente_iddocente',                $_REQUEST['docente_iddocente']);
			
			$model->ActualizarMaterial($material);
			header('Location: controlador_material.php');
			break;

		case 'registrar':
			
			$material->__SET('nombre',                           $_REQUEST['nombre']);
			$material->__SET('descripcion',                      $_REQUEST['descripcion']);
			$material->__SET('curso_idcurso',                    $_REQUEST['curso_idcurso']);
			$material->__SET('tipo_material_idtipo_material',    $_REQUEST['tipo_material_idtipo_material']);
			$material->__SET('docente_iddocente',                $_REQUEST['docente_iddocente']);
			
			$model->RegistrarMaterial($material);
			header('Location: controlador_material.php');
			break;

		case 'eliminar':
			$model->EliminarMaterial($_REQUEST['idmateriales']);
			header('Location: controlador_material.php');
			break;

		case 'editar':
			$material = $model->ObtenerMaterial($_REQUEST['idmateriales']);
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
    	         <h1>MATERIAL</h1>
              </td>
           </table>
        </div>    	
        <div class="pure-g">
            <div class="pure-u-1-12">
                
                <form action="?action=<?php echo $material->idmateriales > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idmateriales" value="<?php echo $material->__GET('idmateriales'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $material->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Descripcion</th>
                            <td><input type="text" name="descripcion" value="<?php echo $material->__GET('descripcion'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Curso</th>
                            <td><input type="text" name="curso_idcurso" value="<?php echo $material->__GET('curso_idcurso'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Tipo material</th>
                            <td><input type="text" name="tipo_material_idtipo_material" value="<?php echo $material->__GET('tipo_material_idtipo_material'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Docente</th>
                            <td><input type="text" name="docente_iddocente" value="<?php echo $material->__GET('docente_iddocente'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">Curso</th>
                            <th style="text-align:left;">Tipo material</th>
                            <th style="text-align:left;">Docente</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->ListarMaterial() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('descripcion'); ?></td>
                            <td><?php echo $r->__GET('curso_idcurso'); ?></td>
                            <td><?php echo $r->__GET('tipo_material_idtipo_material'); ?></td>
                            <td><?php echo $r->__GET('docente_iddocente'); ?></td>
                            <td>
                                <a href="?action=editar&idmateriales=<?php echo $r->idmateriales; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&idmateriales=<?php echo $r->idmateriales; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>