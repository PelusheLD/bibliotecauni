<?php
include('../conexion.php');
$id = $_POST['id'];
$valores = mysqli_query($con, "SELECT * FROM subcategorias WHERE id_subcategoria = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['nombre_subcategoria'], 
				); 
echo json_encode($datos);
?>