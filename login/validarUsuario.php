<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>Validando...</title>
	<meta charset="utf-8">
</head>

<body>
	<?php
	include '../admin/conexion.php';
	if (isset($_SESSION['temp_username']) && isset($_SESSION['temp_password'])) {
		$usuario = $_SESSION['temp_username'];
		$pw = $_SESSION['temp_password'];
		// Eliminar las variables de sesión temporales
		unset($_SESSION['temp_username']);
		unset($_SESSION['temp_password']);
	} else if (isset($_POST['login'])) {
		$usuario = $_POST['username'];
		$pw = $_POST['password'];
	} else {
		// Redirigir al usuario a la página de inicio de sesión si no se proporcionan datos de inicio de sesión
		header('Location:' . $URL . '../index');
		exit();
	}

	$query = "SELECT * FROM visitantes WHERE usuario = '$usuario'";
	$resultado = mysqli_query($con, $query);
	$registro = mysqli_fetch_assoc($resultado);
	$hashAlmacenado = $registro['pass'];

	if (password_verify($pw, $hashAlmacenado)) {
		if ($registro['estado'] == 1) {
			$_SESSION["usuario"] = $usuario;
			$_SESSION["nombreCompleto"] = $registro['nombreCompleto'];
			$_SESSION["email"] = $registro['email'];
			$_SESSION["cedula"] = $registro['cedula'];
			$_SESSION["prefijo"] = $registro['prefijo'];
			$_SESSION["telefono"] = $registro['telefono'];
			$_SESSION["direccion"] = $registro['direccion'];
			$_SESSION["provincia"] = $registro['provincia'];
			$_SESSION["estadoPais"] = $registro['estadoPais'];
			$_SESSION["edad"] = $registro['edad'];
			$_SESSION["sexo"] = $registro['sexo'];
			$_SESSION["pais"] = $registro['pais'];
			echo '<script> window.location="../inicio.php"; </script>';
		} else {
			$_SESSION["temp_username"] = $usuario;
			$_SESSION["temp_password"] = $pw;
			$_SESSION["usuario"] = $usuario;
			$_SESSION["nombreCompleto"] = $registro['nombreCompleto'];
			$_SESSION["email"] = $registro['email'];
			$_SESSION["cedula"] = $registro['cedula'];
			echo '<script> window.location="../verificacion.php"; </script>';
		}
	} else {
		header('Location:' . $URL . '../index');
		session_start();
		$_SESSION['error'] = "Usuario o contraseña incorrectos";
		echo '<script> window.location="../index.php"; </script>';
	}
	?>
</body>

</html>