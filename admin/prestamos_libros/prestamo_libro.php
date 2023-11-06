<?php include "../conexion.php" ?>
<?php

$peticion = ("UPDATE libros SET disponible = 'no' WHERE id_libro = '" . $_GET['id'] . "'");
$resultado = mysqli_query($con, $peticion);
if ($resultado == true) {
  echo '<tr><script>
      Swal.fire("Libro Prestado!")</script></tr>';
  echo '<script> window.location="../prestar_libro.php"; </script>';
} else {
  echo '<tr><script>
  Swal.fire("Error al prestar el libro!")</script></tr>';
}
?>

