
<?php
include('../conexion.php');

$id = $_POST['id-prod'];
$proceso = $_POST['pro'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$carnet = $_POST['carnet'];
$email = $_POST['email'];
$anio = $_POST['anio'];
$carrera = $_POST['carrera'];
$status = isset($_POST['status']) ? $_POST['status'] : 'OK';


switch ($proceso) {
	case 'Registro':

		$estudianteExistente = mysqli_query($con, "SELECT * FROM usuario_estudiante WHERE carnet = '$carnet'");
		$profesorExistente = mysqli_query($con, "SELECT * FROM usuario_profesores WHERE carnet = '$carnet'");

		if (mysqli_num_rows($estudianteExistente) > 0) {
			echo "<script>
				Swal.fire({
					icon: 'warning',
					title: 'Oops...',
					text: 'El usuario con la Cedula $carnet ya se encuentra registrado!',
				})
				</script>";
		} elseif (mysqli_num_rows($profesorExistente) > 0) {
			echo "<script>
				Swal.fire({
					icon: 'warning',
					title: 'Oops...',
					text: 'El usuario con la Cedula $carnet ya se encuentra registrado como Profesor!',
				})
				</script>";
		} else {
			$query = "INSERT INTO usuario_estudiante (carnet, nombre, apellidos, email, anio, carrera, status) VALUES('$carnet','$nombre','$apellidos',
	                     '$email', '$anio', '$carrera', '$status')";
			if (mysqli_query($con, $query)) {
				echo "<script>
							  Swal.fire({
								  icon: 'success',
								  title: 'Estudiante registrado',
								  text: 'El Estudiante se ha registrado exitosamente!',
							  })
							  </script>";
			} else {
				echo "<script>
							  Swal.fire({
								  icon: 'error',
								  title: 'Error',
								  text: 'No se pudo registrar el Estudiante.',
							  })
							  </script>";
			}
		}
		break;
	case 'Edicion':
		$query = "UPDATE usuario_estudiante SET carnet = '$carnet', nombre = '$nombre', apellidos = '$apellidos',
	                             email = '$email', anio = '$anio', carrera = '$carrera'  WHERE id_usuario_estudiante = '$id'";
		if (mysqli_query($con, $query)) {
			echo "<script>
				  Swal.fire({
					  icon: 'success',
					  title: 'Estudiante Actualizado',
					  text: 'El Estudiante se ha actualizado exitosamente!',
				  })
				  </script>";
		} else {
			echo "<script>
				  Swal.fire({
					  icon: 'error',
					  title: 'Error',
					  text: 'No se pudo actualizar el Estudiante.',
				  })
				  </script>";
		}
		break;
}
$registro = mysqli_query($con, "SELECT * FROM usuario_estudiante ORDER BY id_usuario_estudiante ASC");

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	 <th width="50">Carnet</th>
            	<th width="100">Estudiante</th>
				<th width="100">Apellidos</th>
				<th width="100">Email</th>
				<th width="50">Año</th>
				<th width="100">Carrera</th>
				<th width="100">status</th>
				<th width="100">Opciones</th>
            </tr>';
while ($registro2 = mysqli_fetch_array($registro)) {
	echo '<tr>
				<td>' . $registro2['carnet'] . '</td>
				<td>' . $registro2['nombre'] . '</td>
				<td>' . $registro2['apellidos'] . '</td>
				<td>' . $registro2['email'] . '</td>
				<td>' . $registro2['anio'] . '</td>
				<td>' . $registro2['carrera'] . '</td>
				<td>' . $registro2['status'] . '</td>
				<td> <a href="javascript:editarEmpleado(' . $registro2['id_usuario_estudiante'] . ');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
				 <a href="javascript:eliminarEmpleado(' . $registro2['id_usuario_estudiante'] . ');">
				 <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
				 </td>
				</tr>';
}
echo '</table>';
?>