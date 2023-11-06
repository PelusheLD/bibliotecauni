 <?php 

include('../conexion.php');

	$cad="truncate table visitas";
	mysqli_query($con, $cad) or die("Error al Borrar");

	  echo '<script> alert("Se ha eliminado todas las visitas.");</script>';
	  echo '<script> window.location="../visitas.php"; </script>';
	 
 ?>