<?php
include('../libros/php/conexion.php');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

//COMPROBAMOS QUE LAS FECHAS EXISTAN
if(isset($desde)==false){
	$desde = $hasta;
}

if(isset($hasta)==false){
	$hasta = $desde;
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysqli_query($con, "SELECT * FROM visitas WHERE fecha_visita >= '$desde' AND  <= '$hasta' ORDER BY id_prod ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
          	<th width="200">Fecha de Visita</th>
            	<th width="200">IP </th>
            	<th width="600">Navegador y S.O</th>
            	<th width="200">Pagina Visitada</th>
				<th width="50">Opciones</th>
            </tr>';
if(mysqli_num_rows($registro)>0){
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		<td>'.$registro2['fecha_visita'].'</td>
				<td>'.$registro2['ip'].'</td>
				<td>'.$registro2['navegador'].'</td>
				<td>'.$registro2['pagina'].'</td>
				<td> <a href="javascript:eliminarComentario('.$registro2['utc'].');">
				    <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
				 </td>
				</tr>';
	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>