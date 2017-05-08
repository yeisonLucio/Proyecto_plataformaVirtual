<?php
    //session_start();
    //require("../config/martinieto.mysql.conf");      // Obtiene variables de conexión
    //require '../PHPMailer-master/PHPMailerAutoload.php';
    require("../config/conexion.php"); 
   
    if(isset($_POST['accion'])) $accion = $_POST['accion']; 
	else $accion="no pasa nada";
				
    if(isset($accion))
	{
		switch ($accion)
		{
			case 'cargar_listbox':
				$tabla = $_POST['tabla'];
                                $id = $_POST['id'];
                            
				switch($tabla)
				{
					
                                        case 'docente':
						$sql="SELECT d.iddocente,d.nombre,d.apellido from docente d ORDER BY d.nombre ASC";
						break;
                                       
                                        
				}
				crearComboGenerico($sql);
				break;
		}
	}
	
?>
