<?php
 
class conexion_mysql extends mysqli
{
     /************************************************************************************************************
	  * El método conectar establece la conexion del objeto que se crea cada vez que se invoca                   *
	  ************************************************************************************************************/
     public function conectar($db)
    {
	    // Se pasan los parametros de conexion al servidor y a la base de datos al constructor de la superclase
        if(ENHOSTING==1)  //ENHOSTING se define en logica.php
			 //parent::__construct("localhost","lologrei_usuario","u!_acc.2016_logre",$db);   //nuevos datos de conexion en julio 7 de 2016
			 parent::__construct("localhost","user_en_hosting","clave_en_hosting",$db);   //nuevos datos de conexion en julio 7 de 2016
		else
		     parent::__construct("localhost","root","",$db);
        
		if ($this->connect_errno) 
		{
           echo "<br>Fallo al connectar a MySQL: (" . $this->connect_errno . ") " . $this->connect_error;
        }
    }
    
     /************************************************************************************************************
	  * El método insert almacena los datos recibidos en la base de datos                                        *
	  * retorna el id generado al realizarse la sentencia                                                        *
	  ************************************************************************************************************/
	public function insert($sql)
	{
		//$resu=mysql_query($this->db,$sql,$this->conexion) or die("!! Error al crear al insertar !!");
		$resu=$this->query($sql) or die("!! Error al crear al insertar !!");
		//$id=mysql_insert_id();
		$id=$this->insert_id;
		return $id;
	}
	/*************************************************************************************************************
	  * El método update ejecuta una sentencia de actualización sobre datos de la base de datos                   *
	  * No retorna ningun valor                                                                                  *
	  ************************************************************************************************************/
	public function update($sql)
    {
        //$resu=mysql_db_query($this->db,$sql,$this->conexion) or die("!! Error al crear al actualizar !!");
		$resu=$this->query($sql) or die("!! Error al intentar actualizar !!");
    }
    /*************************************************************************************************************
     * El método consulta_arreglo es UTIL para cuando se hace consultas que retornan UNA SOLA FILA ya que     	 *
     * devuelve una sola fila de datos, OJO : Retorna el arreglo sin codificacion JSON                           *
     *************************************************************************************************************/
    public function consulta_arreglo($sql)
    {
	
		if (!($resultado=$this->query($sql))) 
		{
           echo "<br>Fallo en la consulta : (" . $this->error . ")";
        }
		else
		{
            $arregloReg = array();
            $arregloReg[0] = $resultado->fetch_array(MYSQLI_BOTH); 
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

	/*
     *  Esta funcion es UTIL para cuando se hace un select que retorna varias filas, ya que devuelve
     *  un arreglo con todo el resultado de la consulta
     */
    public function consulta_objetos($sql)
    {
	    $pos=0;
		if (!($resultado=$this->query($sql))) 
		{
        }
		else
		{
			$numero = $resultado->num_rows;
            $arregloReg = array();
            //while($row = $resultado->fetch_array(MYSQLI_BOTH))
			// row se crea como un objeto, es decir que lo que tendremos es un arreglo de objetos, por lo que 
			// habrá que manejarlos así $arregloReg[$idx]->campo_n
			while($obj = mysqli_fetch_object($resultado))
			// MYSQLI_BOTH permite referirse a los elementos del arreglo tanto de forma asociativa, ejemplo
			// $a["nombre"] o numericamente, ejemplo $a[0]
            {
			    $pos=count($arregloReg);
                $arregloReg[$pos] = $obj;
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
