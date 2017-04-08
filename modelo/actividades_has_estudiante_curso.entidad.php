<?php
class Actividades_has_estudiante_curso
{
	private $idactividade_has_estudiante_curso;
	private $actividades_idactividades;
	private $estudiante_curso_idestudiante_curso;
		
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}