<?php
session_start();
include("conexion.php");
$tipoBusqueda = isset($_POST['tipoBusqueda']) ? $_POST['tipoBusqueda'] : '';

if (isset($_POST['idUsuario']) && isset($_POST['fechaFinSancion']) && isset($_POST['status']) && isset($_POST['tipoBusqueda'])) {
    $idUsuario = $_POST['idUsuario'];
    $fechaFinSancion = $_POST['fechaFinSancion'];
    $status = $_POST['status'];
    $razonSancion = isset($_POST['razonSancion']) ? $_POST['razonSancion'] : '';
    $tipoBusqueda = $_POST['tipoBusqueda'];

    if ($tipoBusqueda === 'Estudiantes') {
        $table = 'usuario_estudiante';
        $idColumn = 'id_usuario_estudiante';
        $contadorTable = 'contador_sanciones';
        $contadorColumn = 'cantidad_sanciones';
        $limiteSanciones = 3;
    } elseif ($tipoBusqueda === 'Profesores') {
        $table = 'usuario_profesores';
        $idColumn = 'id_usuario_profesor';
        $contadorTable = 'contador_sanciones_profesores';
        $contadorColumn = 'cantidad_sanciones';
        $limiteSanciones = 3;
    }

    $query = "UPDATE $table SET fecha_fin_sancion = '$fechaFinSancion', status = '$status', razon_sancion = '$razonSancion' WHERE $idColumn = $idUsuario";
    $result = mysqli_query($con, $query);

    if ($result) {
        if ($status === 'Sancionado') {
            $selectQuery = "SELECT * FROM $contadorTable WHERE $idColumn = $idUsuario";
            $selectResult = mysqli_query($con, $selectQuery);
            if (mysqli_num_rows($selectResult) > 0) {
                $row = mysqli_fetch_assoc($selectResult);
                $cantidadSanciones = $row[$contadorColumn] + 1;
                $updateQuery = "UPDATE $contadorTable SET $contadorColumn = $cantidadSanciones WHERE $idColumn = $idUsuario";
                mysqli_query($con, $updateQuery);
            } else {
                $insertQuery = "INSERT INTO $contadorTable ($idColumn, $contadorColumn) VALUES ($idUsuario, 1)";
                mysqli_query($con, $insertQuery);
                $cantidadSanciones = 1;
            }

            if ($cantidadSanciones >= $limiteSanciones) {
                $updateStatusQuery = "UPDATE $table SET status = 'Vetado', razon_sancion = 'Límite de Sanciones' WHERE $idColumn = $idUsuario";
                mysqli_query($con, $updateStatusQuery);
            }
        }

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
