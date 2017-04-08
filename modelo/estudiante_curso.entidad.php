<?php
class Estudiante_curso
{
	private $idestudiante_curso;
	private $estado;
	private $estudiante_idestudiante;
	private $curso_idcurso;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}