<?php
class DocenteModel
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

	public function ListarDocente()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM docente");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Docente();

				$alm->__SET('iddocente', $r->iddocente);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('apellido', $r->apellido);
				$alm->__SET('correo', $r->correo);
				$alm->__SET('fechaNacimiento', $r->fechaNacimiento);
				$alm->__SET('sexo', $r->sexo);
				$alm->__SET('licenciatura', $r->licenciatura);
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

	public function ObtenerDocente($iddocente)
	{
		try 
		{
                    $result = array();
                    $stm = $this->pdo->prepare("SET NAMES 'utf8'");
                    $stm->execute();
                        $stm = $this->pdo->prepare("SELECT * FROM docente WHERE iddocente = ?");
			

			$stm->execute(array($iddocente));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Docente();

                                $alm->__SET('iddocente', $r->iddocente);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('apellido', $r->apellido);
				$alm->__SET('correo', $r->correo);
				$alm->__SET('fechaNacimiento', $r->fechaNacimiento);
				$alm->__SET('sexo', $r->sexo);
				$alm->__SET('licenciatura', $r->licenciatura);
				$alm->__SET('usuario_idusuario', $r->usuario_idusuario);
                                
                                $result[] = $alm;
                                
			return $result;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function EliminarDocente($iddocente)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM docente WHERE iddocente = ?");			          

			$stm->execute(array($iddocente));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ActualizarDocente(Docente $data)
	{
            $respuesta=false;
		try 
		{
			$sql = "UPDATE docente SET 
						nombre   		= ?, 
						apellido        = ?,
						correo          = ?,
						fechaNacimiento = ?,
						sexo            = ?,
						licenciatura    = ?,
						usuario_idusuario =?
						
						
				    WHERE iddocente     = ?";

			$respuesta=$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'), 
					$data->__GET('apellido'), 
					$data->__GET('correo'),
					$data->__GET('fechaNacimiento'),
					$data->__GET('sexo'),
					$data->__GET('licenciatura'),
					$data->__GET('usuario_idusuario'),
					$data->__GET('iddocente')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
                
                echo $respuesta;
                
	}


	public function RegistrarDocente(Docente $data)
	{
            $respuesta=false;
		try 
		{
		$sql = "INSERT INTO docente (nombre,apellido,correo,fechaNacimiento,sexo,licenciatura,usuario_idusuario) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

		$respuesta=$this->pdo->prepare($sql)
		     ->execute(
			array(
					$data->__GET('nombre'), 
					$data->__GET('apellido'), 
					$data->__GET('correo'),
					$data->__GET('fechaNacimiento'),
					$data->__GET('sexo'),
					$data->__GET('licenciatura'),
					$data->__GET('usuario_idusuario')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
                
                echo $respuesta;
	}
}