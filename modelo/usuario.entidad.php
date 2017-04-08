<?php
class Usuario
{
	private $idusuario;
	private $nombreUsuario;
	private $contrasena;
	private $tipoUsuario;
	

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}