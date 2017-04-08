<?php
class MaterialesModel
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

	public function ListarMaterial()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM materiales");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Material();

				$alm->__SET('idmateriales', $r->idmateriales);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('descripcion', $r->descripcion);
				$alm->__SET('curso_idcurso', $r->curso_idcurso);
				$alm->__SET('tipo_material_idtipo_material', $r->tipo_material_idtipo_material);
				$alm->__SET('docente_iddocente', $r->docente_iddocente);
				
				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerMaterial($idmateriales)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM materiales WHERE idmateriales = ?");
			          

			$stm->execute(array($idmateriales));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Material();

			    $alm->__SET('idmateriales', $r->idmateriales);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('descripcion', $r->descripcion);
				$alm->__SET('curso_idcurso', $r->curso_idcurso);
				$alm->__SET('tipo_material_idtipo_material', $r->tipo_material_idtipo_material);
				$alm->__SET('docente_iddocente', $r->docente_iddocente);


			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function EliminarMaterial($idmateriales)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM materiales WHERE idmateriales = ?");			          

			$stm->execute(array($idmateriales));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ActualizarMaterial(Material $data)
	{
		try 
		{
			$sql = "UPDATE materiales SET 
						nombre                         = ?, 
						descripcion                    = ?,
						curso_idcurso                  = ?,
						tipo_material_idtipo_material  = ?,
						docente_iddocente              = ?
												
				    WHERE idmateriales = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'), 
					$data->__GET('descripcion'), 
					$data->__GET('curso_idcurso'),
					$data->__GET('tipo_material_idtipo_material'),
					$data->__GET('docente_iddocente'),
					$data->__GET('idmateriales')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function RegistrarMaterial(Material $data)
	{
		try 
		{
		$sql = "INSERT INTO materiales (nombre, descripcion, curso_idcurso, tipo_material_idtipo_material, docente_iddocente) 
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombre'), 
				$data->__GET('descripcion'), 
				$data->__GET('curso_idcurso'),
				$data->__GET('tipo_material_idtipo_material'),
				$data->__GET('docente_iddocente')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}