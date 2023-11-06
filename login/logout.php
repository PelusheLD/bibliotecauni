<?php
session_start();
header('Location:' . $URL . '../inicio.php');
session_start();
$_SESSION['exito'] = "Saliste de Administracion";
