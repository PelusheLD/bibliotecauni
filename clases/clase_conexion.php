<?php 
class clase_conexion{

  var $conect;
     function clase_conexion(){
	 }
	 
	 function getCon(){
	 return $this->conect;
	 }
	 
	 function conectarse() {
		
	     if(!($con=@mysql_connect("localhost","root","elier12345javier",true,65536)))
		 {
		     echo"Error al conectar a la base de datos";	
			 exit();
	      }
		  if (!@mysql_select_db("bibliotecauni",$con)) {
		   echo "Error al seleccionar la base de datos";  
		   exit();
		  }
	       $this->conect=$con;
		   return true;	
	 }
}

?>
