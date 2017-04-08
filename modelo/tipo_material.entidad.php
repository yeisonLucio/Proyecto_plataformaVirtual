<?php
class TipoMaterial
{
	private $idtipo_material;
	private $nombre;


	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}