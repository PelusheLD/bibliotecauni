<?php
include('../conexion.php');

$id = $_POST['utc'];

mysqli_query($con, "DELETE FROM visitas WHERE utc = '$id'");

$registro = mysqli_query($con, "SELECT * FROM visitas");

echo '<table class="table table-striped table-condensed table-hover table-responsive">
        	<tr>
            	<th width="50"> </th>
               <th width="200">Fecha de Visita</th>
            	<th width="200">IP </th>
            	<th width="600">Navegador y S.O</th>
            	<th width="200">Pagina Visitada</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		        <th width="50"> </th>
				<td>'.$registro2['fecha_visita'].'</td>
				<td>'.$registro2['ip'].'</td>
				<td>'.$registro2['navegador'].'</td>
				<td>'.$registro2['pagina'].'</td>
				</tr>';
	}
echo '</table>';
?>