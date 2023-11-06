<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "bibliotecauni");

// Verificar la conexión
if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Obtener los datos del formulario
$correo = $_POST['correo'];
$cedula = $_POST['cedula'];

// Consultar si existe un registro con el correo y la cédula proporcionados
$query = "SELECT * FROM visitantes WHERE email = '$correo' AND cedula = '$cedula'";
$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) > 0) {
    // Incluir el archivo del modal para la nueva contraseña
    include("index.php");

    // Mostrar el modal para la nueva contraseña
    echo "<script>$('#nuevaContrasenaModal').modal('show');</script>";
} else {
    // No se encontró ningún registro con el correo y la cédula proporcionados
    echo "<script>alert('No se encontró ningún usuario con los datos proporcionados.');</script>";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
