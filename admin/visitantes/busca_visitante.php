<?php
include('../conexion.php');
$dato = $_POST['dato'];

$registro = mysqli_query($con, "SELECT * FROM visitantes WHERE usuario LIKE '%$dato%' ORDER BY idvisitante ASC");
echo '<table class="table table-striped table-condensed table-hover table-responsive">
        	<tr>
               <th width="200">Usuario</th>
              <th width="200">Password</th>
              <th width="200">Estado</th>
              <th width="50">Opciones</th>
            </tr>';
if(mysqli_num_rows($registro)>0){
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
}else{
	echo '<tr>
				<td colspan="4">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>