<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>

	<head>
		<title>Validando...</title>
		<meta charset="utf-8">
	</head>
</head>

<body>
	<?php
	include '../admin/conexion.php';
	if (isset($_POST['login'])) {
		$usuario = $_POST['username'];
		$pw = $_POST['password'];
		//$log = mysql_query("SELECT * FROM usuario WHERE usuario='$usuario' AND clave='".sha1($_POST['pw'])."'");
		$log = mysqli_query($con, "SELECT * FROM administrador_biblioteca WHERE user='$usuario' AND pass='" . sha1($pw) . "'");
		if (mysqli_num_rows($log) > 0) {
			$row = mysqli_fetch_array($log);
			$_SESSION["user"] = $row['user'];
			echo 'Iniciando sesión para ' . $_SESSION['user'] . ' <p>';
			//  	header ("Location: ../admin/index.php");
			echo '<script> window.location="../admin/inicio.php"; </script>';
		} else {
			header('Location:' . $URL . '../inicio.php');
			session_start();
			$_SESSION['error'] = "Usuario o contraseña incorrectos";
		}
	}
	?>
</body>

</html>