<?php
include('../conexion.php');
$paginaActual = $_POST['partida'];

$nroProductos = mysqli_num_rows(mysqli_query($con, "SELECT * FROM subcategorias"));
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
$registro = mysqli_query($con, "SELECT * FROM subcategorias LIMIT $limit, $nroLotes ");
$tabla = $tabla . '<table class="table table-striped table-condensed table-hover table-responsive">
			           <tr>
              <th width="200">Categoria</th>
        <th width="50">Opciones</th>
            </tr>';
if (mysqli_num_rows($registro) > 0) {
    while ($registro2 = mysqli_fetch_array($registro)) {
        $tabla = $tabla . '<tr>
           <td>' . $registro2['nombre_subcategoria'] . '</td>
            <td> <a href="javascript:editarEmpleado(' . $registro2['id_subcategoria'] . ');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
             <a href="javascript:eliminarEmpleado(' . $registro2['id_subcategoria'] . ');">
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
