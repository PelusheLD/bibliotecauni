<?php
include('../conexion.php');

$id = $_POST['id'];

mysqli_query($con, "DELETE FROM comentarios WHERE id_comentario = '$id'");

$registro = mysqli_query($con, "SELECT * FROM comentarios ORDER BY id_comentario ASC");

echo '<table class="table table-striped table-condensed table-hover table-responsive">
        	<tr>
        	    <th width="100"></th>
            	<th width="200">Remitente</th>
            	<th width="200">Correo</th>
            	<th width="400">Mensaje</th>
                <th width="200">Fecha Envio</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		        <td></td>
				<td>'.$registro2['remitente'].'</td>
				<td>'.$registro2['correo'].'</td>
				<td>'.$registro2['mensaje'].'</td>
				<td>'.$registro2['fecha'].'</td>
				<td> <a href="javascript:eliminarComentario('.$registro2['id_comentario'].');">
				    <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
				 </td>
				</tr>';
	}
echo '</table>';
?>