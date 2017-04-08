<?php

class Test
{
	private $idtest;
	private $nombre;
	private $descripcion;
	private $preguntas;
	private $actividades_idactividades;
	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v;}
}
