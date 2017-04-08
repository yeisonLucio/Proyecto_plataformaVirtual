<?php
class Material
{
	private $idmateriales;
	private $nombre;
	private $descripcion;
	private $curso_idcurso;
	private $tipo_material_idtipo_material;
	private $docente_iddocente;

	
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
