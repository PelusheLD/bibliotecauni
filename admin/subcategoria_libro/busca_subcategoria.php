<?php
include('../conexion.php');
$dato = $_POST['dato'];

$registro = mysqli_query($con, "SELECT * FROM subcategorias WHERE nombre_subcategoria LIKE '%$dato%' ORDER BY id_subcategoria ASC");
echo '<table class="table table-striped table-condensed table-hover table-responsive">
        	<tr>
                <th width="200">Categoria</th>
				<th width="50">Opciones</th>
            </tr>';
if (mysqli_num_rows($registro) > 0) {
	while ($registro2 = mysqli_fetch_array($registro)) {
		echo '<tr>
				<td>' . $registro2['nombre_subcategoria'] . '</td>
				<td> <a href="javascript:editarEmpleado(' . $registro2['id_subcategoria'] . ');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
				 <a href="javascript:eliminarEmpleado(' . $registro2['id_subcategoria'] . ');">
				 <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
				 </td>
				</tr>';
	}
} else {
	echo '<tr><script>
    Swal.fire("No hay resultados que mostrar!")</script></tr>';
}
echo '</table>';
