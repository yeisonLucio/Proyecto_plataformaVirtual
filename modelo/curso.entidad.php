
<?php
class Curso
{
	private $idcurso;
	private $docente_iddocente;
	private $nombre;
	private $descripcion;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}