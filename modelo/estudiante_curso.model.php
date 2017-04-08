<?php
class Estudiante_cursoModel
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

	public function ListarEstudiante_curso()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM estudiante_curso");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Estudiante_curso();

				$alm->__SET('idestudiante_curso', $r->idestudiante_curso);
				$alm->__SET('estado', $r->estado);
				$alm->__SET('estudiante_idestudiante', $r->estudiante_idestudiante);
				$alm->__SET('curso_idcurso', $r->curso_idcurso);
				
				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerEstudiante_curso($idestudiante_curso)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM estudiante_curso WHERE idestudiante_curso = ?");
			          

			$stm->execute(array($idestudiante_curso));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Estudiante_curso();

			   $alm->__SET('idestudiante_curso', $r->idestudiante_curso);
				$alm->__SET('estado', $r->estado);
				$alm->__SET('estudiante_idestudiante', $r->estudiante_idestudiante);
				$alm->__SET('curso_idcurso', $r->curso_idcurso);

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function EliminarEstudiante_curso($idestudiante_curso)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM estudiante_curso WHERE idestudiante_curso = ?");			          

			$stm->execute(array($idestudiante_curso));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ActualizarEstudiante_curso(Estudiante_curso $data)
	{
		try 
		{
			$sql = "UPDATE estudiante_curso SET 
						estado                	  = ?,
						estudiante_idestudiante   = ?,
						curso_idcurso			  = ?
						
						
				    WHERE idestudiante_curso = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('estado'), 
					$data->__GET('estudiante_idestudiante'), 
					$data->__GET('curso_idcurso'),
					$data->__GET('idestudiante_curso')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function RegistrarEstudiante_curso(Estudiante_curso $data)
	{
		try 
		{
		$sql = "INSERT INTO estudiante_curso (estado,estudiante_idestudiante,curso_idcurso) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('estado'), 
				$data->__GET('estudiante_idestudiante'), 
				$data->__GET('curso_idcurso')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}