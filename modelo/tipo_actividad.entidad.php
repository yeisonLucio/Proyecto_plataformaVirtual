<?php
class TipoActividad
{
	private $idtipo_actividad;
	private $nombre;
	private $descripcion;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}