<?php
include('../conexion.php');

$id = $_POST['id'];

mysqli_query($con, "DELETE FROM subcategorias WHERE id_subcategoria = '$id'");

$registro = mysqli_query($con, "SELECT * FROM subcategorias ORDER BY id_subcategoria ASC");

echo '<table class="table table-striped table-condensed table-hover table-responsive">
        	<tr>
            	<th width="200">Categoria</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['nombre_subcategoria'].'</td>
				<td> <a href="javascript:editarEmpleado('.$registro2['id_subcategoria'].');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
				 <a href="javascript:eliminarEmpleado('.$registro2['id_subcategoria'].');">
				 <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
				 </td>
				</tr>';
	}
echo '</table>';
?>