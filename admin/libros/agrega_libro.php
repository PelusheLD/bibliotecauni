<?php
include('../conexion.php');

$id = $_POST['id-prod'];
$proceso = $_POST['pro'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$nombre = $_POST['nombre'];
$autor = $_POST['autor'];
$cota = $_POST['cota'];
$ejemplares = $_POST['ejemplares'];
$editorial = $_POST['editorial'];
$descripcion = $_POST['descripcion'];
$disponible = $_POST['disponible'];
$circulante = $_POST['circulante'];
$categoria = $_POST['id_categoria'];
$subcategoria = $_POST['id_subcategoria'];
$url_descarga = $_POST['url_descarga'];
$serial = $_POST['serial'];

switch ($proceso) {
  case 'Registro':
    // Verificar si ya existe un libro con la misma cota
    $libroExistente = mysqli_query($con, "SELECT * FROM libros WHERE cota = '$cota'");
    if (mysqli_num_rows($libroExistente) > 0) {
      echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El libro con la cota $cota ya se encuentra registrado!',
            })
            </script>";
    } else {
      $query = "INSERT INTO libros (fecha_ingreso, nombre, autor, cota, ejemplares, editorial, descripcion, disponible, circulante, id_categoria, id_subcategoria, url_descarga, serial) 
                                VALUES ('$fecha_ingreso', '$nombre', '$autor', '$cota', '$ejemplares', '$editorial', '$descripcion', '$disponible', '$circulante', '$categoria', '$subcategoria', '$url_descarga', '$serial')";
      if (mysqli_query($con, $query)) {
        echo "<script>
              Swal.fire({
                  icon: 'success',
                  title: 'Libro registrado',
                  text: 'El libro se ha registrado exitosamente!',
              })
              </script>";
      } else {
        echo "<script>
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'No se pudo registrar el libro.',
              })
              </script>";
      }
    }
    break;

  case 'Edicion':
    $query = "UPDATE libros SET fecha_ingreso = '$fecha_ingreso', nombre = '$nombre', autor = '$autor', cota = '$cota', ejemplares = '$ejemplares', editorial = '$editorial', descripcion = '$descripcion', disponible = '$disponible', circulante = '$circulante', id_categoria = '$categoria', id_subcategoria = '$subcategoria', url_descarga = '$url_descarga', serial = '$serial' WHERE id_libro = '$id'";
    if (mysqli_query($con, $query)) {
      echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Libro Actualizado',
                text: 'El libro se ha actualizado exitosamente!',
            })
            </script>";
    } else {
      echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo actualizar el libro.',
            })
            </script>";
    }
    break;
}

$registro = mysqli_query($con, "SELECT * FROM libros ORDER BY id_libro DESC");

echo '<table class="table table-striped table-condensed table-hover">
    <tr>
        <th width="200">Fecha Ingreso</th>
        <th width="300">Titulo</th>
        <th width="200">Autor</th>
        <th width="200">Cota</th>
        <th width="300">Ejemplares</th>
        <th width="300">Editorial</th>
        <th width="300">Descripcion</th>
        <th width="100">Disponible</th>
        <th width="100">Circulante</th>
        <th width="300">URL Descarga</th>
        <th width="300">Serial</th>
        <th width="50">Opciones</th>
    </tr>';
while ($registro2 = mysqli_fetch_array($registro)) {
  echo '<tr>
        <td>' . $registro2['fecha_ingreso'] . '</td>
        <td>' . $registro2['nombre'] . '</td>
        <td>' . $registro2['autor'] . '</td>
        <td>' . $registro2['cota'] . '</td>
        <td>' . $registro2['ejemplares'] . '</td>
        <td>' . $registro2['editorial'] . '</td>
        <td>' . $registro2['descripcion'] . '</td>
        <td>' . $registro2['disponible'] . '</td>
        <td>' . $registro2['circulante'] . '</td>
        <td>' . $registro2['url_descarga'] . '</td>
        <td>' . $registro2['serial'] . '</td>
        <td>
            <a href="javascript:editarLibro(' . $registro2['id_libro'] . ');" class="glyphicon glyphicon-edit eliminar" title="Editar"></a>
            <a href="javascript:eliminarLibro(' . $registro2['id_libro'] . ');">
                <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" />
            </a>
        </td>
    </tr>';
}
echo '</table>';
