<?php
session_start();
include("conexion.php");

// Obtener el valor de $idUsuarioEstudiante desde la sesión o desde algún otro lugar
$idUsuarioEstudiante = $_SESSION['idUsuarioEstudiante'];

$query = "SELECT contador_sanciones FROM sanciones_estudiante WHERE id_usuario_estudiante = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $idUsuarioEstudiante);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$contadorSanciones = $row['contador_sanciones'];

// Incrementar el contador de sanciones
$contadorSanciones++;

// Actualizar el contador en la tabla
$query = "UPDATE sanciones_estudiante SET contador_sanciones = ? WHERE id_usuario_estudiante = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "ii", $contadorSanciones, $idUsuarioEstudiante);
mysqli_stmt_execute($stmt);
