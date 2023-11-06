<?php
include('../conexion.php');

$id = $_POST['id'];

mysqli_query($con, "DELETE FROM usuario_profesores WHERE id_usuario_profesor = '$id'");

$registro = mysqli_query($con, "SELECT * FROM usuario_profesores ORDER BY id_usuario_profesor ASC");

echo '<table class="table table-striped table-condensed table-hover table-responsive">
        	<tr>
            	 <th width="50">Carnet</th>
            	<th width="100">Estudiante</th>
				<th width="100">Apellidos</th>
				<th width="100">Email</th>
				<th width="50">Año</th>
				<th width="100">Carrera</th>
				<th width="100">Opciones</th>
            </tr>';
while ($registro2 = mysqli_fetch_array($registro)) {
	echo '<tr>
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
echo '</table>';
