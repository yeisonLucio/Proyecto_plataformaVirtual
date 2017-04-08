<?php
class Test_estudiante_cursoModel
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

			$stm = $this->pdo->prepare("SELECT * FROM test_estudiante_curso");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Test_estudiante_curso();

				$alm->__SET('idtes_estudiante_curso', 						$r->idtes_estudiante_curso);
				$alm->__SET('docente_iddocente', 	  						$r->docente_iddocente);
				$alm->__SET('calificacion',			 						$r->calificacion);
				$alm->__SET('test_idtest', 			  						$r->test_idtest);
				$alm->__SET('estudiante_curso_idestudiante_curso', 	        $r->estudiante_curso_idestudiante_curso);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idtes_estudiante_curso)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM test_estudiante_curso WHERE idtes_estudiante_curso = ?");
			          

			$stm->execute(array($idtes_estudiante_curso));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Test_estudiante_curso();

			    $alm->__SET('idtes_estudiante_curso', 						$r->idtes_estudiante_curso);
				$alm->__SET('docente_iddocente', 	  						$r->docente_iddocente);
				$alm->__SET('calificacion',			 						$r->calificacion);
				$alm->__SET('test_idtest', 			  						$r->test_idtest);
				$alm->__SET('estudiante_curso_idestudiante_curso', 	        $r->estudiante_curso_idestudiante_curso);

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idtes_estudiante_curso)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM test_estudiante_curso WHERE idtes_estudiante_curso = ?");			          

			$stm->execute(array($idtes_estudiante_curso));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Test_estudiante_curso $data)
	{
		try 
		{
			$sql = "UPDATE test_estudiante_curso SET 
						docente_iddocente   = ?, 
						calificacion      = ?,
						test_idtest     = ?,
						estudiante_curso_idestudiante_curso =?
						
						
				    WHERE idtes_estudiante_curso  = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('docente_iddocente'), 
					$data->__GET('calificacion'), 
					$data->__GET('test_idtest'),
					$data->__GET('estudiante_curso_idestudiante_curso'),
					$data->__GET('idtes_estudiante_curso')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Test_estudiante_curso $data)
	{
		try 
		{
		$sql = "INSERT INTO test_estudiante_curso (docente_iddocente,calificacion,test_idtest,estudiante_curso_idestudiante_curso) 
		        VALUES (?, ?, ?,?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('docente_iddocente'), 
				$data->__GET('calificacion'), 
				$data->__GET('test_idtest'),
				$data->__GET('estudiante_curso_idestudiante_curso')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}