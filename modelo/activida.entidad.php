<?php
class Actividad
{
	private $idactividades;
	private $nombre;
	private $descripcion;
	private $tipo_actividad_idtipo_actividad;
	private $docente_iddocente;
	private $curso_idcurso;
		

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
