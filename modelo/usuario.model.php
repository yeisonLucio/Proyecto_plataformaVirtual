<?php
class UsuarioModel
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

			$stm = $this->pdo->prepare("SELECT * FROM usuario");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Usuario();

				$alm->__SET('idusuario', $r->idusuario);
				$alm->__SET('nombreUsuario', $r->nombreUsuario);
				$alm->__SET('contrasena', $r->contrasena);
				$alm->__SET('tipoUsuario', $r->tipoUsuario);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($idusuario)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuario WHERE idusuario = ?");
			          

			$stm->execute(array($idusuario));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Usuario();

			    $alm->__SET('idusuario', $r->idusuario);
				$alm->__SET('nombreUsuario', $r->nombreUsuario);
				$alm->__SET('contrasena', $r->contrasena);
				$alm->__SET('tipoUsuario', $r->tipoUsuario);

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($idusuario)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM usuario WHERE idusuario = ?");			          

			$stm->execute(array($idusuario));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Usuario $data)
	{
		try 
		{
			$sql = "UPDATE usuario SET 
						nombreUsuario   = ?, 
						contrasena      = ?,
						tipoUsuario     = ?
						
						
				    WHERE idusuario	  = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombreUsuario'), 
					$data->__GET('contrasena'), 
					$data->__GET('tipoUsuario'),
					$data->__GET('idusuario')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Usuario $data)
	{
		try 
		{
		$sql = "INSERT INTO usuario (nombreUsuario,contrasena,tipoUsuario) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombreUsuario'), 
				$data->__GET('contrasena'), 
				$data->__GET('tipoUsuario')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}