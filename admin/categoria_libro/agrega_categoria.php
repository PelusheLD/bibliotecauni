
<?php
include('../conexion.php');

$id = $_POST['id-prod'];
$proceso = $_POST['pro'];
$cate = $_POST['nombre'];

switch ($proceso) {
	case 'Registro':
		$cateexistente = mysqli_query($con, "SELECT * FROM categorias WHERE nombre_categoria = '$cate'");
		if (mysqli_num_rows($cateexistente) > 0) {
			echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'La categoria $cate ya se encuentra registrada!',
            })
            </script>";
		} else {
			$query = "INSERT INTO categorias (nombre_categoria) 
                                VALUES ('$cate')";
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
		$query = "UPDATE categorias SET nombre_categoria = '$cate' where id_categoria = '$id'";
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
$registro = mysqli_query($con, "SELECT * FROM categorias ORDER BY id_categoria ASC");

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="200">Categoria</th>
				<th width="50">Opciones</th>
            </tr>';
while ($registro2 = mysqli_fetch_array($registro)) {
	echo '<tr>
				<td>' . $registro2['nombre_categoria'] . '</td>
				<td> <a href="javascript:editarEmpleado(' . $registro2['id_categoria'] . ');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
				 <a href="javascript:eliminarcategoria(' . $registro2['id_categoria'] . ');">
				 <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
				 </td>
				</tr>';
}
echo '</table>';
?>