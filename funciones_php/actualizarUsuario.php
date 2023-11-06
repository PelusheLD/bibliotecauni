<?php
session_start();
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bibliotecauni";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$cedula = $_POST['cédula'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$prefijo = $_POST['prefijo'];
$usuario = $_POST['usuario'];
$direccion = $_POST['direccion'];
$provincia = $_POST['provincia'];
$estadoPais = $_POST['estadoPais'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$pais = $_POST['pais'];

// Actualizar los datos del usuario en la base de datos
$sql = "UPDATE visitantes SET nombreCompleto='$nombre', email='$email', provincia='$provincia', estadoPais='$estadoPais', edad='$edad', sexo='$sexo', pais='$pais', telefono='$telefono',prefijo='$prefijo',direccion='$direccion', usuario='$usuario' WHERE cedula='$cedula'";

if ($conn->query($sql) === TRUE) {
    header('Location:' . $URL . '../inicio.php');
    session_start();
    $_SESSION['exito'] = "El usuario se a Actualizado exitosamente";
} else {
    header('Location:' . $URL . '../inicio.php');
    session_start();
    $_SESSION['error'] = "Ocurrio un problema al Actualizar el Usuario";
}

// Cerrar la conexión a la base de datos
$conn->close();
