<?php
class Docente
{
	private $iddocente;
	private $nombre;
	private $contrasena;
	private $apellido;
	private $correo;
	private $fechaNacimiento;
	private $sexo;
	private $licenciatura;
	private $usuario_idusuario;
	

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}