<?php
class ActividadModel
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

	public function ListarActividad()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM actividades");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Actividad();

				$alm->__SET('idactividades', $r->idactividades);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('descripcion', $r->descripcion);
				$alm->__SET('tipo_actividad_idtipo_actividad', $r->tipo_actividad_idtipo_actividad);
				$alm->__SET('docente_iddocente', $r->docente_iddocente);
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

	public function ObtenerActividades($idactividades)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM actividades WHERE idactividades = ?");
			          

			$stm->execute(array($idactividades));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Actividad();

				$alm->__SET('idactividades', $r->idactividades);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('descripcion', $r->descripcion);
				$alm->__SET('tipo_actividad_idtipo_actividad', $r->tipo_actividad_idtipo_actividad);
				$alm->__SET('docente_iddocente', $r->docente_iddocente);
				$alm->__SET('curso_idcurso', $r->curso_idcurso);

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function EliminarActividad($idactividades)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM actividades WHERE idactividades = ?");			          

			$stm->execute(array($idactividades));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ActualizarActividad(Actividad $data)
	{
		try 
		{
			$sql = "UPDATE actividades SET 
						nombre                         = ?, 
						descripcion                    = ?,
						tipo_actividad_idtipo_actividad= ?,
						docente_iddocente              = ?,
						curso_idcurso                  = ?

				    WHERE idactividades = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'), 
					$data->__GET('descripcion'), 
					$data->__GET('tipo_actividad_idtipo_actividad'),
					$data->__GET('docente_iddocente'),
					$data->__GET('curso_idcurso'),
					$data->__GET('idactividades')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function RegistrarActividad(Actividad $data)
	{
		try 
		{
		$sql = "INSERT INTO actividades (nombre, descripcion, tipo_actividad_idtipo_actividad, docente_iddocente, curso_idcurso) 
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombre'), 
				$data->__GET('descripcion'), 
				$data->__GET('tipo_actividad_idtipo_actividad'),
				$data->__GET('docente_iddocente'),
				$data->__GET('curso_idcurso')

				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}