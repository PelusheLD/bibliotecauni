<?php
session_start();
include 'admin/conexion.php';
$usuario = $_SESSION['usuario'];

$uno = $_POST['uno'];
$dos = $_POST['dos'];
$tres = $_POST['tres'];
$cuatro = $_POST['cuatro'];
$cinco = $_POST['cinco'];
$seis = $_POST['seis'];

$tokenCompleto = $uno . $dos . $tres . $cuatro . $cinco . $seis;
$data = mysqli_query($con, "SELECT * FROM visitantes WHERE usuario = '$usuario'");

while ($consulta = mysqli_fetch_array($data)) {
    $tokenBase = $consulta["token"];
}
if ($tokenBase == $tokenCompleto) {
    $changetoken = mysqli_query($con, "UPDATE visitantes SET estado = '1' WHERE usuario = '$usuario'");

    header('Location:' . $URL . 'login/validarUsuario.php');
    session_start();
    $_SESSION['exito'] = "Bienvenido al sistema!";
} else {
    header('Location:' . $URL . 'verificacion.php');
    session_start();
    $_SESSION['error'] = "El Codigo es incorrecto, Se a enviado un nuevo codigo al correo";
}
mysqli_close($con);
