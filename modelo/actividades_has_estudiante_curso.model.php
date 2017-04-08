<?php
class Actividades_has_estudiante_cursoModel
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

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM actividades_has_estudiante_curso");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Actividades_has_estudiante_curso();

				$alm->__SET('idactividade_has_estudiante_curso', 						$r->idactividade_has_estudiante_curso);
				$alm->__SET('actividades_idactividades', 								$r->actividades_idactividades);
				$alm->__SET('estudiante_curso_idestudiante_curso', 						$r->estudiante_curso_idestudiante_curso);
				
				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idactividade_has_estudiante_curso)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM actividades_has_estudiante_curso WHERE idactividade_has_estudiante_curso = ?");
			          

			$stm->execute(array($idactividade_has_estudiante_curso));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Actividades_has_estudiante_curso();

			   $alm->__SET('idactividade_has_estudiante_curso', 						$r->idactividade_has_estudiante_curso);
			   $alm->__SET('actividades_idactividades', 								$r->actividades_idactividades);
			   $alm->__SET('estudiante_curso_idestudiante_curso', 						$r->estudiante_curso_idestudiante_curso);
				
			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idactividade_has_estudiante_curso)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM actividades_has_estudiante_curso WHERE idactividade_has_estudiante_curso = ?");			          

			$stm->execute(array($idactividade_has_estudiante_curso));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Actividades_has_estudiante_curso $data)
	{
		try 
		{
			$sql = "UPDATE actividades_has_estudiante_curso SET 
						
						actividades_idactividades   =?, 
						estudiante_curso_idestudiante_curso= ?				
						
				    WHERE idactividade_has_estudiante_curso  = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('actividades_idactividades'),
					$data->__GET('estudiante_curso_idestudiante_curso'),
					$data->__GET('idactividade_has_estudiante_curso')
					 )
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Actividades_has_estudiante_curso $data)
	{
		try 
		{
		$sql = "INSERT INTO actividades_has_estudiante_curso (actividades_idactividades,estudiante_curso_idestudiante_curso) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
			
				$data->__GET('actividades_idactividades'), 
				$data->__GET('estudiante_curso_idestudiante_curso')
				
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}