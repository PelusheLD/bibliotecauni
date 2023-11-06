<?php
include('../conexion.php');
$id = $_POST['id'];
$valores = mysqli_query($con, "SELECT * FROM libros WHERE id_libro = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
	0 => $valores2['fecha_ingreso'],
	1 => $valores2['nombre'],
	2 => $valores2['autor'],
	3 => $valores2['cota'],
	4 => $valores2['ejemplares'],
	5 => $valores2['editorial'],
	6 => $valores2['descripcion'],
	7 => $valores2['disponible'],
	8 => $valores2['circulante'],
	9 => $valores2['id_categoria'],
	10 => $valores2['id_subcategoria'],
	11 => $valores2['url_descarga'],
	12 => $valores2['serial'],
);
echo json_encode($datos);
