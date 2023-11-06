<?php
include('../conexion.php');
$dato = $_POST['dato'];

$registro = mysqli_query($con, "SELECT * FROM categorias WHERE nombre_categoria LIKE '%$dato%' ORDER BY id_categoria ASC");
echo '<table class="table table-striped table-condensed table-hover table-responsive">
        	<tr>
                <th width="200">Categoria</th>
				<th width="50">Opciones</th>
            </tr>';
if (mysqli_num_rows($registro) > 0) {
	while ($registro2 = mysqli_fetch_array($registro)) {
		echo '<tr>
				<td>' . $registro2['nombre_categoria'] . '</td>
				<td> <a href="javascript:editarEmpleado(' . $registro2['id_categoria'] . ');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
				 <a href="javascript:eliminarcategoria(' . $registro2['id_categoria'] . ');">
				 <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
				 </td>
				</tr>';
	}
} else {
	echo '<tr><script>
    Swal.fire("No hay resultados que mostrar!")</script></tr>';
}
echo '</table>';
