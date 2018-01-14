<?php
class Estudiante_cursoModel
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
                    $result = array();
                    $stm = $this->pdo->prepare("SET NAMES 'utf8'");
                    $stm->execute();
			$stm = $this->pdo->prepare("SELECT * FROM estudiante_curso WHERE idestudiante_curso = ?");
			          

			$stm->execute(array($idestudiante_curso));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Estudiante_curso();

			        $alm->__SET('idestudiante_curso', $r->idestudiante_curso);
				$alm->__SET('estado', $r->estado);
				$alm->__SET('estudiante_idestudiante', $r->estudiante_idestudiante);
				$alm->__SET('curso_idcurso', $r->curso_idcurso);
                                
                            $result[]=$alm;

                        
			return $result;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
        
        public function Obtener_lista_estudiantes($curso_idcurso)
	{
		try 
		{
                    $result = array();
                    $stm = $this->pdo->prepare("SET NAMES 'utf8'");
                    $stm->execute();
			$stm = $this->pdo->prepare("SELECT * FROM estudiante_curso WHERE curso_idcurso = ?");
			          

			$stm->execute(array($curso_idcurso));
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
            $respuesta=false;
		try 
		{
			$sql = "UPDATE estudiante_curso SET 
						estado                	  = ?,
						estudiante_idestudiante   = ?,
						curso_idcurso			  = ?
						
						
				    WHERE idestudiante_curso = ?";

			$respuesta=$this->pdo->prepare($sql)
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
                echo $respuesta;
	}

	public function RegistrarEstudiante_curso(Estudiante_curso $data)
	{
            $respuesta=false;
		try 
		{
		$sql = "INSERT INTO estudiante_curso (estado,estudiante_idestudiante,curso_idcurso) 
		        VALUES (?, ?, ?)";

		$respuesta=$this->pdo->prepare($sql)
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
                echo $respuesta;
	}
        
        
        public function obtenercombo_cursos(){
            try {
                
                $result = array();
                    $stm = $this->pdo->prepare("SET NAMES 'utf8'");
                    $stm->execute();
                    
			$stm = $this->pdo->prepare("SELECT * from curso d ORDER BY d.nombre ASC");
			$stm->execute();
                        
			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Estudiante_curso();

				
				$alm->__SET('idcurso', $r->idcurso);
                                $alm->__SET('nombre', $r->nombre);
                                
                                
				
				$result[] = $alm;
                                
			}
                       
			return $result;
            } catch (Exception $ex) {
                
            }
            
        }
        public function obtenercombo_estudiantes(){
            try {
                
                $result = array();
                    $stm = $this->pdo->prepare("SET NAMES 'utf8'");
                    $stm->execute();
                    
			$stm = $this->pdo->prepare("SELECT * from estudiante d ORDER BY d.nombre ASC");
			$stm->execute();
                        
			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Estudiante_curso();

				
				$alm->__SET('idestudiante', $r->idestudiante);
                                $alm->__SET('nombre', $r->nombre);
                                $alm->__SET('apellido', $r->apellido);
                                
				
				$result[] = $alm;
                                
			}
                       
			return $result;
            } catch (Exception $ex) {
                
            }
            
        }
        
        
        public function  cargar_valor_comboestudiante($idestudiante, $n){
     
      
                    $stm = $this->pdo->prepare("SET NAMES 'utf8'");
                    $stm->execute();
                     
			$stm = $this->pdo->prepare("SELECT * from estudiante e ORDER BY e.nombre ASC");
			$stm->execute();
                        $aux="";
			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				
			
                        if ($idestudiante == $r->idestudiante && $n==0){
                            
                           $aux = "<option value=".$r->idestudiante." selected=".$r->idestudiante.">".$r->nombre." ".$r->apellido."</option>";
                        }
                         else if($idestudiante == $r->idestudiante && $n==1){
                            
                            $aux="<td>".$r->nombre." ".$r->apellido."</td>";
                           
                            
                        }
                       
			}
                       
            return $aux;
        }
        
        public function  cargar_valor_combocurso($idcurso, $n){
     
      
                    $stm = $this->pdo->prepare("SET NAMES 'utf8'");
                    $stm->execute();
                     
			$stm = $this->pdo->prepare("SELECT * from curso c ORDER BY c.nombre ASC");
			$stm->execute();
                        $aux="";
			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				
			
                        if ($idcurso == $r->idcurso && $n==0){
                            
                           $aux = "<option value=".$r->idcurso." selected=".$r->idcurso.">".$r->nombre."</option>";
                        }
                         else if($idcurso == $r->idcurso && $n==1){
                            
                            $aux="<td>".$r->nombre."</td>";
                           
                            
                        }
                       
			}
                       
            return $aux;
        }

}