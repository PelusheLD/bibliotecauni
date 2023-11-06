<?php include "../conexion.php" ?>
<?php

$peticion = "UPDATE prestamo_libro SET estado=1 WHERE id_prestamo = '" . $_GET['id'] . "'";
$resultado = mysqli_query($con, $peticion);

$peticion2 = "UPDATE libros SET disponible = 'si' WHERE id_libro = '" . $_GET['id'] . "'";
$resultado2 = mysqli_query($con, $peticion2);

echo '<tr><script>
  Swal.fire("No hay resultados que mostrar!")</script></tr>';
echo '<script> window.location="../Lista_prestamos_libros.php"; </script>';
?>
