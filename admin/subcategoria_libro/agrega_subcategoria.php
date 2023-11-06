
<?php
include('../conexion.php');

$id = $_POST['id-prod'];
$proceso = $_POST['pro'];
$subcate = $_POST['nombre'];

switch ($proceso) {
	case 'Registro':
		$scateexistente = mysqli_query($con, "SELECT * FROM subcategorias WHERE nombre_subcategoria = '$subcate'");
		if (mysqli_num_rows($scateexistente) > 0) {
			echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'La categoria $subcate ya se encuentra registrada!',
            })
            </script>";
		} else {
			$query = "INSERT INTO subcategorias (nombre_subcategoria) 
                                VALUES ('$subcate')";
			if (mysqli_query($con, $query)) {
				echo "<script>
				  Swal.fire({
					  icon: 'success',
					  title: 'Categoria registrada',
					  text: 'La Categoria se ha registrado exitosamente!',
				  })
				  </script>";
			} else {
				echo "<script>
				  Swal.fire({
					  icon: 'error',
					  title: 'Error',
					  text: 'No se pudo registrar la Categoria.',
				  })
				  </script>";
			}
		}
		break;

	case 'Edicion':
		$query = "UPDATE subcategorias SET nombre_subcategoria = '$subcate' where id_subcategoria = '$id'";
		if (mysqli_query($con, $query)) {
			echo "<script>
					  Swal.fire({
						  icon: 'success',
						  title: 'Categoria Actualizada',
						  text: 'La Categoria se ha actualizado exitosamente!',
					  })
					  </script>";
		} else {
			echo "<script>
					  Swal.fire({
						  icon: 'error',
						  title: 'Error',
						  text: 'No se pudo actualizar la categoria.',
					  })
					  </script>";
		}
		break;
}
$registro = mysqli_query($con, "SELECT * FROM subcategorias ORDER BY id_subcategoria ASC");

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="200">Subcategoria</th>
				<th width="50">Opciones</th>
            </tr>';
while ($registro2 = mysqli_fetch_array($registro)) {
	echo '<tr>
				<td>' . $registro2['nombre_subcategoria'] . '</td>
				<td> <a href="javascript:editarEmpleado(' . $registro2['id_subcategoria'] . ');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
				 <a href="javascript:eliminarEmpleado(' . $registro2['id_subcategoria'] . ');">
				 <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
				 </td>
				</tr>';
}
echo '</table>';
?>