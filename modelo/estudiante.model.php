<?php
class EstudianteModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarEstudiante()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM estudiante");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Estudiante();

				$alm->__SET('idestudiante', $r->idestudiante);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('apellido', $r->apellido);
				$alm->__SET('correo', $r->correo);
				$alm->__SET('fechaNacimiento', $r->fechaNacimiento);
				$alm->__SET('sexo', $r->sexo);
				$alm->__SET('estado', $r->estado);
				$alm->__SET('usuario_idusuario', $r->usuario_idusuario);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerEstudiante($idestudiante)
	{
		try 
		{
                        $result = array();
                        $stm = $this->pdo->prepare("SET NAMES 'utf8'");
                        $stm->execute();
                            $stm = $this->pdo->prepare("SELECT * FROM estudiante WHERE idestudiante = ?");
			          

			$stm->execute(array($idestudiante));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Estudiante();

			    $alm->__SET('idestudiante', $r->idestudiante);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('apellido', $r->apellido);
				$alm->__SET('correo', $r->correo);
				$alm->__SET('fechaNacimiento', $r->fechaNacimiento);
				$alm->__SET('sexo', $r->sexo);
				$alm->__SET('estado', $r->estado);
				$alm->__SET('usuario_idusuario', $r->usuario_idusuario);

                                $result[]=$alm;
			return $result;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function EliminarEstudiante($idestudiante)
	{
		$respuesta=false;
		try 
		{
			$respuesta=$stm = $this->pdo
			          ->prepare("DELETE FROM estudiante WHERE idestudiante = ?");			          

			$stm->execute(array($idestudiante));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
		echo $respuesta;
	}

	public function ActualizarEstudiante(Estudiante $data)
	{
		 $respuesta=false;
		try 
		{
			$sql = "UPDATE estudiante SET 
						nombre          = ?, 
						apellido        = ?,
						correo          = ?,
						fechaNacimiento = ?,
						sexo            = ?, 
						estado          = ?,
						usuario_idusuario=?
						
				    WHERE idestudiante = ?";

			$respuesta=$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'), 
					$data->__GET('apellido'),
			     	$data->__GET('correo'),					
					$data->__GET('fechaNacimiento'),
					$data->__GET('sexo'),
					$data->__GET('estado'),
					$data->__GET('usuario_idusuario'),
					$data->__GET('idestudiante')
					
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
		echo $respuesta;
	}

	public function RegistrarEstudiante(Estudiante $data)
	{
            $respuesta=false;
		try 
		{
		$sql = "INSERT INTO estudiante (nombre,apellido,correo,fechaNacimiento,sexo,estado,usuario_idusuario) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

		$respuesta=$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombre'), 
				$data->__GET('apellido'), 
				$data->__GET('correo'),
				$data->__GET('fechaNacimiento'),
				$data->__GET('sexo'),
				$data->__GET('estado'),
				$data->__GET('usuario_idusuario')
				)
			);
                
                
		}
                catch (Exception $e) 
		{
			die($e->getMessage());
		}
                 echo $respuesta;
	}
}