
<?php
include('../conexion.php');

$id = $_POST['id-prod'];
$proceso = $_POST['pro'];
$nombre = $_POST['nombre'];
$cedula = $_POST['cédula'];
$email = $_POST['email'];
$prefijo = $_POST['prefijoo'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$provincia = $_POST['provincia'];
$estado = $_POST['estado'];
$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$pais = $_POST['pais'];

switch ($proceso) {
   case 'Registro':
      $visitanteExistente = mysqli_query($con, "SELECT * FROM visitantes WHERE cedula = '$cedula'");
      if (mysqli_num_rows($visitanteExistente) > 0) {
         echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El Visitante con la cedula $cedula ya se encuentra registrado!',
            })
            </script>";
      } else {
         $passEncriptada = password_hash($pass, PASSWORD_DEFAULT);
         $sql = "INSERT INTO visitantes (nombreCompleto, cedula, usuario, pass, email, telefono, prefijo, direccion, provincia, estadoPais, edad, sexo, pais, estado)
            VALUES ('$nombre', '$cedula', '$usuario', '$passEncriptada', '$email', '$telefono','$prefijo','$direccion', '$provincia', '$estado', '$edad', '$sexo', '$pais', '1')";
         if (mysqli_query($con, $sql)) {
            echo "<script>
           Swal.fire({
              icon: 'success',
              title: 'Usuario registrado',
              text: 'El Usuario se ha registrado exitosamente!',
           })
           </script>";
         } else {
            echo "<script>
           Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'No se pudo registrar el Usuario.',
           })
           </script>";
         }
      }
      break;

   case 'Edicion':
      $query = "UPDATE visitantes SET usuario = '$usuario', nombreCompleto ='$nombre', cedula ='$cedula', email ='$email', telefono ='$telefono', prefijo='$prefijo', direccion ='$direccion', provincia ='$provincia', estadoPais ='$estado', edad ='$edad', sexo ='$sexo', pais ='$pais' where idvisitante = '$id'";
      if (mysqli_query($con, $query)) {
         echo "<script>
               Swal.fire({
                  icon: 'success',
                  title: 'Usuario Actualizado',
                  text: 'El Usuario se ha actualizado exitosamente!',
               })
               </script>";
      } else {
         echo "<script>
               Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'No se pudo actualizar el Usuario.',
               })
               </script>";
      }
      break;
}
$registro = mysqli_query($con, "SELECT * FROM visitantes ORDER BY idvisitante ASC");

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
              <th width="200">Usuario</th>
              <th width="200">Password</th>
              <th width="200">Estado</th>
              <th width="50">Opciones</th>
            </tr>';
while ($registro2 = mysqli_fetch_array($registro)) {
   echo '<tr>
				 <td>' . $registro2['usuario'] . '</td>
                  <td>' . $registro2['pass'] . '</td>
                  <td>' . $registro2['estado'] . '</td>
                  <td> <a href="javascript:editarEmpleado(' . $registro2['idvisitante'] . ');" class="glyphicon glyphicon-edit eliminar"     title="Editar"></a>
                  <a href="javascript:eliminarEmpleado(' . $registro2['idvisitante'] . ');">
                  <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
                  </td>
				</tr>';
}
echo '</table>';
?>