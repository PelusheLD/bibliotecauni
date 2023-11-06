<?php
session_start();
include "../conexion.php";

$id_prestamo = $_POST['id_prestamo'];
$estado_libro = $_POST['estado'];
$fecha_hoy = $_POST['fecha_entregaa'];
$consulta_libro = mysqli_query($con, "SELECT id_libro, id_usuario_profesor, fecha_entrega FROM prestamo_libro_profesores WHERE id_prestamo = '$id_prestamo'");
$row = mysqli_fetch_assoc($consulta_libro);
$id_libro = $row['id_libro'];
$id_usuario_profesor = $row['id_usuario_profesor'];
$fecha_entrega = $row['fecha_entrega'];
$consulta_estado = mysqli_query($con, "SELECT estado FROM prestamo_libro_profesores WHERE id_prestamo = '$id_prestamo'");
$row = mysqli_fetch_assoc($consulta_estado);
$estado_actual = $row['estado'];
if ($estado_actual == 1) {
  $actualizacion_ejemplares = mysqli_query($con, "UPDATE libros SET ejemplares = ejemplares + 1 WHERE id_libro = '$id_libro'");
  $actualizacion_estado = mysqli_query($con, "UPDATE prestamo_libro_profesores SET estado = 0, estado_libro = '$estado_libro', fecha_hoy = '$fecha_hoy' WHERE id_prestamo = '$id_prestamo'");
  $fecha_hoy_obj = new DateTime($fecha_hoy);
  $fecha_entrega_obj = new DateTime($fecha_entrega);
  if ($fecha_hoy_obj > $fecha_entrega_obj || $estado_libro == "Dañado") {
    $actualizacion_estado_profesor = mysqli_query($con, "UPDATE usuario_profesores SET status = 'Sancionado' WHERE id_usuario_profesor = '$id_usuario_profesor'");
    if ($actualizacion_estado_profesor) {
      $actualizacion_sanciones = mysqli_query($con, "UPDATE contador_sanciones_profesores SET cantidad_sanciones = cantidad_sanciones + 1 WHERE id_usuario_profesor = '$id_usuario_profesor'");
      if ($actualizacion_sanciones) {
        $consulta_sanciones_actualizada = mysqli_query($con, "SELECT cantidad_sanciones FROM contador_sanciones_profesores WHERE id_usuario_profesor = '$id_usuario_profesor'");
        if ($consulta_sanciones_actualizada) {
          $row_sanciones = mysqli_fetch_assoc($consulta_sanciones_actualizada);
          $cantidad_sanciones_actualizada = $row_sanciones['cantidad_sanciones'];
          if ($cantidad_sanciones_actualizada == 1) {
            $fecha_fin_sancion = date('Y-m-d', strtotime($fecha_hoy . ' + 7 days'));
            $actualizacion_fecha_sancion = mysqli_query($con, "UPDATE usuario_profesores SET razon_sancion = 'Fecha Excedida o Libro Dañado', fecha_fin_sancion = '$fecha_fin_sancion' WHERE id_usuario_profesor = '$id_usuario_profesor'");
          } elseif ($cantidad_sanciones_actualizada == 2) {
            $fecha_fin_sancion = date('Y-m-d', strtotime($fecha_hoy . ' + 14 days'));
            $actualizacion_fecha_sancion = mysqli_query($con, "UPDATE usuario_profesores SET razon_sancion = 'Fecha Excedida o Libro Dañado', fecha_fin_sancion = '$fecha_fin_sancion' WHERE id_usuario_profesor = '$id_usuario_profesor'");
          } elseif ($cantidad_sanciones_actualizada == 3) {
            $fecha_fin_sancion = date('Y-m-d', strtotime($fecha_hoy . ' + 21 days'));
            $actualizacion_fecha_sancion = mysqli_query($con, "UPDATE usuario_profesores SET razon_sancion = 'Fecha Excedida o Libro Dañado', fecha_fin_sancion = '$fecha_fin_sancion' WHERE id_usuario_profesor = '$id_usuario_profesor'");
          } else {
            $fecha_fin_sancion = date('Y-m-d', strtotime($fecha_hoy . ' + 100 years'));
            $actualizacion_sancion = mysqli_query($con, "UPDATE usuario_profesores SET status = 'Vetado', razon_sancion = 'Limite de Sanciones', fecha_fin_sancion = '$fecha_fin_sancion' WHERE id_usuario_profesor = '$id_usuario_profesor'");
          }
        } else {
          header('Location:' . $URL . '../Lista_prestamos_libros.php');
          session_start();
          $_SESSION['error'] = "Error al consultar la cantidad de sanciones actualizada.";
        }
      } else {
        header('Location:' . $URL . '../Lista_prestamos_libros.php');
        session_start();
        $_SESSION['error'] = "Error al actualizar la cantidad de sanciones.";
      }
    } else {
      header('Location:' . $URL . '../Lista_prestamos_libros.php');
      session_start();
      $_SESSION['error'] = "Error al actualizar el estado del profesor.";
    }
  }
  header('Location:' . $URL . '../Lista_prestamos_libros.php');
  session_start();
  $_SESSION['exito'] = "¡Libro devuelto exitosamente!";
} else {
  header('Location:' . $URL . '../Lista_prestamos_libros.php');
  session_start();
  $_SESSION['error'] = "El estado del libro no es igual a 1.";
}

mysqli_close($con);
