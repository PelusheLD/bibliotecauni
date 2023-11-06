<?php
include('../conexion.php');
$id = $_POST['id'];
$valores = mysqli_query($con, "SELECT * FROM suscriptores WHERE id_suscriptor = '$id'");
$valores2 = mysqli_fetch_array($valores);
$datos = array(
				0 => $valores2['nombre_completo'], 
				1 => $valores2['correo'], 
			    2 => $valores2['observaciones'], 
				3 => $valores2['fecha_suscripcion'], 
				); 
echo json_encode($datos);
?>