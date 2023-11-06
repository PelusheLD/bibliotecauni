<?php
include('../conexion.php');

$id = $_POST['id'];
$valores = mysqli_query($con, "SELECT * FROM visitantes WHERE idvisitante = '$id'");
$valores2 = mysqli_fetch_array($valores);
$datos = array(
	0 => $valores2['nombreCompleto'],
	1 => $valores2['cedula'],
	2 => $valores2['email'],
	3 => $valores2['prefijo'],
	4 => $valores2['telefono'],
	5 => $valores2['direccion'],
	6 => $valores2['provincia'],
	7 => $valores2['estadoPais'],
	8 => $valores2['usuario'],
	9 => '', // Dejar vacío inicialmente
	10 => $valores2['edad'],
	11 => $valores2['sexo'],
	12 => $valores2['pais'],
);

// Desencriptar la contraseña
$contrasenaEncriptada = $valores2['pass'];
$contrasenaOriginal = password_verify('contrasena_actual', $contrasenaEncriptada);
if ($contrasenaOriginal) {
	$datos[9] = $contrasenaOriginal;
}

echo json_encode($datos);
