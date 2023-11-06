<?php
include('../conexion.php');
$dato = $_POST['dato'];

$registro = mysqli_query($con, "SELECT * FROM administrador_biblioteca WHERE user LIKE '%$dato%' ORDER BY id_bibliotecario ASC");
echo '<table class="table table-striped table-condensed table-hover table-responsive">
        	<tr>
                <th width="200">Usuario</th>
            	<th width="200">Contraseña</th>
				<th width="50">Opciones</th>
            </tr>';
if (mysqli_num_rows($registro) > 0) {
	while ($registro2 = mysqli_fetch_array($registro)) {
		echo '<tr>
				<td>' . $registro2['user'] . '</td>
				<td>' . $registro2['pass'] . '</td>
				<td> <a href="javascript:editarEmpleado(' . $registro2['id_bibliotecario'] . ');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
				 <a href="javascript:eliminarEmpleado(' . $registro2['id_bibliotecario'] . ');">
				 <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
				 </td>
				</tr>';
	}
} else {
	echo '<tr><script>
    Swal.fire("No hay resultados que mostrar!")</script></tr>';
}
echo '</table>';
