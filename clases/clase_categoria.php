<?php 
//Referenciamos la clase clsConexion
include_once("clase_conexion.php");

//Implementamos la clase categoria
class clase_categoria{
 //Constructor	
 function clase_categoria(){
 }	
 //Funcion para agregar una nueva categoria en la BD
 function agregarCategoria($descripcion, $subcategoria){
   $con = new clase_conexion;
   if($con->conectarse()==true){
     $query = "CALL SP_Insertar_Categoria('$descripcion', '$subcategoria')";
     $result = @mysql_query($query);
     if (!$result)
	   return false;
     else
       return true;
   }
 }
 function CantidadCategoria(){
   $con = new clase_conexion;
   if($con->conectarse()==true){
     $query = "CALL SP_S_CANTIDAD_CATEGORIAS()";
   $result = @mysql_query($query);
   if (!$result)
     return false;
   else
     return $result;
   }
}
 //Modificar categoria en la base de datos
 function modificarCategoria($idcategoria,$descripcion, $subcategoria){
   $con = new clase_conexion;
   if($con->conectarse()==true){
     $query = "CALL  SP_Actualizar_categoria('$idcategoria','$descripcion', '$subcategoria')";
     $result = @mysql_query($query);
     if (!$result)
	   return false;
     else
       return true;
   }
 }
 function consultarCategoria(){
   //creamos el objeto $con a partir de la clase clase_conexion
   $con = new clase_conexion;
   //usamos el metodo conectar para realizar la conexion
   if($con->conectarse()==true){
     $query = "CALL SP_S_Categoria()";
	 $result = @mysql_query($query);
	 if (!$result)
	   return false;
	 else
	   return $result;
   }
 }
function consultarTotalCategorias(){
   //creamos el objeto $con a partir de la clase clsConexion
   $con = new clsConexion;
   //usamos el metodo conectar para realizar la conexion
   if($con->conectarse()==true){
     $query = "CALL SP_S_CategoriaCantidadTotal()";
	 $result = @mysql_query($query);
	 if (!$result)
	   return false;
	 else
	   return $result;
   }
 }
 
}
?>
