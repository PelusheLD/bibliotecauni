<?php
session_start();
include '../admin/conexion.php';
$usuario = $_SESSION['usuario'];
$changetoken = mysqli_query($con, "UPDATE visitantes SET estado = '0' WHERE usuario = '$usuario'");

session_destroy();
header('Location:' . $URL . '../index');
session_start();
$_SESSION['exito'] = "Vuelve Pronto";
