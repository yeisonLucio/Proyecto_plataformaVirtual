<?php
class CursoModel
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

	public function ListarCurso()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM curso");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Curso();

				$alm->__SET('idcurso', $r->idcurso);
				$alm->__SET('docente_iddocente', $r->docente_iddocente);
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

	public function ObtenerCurso($idcurso)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM curso WHERE idcurso = ?");
			          

			$stm->execute(array($idcurso));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Curso();

			    $alm->__SET('idcurso', $r->idcurso);
				$alm->__SET('docente_iddocente', $r->docente_iddocente);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('descripcion', $r->descripcion);


			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function EliminarCurso($idcurso)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM curso WHERE idcurso = ?");			          

			$stm->execute(array($idcurso));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ActualizarCurso(Curso $data)
	{
		try 
		{
			$sql = "UPDATE curso SET 
						docente_iddocente          = ?, 
						nombre                     = ?,
						descripcion                = ?
						
						WHERE idcurso = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					
					$data->__GET('docente_iddocente'), 
					$data->__GET('nombre'), 
					$data->__GET('descripcion'),
					$data->__GET('idcurso')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function RegistrarCurso(Curso $data)
	{
		try 
		{
		$sql = "INSERT INTO curso (docente_iddocente,nombre,descripcion) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('docente_iddocente'), 
				$data->__GET('nombre'), 
				$data->__GET('descripcion')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}