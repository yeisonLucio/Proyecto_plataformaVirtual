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
                        $stm = $this->pdo->prepare("SET NAMES 'utf8'");
                        $stm->execute();

			$stm = $this->pdo->prepare("SELECT * FROM curso");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Curso();

				$alm->__SET('idcurso', $r->idcurso);
				$alm->__SET('docente_iddocente', $r->docente_iddocente);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('descripcion', $r->descripcion);
				$alm->__SET('ruta_imagen', $r->ruta_imagen);
				
                                
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
                    $result = array();
                    $stm = $this->pdo->prepare("SET NAMES 'utf8'");
                    $stm->execute();
			$stm = $this->pdo->prepare("SELECT * FROM curso where idcurso=?");
			
			          

			$stm->execute(array($idcurso));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Curso();

			        $alm->__SET('idcurso', $r->idcurso);
				$alm->__SET('docente_iddocente', $r->docente_iddocente);
				$alm->__SET('nombre', $r->nombre);
				$alm->__SET('descripcion', $r->descripcion);
				$alm->__SET('ruta_imagen', $r->ruta_imagen);
                                

                                $result[]=$alm;

                        
			return $result;
                        
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
                
	}
        

	public function EliminarCurso($idcurso){
		$respuesta=false;
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM curso WHERE idcurso = ?");			          

			$respuesta=$stm->execute(array($idcurso));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
		return $respuesta;

	}

	public function ActualizarCurso(Curso $data)
	{
            $respuesta=false;
		try 
		{
			$sql = "UPDATE curso SET 
						docente_iddocente          = ?, 
						nombre                     = ?,
						descripcion                = ?,
						ruta_imagen                = ?
						
						WHERE idcurso = ?";

			$respuesta=$this->pdo->prepare($sql)
			     ->execute(
				array(
					
					$data->__GET('docente_iddocente'), 
					$data->__GET('nombre'), 
					$data->__GET('descripcion'),
					$data->__GET('ruta_imagen'),
					$data->__GET('idcurso')

					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
                return $respuesta;
	}

	public function RegistrarCurso(Curso $data)
	{
            $respuesta=false;
		try 
		{
		$sql = "INSERT INTO curso (docente_iddocente,nombre,descripcion,ruta_imagen) 
		        VALUES (?, ?, ?, ?)";

		$respuesta=$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('docente_iddocente'), 
				$data->__GET('nombre'), 
				$data->__GET('descripcion'),
				$data->__GET('ruta_imagen')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
                return $respuesta;
	}
        
        public function obtenercombo(){
            try {
                
                $result = array();
                    $stm = $this->pdo->prepare("SET NAMES 'utf8'");
                    $stm->execute();
                    
			$stm = $this->pdo->prepare("SELECT * from docente d ORDER BY d.nombre ASC");
			$stm->execute();
                        
			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Curso();

				
				$alm->__SET('iddocente', $r->iddocente);
                                $alm->__SET('nombre', $r->nombre);
                                $alm->__SET('apellido', $r->apellido);
                                
				
				$result[] = $alm;
                                
			}
                       
			return $result;
            } catch (Exception $ex) {
                
            }
            
        }
        
        
        public function  cargar_valor($iddocente, $n){
     
      
      $stm = $this->pdo->prepare("SET NAMES 'utf8'");
                    $stm->execute();
                     
			$stm = $this->pdo->prepare("SELECT * from docente d ORDER BY d.nombre ASC");
			$stm->execute();
                        $aux="";
			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				
			
                        if ($iddocente == $r->iddocente && $n==0){
                            
                           $aux = "<option value=".$r->iddocente." selected=".$r->iddocente.">".$r->nombre." ".$r->apellido."</option>";
                        }
                         else if($iddocente == $r->iddocente && $n==1){
                            
                            $aux="<p>Docente: ".$r->nombre." ".$r->apellido."</p>";
                           
                            
                        }
                       
			}
                       
            return $aux;
        }

        
        
}