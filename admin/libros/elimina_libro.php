<?php
include('../conexion.php');

$id = $_POST['id'];

mysqli_query($con, "DELETE FROM libros WHERE id_libro = '$id'");

$registro = mysqli_query($con, "SELECT * FROM libros ORDER BY id_libro desc");

echo '<table class="table table-striped table-condensed table-hover table-responsive">
        	<tr>
			<th width="200">Fecha Ingreso</th>
            <th width="300">Titulo</th>
            <th width="200">Autor</th>
            <th width="200">Cota</th>
            <th width="300">Ejemplares</th>
            <th width="300">Editorial</th>
            <th width="300">Descripcion</th>
            <th width="100">Disponible</th>
			<th width="100">circulante</th>
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
				<td> <a href="javascript:editarLibro(' . $registro2['id_libro'] . ');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
				 <a href="javascript:eliminarLibro(' . $registro2['id_libro'] . ');">
				 <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
				 </td>
				</tr>';
}
echo '</table>';
