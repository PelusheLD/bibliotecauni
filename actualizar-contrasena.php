<?php
session_start();
// Conectar a la base de datos
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "bibliotecauni");

// Verificar la conexión
if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Obtener los datos del formulario
$correo = $_POST['correo'];
$cedula = $_POST['cedula'];
$nuevaContrasena = $_POST['nuevaContrasena'];

// Validar la contraseña
if (strlen($nuevaContrasena) < 8 || !preg_match("#[0-9]+#", $nuevaContrasena) || !preg_match("#[A-Z]+#", $nuevaContrasena) || !preg_match("#\W+#", $nuevaContrasena)) {
    echo "<script>alert('La contraseña debe tener al menos 8 caracteres, 1 número, 1 mayúscula y 1 carácter especial.');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
    exit();
}

// Encriptar la contraseña
$hash = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

// Actualizar la contraseña en la base de datos
$query = "UPDATE visitantes SET pass = '$hash' WHERE email = '$correo' AND cedula = '$cedula'";
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
    header('Location:' . $URL . 'index');
    session_start();
    $_SESSION['exito'] = "La Contraseña se a Actualizado exitosamente";
} else {
    header('Location:' . $URL . 'inicio');
    session_start();
    $_SESSION['error'] = "Ocurrio un problema al Actualizar la contraseña";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
