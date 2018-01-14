<?php
 
class conexion_mysql extends mysqli
{
     /************************************************************************************************************
	  * El método conectar establece la conexion del objeto que se crea cada vez que se invoca                   *
	  ************************************************************************************************************/
     public function conectar()
    {
	    // Se pasan los parametros de conexion al servidor y a la base de datos al constructor de la superclase
		parent::__construct("localhost","root","","mydb");
        if ($this->connect_errno) 
		{
           echo "<br>Fallo al connectar a MySQL: (" . $this->connect_errno . ") " . $this->connect_error;
        }
    }
    public function consulta_objetos($sql)
    {
	    $pos=0;
		depurar_sentencia("consulta_objetos","<br>SQL : ",$sql);
	
		//$resultado = mysql_db_query($this->db,$sql,$this->conexion) or die("!! No se pudo ejecutar satisfactoriamente la sentencia SQL!!");
		//$resultado=parent::query($sql) or die("!! Error al realizar consulta !!");
		// or die("!! Error al realizar consulta !!");
		if (!($resultado=$this->query($sql))) 
		{
		   //depurar_sentencia("consulta_objetos","<br>mensaje error : ",$this->error);
           echo "<br>Fallo en la consulta : (" . $this->error . ")";
        }
		else
		{
			$numero = $resultado->num_rows;
			depurar_sentencia("consulta_objetos","<br>se encontraron : ",$numero);
            $arregloReg = array();
            //while($row = $resultado->fetch_array(MYSQLI_BOTH))
			// row se crea como un objeto, es decir que lo que tendremos es un arreglo de objetos, por lo que 
			// habrá que manejarlos así $arregloReg[$idx]->campo_n
			while($obj = mysqli_fetch_object($resultado))
			// MYSQLI_BOTH permite referirse a los elementos del arreglo tanto de forma asociativa, ejemplo
			// $a["nombre"] o numericamente, ejemplo $a[0]
            {
			    $pos=count($arregloReg);
				depurar_sentencia("consulta_objetos","<br>pos : ",$pos);
				//$arregloReg[count($arregloReg)] = $obj;
                $arregloReg[$pos] = $obj;
				depurar_sentencia("consulta_objetos","<br>subindice : ",count($arregloReg));
            }
		}
		
		if (isset($arregloReg))
        {
            return $arregloReg;
        }
        else
		{
            return false;
		}
    }

}
?>
