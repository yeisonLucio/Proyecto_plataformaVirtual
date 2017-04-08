<?php
class TestModel
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

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM test");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Test();

				$alm->__SET('idtest', $r->idtest);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('descripcion', $r->descripcion);
				$alm->__SET('preguntas', $r->preguntas);
				$alm->__SET('actividades_idactividades', $r->actividades_idactividades);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idtest)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM test WHERE idtest = ?");
			          

			$stm->execute(array($idtest));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Test();

				$alm->__SET('idtest', $r->idtest);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('descripcion', $r->descripcion);
				$alm->__SET('preguntas', $r->preguntas);
				$alm->__SET('actividades_idactividades', $r->actividades_idactividades);

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idtest)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM test WHERE idtest = ?");			          

			$stm->execute(array($idtest));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Test $data)
	{
		try 
		{
			$sql = "UPDATE test SET 
						 
						nombre      = ?,
						descripcion = ?, 
						preguntas   = ?,
						actividades_idactividades =?
						
				    WHERE idtest = ?";
					
			$this->pdo->prepare($sql)
			     ->execute(
				array(
					
					$data->__GET('nombre'), 
					$data->__GET('descripcion'),
					$data->__GET('preguntas'),
					$data->__GET('actividades_idactividades'),
					$data->__GET('idtest')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Test $data)
	{
		try 
		{
		$sql = "INSERT INTO test (nombre,descripcion,preguntas,actividades_idactividades) 
		        VALUES (?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				
				$data->__GET('nombre'), 
				$data->__GET('descripcion'),
				$data->__GET('preguntas'),
				$data->__GET('actividades_idactividades')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}