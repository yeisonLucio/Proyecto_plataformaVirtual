<?php
class Estudiante
{
	private $idestudiante;
	private $nombre;
	private $apellido;
	private $correo;
	private $fechaNacimiento;
	private $sexo;
	private $estado;
	private $usuario_idusuario;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}