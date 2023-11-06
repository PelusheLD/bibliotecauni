<?php
session_start();
include("admin/conexion.php");
if (isset($_SESSION['usuario'])) {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="biblioteca virtual UNI">
		<title>Prestamos</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/prettyPhoto.css" rel="stylesheet">
		<link href="css/price-range.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/responsive.css" rel="stylesheet">
		<link rel="shortcut icon" href="images/iconolibreria.jpg">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
	</head>

	<body>
		<!--barra de correo, telefono y login-->
		<?php include('includes/header.php'); ?>
		<!--slider de imagenes-->
		<?php //include ('includes/slider.php');
		?>
		<br>
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<img src="images/prestamos.jpg" width="600" height="300">
				</div>

				<div class="col-md-5">
					<h3>Prestamo de Libros</h3>
					<p>
						Libros para todo el que llegue
					</p>
					<a href="busqueda.php"><button type="submit" class="btn" name="login">Solicitar</button></a>
				</div>
			</div>
		</div>
		<br>
		<br>
		<!--pie de pagina-->
		<?php include('includes/footer.php'); ?>
		<!--Librerias de Jquery, Bootstrap y otras mas-->
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.scrollUp.min.js"></script>
		<script src="js/price-range.js"></script>
		<script src="js/jquery.prettyPhoto.js"></script>
		<script src="js/main.js"></script>
	</body>

	</html>

	<?php include "log.php"; ?>
<?php
} else {
	echo '<script> window.location="index.php"; </script>';
}
?>