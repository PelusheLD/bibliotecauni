
<?php
include('../conexion.php');

$id = $_POST['id-prod'];
$proceso = $_POST['pro'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$observaciones = $_POST['observaciones'];
$fecha =date("Y-m-d h:i:s");

switch($proceso){
	case 'Registro': mysqli_query($con, "INSERT INTO suscriptores (nombre_completo, correo, observaciones, fecha_suscripcion) VALUES('$nombre','$correo','$observaciones','$fecha')");
	break;

	case 'Edicion': mysqli_query($con, "UPDATE suscriptores SET nombre_completo = '$nombre', correo = '$correo', observaciones ='$observaciones', fecha_suscripcion = '$fecha' where id_suscriptor = '$id'");
	break;
   }
    $registro = mysqli_query($con, "SELECT * FROM suscriptores ORDER BY id_suscriptor ASC");

    echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
              <th width="200">Nombre Completo</th>
              <th width="200">Correo</th>
              <th width="200">Observaciones</th>
              <th width="200">Fecha Suscripcion</th>
              <th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				 <td>'.$registro2['nombre_completo'].'</td>
                  <td>'.$registro2['correo'].'</td>
                  <td>'.$registro2['observaciones'].'</td>
                  <td>'.$registro2['fecha_suscripcion'].'</td>
                  <td> <a href="javascript:editarEmpleado('.$registro2['id_suscriptor'].');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
                  <a href="javascript:eliminarEmpleado('.$registro2['id_suscriptor'].');">
                  <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
                  </td>
				</tr>';
	}
   echo '</table>';
?>