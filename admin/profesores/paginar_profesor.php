<?php
include('../conexion.php');
$paginaActual = $_POST['partida'];

$nroProductos = mysqli_num_rows(mysqli_query($con, "SELECT * FROM usuario_profesores"));
$nroLotes = 8;
$nroPaginas = ceil($nroProductos / $nroLotes);
$lista = '';
$tabla = '';

if ($paginaActual > 1) {
    $lista = $lista . '<li><a href="javascript:pagination(' . ($paginaActual - 1) . ');">Anterior</a></li>';
}
for ($i = 1; $i <= $nroPaginas; $i++) {
    if ($i == $paginaActual) {
        $lista = $lista . '<li class="active"><a href="javascript:pagination(' . $i . ');">' . $i . '</a></li>';
    } else {
        $lista = $lista . '<li><a href="javascript:pagination(' . $i . ');">' . $i . '</a></li>';
    }
}
if ($paginaActual < $nroPaginas) {
    $lista = $lista . '<li><a href="javascript:pagination(' . ($paginaActual + 1) . ');">Siguiente</a></li>';
}

if ($paginaActual <= 1) {
    $limit = 0;
} else {
    $limit = $nroLotes * ($paginaActual - 1);
}
$registro = mysqli_query($con, "SELECT * FROM usuario_profesores LIMIT $limit, $nroLotes ");
$tabla = $tabla . '<table class="table table-striped table-condensed table-hover table-responsive">
			       <tr>
              <th width="50">Carnet</th>
              <th width="100">Estudiante</th>
              <th width="100">Apellidos</th>
              <th width="100">Email</th>
              <th width="50">Año</th>
              <th width="100">Carrera</th>
              <th width="100">Opciones</th>
            </tr>';

if (mysqli_num_rows($registro) > 0) {
    while ($registro2 = mysqli_fetch_array($registro)) {
        $tabla = $tabla . '<tr>
        <td>' . $registro2['carnet'] . '</td>
        <td>' . $registro2['nombre'] . '</td>
        <td>' . $registro2['apellidos'] . '</td>
        <td>' . $registro2['email'] . '</td>
        <td>' . $registro2['anio'] . '</td>
        <td>' . $registro2['carrera'] . '</td>
        <td> <a href="javascript:editarEmpleado(' . $registro2['id_usuario_profesor'] . ');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
         <a href="javascript:eliminarEmpleado(' . $registro2['id_usuario_profesor'] . ');">
         <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
         </td>
     </tr>';
    }
} else {
    $tabla = $tabla . '<tr><script>
    Swal.fire("No hay resultados que mostrar!")</script></tr>';
}
$tabla = $tabla . '</table>';



$array = array(
    0 => $tabla,
    1 => $lista
);

echo json_encode($array);
