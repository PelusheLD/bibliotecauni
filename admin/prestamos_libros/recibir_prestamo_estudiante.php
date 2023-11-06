<?php
session_start();
require_once '../conexion.php';

$id = $_POST["id"];
$fecha1 = $_POST["fecha1"];
$fecha2 = $_POST["fecha2"];
$estudiante = $_POST["estudiante"];
$estado = "0";

// Verificar el estado del estudiante
$sql_estado_estudiante = "SELECT status FROM usuario_estudiante WHERE id_usuario_estudiante = '$estudiante'";
$resultado_estado_estudiante = mysqli_query($con, $sql_estado_estudiante);

if (mysqli_num_rows($resultado_estado_estudiante) > 0) {
	$row_estado_estudiante = mysqli_fetch_assoc($resultado_estado_estudiante);
	$status_estudiante = $row_estado_estudiante['status'];

	if ($status_estudiante == 'OK') {
		// Verificar el número de ejemplares disponibles
		$sql_libro = "SELECT ejemplares FROM libros WHERE id_libro = '$id'";
		$resultado_libro = mysqli_query($con, $sql_libro);

		if (mysqli_num_rows($resultado_libro) > 0) {
			$libro = mysqli_fetch_assoc($resultado_libro);
			$ejemplares_disponibles = $libro['ejemplares'];

			if ($ejemplares_disponibles > 0) {
				// Realizar el préstamo
				$sql_insertar_prestamo = "INSERT INTO prestamo_libro (fecha_prestamo, fecha_entrega, id_libro, id_usuario_estudiante, estado) 
            VALUES ('$fecha1', '$fecha2', '$id', '$estudiante', '1')";
				$resultado_insertar_prestamo = mysqli_query($con, $sql_insertar_prestamo);

				if ($resultado_insertar_prestamo) {
					// Obtener el ID del préstamo recién insertado
					$id_prestamo = mysqli_insert_id($con);

					// Insertar los detalles del préstamo en la tabla detalles_prestamo
					$sql_insertar_detalles = "INSERT INTO detalles_prestamo (id_usuario_estudiante, carnet, nombre, fecha_prestamo, fecha_entrega, id_libro, contador) 
				VALUES ('$estudiante', (SELECT carnet FROM usuario_estudiante WHERE id_usuario_estudiante = '$estudiante'), (SELECT nombre FROM usuario_estudiante WHERE id_usuario_estudiante = '$estudiante'), '$fecha1', '$fecha2', '$id', '1')";
					$resultado_insertar_detalles = mysqli_query($con, $sql_insertar_detalles);

					if ($resultado_insertar_detalles) {
						// Restar 1 al número de ejemplares disponibles
						$sql_restar_ejemplar = "UPDATE libros SET ejemplares = ejemplares - 1 WHERE id_libro = '$id'";
						$resultado_restar_ejemplar = mysqli_query($con, $sql_restar_ejemplar);

						if ($resultado_restar_ejemplar) {
							// Verificar si el libro queda sin ejemplares disponibles
							if ($ejemplares_disponibles <= 1) {
								// Actualizar el estado del libro a no disponible
								$sql_actualizar_libro = "UPDATE libros SET disponible = 'no' WHERE id_libro = '$id'";
								$resultado_actualizar_libro = mysqli_query($con, $sql_actualizar_libro);

								if ($resultado_actualizar_libro) {
									header('Location:' . $URL . '../prestar_libro.php');
									session_start();
									$_SESSION['exito'] = "Prestamo Exitoso";
								} else {
									header('Location:' . $URL . '../prestar_libro.php');
									session_start();
									$_SESSION['error'] = "Error al actualizar el estado del libro.";
								}
							} else {
								header('Location:' . $URL . '../prestar_libro.php');
								session_start();
								$_SESSION['exito'] = "Prestamo Exitoso";
							}
						} else {
							header('Location:' . $URL . '../prestar_libro.php');
							session_start();
							$_SESSION['error'] = "Error al restar el ejemplar del libro.";
						}
					} else {
						header('Location:' . $URL . '../prestar_libro.php');
						session_start();
						$_SESSION['error'] = "Error al guardar los detalles del préstamo.";
					}
				} else {
					header('Location:' . $URL . '../prestar_libro.php');
					session_start();
					$_SESSION['error'] = "Error al procesar el préstamo.";
				}
			} else {
				header('Location:' . $URL . '../prestar_libro.php');
				session_start();
				$_SESSION['error'] = "No hay ejemplares disponibles para prestar.";
			}
		} else {
			header('Location:' . $URL . '../prestar_libro.php');
			session_start();
			$_SESSION['error'] = "El libro no existe.";
		}
	} elseif ($status_estudiante == 'Sancionado') {
		header('Location:' . $URL . '../prestar_libro.php');
		session_start();
		$_SESSION['error'] = "No se puede realizar el préstamo. El estudiante está sancionado.";
	} elseif ($status_estudiante == 'Vetado') {
		header('Location:' . $URL . '../prestar_libro.php');
		session_start();
		$_SESSION['error'] = "No se puede realizar el préstamo. El estudiante está vetado.";
	} else {
		header('Location:' . $URL . '../prestar_libro.php');
		session_start();
		$_SESSION['error'] = "El estado del estudiante es inválido.";
	}
} else {
	header('Location:' . $URL . '../prestar_libro.php');
	session_start();
	$_SESSION['error'] = "El estudiante no existe.";
}

mysqli_close($con);
