<?php
include('../conexion.php');

$id = $_POST['id'];

mysqli_query($con, "DELETE FROM visitantes WHERE idvisitante = '$id'");

$registro = mysqli_query($con, "SELECT * FROM visitantes ORDER BY idvisitante ASC");

echo '<table class="table table-striped table-condensed table-hover table-responsive">
        	<tr>
                <th width="200">Usuario</th>
              <th width="200">Password</th>
              <th width="200">Estado</th>
              <th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				  <td>'.$registro2['usuario'].'</td>
                  <td>'.$registro2['pass'].'</td>
                  <td>'.$registro2['estado'].'</td>
                  <td> <a href="javascript:editarEmpleado('.$registro2['idvisitante'].');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
                  <a href="javascript:eliminarEmpleado('.$registro2['idvisitante'].');">
                  <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
                  </td>
				</tr>';
	}
echo '</table>';
?>