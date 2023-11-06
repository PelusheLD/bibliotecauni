<?php
session_start(); // Inicia la sesión al principio
include('../admin/conexion.php');

$nombre = $_POST['nombre'];
$cedula = $_POST['cédula'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$prefijo = $_POST['prefijo'];
$direccion = $_POST['direccion'];
$provincia = $_POST['provincia'];
$estado = $_POST['estado'];
$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$pais = $_POST['pais'];

// Validar si la persona ya está registrada
$sql_verificar = "SELECT * FROM visitantes WHERE cedula = '$cedula'";
$res_verificar = mysqli_query($con, $sql_verificar);

if (mysqli_num_rows($res_verificar) > 0) {
	header('Location:' . $URL . '../index');
	session_start();
	$_SESSION['wr'] = "Esta Persona ya esta Registrada";
} else {
	// Encriptar la contraseña
	$passEncriptada = password_hash($pass, PASSWORD_DEFAULT);

	$sql = "INSERT INTO visitantes (nombreCompleto, cedula, usuario, pass, email, telefono, prefijo, direccion, provincia, estadoPais,edad, sexo, pais, estado)
            VALUES ('$nombre', '$cedula', '$usuario', '$passEncriptada', '$email', '$telefono','$prefijo','$direccion', '$provincia', '$estado', '$edad', '$sexo', '$pais', '1')";

	$res = mysqli_query($con, $sql);
	if ($res) {
		header('Location:' . $URL . '../index');
		session_start();
		$_SESSION['exito'] = "El usuario se a registrado exitosamente";
	} else {
		header('Location:' . $URL . '../index');
		session_start();
		$_SESSION['error'] = "Ocurrio un problema al registrar el Usuario";
	}
}
