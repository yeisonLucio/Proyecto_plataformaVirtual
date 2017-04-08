<?php
class tipoMaterialModel
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

	public function ListarTipoMaterial()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tipo_material");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$tipoM = new TipoMaterial();

				$tipoM->__SET('idtipo_material', $r->idtipo_material);
				$tipoM->__SET('Nombre', $r->nombre);
				
				$result[] = $tipoM;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerTipoMaterial($idtipo_material)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM tipo_material WHERE idtipo_material = ?");
			          

			$stm->execute(array($idtipo_material));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$tipoM = new TipoMaterial();

			    $tipoM->__SET('idtipo_material', $r->idtipo_material);
				$tipoM->__SET('nombre', $r->nombre);


			return $tipoM;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function EliminarTipoMaterial($idtipo_material)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM tipo_material WHERE idtipo_material = ?");			          

			$stm->execute(array($idtipo_material));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ActualizarTipoMaterial(TipoMaterial $data)
	{
		try 
		{
			$sql = "UPDATE tipo_material SET 
						nombre          = ? 
						
				    WHERE idtipo_material = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'), 
					$data->__GET('idtipo_material')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function RegistrarTipoMaterial(TipoMaterial $data)
	{
		try 
		{
		$sql = "INSERT INTO tipo_material (nombre) 
		        VALUES (?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombre') 
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}