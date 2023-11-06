<?php
session_start();
include("conexion.php");
$tipoBusqueda = isset($_POST['tipoBusqueda']) ? $_POST['tipoBusqueda'] : '';

if (isset($_POST['idUsuario']) && isset($_POST['status']) && isset($_POST['tipoBusqueda'])) {
    $idUsuario = $_POST['idUsuario'];
    $status = $_POST['status'];
    $razonSancion = isset($_POST['razonSancion']) ? $_POST['razonSancion'] : '';
    $tipoBusqueda = $_POST['tipoBusqueda'];

    // Ajustar la consulta SQL según el tipo de búsqueda seleccionado
    if ($tipoBusqueda === 'Estudiantes') {
        $tabla = 'usuario_estudiante';
        $idColumn = 'id_usuario_estudiante';
    } elseif ($tipoBusqueda === 'Profesores') {
        $tabla = 'usuario_profesores';
        $idColumn = 'id_usuario_profesor';
    }

    // Actualizar los datos en la base de datos
    $query = "UPDATE $tabla SET status = ?, razon_sancion = ? WHERE $idColumn = ?";
    $statement = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($statement, 'ssi', $status, $razonSancion, $idUsuario);
    $result = mysqli_stmt_execute($statement);

    if ($result) {
        $message = "Registro guardado exitosamente.";
    } else {
        $message = "Error al guardar el registro.";
    }

    // Retornar la respuesta como JSON
    $response = array(
        'message' => $message
    );
    echo json_encode($response);
} else {
    $message = "Error: Datos faltantes.";
    $response = array(
        'message' => $message
    );
    echo json_encode($response);
}
