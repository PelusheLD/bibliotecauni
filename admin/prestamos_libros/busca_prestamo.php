<?php
include('../conexion.php');

$dato = $_POST['dato'];

$registro = mysqli_query($con, "SELECT libros.*, categorias.nombre_categoria FROM libros JOIN categorias ON libros.id_categoria = categorias.id_categoria WHERE libros.nombre LIKE '%$dato%' OR libros.cota LIKE '%$dato%'OR categorias.nombre_categoria LIKE '%$dato%' ORDER BY libros.id_libro ASC") or die(mysqli_error($con));

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="100">Cota</th>
            	<th width="300">Nombre</th>
            	<th width="300">Descripción</th>
            	<th width="100">Disponible</th>
				<th width="100">Ejemplares</th>
            	<th width="300">URL Descarga</th>
				<th width="300">Categoría</th>
				<th width="50">Opciones</th>
				<td></td>
            </tr>';
if (mysqli_num_rows($registro) > 0) {
	while ($registro2 = mysqli_fetch_assoc($registro)) {
		$disponible = $registro2['disponible'];
		$ejemplares = $registro2['ejemplares'];

		echo '<tr';
		switch ($disponible) {
			case "si":
				echo ' style="background:rgba(200,255,200,0.6);"';
				break;
			case "no":
				echo ' style="background:rgba(255,200,200,0.6);"';
				break;
			case "Unico":
				echo ' style="background:rgba(255, 165, 0,0.3);"';
				break;
		}
		echo '>
				<td>' . $registro2['cota'] . '</td>
				<td>' . $registro2['nombre'] . '</td>
				<td>' . $registro2['descripcion'] . '</td>
				<td>' . $registro2['disponible'] . '</td>
				<td>' . $registro2['ejemplares'] . '</td>
				<td>' . $registro2['url_descarga'] . '</td>
				<td>' . $registro2['nombre_categoria'] . '</td>';

		if ($disponible == "si") {
			if ($ejemplares > 1) {
				echo '
	            <td><a href="prestamos_libros/ventana_prestamo.php?id=' . $registro2['id_libro'] . '"><button class="btn btn-primary btn-xs">Prestar</button></a></td>
				<td></td>';
			} else {
				echo '
	            <td><a href="#"><button class="btn btn-warning btn-xs">No hay Ejemplares Disponibles</button></a></td>
				<td></td>';
			}
		} elseif ($disponible == "no") {
			if ($ejemplares > 1) {
				echo '
	            <td><a href="#"><button class="btn btn-warning btn-xs">Libro no Disponible</button></a></td>
				<td></td>';
			}
		} elseif ($disponible == "Unico") {
			echo '
	            <td><a href="#"><button class="btn btn-success btn-xs">No Apto para Prestar</button></a></td>
				<td></td>';
		}

		echo '</tr>';
	}
} else {
	echo '<tr><script>
    Swal.fire("No hay resultados que mostrar!")</script></tr>';
}
echo '</table>';
