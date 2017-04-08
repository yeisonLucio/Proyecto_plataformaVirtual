<?php
class test_estudiante_curso
{
	private $idtes_estudiante_curso;
	private $docente_iddocente;
	private $calificacion;
	private $test_idtest;
	private $estudiante_curso_idestudiante_curso;
	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
	
}