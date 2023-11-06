<?php
include('../conexion.php');
$dato = $_POST['dato'];

$registro = mysqli_query($con, "SELECT * FROM visitas WHERE pagina LIKE '%$dato%' ORDER BY utc ASC");
echo '<table class="table table-striped table-condensed table-hover table-responsive">
        	<tr> 
        	   <th width="30"> </th>
            	<th width="200">Fecha de Visita</th>
            	<th width="200">IP </th>
            	<th width="600">Navegador y S.O</th>
            	<th width="200">Pagina Visitada</th>
            </tr>';
if(mysqli_num_rows($registro)>0){
	while($registro2 = mysqli_fetch_array($registro)){
		$id=$registro2['utc'];
		echo '<tr>
		       <th width="30"> </th>
				<td>'.$registro2['fecha_visita'].'</td>
				<td>'.$registro2['ip'].'</td>
				<td>'.$registro2['navegador'].'</td>
				<td>'.$registro2['pagina'].'</td>
				</tr>';
	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>