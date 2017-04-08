<?php
class TipoActividadModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=id1114169_mydb', 'id1114169_root', 'rootroot');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarTipoActividad()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tipo_actividad");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new TipoActividad();

				$alm->__SET('idtipo_actividad', $r->idtipo_actividad);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('descripcion', $r->descripcion);
				
				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerTipoActividad($idtipo_actividad)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM tipo_actividad WHERE idtipo_actividad = ?");
			          

			$stm->execute(array($idtipo_actividad));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new TipoActividad();

			    $alm->__SET('idtipo_actividad', $r->idtipo_actividad);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('descripcion', $r->descripcion);

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function EliminarTipoActividad($idtipo_actividad)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM tipo_actividad WHERE idtipo_actividad = ?");			          

			$stm->execute(array($idtipo_actividad));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ActualizarTipoActividad(TipoActividad $data)
	{
		try 
		{
			$sql = "UPDATE tipo_actividad SET 
						nombre                 = ?, 
						descripcion            = ?
						
				    WHERE idtipo_actividad = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'), 
					$data->__GET('descripcion'), 
					$data->__GET('idtipo_actividad')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function RegistrarTipoActividad(TipoActividad $data)
	{
		try 
		{
		$sql = "INSERT INTO tipo_actividad (nombre,descripcion) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombre'), 
				$data->__GET('descripcion'), 
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}